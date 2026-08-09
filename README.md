# Zoe Dao-Kroeker Custom Theme
# Version 0.1.0 — Last updated: August 9, 2026

A **custom standalone WordPress theme** for Zoe Dao-Kroeker. No parent theme, no page builder,
no build step. Hand-written PHP templates plus two stylesheets — once written.

🔴 **This is a folder-structure scaffold, not a built theme.** It was cloned from
`Mel-lif-lu-ous/Website/mel-theme` on August 9, 2026: file names, the theme header, the enqueue
pattern, and the template-routing approach are real. Almost everything else — `front-page.php`,
`footer.php`'s CTA and social links, `zoe.css`'s actual rules, `colors_and_type.css`'s palette,
and the two helper functions in `functions.php` — is still Mel's content, left in place and
flagged with 🔴 banners rather than silently relabelled. See **Status** below before assuming
anything here works for Zoe.

- Status and tasks: `../ZOE-website-status.md`
- Workspace rules: `../../../WORKSPACE-file-management.md`
- **Donor reference — read before touching Mel-derived code:** `mel-theme`'s own README at
  `../../../Mel-lif-lu-ous/Website/mel-theme/README.md`. It documents the real, live version of
  everything this scaffold copied, including a "Gotchas already paid for" section.
- No `ZOE-folder-structure-and-rules.md` or `ZOE-workflow.md` yet — both are open tasks in
  `ZOE-website-status.md`.

---

## Status — what's real vs. still Mel's

| | State |
|---|---|
| Folder name, repo shape, git history | ✅ Real. Fresh local repo, no Mel history carried over |
| `style.css` header (Theme Name, Text Domain, etc.) | ✅ Real |
| `functions.php` — theme supports, enqueue, cache-busting constant | ✅ Real pattern, generic |
| `functions.php` — `mel_residency_posts()` / `mel_bandcamp_embed()` | 🔴 Mel's content logic. Left unrenamed on purpose so they read as obviously foreign. Delete once `front-page.php` is rebuilt |
| `header.php` — wordmark, structure | ✅ Wordmark renamed. Nav is still Mel's anchor-based one-pager nav (🔴 see banner in the file) |
| `footer.php` | 🔴 Entirely Mel's: the "Listen" CTA and the Instagram/Bandcamp/Spotify/Apple Music social row are Mel's real links |
| `front-page.php` | 🔴 Entirely Mel's one-pager (hero slideshow, three album sections). Zoe's site is 8 pages + posts + a `portfolio` CPT, not a one-pager |
| `zoe.css` (renamed from `mel.css`) | 🔴 Every rule is still Mel's |
| `colors_and_type.css` | 🔴 Mel's actual palette and `--qp-*` prefix. Zoe has no brand tokens on record — this is a placeholder, not a decision |
| `search.php` / `searchform.php` | ✅ Real (text domain updated, no brand content) |
| `home.php`, `single-post.php`, `archive.php`, `page.php`, `404.php`, `index.php` | ✅ Real, brand-agnostic — carried no Mel references to begin with |
| `screenshot.jpg` | 🔴 Still Mel's photo. Needs a real capture once there's something to capture |
| `.github/workflows/deploy-staging.yml`, `.gitignore` | ✅ Real, generic (secrets-driven, no hardcoded paths) |

---

## What kind of theme this is

| | |
|---|---|
| Type | **Standalone custom theme** |
| Parent theme | **none.** No `Template:` line in `style.css` |
| Page builder | none |
| Build step | none |
| CSS | plain CSS with custom properties |
| JS | vanilla, inline in `footer.php` |
| Template routing | WordPress's own hierarchy. **No `template_include` filter** — though Zoe's `all-porfolio` category typo may need one; see `ZOE-website-status.md` |

---

## Files

### Configuration

| File | What it does |
|---|---|
| `style.css` | Theme header only. **Contains no CSS** |
| `functions.php` | Enqueue, `add_theme_support()` calls, nav body-class, two 🔴 Mel helpers pending replacement |

### Styles

| File | What it does |
|---|---|
| `colors_and_type.css` | Design tokens. 🔴 Currently Mel's, `--qp-` prefix |
| `zoe.css` | Everything else. 🔴 Currently Mel's, ~1,040 lines |

