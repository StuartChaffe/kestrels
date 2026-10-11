# Origin
Origin is a WordPress starter theme using [Vite](https://vite.dev/) to compile assets.

## Requirements
- Node.js `^20.19.0 || >=22.12.0` (Node 22 LTS recommended)
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/)
- [Laravel Valet](https://laravel.com/docs/valet) or similar local environment

## Installation
1. `cd path/to/wp-content/themes`
2. Clone this repo: `git clone git@github.com:16by9/origin.git my-theme`
3. `cd my-theme && npm install`
4. `cp .env-sample .env` and update the proxy and SSL paths
5. Point the theme at a new Git repo: `rm -rf .git`, then follow [GitHub's guide](https://docs.github.com/en/github/importing-your-projects-to-github/adding-an-existing-project-to-github-using-the-command-line)

## Usage
| Command | Description |
|---|---|
| `npm run watch` | Watch mode with BrowserSync live reload |
| `npm run development` | One-off development build with sourcemaps |
| `npm run production` | Production build with minification and content-hashed filenames |

BrowserSync proxies your local site and reloads on PHP, CSS, and JS changes. Access it at `https://your-host:3000` (or `http://` if not using SSL).

## SSL
SSL in watch mode is controlled via `.env`. To disable it, omit the `VITE_HTTPS_KEY` and `VITE_HTTPS_CERT` lines from your `.env` file.

## Recommended plugins
- [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/) — required
- [Site Functionality](https://github.com/marcjenkins/site-functionality) — for CPTs and taxonomies

## Example config files
Head to the [wp-things repo](https://github.com/marcjenkins/wp-things) for `.gitignore` and `.editorconfig` files. Copy them to your project root.
