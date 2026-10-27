# Changelog

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

## 2026-10-26

### Added
- `.main--blocks` rule in `_layout.scss` — a `<main>` wrapper for block-built pages that adds the landmark without changing layout (rebuild assets to apply)
- Self-hosted fonts: DM Sans (variable, with optical size) and Instrument Serif in `src/fonts/`, declared in `src/styles/base/_fonts.scss`, with their licences
- `kestrels_preload_fonts()` in `lib/enqueue.php` — preloads regular DM Sans in the `<head>`
- GitHub Actions deploy workflow (`.github/workflows/deploy.yml`): builds on every push to `main`, deploys to staging automatically and to production by manual run, using `rsync` over SSH

### Changed
- Renamed the starter to Kestrels: theme name, package name, `origin_` function prefix and `'origin'` text domain are now `kestrels`; `.env-sample` and repository links updated
- `CLAUDE.md` and `README.md` rewritten for this project, including known gaps and deployment notes
- `.claude/commands/newblock.md` — WYSIWYG output now uses `wp_kses_post`
- `package-lock.json` is now tracked and the root `.gitignore` allows `.github/`, both needed by the deploy workflow

### Removed
- Google Fonts `<link>` tags from `header.php` — the site no longer makes requests to Google for fonts

### Fixed
- Builds now clear `assets/fonts` and `assets/images` as well as `css` and `js`, so renamed fonts and images no longer pile up in `assets/`
- Skip link has a target on every template: `page.php`, `single.php`, archives, search and 404 now wrap content in `<main id="content">`
- One `<h1>` per template: pages still get theirs from the Page Header block, and post titles in lists are `h2`
- `esc_url( the_permalink() )` replaced with `esc_url( get_permalink() )`, and title attributes use `the_title_attribute()`
- Single post date uses `get_the_date()` and drops the obsolete `pubdate` attribute

## 2026-05-15

### Added
- Image Gallery block — Swiper carousel with navigation arrows (hover-only) and pagination dots; ACF repeater field for slides (image + caption); editor preview shows first slide only via CSS
- `vite_asset_css()` helper and `vite_get_manifest()` shared manifest cache — enqueues CSS files extracted from JS entry points (e.g. Swiper CSS imported via `import 'swiper/css'`); fixes #91
- Per-block ACF JSON — field group JSON now lives in `blocks/{slug}/acf-json/` alongside its block; `acf/settings/load_json` adds all block folders as load paths; `acf/update_field_group` routes saves to the correct block folder automatically; closes #81

### Changed
- `blocks/register.php` — added `GLOB_ONLYDIR` flag and `file_exists('block.json')` guard to skip non-block subdirectories safely
- `enqueue.php` — `vite_asset()` refactored to use shared `vite_get_manifest()` so the manifest JSON is parsed only once per request
- Gutenberg editor block alignment — added `margin: auto` to `.wp-block` (blocks were left-aligned due to missing centring); ACF blocks now get `max-width: none` via `[data-type^="acf/"]` rule
- `editor-style.scss` — added `layout/layout` import so `.container` styles are available in the block editor

### Removed
- Cookie alert — `partials/global-cookie-notice.php`, `src/js/components/cookie.js`, `.cookie-alert` SCSS, and `get_template_part` call in `footer.php`

## 2026-05-14

### Fixed
- Auto reload triggering incorrectly after build directory clean

## 2026-05-13

### Added
- `theme.json` — block editor colour palette, layout sizes, spacing and typography controls; replaces deprecated PHP `add_theme_support` calls. Closes #55
- `lib/comments.php` — disables comments site-wide: filters, post type support, admin menu, admin bar node, and a 403 block on direct `wp-comments-post.php` requests. Closes #89
- `.skip-nav` styles in `_header.scss` — hidden off-screen by default, slides into view on `:focus`
- `BEM_Nav_Walker` class in `lib/menus.php` — custom walker accepting a BEM prefix; outputs clean `primary-nav__item`, `primary-nav__link` etc. classes with `--current`, `--ancestor`, `--parent` modifiers and `aria-current="page"` on active links; sub-menus use `__sub-menu`, `__sub-item`, `__sub-link`
- Primary nav styles in `_primary-nav.scss` — flex layout, reversed text colour, `aria-current="page"]` underline
- `cleanBuildDirs` Vite plugin — wipes `assets/css/` and `assets/js/` at build start to prevent stale hashed files accumulating (replaces the broader `emptyOutDir`)
- Site logo in `partials/site-header.php` — `<img>` from `assets/images/logo.svg` with empty `alt` and `aria-label="Home"` on the wrapping link; sized via `.site-header__logo img` in `_header.scss`

### Changed
- `partials/site-header.php` — both `wp_nav_menu` calls updated with `BEM_Nav_Walker`, `container => false`, and `items_wrap` without an `id` attribute; desktop uses `primary-nav` prefix, mobile uses `mobile-nav`
- `header.php` — removed `screen-reader-text` class from skip link (now styled directly via `.skip-nav`)

