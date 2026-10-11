import { defineConfig, loadEnv } from 'vite'
import VitePluginBrowserSync from 'vite-plugin-browser-sync'
import path from 'node:path'
import fs from 'node:fs'

function sassGlob() {
    return {
        name: 'vite-sass-glob',
        enforce: 'pre',
        transform(code, id) {
            if (!id.endsWith('.scss')) return
            if (!code.includes('*')) return

            const dir = path.dirname(id)
            const expanded = code.replace(
                /@import\s+['"]([^'"]*\*[^'"]*)['"]/g,
                (_, pattern) => {
                    const files = resolveGlob(dir, pattern)
                    return files
                        .map(f => `@import "${path.relative(dir, f).replace(/\\/g, '/')}";`)
                        .join('\n')
                }
            )

            return expanded !== code ? { code: expanded, map: null } : null
        },
    }
}

function fixCssAssetPaths() {
    return {
        name: 'fix-css-asset-paths',
        generateBundle(_, bundle) {
            for (const chunk of Object.values(bundle)) {
                if (chunk.type !== 'asset') continue
                if (!chunk.fileName.startsWith('css/')) continue
                if (typeof chunk.source !== 'string') continue
                chunk.source = chunk.source
                    // fonts/… or ./fonts/… → ../fonts/…
                    .replace(/url\(\.\/fonts\//g, 'url(../fonts/')
                    .replace(/url\(fonts\//g, 'url(../fonts/')
                    // any path that escapes assets/ and contains /images/ → ../images/
                    .replace(
                        /url\((['"]?)(?:\.\.\/)+(?:[^/'"]+\/)*images\/([^)'"]+)\1\)/g,
                        'url($1../images/$2$1)'
                    )
            }
        },
    }
}

function cleanBuildDirs(dirs) {
    let cleaned = false
    return {
        name: 'clean-build-dirs',
        buildStart() {
            if (cleaned) return
            cleaned = true
            for (const dir of dirs) {
                const target = path.resolve('assets', dir)
                if (fs.existsSync(target)) fs.rmSync(target, { recursive: true })
            }
        },
    }
}

function copyStatic(dirs) {
    return {
        name: 'copy-static',
        closeBundle() {
            for (const dir of dirs) {
                const src = path.resolve('src', dir)
                const dest = path.resolve('assets', dir)
                if (fs.existsSync(src)) fs.cpSync(src, dest, { recursive: true })
            }
        },
    }
}

function resolveGlob(baseDir, pattern) {
    const abs = path.resolve(baseDir, pattern)
    const starIdx = abs.indexOf('*')
    if (starIdx === -1) return [abs]

    const fixed = abs.slice(0, abs.lastIndexOf(path.sep, starIdx) + 1)
    const parts = abs.slice(fixed.length).split(path.sep)

    function walk(dir, remaining) {
        if (!remaining.length) {
            return fs.existsSync(dir) && fs.statSync(dir).isFile() ? [dir] : []
        }
        const [head, ...tail] = remaining
        if (!head.includes('*')) return walk(path.join(dir, head), tail)
        const rx = new RegExp('^' + head.replace(/\./g, '\\.').replace(/\*/g, '.*') + '$')
        const out = []
        try {
            for (const entry of fs.readdirSync(dir)) {
                if (rx.test(entry)) out.push(...walk(path.join(dir, entry), tail))
            }
        } catch {}
        return out.sort()
    }

    return walk(fixed, parts)
}

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '')

    return {
        plugins: [
            cleanBuildDirs(['css', 'js']),
            sassGlob(),
            fixCssAssetPaths(),
            copyStatic(['fonts', 'images']),
            VitePluginBrowserSync({
                buildWatch: {
                    enable: true,
                    bs: {
                        proxy: env.VITE_PROXY,
                        host: env.VITE_HOST,
                        open: false,
                        logLevel: 'silent',
                        ...(env.VITE_HTTPS_KEY && env.VITE_HTTPS_CERT ? {
                            https: {
                                key: env.VITE_HTTPS_KEY,
                                cert: env.VITE_HTTPS_CERT,
                            }
                        } : {}),
                        files: [
                            'assets/css/*.css',
                            'assets/js/*.js',
                            '*.php',
                            '*/*.php',
                        ],
                    },
                },
            }),
        ],
        css: {
            preprocessorOptions: {
                scss: {
                    silenceDeprecations: ['import', 'global-builtin'],
                },
            },
        },
        base: './',
        build: {
            outDir: 'assets',
            emptyOutDir: false,
            manifest: true,
            sourcemap: mode !== 'production',
            rollupOptions: {
                input: {
                    scripts: 'src/js/scripts.js',
                    editor: 'src/js/editor.js',
                    styles: 'src/styles/styles.scss',
                    'editor-style': 'src/styles/editor-style.scss',
                },
                output: {
                    entryFileNames: mode === 'production' ? 'js/[name]-[hash].js' : 'js/[name].js',
                    chunkFileNames: mode === 'production' ? 'js/[name]-[hash].js' : 'js/[name].js',
                    assetFileNames: ({ name }) => {
                        if (name?.endsWith('.css')) return mode === 'production' ? 'css/[name]-[hash][extname]' : 'css/[name][extname]'
                        if (name?.match(/\.(woff2?|woff|ttf|otf|eot)$/i)) return 'fonts/[name][extname]'
                        if (name?.match(/\.(svg|png|jpe?g|gif|webp|avif|ico)$/i)) return 'images/[name][extname]'
                        return '[name]-[hash][extname]'
                    },
                },
            },
        },
    }
})
