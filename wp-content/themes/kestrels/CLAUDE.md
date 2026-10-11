# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Origin is a WordPress starter theme using Vite 8 for asset compilation. It's designed for use with Laravel Valet.

## Build Commands

All commands run from the theme directory (`wp-content/themes/origin/`):

```bash
npm run watch         # Watch mode with BrowserSync live reload at localhost:3000
npm run production    # Production build with minification and content-hashed filenames
npm run development   # Development build (no watch, includes sourcemaps)
```

## Architecture

### Directory Structure

```
wp-content/themes/origin/
├── src/
│   ├── js/scripts.js           # JS entry point → assets/js/scripts-[hash].js
│   ├── styles/styles.scss      # Main CSS entry → assets/css/styles-[hash].css
│   └── styles/editor-style.scss # Block editor styles → assets/css/editor-style-[hash].css
├── lib/                        # PHP modules (loaded by functions.php)
│   ├── theme-setup.php         # Theme support, head cleanup
│   ├── images.php              # Image sizes
│   ├── enqueue.php             # Asset loading
│   ├── gutenberg.php           # Block editor config
│   ├── menus.php               # Menu registration
│   ├── acf.php                 # ACF options pages, JSON sync
│   ├── vendors.php             # Third-party integrations
│   ├── helpers.php             # Utility functions
│   └── env-indicator.php       # Staging/production admin indicator
├── blocks/                     # ACF blocks (auto-registered)
│   └── register.php            # Scans blocks/ subdirs and registers via block.json
├── partials/                   # Reusable template parts
├── acf-json/                   # ACF field group exports (auto-synced)
└── assets/                     # Compiled output (do not edit directly)
```

### Key Patterns

- **Modular PHP**: `functions.php` loads feature files from `lib/`
- **ACF Blocks**: Add `block.json` + template in `blocks/block-name/` for auto-registration
- **Asset versioning**: Use `vite_asset('src/path/file.scss')` helper — reads `assets/.vite/manifest.json` and returns the hashed URL
- **Block SCSS**: Add explicit `@import` to both `styles.scss` and `editor-style.scss` when adding a new block with styles (glob imports are not used)
- **SVG icons**: Use `get_icon('name')` helper for sprite references

### SCSS Organization

ITCSS-inspired: settings → variables → utilities → base → components → layout → media

### JavaScript Components

ES6 modules in `src/js/components/` imported via `src/js/scripts.js`

## Dependencies

- **Required**: Advanced Custom Fields Pro
- **Optional**: Gravity Forms, site-functionality plugin (for CPTs), custom-blocks plugin

## Environment Setup

Requires Node.js `^20.19.0 || >=22.12.0` (Vite 8 requirement). Use Node 22 LTS recommended.

1. `npm install`
2. `cp .env-sample .env` and configure proxy/SSL paths
3. `npm run watch`

For non-SSL development, omit the `VITE_HTTPS_KEY` and `VITE_HTTPS_CERT` lines from `.env`.
