# Zoe Dao-Kroeker Custom Theme
# Version 0.1.0 — Last updated: August 24, 2026

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

## Status — what's real vs. still open

**Updated August 24, 2026.** Content architecture (Phase 2), header/footer (Phase 3), and a full
brand + Design Guidelines pass are done and live on staging. Real brand colours (two greens,
a yellow CTA, LKI's grey ramp borrowed by Lara's explicit instruction), Zoe's real logo, and a
token/CSS system structurally copied from `larakroekerinteractive.com/design-guidelines/` are all
in place — see `/design-guidelines/` on staging for the self-checking colour/type/spacing record.

| | State |
|---|---|
| Folder name, repo shape, git history | ✅ Real. Pushed to `github.com/Zoe-Dao-Kroeker/zoe-website` |
| `style.css` header (Theme Name, Text Domain, etc.) | ✅ Real |
| `functions.php` | ✅ Real. Registers `primary` nav menu location, custom logo support, noindex for the guidelines/icon-library templates; requires `inc/acf-fields.php` and `inc/template-helpers.php` |
| `inc/acf-fields.php` | ✅ Real. One ACF field group per page template (Home/Research/Work/About) plus a Site Settings options page (email, LinkedIn, Instagram, résumé) |
| `inc/template-helpers.php` | ✅ Real. `zoe_cta()` renders the real `.btn-pill`/`.btn-outline`/`.btn-ghost` markup (copied from LKI's guidelines page), `zoe_external_link_atts()` |
| `header.php` | ✅ Real. Real logo (falls back to text wordmark if unset) + `wp_nav_menu()` against the `primary` location |
| `footer.php` | ✅ Real. Email/LinkedIn/Instagram/Résumé/Media Kit + copyright — social links source from the Site Settings options page, LinkedIn/Instagram still blank pending real URLs |
| `front-page.php` | ❌ **Deleted.** Was entirely Mel's one-pager; the new Home page is a regular Page on `page-home.php` |
| `page-home.php`, `page-research.php`, `page-work.php`, `page-about.php` | ✅ Real. Content is ACF fields, not hardcoded — populated from `Website/zoe_dao_kroeker_wireframes_with_content.html` |
| `page-design-guidelines.php` | ✅ Real. Mirrors LKI's guidelines page section-for-section (Foundation/Logo/Photography/Icons/Colour/Type/Spacing/Buttons), self-checking swatches via live `getComputedStyle()`, noindexed, footer-linked as "Media Kit" |
| `page-icon-library.php` | ✅ Real. Globs `assets-icons/System Icons/` at render time — never a hardcoded list — with a client-side name filter |
| `assets-icons/System Icons/` | ✅ Real. Full Phosphor Light set, 1,512 icons, MIT licensed, shallow-cloned per the design guidelines playbook |
| `zoe.css` | ✅ Real brand CSS — `.container`/`.eyebrow`/`.btn-pill`/`.btn-outline`/`.btn-ghost`/`.card` copied class-for-class from LKI's guidelines page, plus the site's own nav/hero/card/process/footer layout, all reading the role-layer tokens below |
| `colors_and_type.css` | ✅ Real brand tokens. Primitive → role architecture copied from LKI exactly; Zoe's own primitives: greens `#8CB120`/`#05704E`, surface `#042E33`, CTA `#F5CE12` (+derived dark/light states), LKI's grey ramp reused verbatim per Lara's instruction, plus additional/semantic colours. Type is LKI's exact system: Inter, Instrument Serif, JetBrains Mono |
| `search.php` / `searchform.php` | ✅ Real (text domain updated, no brand content) |
| `home.php`, `single-post.php`, `archive.php`, `page.php`, `404.php`, `index.php` | ✅ Real, brand-agnostic — carried no Mel references to begin with |
| `screenshot.jpg` | ✅ Real — a photo of Zoe, replacing Mel's |
| `.gitignore` | ✅ Real. The `.github/workflows/deploy-staging.yml` that used to sit beside it was **deleted August 30, 2026**: it never ran successfully once, never had repository secrets, and targeted staging — which is the authoring environment, not a deploy target. See "Deploying" below |

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

**Staging is where this site is authored.** Content, pages, and layout are edited directly on
`https://stg-zoedaokroeker-staging.kinsta.cloud/`, and Lara pushes staging → live by hand through
MyKinsta. Live is never edited directly.

**This repo still owns every PHP and CSS file**, because Novamira cannot write them: both
`novamira/write-file` and `novamira/edit-file` refuse `*.php` outside
`wp-content/novamira-sandbox/`. Any change to `functions.php`, a page template, or `zoe.css` must
be made here and shipped as a zip (see "Deploying"). Editing those on the server is not something
the tooling permits — it is a hard limit, not a preference.

### Cache-busting will be manual and load-bearing, same as every theme in this workspace

**Bump `ZOE_STYLE_VER` in `functions.php` on every `zoe.css` change**, and keep the theme
`Version` in `style.css` in step. Browsers and Kinsta's CDN cache by `?ver=` query string, not
file content — confirmed failure mode on both LKI and Mel.

### Token discipline, once real tokens exist

Once a `Design Guidelines/colors_and_type.css` exists for Zoe, this folder's copy must stay
byte-identical to it (same discipline as Mel and Loc). Right now there is no canonical source —
this copy **is** Mel's file, not a divergence from one.

### Deploying

**There is no CI. Deploys are manual, in two hops.**

**Hop 1 — repo → staging**, for PHP/CSS changes only:

1. Confirm the target first: `novamira/execute-php` → `home_url()` must return the staging host.
2. `git archive --format=zip -o <zip> HEAD`, then **delete `README.md` and `.gitignore` from the
   zip before uploading** — see the warning below. Off Google Drive this takes minutes, not
   seconds; run it in the background.

   ```bash
   git archive --format=zip -o theme.zip HEAD && zip -d theme.zip README.md .gitignore
   ```
3. `novamira/create-upload-link`. Uploads are confined to the web root, so use an unguessable
   filename and move the zip out of the web root server-side before extracting.
4. Verify `hash_file('sha256', ...)` against the local zip **before** extracting. Abort on mismatch.
5. `ZipArchive::extractTo()` over the theme directory, then delete the zip.

Extraction overwrites and adds — it never deletes. That is deliberate: the server can legitimately
hold files this repo does not. **Never deploy this theme with `rsync --delete`.**

⚠️ **Never ship this README to a server.** Everything in the theme directory is served
publicly: `wp-content/themes/zoe-theme/README.md` returned HTTP 200 to anonymous requests on both
staging and live until August 30, 2026, when it was deleted from staging. This file documents the
deploy procedure, the staging host, and the Novamira setup — none of which belongs on a public
portfolio site. It is documentation for whoever works in this repo, not a theme asset. Dotfiles
are already blocked (403) and directory listing is off, so `README.md` is the one tracked file
that needs excluding by hand.

The copy on live is still public and will clear on the next MyKinsta staging → live push.

**Hop 2 — staging → live:** Lara pushes the environment through MyKinsta by hand. This copies
content, plugins, and theme wholesale, which is how the Novamira plugin ended up active on
production.

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
