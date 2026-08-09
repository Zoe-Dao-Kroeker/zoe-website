# Mel·lif·lu·ous Custom Theme
# Version 1.8.0 — Last updated: August 9, 2026

A **custom standalone WordPress theme** for Mel·lif·lu·ous. No parent theme, no page builder, no
build step. Hand-written PHP templates plus two stylesheets.

🚀 **Live on `mel-lif-lu-ous.com` since August 9, 2026.** Treat it as a real site: `git push`
deploys to **staging only**, and promoting to live is a separate manual step in MyKinsta.

- **How to work on this: `../MEL-workflow.md`**
- Project rules: `../../MEL-folder-structure-and-rules.md`
- To-do, all folders: `../../MEL-Todo.md`
- Status and detail: `../MEL-website-status.md`
- Workspace rules: `../../../WORKSPACE-file-management.md`

---

## What kind of theme this is

| | |
|---|---|
| Type | **Standalone custom theme** (converted from a child theme August 8, 2026) |
| Parent theme | **none.** No `Template:` line in `style.css` |
| Page builder | none. Elementor was deactivated August 7, 2026 |
| Build step | none |
| CSS | plain CSS with custom properties |
| JS | vanilla, inline in `footer.php` |
| Template routing | WordPress's own hierarchy. **No `template_include` filter** |

**This theme is the donor for future sites.** As of August 8, 2026 it carries no other brand's
variable names, has correct stylesheet load order, and resolves every template natively. Zoe
Dao-Kroeker and Forge & Spark should be built from this structure. `Loc Dao/Website/loc-theme/`
was the first to use it.

---

## Files

### Configuration

| File | What it does |
|---|---|
| `style.css` | Theme header only. **Contains no CSS** |
| `functions.php` | Enqueue, 8 `add_theme_support()` calls, nav body-class, two helpers |

### Styles

| File | What it does |
|---|---|
| `colors_and_type.css` | **All design tokens**, `--qp-` prefix. Byte-identical copy of `../../Design Guidelines/colors_and_type.css` |
| `mel.css` | Everything else. ~890 lines, banner-commented by section |

### Templates (12)

| File | Handles |
|---|---|
| `front-page.php` | The one-pager: hero, listen strip, three album sections, about, writing |
| `home.php` | Posts index |
| `single-post.php` | A single post. Featured image gives a dark hero |
| `archive.php` | Category, tag, date and author archives |
| `page.php` | Static pages |
| `search.php` / `searchform.php` | Search |
| `404.php` | Not found. Returns a real 404 status |
| `index.php` | Universal fallback, delegates to `archive.php` |
| `header.php` / `footer.php` | The shell |

**Not created, on purpose:** `category.php`, `tag.php`, `date.php`, `author.php` (all covered by
`archive.php`), `sidebar.php`, `comments.php`.

---

## Content model: categories drive the one-pager

Content is queried, never hardcoded, so new posts appear without touching code.

| Category | Slug | Posts | Section |
|---|---|---|---|
| Japan 2025 | `japan-2025` | 20 | Wildroot & Amber |
| iceland 2023 | `iceland-2023` | 14 | Spákonufell |
| Musings | `musings` | 6 | Writing |

🔴 **The categories are already correct on the site. Never re-tag them.**

Talking to the Trees has no residency category, so that section shows the album alone.

---

## Two things worth understanding before editing

### Bandcamp players are real iframes, lazy-loaded

`mel_bandcamp_embed()` in `functions.php` renders the actual Bandcamp iframe, so the tracklist
and play controls are visible on arrival. This **replaced an earlier click-to-load facade** on
Lara's instruction (August 9, 2026) — if you find a doc claiming zero iframes on page load,
that doc is stale.

`loading="lazy"` keeps the cost off the initial load: each player is fetched as it nears the
viewport, so the top of the page paints without waiting on three third-party embeds. `linkcol`
is Mel's brand forest `4d7a5c`, not Bandcamp's default green.

⚠️ **Height is per-album and must be passed in.** Bandcamp's large player does not reflow, so
it needs an exact pixel height or it scrolls internally / leaves dead space. **Do not calculate
it from the track count** — observed: 4 tracks is 588, 5 tracks is 588, 8 tracks is 720. There
is a floor and the growth above it is not per-track. Copy the height out of the embed code
Bandcamp generates for that specific album.

### The hero is an eleven-image slideshow

`$hero_slides` in `front-page.php` holds the attachment IDs; the handler is in `footer.php`.

Only slide 0 ships a real `src` (with `fetchpriority="high"`); the rest carry `data-src` and are
given a `src` one slide ahead of being shown. **`loading="lazy"` would not help here** — every
slide is absolutely positioned inside the viewport, so the browser treats all eleven as urgent
and downloads ~3.9 MB of photographs before the page settles. The deferral is the whole point.

It pauses when the hero scrolls out of view and when the tab is hidden, and
`prefers-reduced-motion` gets slide 0 and no cycling.

### Images are referenced by attachment ID, never by URL

Several filenames in the media library contain a **zero-width character**
(`Wildroot-Amber<ZWSP>-Featured-Image`). A hardcoded URL would break in ways invisible in an
editor. `front-page.php` uses IDs and lets WordPress build the URL.

