# Kestrels

Custom WordPress theme for the Killamarsh Kestrels website. Built on the Origin starter theme by [Marc Jenkins](https://github.com/marcjenkins/origin), with [Vite](https://vite.dev/) for assets and ACF Pro blocks for content.

## Requirements

- Node.js `^20.19.0 || >=22.12.0` (Node 22 LTS recommended)
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/)
- A local WordPress environment such as [Laravel Valet](https://laravel.com/docs/valet)

## Setup

1. Clone the repository into your WordPress install root (only `wp-content/themes/kestrels` is tracked).
2. `cd wp-content/themes/kestrels && npm install`
3. `cp .env-sample .env` and set the proxy host and SSL paths. Leave out the two SSL lines for plain HTTP.
4. `npm run watch`

## Commands

| Command | What it does |
|---|---|
| `npm run watch` | Builds on change with BrowserSync live reload |
| `npm run development` | One-off build with source maps |
| `npm run production` | Minified build with content-hashed filenames |

BrowserSync proxies your local site and reloads on PHP, CSS and JS changes. Open it at `https://your-host:3000` (or `http://` without SSL).

## Deploying

The compiled `assets/` folder is not in Git. Run `npm run production` and make sure the built files reach the server with the theme. Remove old dev builds first so stale files are not deployed.

## Notes

- Page content is built from ACF blocks in `blocks/`. Add new ones with the `/newblock` command in Claude Code.
- Site-wide settings (alert banner, analytics, social links) are on the Theme Options page. Their field group is not stored in the theme, so export it from ACF if you need it in version control.
- See `CLAUDE.md` for the structure, conventions and known gaps, and `CHANGELOG.md` for history.

## Licence and credit

Based on [Origin](https://github.com/marcjenkins/origin) by Marc Jenkins. See `LICENSE`.