### Templates

| File | Handles |
|---|---|
| `front-page.php` | 🔴 Mel's one-pager — needs a full rebuild for Zoe's 8-page model |
| `home.php` | Posts index |
| `single-post.php` | A single post |
| `archive.php` | Category, tag, date and author archives |
| `page.php` | Static pages |
| `search.php` / `searchform.php` | Search |
| `404.php` | Not found. Returns a real 404 status |
| `index.php` | Universal fallback, delegates to `archive.php` |
| `header.php` / `footer.php` | The shell — 🔴 nav and footer content still Mel's |

**Not created, on purpose:** `category.php`, `tag.php`, `date.php`, `author.php` (all covered by
`archive.php`), `sidebar.php`, `comments.php`. Zoe's content model may also need
`archive-portfolio.php` / `single-portfolio.php` if the `portfolio` CPT turns out to be the real
portfolio source rather than categorised posts — see the open question in `ZOE-website-status.md`.

---

## Before building real content

Open decisions this scaffold deliberately did not guess at (all from `ZOE-website-status.md`):

- Keep the current Elementor look, or redesign?
- Any existing brand material — colours, fonts, logo?
- Token prefix (`--zoe-*`, matching the `--lki-*` / partial `--loc-*` pattern)?
- `portfolio` CPT vs. categorised posts — which is the real portfolio source?
- What to do about the `all-porfolio` category slug typo, given it's presumably in live URLs

None of these block having the folder structure in place, which is what this scaffold is.

---

## Working on this theme

### Editing

Local is the source of truth: `Zoe Dao-Kroeker/Website/zoe-theme/`. Edit here, then deploy.

### Cache-busting will be manual and load-bearing, same as every theme in this workspace

**Bump `ZOE_STYLE_VER` in `functions.php` on every `zoe.css` change**, and keep the theme
`Version` in `style.css` in step. Browsers and Kinsta's CDN cache by `?ver=` query string, not
file content — confirmed failure mode on both LKI and Mel.

### Token discipline, once real tokens exist

Once a `Design Guidelines/colors_and_type.css` exists for Zoe, this folder's copy must stay
byte-identical to it (same discipline as Mel and Loc). Right now there is no canonical source —
this copy **is** Mel's file, not a divergence from one.

### Deploying

🔴 **Blocked.** No Novamira connection and no staging environment confirmed yet for Zoe's site —
see `ZOE-website-status.md` → "🔴 Blocking: no connection to this site". Do not write anything to
a live or staging server until that's resolved and `home_url()` is confirmed.

---

## Gotchas to carry over from Mel and Loc (not yet hit here, but will be)

Full detail lives in `mel-theme/README.md` → "Gotchas already paid for" and
`WORKSPACE-file-management.md` → "Global Open Issues". Short version:

- **Activating the theme is not enough** if pages still carry `_wp_page_template =
  elementor_header_footer` — check that meta on every page during migration
- **Elementor's Default Kit beats theme CSS on specificity** until Elementor is deactivated
- **The `ul, ol { list-style: none }` reset in `zoe.css` strips bullets from real prose** unless
  restored inside `.post-content` / `.body-copy` / `.page-content`. Already present in the copied
  CSS (inherited fixed, not broken) — verify it's still there once `zoe.css` gets rewritten
- **`wp_get_theme()` caches headers within a request** — call `wp_clean_themes_cache( true )` or
  check in a fresh request after editing `style.css`
- **Kinsta caches `/wp-json/` as HTML for 24 hours** — append `?cb=$RANDOM` when diagnosing REST

---

## Provenance

Cloned from `Mel-lif-lu-ous/Website/mel-theme` (August 9, 2026), which is the workspace's
designated donor for new sites: no other brand's variable names, correct stylesheet load order,
every template resolved natively. Copied as folder structure and naming only — content, tokens,
and the front-page rebuild are separate, later work. Git history was **not** carried over; this
is a fresh local repo with one commit.

`Loc Dao/Website/loc-theme/` used the same donor first and is a second reference point for what
a full rebuild from Mel looks like (its README's "Provenance" section documents the token
remap and content swap it went through).