---

## Working on this theme

### Editing

Local is the source of truth: `Mel-lif-lu-ous/Website/mel-theme/`. Edit here, then deploy.

### ⚠️ Cache-busting is manual and load-bearing

**Bump `MEL_STYLE_VER` in `functions.php` on every `mel.css` change.** Browsers and Kinsta's CDN
cache by `?ver=` query string, not by file content. Confirmed failure on LKI, August 3, 2026: CSS
uploaded correctly and rendered stale until the version bumped.

Keep the theme `Version` in `style.css` in step with it.

### ⚠️ Token discipline

`../../Design Guidelines/colors_and_type.css` is the source of truth. This folder's copy must
stay **byte-identical**.

**Never hand-edit the copy here.** Edit the canonical file, copy it over, verify:

```bash
diff "Design Guidelines/colors_and_type.css" "Website/mel-theme/colors_and_type.css"
```

`mel.css` must never redefine anything the token file owns (`--qp-*`, `--font-*`, `--fw-*`,
`--radius-*`, `--sp-*`, `--sz-*`, `--type-*`, `--ls-*`, `--ease-std`, `--dur-*`). It loads second
and would silently win. Verified clean: 67 `var()` references all resolve, zero redefinitions.

### Deploying

Via Novamira MCP (`novamira-mel`) writing to
`/www/larakroekercom_798/public/wp-content/themes/`.

🔴 **Confirm `home_url()` before any server write.** The Kinsta nicknames are crossed between
brands: Mel is `larakroekercom_798`, LKI is `larakroekermusic_621`.

The GitHub Actions pipeline (`.github/workflows/deploy-staging.yml`) is live and confirmed
working as of August 8, 2026: push to `main` and it deploys via `rsync -avz --delete` against
`KINSTA_THEME_PATH` (currently `.../themes/mel-theme`) in 10-15 seconds. Two real lessons from
getting it running the first time:

- The `KINSTA_SSH_HOST`, `KINSTA_SSH_PORT`, and `KINSTA_SSH_USERNAME` secrets set up in May 2026
  were stale. Get current values from MyKinsta → the site → **Info** tab → **Primary SFTP/SSH
  user** card, not from the account-wide SSH Keys page (that page lists authorized public keys,
  not the server address)
- `--delete` removes anything on the server that isn't tracked in this repo. It already claimed
  one file this way: a `screenshot.jpg` written directly to the server via Novamira, outside git.
  **Anything meant to persist has to be committed here, not just written to the live server.**

---

## Gotchas already paid for

Each of these cost real time. They are recorded so they cost nothing next time.

**Removing `Template:` from `style.css` does not make a theme standalone.** WordPress stores the
parent in the **`template` option** in the database. Edit the file and WordPress keeps loading
the old parent's stylesheets, which looks exactly like the change failed. Re-activate with
`switch_theme()`, then verify `get_option('template') === get_option('stylesheet')`.

**`wp_get_theme()` returns cached headers within a request.** After writing a new `style.css`,
call `wp_clean_themes_cache( true )` or check in a fresh request, or you will read the old values
and think nothing happened.

**Elementor's page template silently bypassed `front-page.php`.** Pages carried
`_wp_page_template = elementor_header_footer`, routing them to Elementor's own template. The
custom `header.php` still rendered, so it looked half-working rather than overridden. Check
`_wp_page_template` on every page during a migration.

**Elementor's Default Kit beat theme CSS on specificity**, turning the brand forest CTA salmon.

**The global `ul, ol { list-style: none }` reset stripped bullets from post content.** Right for
nav, wrong for writing: a materials list rendered as loose lines. Markers are now restored for
`.post-content` / `.body-copy` / `.page-content` and explicitly kept off `.post-list`,
`.nav__links` and `.footer__nav`, which are lists only semantically. **`lki-child` still has this
bug.**

**Kinsta caches `/wp-json/` as HTML for 24 hours.** Append `?cb=$RANDOM` and check
`cf-cache-status` / `x-kinsta-cache` before concluding anything about REST routing.

---

## Design status

The **structure** is finished. The **design is Lara's** and in progress.

- Tokens, type scale, spacing, components: real, from the design guidelines
- Layout and section order: real
- **Copy: Lara's own**, as of August 9, 2026 (hero, About, and the three album blurbs)
- **Hero lead contrast** is the weakest thing on the page: cream at 72% over a bright photo,
  and now over eleven rotating photos rather than one, so it varies shot to shot
- `body` background is pure white `#ffffff` while the canvas token is `#f5f5f5`. Inherited from
  LKI's structure, where white body plus `.sec--neutral` bands gave the rhythm. Worth revisiting

---

## Provenance

Cloned from `lki-child` (August 7, 2026), then stripped to Mel: 236 lines of LKI-only CSS
removed, buttons rebuilt at 8px radius, type rebuilt (Newsreader display, Inter structural),
84 `--lki-*` token references rewritten to canonical `--qp-*` with the alias layer deleted,
converted to standalone with Hello Elementor dropped, and renamed `mel-child` → `mel-theme`.

Full detail is in the `mel-website` git history.