### Changed
- `lib/theme-setup.php` — replaced stale WP 6.3 `render_block` filter removals with `add_theme_support('disable-layout-styles')`; added `wp_shortlink_wp_head` and `wp_resource_hints` to head cleanup; added XML-RPC disable, asset version string stripping, and frontend style dequeues (`wp-block-library`, `classic-theme-styles`, `dashicons`, `wp-img-auto-sizes-contain`); added `should_load_separate_core_block_assets` filter to prevent per-block stylesheets bypassing the dequeue
- `lib/gutenberg.php` — removed deprecated `disable-custom-colors`, `disable-custom-gradients`, and `editor-color-palette` calls (moved to `theme.json`); removed dead `origin_deregister_styles`; renamed script handle `be-editor` → `origin-editor`
- `lib/acf.php` — `add_action` → `add_filter` for `acf/settings/save_json` (return value was previously ignored); removed unused `$child` variable
- `lib/images.php` — `update_option` calls moved from `after_setup_theme` (ran on every request) to `after_switch_theme` (runs once on activation)
- `lib/menus.php` — `register_nav_menus` wrapped in `after_setup_theme`; removed commented secondary menu
- `lib/helpers.php` — fixed `$post->$pid` variable property bug in `is_tree()`; `xlink:href` → `href` in `get_icon()`; removed dead `origin_display_post_blocks` referencing undefined `origin_pp()`
- `lib/env-indicator.php` — inline CSS now only output on `wp_head` when admin bar is showing; previously leaked to all logged-out visitors
- `header.php` — added `language_attributes()`, dropped IE conditional comment, added `wp_body_open()` after opening `<body>`; `get_template_part()` calls updated to use array-based slug arguments
- Social links moved to `partials/social-links.php` and loaded via `get_template_part()`
- Global options tidied up

### Removed
- SVG sprite — no longer bundled via Vite; `get_icon()` helper updated to reference `href` directly

## 2026-05-12

### Added
- Accordion block: optional title field renders an `<h2>` heading above the items
- Accordion block: optional "Show all" / "Close all" toggle button (ACF true/false field), scoped per block instance
- `src/styles/components/_block-heading.scss` — flex layout component for headings with right-aligned action buttons
- Page Header block with ACF fields for title (text), description (textarea), and button (link); primary colour background, reversed text, container wrapper
- Content Block using ACF inner blocks (`<InnerBlocks>`) — no ACF fields; allows heading, paragraph, list, image, and `acf/quote-block` as inner blocks
- `/newblock` Claude Code skill (`.claude/commands/newblock.md`) — scaffolds block.json, PHP template, SCSS, and ACF JSON for a new ACF block from a prompt

### Changed
- Accordion block rewritten to use native `<details>`/`<summary>` — fully functional without JS; JS handles URL hash opening and show/close all only
- Accordion block updated to ACF block version 3
- `vite build` now clears `assets/` before each build (`emptyOutDir: true`) — prevents stale hashed files accumulating
- `_buttons.scss` rewritten with CSS custom property architecture — `btn`, `btn--secondary`, `btn--outline`, `btn--link` variants; variables for bg, color, border, radius, hover, and focus-visible outline
- `_variables.scss` — added `--color-{primary,secondary,tertiary,quaternary}-darker` for button hover states
- `.btn-group` flex container added to `_buttons.scss` for spacing button sets
- `_content.scss` — link styles narrowed to `a:not(.btn)` to prevent `.content` overriding button text-decoration
- `_forms.scss` — removed old inline button styling from `input[type="submit/reset/button"]`; submit/reset keep `display: block`, centering helper, and `cursor: pointer`
- Pattern library buttons section updated: added `btn--secondary`, `btn--outline`, `btn--link`, `<button>`, and `<input type="button">` examples wrapped in `.btn-group`

### Fixed
- Editor styles not loading in block editor — `add_editor_style()` now receives a theme-relative path, preventing a failed server-side `wp_remote_get()` against the local SSL URL
- `cookie.js` crashing with `Cannot read properties of null` on pages without a cookie banner
- `unsupported-browsers.js` crashing with a null reference on pages without the unsupported browser element

## 2026-05-11

### Changed
- Node.js requirement updated to `^20.19.0 || >=22.12.0` (Node 22 LTS recommended)
- Migrated build system from Laravel Mix to Vite 8 with content-hashed filenames
- Replaced `mix()` PHP helper with `vite_asset()` reading from `assets/.vite/manifest.json`
- Renamed `.env` variables from `MIX_` to `VITE_` prefix
- Block SCSS files now require explicit imports in `styles.scss` and `editor-style.scss`
- SSL in BrowserSync now controlled via `.env` — omit `VITE_HTTPS_KEY`/`VITE_HTTPS_CERT` for non-HTTPS development
- BrowserSync auto-open disabled (`open: false`) and URL output silenced (`logLevel: 'silent'`) — access via `https://origin.test:3000` directly
- `watch` script now sets `NODE_OPTIONS=--no-deprecation` to suppress `util._extend` warning from BrowserSync internals

### Fixed
- Content hash placeholder corrected from webpack syntax `[contenthash:8]` to Rollup/Vite `[hash]` — output files were being named literally as `styles-[contenthash:8].css`
- Leading whitespace in `.env` file prevented `VITE_HOST` and other variables from loading

### Removed
- Gravity Forms helpers from `lib/vendors.php` (custom validation message, footer JS loading)
