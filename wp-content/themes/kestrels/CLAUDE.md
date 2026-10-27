# CLAUDE.md

Guidance for Claude Code (and anyone else) working in this theme.

## Project overview

Custom WordPress theme for the Killamarsh Kestrels website. It started from the Origin starter theme by Marc Jenkins and uses Vite 8 for SCSS and JavaScript, with ACF Pro blocks for page content. Repository: `StuartChaffe/kestrels`.

- The Git repository root is the WordPress install root. Only `wp-content/themes/kestrels` is tracked; WordPress core, uploads and plugins are ignored.
- Required plugin: Advanced Custom Fields Pro. WP Migrate DB Pro is also installed.
- Run every command below from `wp-content/themes/kestrels/`.

## Commands

```bash
npm install           # first time only (needs Node ^20.19.0 || >=22.12.0)
npm run watch         # build on change, BrowserSync live reload at localhost:3000
npm run development   # one-off build, unhashed filenames, source maps
npm run production    # minified build with content-hashed filenames
```

Local setup: copy `.env-sample` to `.env` and set `VITE_PROXY`, `VITE_HOST` and the SSL paths (omit the two SSL lines for plain HTTP). `.env` is git-ignored; never commit it.

## Compiled assets

`assets/` is build output and is git-ignored, so it never reaches a server through Git. GitHub Actions builds it and deploys the theme (see `README.md` > Deploying): a push to `main` goes to staging, and production is a manual run. Edit `src/`, never `assets/`.

Each build starts by clearing `assets/css`, `assets/js`, `assets/fonts` and `assets/images`, so renamed or deleted source files do not linger. In `npm run watch` this happens once at start-up, so restart it after renaming files. Dev builds leave unhashed files and source maps. Deploys always run a fresh `npm run production`.

## Structure

```
src/js/scripts.js            entry point, imports src/js/components/*
src/js/editor.js             block editor script
src/styles/styles.scss       front-end styles
src/styles/editor-style.scss block editor styles
lib/                         PHP modules, loaded by functions.php
blocks/                      ACF blocks, one folder each (block.json, template, scss, acf-json)
partials/                    template parts (header, footer, alert, analytics, social links)
assets/                      compiled output (git-ignored)
```

Blocks: `accordion`, `content-block`, `image-gallery`, `page-header`, `page-links`. `blocks/register.php` registers every folder that has a `block.json`.

## Conventions

- Function prefix `kestrels_`, text domain `kestrels`.
- Indentation is tabs, with 4 spaces for JSON (see `.editorconfig`).
- Styles follow ITCSS order (settings, variables, utilities, base, layout, components, blocks). Block SCSS is picked up automatically by the `@import "../../blocks/*/*.scss"` glob in both `styles.scss` and `editor-style.scss`.
- Assets are enqueued through `vite_asset()` and `vite_asset_css()`, which read `assets/.vite/manifest.json`.
- New blocks: use the `/newblock` command. ACF field groups save into the block's own `acf-json/` folder.
- Escape output at the point of use: `esc_html`, `esc_attr`, `esc_url`, `wp_kses_post` for rich text.
- Fonts are self-hosted: files live in `src/fonts/` (SIL Open Font Licence, licences alongside), are declared in `src/styles/base/_fonts.scss` and are copied to `assets/fonts/` by the build. Latin subset only; add a subset and its `@font-face` if you need more characters. Regular DM Sans is preloaded in `lib/enqueue.php`; the other files load on demand.
- Commit `package-lock.json`: the deploy workflow uses `npm ci`, which needs it.
- Record notable changes in `CHANGELOG.md` (the `/changelog` command does this).

## Templates and layout

- Every template wraps its content in `<main id="content">`; the skip link in `header.php` points to `#content`.
- `page.php` and `single.php` use `<main id="content" class="main--blocks">`. The `.main--blocks` rule in `src/styles/layout/_layout.scss` keeps blocks full width and constrains loose content, because the site's layout CSS targets direct children of `.global-container`.
- Each page needs exactly one `<h1>`. On pages it comes from the Page Header block, and `page.php` adds none of its own, so a page without that block has no `<h1>`.

## Content that lives in the database

The Theme Options page (alert banner, analytics embed code, social links, unsupported-browser notice) is created in `lib/acf.php`, but its field group is not saved in `acf-json/`. The fields exist only in the database, so a fresh install will not have them until the group is exported.

## Known gaps

- The Content Block's allowed-blocks list names blocks that do not exist (`acf/team`, `acf/faqs`, `acf/logos` and others); only `acf/image-gallery` is built.
- `sidebar.php` and `searchform.php` are not used by any template, and the `footer` menu location is registered but never output.
- `lib/roles.php` gives editors Gravity Forms capabilities, but Gravity Forms is not installed.
- Rich-text ACF fields (accordion body, alert text, browser notice) are echoed without `wp_kses_post`.
- SVG uploads are allowed for administrators without sanitising.
- On single posts the `<article>` is excluded from the container width rules, so check how long post content looks.
- `style.css` version and the changelog are updated by hand.
