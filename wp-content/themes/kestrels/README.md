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

GitHub builds and deploys the theme with the workflow in `.github/workflows/deploy.yml`.

- A push to `main` deploys to **staging** automatically.
- To deploy to **production**, open the Actions tab, choose "Deploy theme", click "Run workflow" and pick `production`.

Each run installs dependencies, runs `npm run production`, then copies the theme to the server over SSH with `rsync`. It adds and updates theme files but deletes nothing except old built files in `assets/`, so files that exist only on the server (such as field groups saved there) are kept. `.env`, `node_modules`, `.git` and `.claude` are never uploaded.

### One-off setup

1. Create a dedicated key: `ssh-keygen -t ed25519 -f ~/.ssh/kestrels_deploy -C "github-deploy"`. Authorise the public key (`kestrels_deploy.pub`) on the server, then keep the private key out of the project folder. On Krystal, SSH shell access has to be enabled for the account first (Client Area, or ask support), and the key is imported and authorised in cPanel under Security > SSH Access.
2. In GitHub, go to Settings > Environments and create `staging` and `production`. For production, consider adding yourself as a required reviewer.
3. In each environment add these as **six separate secrets**. Each one has its own name and its own value, so don't paste them together into one secret. Use Environment secrets (not Repository secrets, and not Variables):

| Secret | Value |
|---|---|
| `DEPLOY_HOST` | The server's hostname |
| `DEPLOY_USER` | The SSH username |
| `DEPLOY_PATH` | Full path to the theme folder on that server, ending in `/wp-content/themes/kestrels` |
| `DEPLOY_KEY` | The whole private key, including the begin and end lines |
| `DEPLOY_KNOWN_HOSTS` | Output of `ssh-keyscan -p 722 your-host` (check the fingerprint with your host) |
| `DEPLOY_PORT` | Optional. Defaults to 722, which is what Krystal uses |

4. Run the workflow once to staging and check the site before using production.

If the "Check deploy settings" step says `Missing secret DEPLOY_HOST in this environment`, the secret is missing or empty in the environment the run used. Check the names exactly, and that they are Environment secrets in an environment called `staging` or `production`. If "Check the server connection" fails, the login failed, `rsync` is not available in the server's shell, or `DEPLOY_PATH` is wrong. If it says `Shell access is not enabled`, ask the host to enable it.

## Notes

- Page content is built from ACF blocks in `blocks/`. Add new ones with the `/newblock` command in Claude Code.
- Site-wide settings (alert banner, analytics, social links) are on the Theme Options page. Their field group is not stored in the theme, so export it from ACF if you need it in version control.
- See `CLAUDE.md` for the structure, conventions and known gaps, and `CHANGELOG.md` for history.

## Licence and credit

Based on [Origin](https://github.com/marcjenkins/origin) by Marc Jenkins. See `LICENSE`.
