<?php
/**
 * Zoe Dao-Kroeker Custom Theme — inc/acf-fields.php
 *
 * One ACF field group per page template (Home / Research / Work / About),
 * registered as local PHP so the field definitions live in git alongside the
 * templates that render them, rather than only in the database. Structure
 * and copy are drawn from
 * Website/zoe_dao_kroeker_wireframes_with_content.html.
 *
 * Gutenberg is off for this site (Admin and Site Enhancements →
 * disable_gutenberg_for: post/page/portfolio) and ACF Pro is active, so this
 * is the intended content-editing surface: Zoe edits structured fields in
 * wp-admin, the page template controls layout/markup.
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

// ── Site Settings (options page) ────────────────────────────────────────
// Footer links (email, LinkedIn, Instagram, résumé) so Zoe/Lara can update
// them from wp-admin instead of editing footer.php.
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( [
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'zoe-site-settings',
        'capability' => 'manage_options',
        'redirect'   => false,
    ] );
}

acf_add_local_field_group( [
    'key'      => 'group_zoe_site_options',
    'title'    => 'Site Settings',
    'fields'   => [
        [ 'key' => 'field_zso_contact_email', 'label' => 'Contact email', 'name' => 'contact_email', 'type' => 'email' ],
        [ 'key' => 'field_zso_linkedin_url', 'label' => 'LinkedIn URL', 'name' => 'linkedin_url', 'type' => 'url' ],
        [ 'key' => 'field_zso_instagram_url', 'label' => 'Instagram URL', 'name' => 'instagram_url', 'type' => 'url' ],
        [
            'key'           => 'field_zso_resume_url',
            'label'         => 'Résumé URL',
            'name'          => 'resume_url',
            'type'          => 'url',
            'instructions'  => 'Link to the hosted résumé PDF. Leave blank to hide the Résumé link in the footer and nav.',
        ],
    ],
    'location' => [
        [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'zoe-site-settings' ] ],
    ],
] );

// ── Shared sub-field shapes ─────────────────────────────────────────────

function zoe_acf_cta_subfields( $key_prefix ) {
    return [
        [
            'key'   => $key_prefix . '_label',
            'label' => 'Label',
            'name'  => 'label',
            'type'  => 'text',
        ],
        [
            'key'   => $key_prefix . '_url',
            'label' => 'URL',
            'name'  => 'url',
            'type'  => 'url',
        ],
    ];
}

function zoe_acf_cta_field( $key, $name, $label = 'CTA' ) {
    return [
        'key'        => $key,
        'label'      => $label,
        'name'       => $name,
        'type'       => 'group',
        'sub_fields' => zoe_acf_cta_subfields( $key . '_sub' ),
    ];
}

function zoe_acf_card_subfields( $key_prefix, $with_description = true ) {
    $fields = [
        [
            'key'   => $key_prefix . '_tag',
            'label' => 'Tag',
            'name'  => 'tag',
            'type'  => 'text',
        ],
        [
            'key'   => $key_prefix . '_title',
            'label' => 'Title',
            'name'  => 'title',
            'type'  => 'text',
        ],
    ];
    if ( $with_description ) {
        $fields[] = [
            'key'   => $key_prefix . '_description',
            'label' => 'Description',
            'name'  => 'description',
            'type'  => 'textarea',
            'rows'  => 2,
        ];
    }
    return $fields;
}

// ── Home ─────────────────────────────────────────────────────────────────

acf_add_local_field_group( [
    'key'      => 'group_zoe_home',
    'title'    => 'Home Page Content',
    'fields'   => [
        [ 'key' => 'field_zh_hero_tab', 'label' => 'Hero', 'type' => 'tab' ],
        [ 'key' => 'field_zh_hero_eyebrow', 'label' => 'Eyebrow', 'name' => 'hero_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zh_hero_heading', 'label' => 'Heading', 'name' => 'hero_heading', 'type' => 'text' ],
        [ 'key' => 'field_zh_hero_intro', 'label' => 'Intro', 'name' => 'hero_intro', 'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_zh_hero_image', 'label' => 'Hero image', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array' ],
        zoe_acf_cta_field( 'field_zh_hero_cta_primary', 'hero_cta_primary', 'Primary CTA' ),
        zoe_acf_cta_field( 'field_zh_hero_cta_secondary', 'hero_cta_secondary', 'Secondary CTA' ),

        [ 'key' => 'field_zh_stats_tab', 'label' => 'Stat bar', 'type' => 'tab' ],
        [
            'key'          => 'field_zh_stats',
            'label'        => 'Stats',
            'name'         => 'stats',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Add stat',
            'sub_fields'   => [
                [ 'key' => 'field_zh_stat_number', 'label' => 'Number', 'name' => 'number', 'type' => 'text' ],
                [ 'key' => 'field_zh_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
            ],
        ],

        [ 'key' => 'field_zh_research_tab', 'label' => 'Research teaser', 'type' => 'tab' ],
        [ 'key' => 'field_zh_research_eyebrow', 'label' => 'Eyebrow', 'name' => 'research_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zh_research_heading', 'label' => 'Heading', 'name' => 'research_heading', 'type' => 'text' ],
        [ 'key' => 'field_zh_research_intro', 'label' => 'Intro', 'name' => 'research_intro', 'type' => 'textarea', 'rows' => 3 ],
        zoe_acf_cta_field( 'field_zh_research_cta_primary', 'research_cta_primary', 'Primary CTA' ),
        zoe_acf_cta_field( 'field_zh_research_cta_secondary', 'research_cta_secondary', 'Secondary CTA' ),

        [ 'key' => 'field_zh_work_tab', 'label' => 'Selected work', 'type' => 'tab' ],
        [ 'key' => 'field_zh_work_eyebrow', 'label' => 'Eyebrow', 'name' => 'work_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zh_work_heading', 'label' => 'Heading', 'name' => 'work_heading', 'type' => 'text' ],
        [ 'key' => 'field_zh_work_intro', 'label' => 'Intro', 'name' => 'work_intro', 'type' => 'textarea', 'rows' => 2 ],
        [
            'key'          => 'field_zh_work_cards',
            'label'        => 'Cards',
            'name'         => 'work_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_zh_work_card' ),
        ],

        [ 'key' => 'field_zh_process_tab', 'label' => 'How I work', 'type' => 'tab' ],
        [ 'key' => 'field_zh_process_eyebrow', 'label' => 'Eyebrow', 'name' => 'process_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zh_process_heading', 'label' => 'Heading', 'name' => 'process_heading', 'type' => 'text' ],
        [
            'key'          => 'field_zh_process_steps',
            'label'        => 'Steps',
            'name'         => 'process_steps',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add step',
            'sub_fields'   => [
                [ 'key' => 'field_zh_step_kicker', 'label' => 'Kicker', 'name' => 'kicker', 'type' => 'text' ],
                [ 'key' => 'field_zh_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
                [ 'key' => 'field_zh_step_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2 ],
            ],
        ],
    ],
    'location' => [
        [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-home.php' ] ],
    ],
] );

// ── Research ─────────────────────────────────────────────────────────────

acf_add_local_field_group( [
    'key'      => 'group_zoe_research',
    'title'    => 'Research Page Content',
    'fields'   => [
        [ 'key' => 'field_zr_hero_tab', 'label' => 'Hero', 'type' => 'tab' ],
        [ 'key' => 'field_zr_hero_eyebrow', 'label' => 'Eyebrow', 'name' => 'hero_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zr_hero_heading', 'label' => 'Heading', 'name' => 'hero_heading', 'type' => 'text' ],
        [ 'key' => 'field_zr_hero_intro', 'label' => 'Intro', 'name' => 'hero_intro', 'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_zr_hero_image', 'label' => 'Hero image', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array' ],
        zoe_acf_cta_field( 'field_zr_hero_cta_primary', 'hero_cta_primary', 'Primary CTA' ),
        zoe_acf_cta_field( 'field_zr_hero_cta_secondary', 'hero_cta_secondary', 'Secondary CTA' ),

        [ 'key' => 'field_zr_stats_tab', 'label' => 'Stat bar', 'type' => 'tab' ],
        [
            'key'          => 'field_zr_stats',
            'label'        => 'Stats',
            'name'         => 'stats',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Add stat',
            'sub_fields'   => [
                [ 'key' => 'field_zr_stat_number', 'label' => 'Number', 'name' => 'number', 'type' => 'text' ],
                [ 'key' => 'field_zr_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
            ],
        ],

        [ 'key' => 'field_zr_problem_tab', 'label' => 'The problem', 'type' => 'tab' ],
        [ 'key' => 'field_zr_problem_eyebrow', 'label' => 'Eyebrow', 'name' => 'problem_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zr_problem_heading', 'label' => 'Heading', 'name' => 'problem_heading', 'type' => 'text' ],
        [ 'key' => 'field_zr_problem_body', 'label' => 'Body', 'name' => 'problem_body', 'type' => 'wysiwyg', 'media_upload' => 0, 'toolbar' => 'basic' ],
        [ 'key' => 'field_zr_problem_question', 'label' => 'Field question', 'name' => 'problem_field_question', 'type' => 'text' ],

        [ 'key' => 'field_zr_framework_tab', 'label' => 'The framework', 'type' => 'tab' ],
        [ 'key' => 'field_zr_framework_eyebrow', 'label' => 'Eyebrow', 'name' => 'framework_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zr_framework_heading', 'label' => 'Heading', 'name' => 'framework_heading', 'type' => 'text' ],
        [ 'key' => 'field_zr_framework_intro', 'label' => 'Intro', 'name' => 'framework_intro', 'type' => 'textarea', 'rows' => 2 ],
        [
            'key'          => 'field_zr_framework_steps',
            'label'        => 'Steps (Projects / Passion / Peers)',
            'name'         => 'framework_steps',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add step',
            'sub_fields'   => [
                [ 'key' => 'field_zr_fw_step_kicker', 'label' => 'Kicker', 'name' => 'kicker', 'type' => 'text' ],
                [ 'key' => 'field_zr_fw_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
                [ 'key' => 'field_zr_fw_step_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2 ],
            ],
        ],
        [
            'key'          => 'field_zr_framework_cards',
            'label'        => 'Cards (Play / Design principle)',
            'name'         => 'framework_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_zr_fw_card' ),
        ],

        [ 'key' => 'field_zr_findings_tab', 'label' => 'Findings', 'type' => 'tab' ],
        [ 'key' => 'field_zr_findings_eyebrow', 'label' => 'Eyebrow', 'name' => 'findings_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zr_findings_heading', 'label' => 'Heading', 'name' => 'findings_heading', 'type' => 'text' ],
        [
            'key'          => 'field_zr_findings_cards',
            'label'        => 'Cards (Worked / Needs work)',
            'name'         => 'findings_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_zr_find_card' ),
        ],

        [ 'key' => 'field_zr_matters_tab', 'label' => 'Why it matters', 'type' => 'tab' ],
        [ 'key' => 'field_zr_matters_eyebrow', 'label' => 'Eyebrow', 'name' => 'matters_eyebrow', 'type' => 'text' ],
        [
            'key'          => 'field_zr_matters_cards',
            'label'        => 'Cards (Theoretical / Methodological / Practical)',
            'name'         => 'matters_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_zr_matters_card' ),
        ],
    ],
    'location' => [
        [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-research.php' ] ],
    ],
] );

// ── Work ─────────────────────────────────────────────────────────────────

acf_add_local_field_group( [
    'key'      => 'group_zoe_work',
    'title'    => 'Work Page Content',
    'fields'   => [
        [ 'key' => 'field_zw_intro_tab', 'label' => 'Intro', 'type' => 'tab' ],
        [ 'key' => 'field_zw_intro_eyebrow', 'label' => 'Eyebrow', 'name' => 'intro_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zw_intro_heading', 'label' => 'Heading', 'name' => 'intro_heading', 'type' => 'text' ],
        [ 'key' => 'field_zw_intro_text', 'label' => 'Text', 'name' => 'intro_text', 'type' => 'textarea', 'rows' => 2 ],

        [ 'key' => 'field_zw_featured_tab', 'label' => 'Featured (AI literacy)', 'type' => 'tab' ],
        [ 'key' => 'field_zw_featured_eyebrow', 'label' => 'Eyebrow', 'name' => 'featured_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_zw_featured_title', 'label' => 'Title', 'name' => 'featured_title', 'type' => 'text' ],
        [ 'key' => 'field_zw_featured_description', 'label' => 'Description', 'name' => 'featured_description', 'type' => 'textarea', 'rows' => 2 ],
        zoe_acf_cta_field( 'field_zw_featured_cta_primary', 'featured_cta_primary', 'Primary CTA' ),
        zoe_acf_cta_field( 'field_zw_featured_cta_secondary', 'featured_cta_secondary', 'Secondary CTA' ),

        [ 'key' => 'field_zw_stem_tab', 'label' => 'STEM curriculum & kits', 'type' => 'tab' ],
        [ 'key' => 'field_zw_stem_eyebrow', 'label' => 'Eyebrow', 'name' => 'stem_eyebrow', 'type' => 'text' ],
        [
            'key'          => 'field_zw_stem_cards',
            'label'        => 'Cards',
            'name'         => 'stem_cards',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_zw_stem_card', false ),
        ],

        [ 'key' => 'field_zw_learning_tab', 'label' => 'Learning design & guides', 'type' => 'tab' ],
        [ 'key' => 'field_zw_learning_eyebrow', 'label' => 'Eyebrow', 'name' => 'learning_eyebrow', 'type' => 'text' ],
        [
            'key'          => 'field_zw_learning_cards',
            'label'        => 'Cards',
            'name'         => 'learning_cards',
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_zw_learning_card', false ),
        ],
    ],
    'location' => [
        [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-work.php' ] ],
    ],
] );

// ── About ────────────────────────────────────────────────────────────────

acf_add_local_field_group( [
    'key'      => 'group_zoe_about',
    'title'    => 'About Page Content',
    'fields'   => [
        [ 'key' => 'field_za_hero_tab', 'label' => 'Hero', 'type' => 'tab' ],
        [ 'key' => 'field_za_hero_eyebrow', 'label' => 'Eyebrow', 'name' => 'hero_eyebrow', 'type' => 'text' ],
        [ 'key' => 'field_za_hero_heading', 'label' => 'Heading', 'name' => 'hero_heading', 'type' => 'text' ],
        [ 'key' => 'field_za_hero_intro', 'label' => 'Intro', 'name' => 'hero_intro', 'type' => 'textarea', 'rows' => 3 ],
        [ 'key' => 'field_za_hero_image', 'label' => 'Portrait', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array' ],

        [ 'key' => 'field_za_background_tab', 'label' => 'Background', 'type' => 'tab' ],
        [ 'key' => 'field_za_background_eyebrow', 'label' => 'Eyebrow', 'name' => 'background_eyebrow', 'type' => 'text' ],
        [
            'key'          => 'field_za_background_blocks',
            'label'        => 'Blocks (Education / Experience / Technical)',
            'name'         => 'background_blocks',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add block',
            'sub_fields'   => [
                [ 'key' => 'field_za_bg_kicker', 'label' => 'Kicker', 'name' => 'kicker', 'type' => 'text' ],
                [ 'key' => 'field_za_bg_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
                [ 'key' => 'field_za_bg_body', 'label' => 'Body', 'name' => 'body', 'type' => 'wysiwyg', 'media_upload' => 0, 'toolbar' => 'basic' ],
            ],
        ],

        [ 'key' => 'field_za_publications_tab', 'label' => 'Publications & awards', 'type' => 'tab' ],
        [ 'key' => 'field_za_publications_eyebrow', 'label' => 'Eyebrow', 'name' => 'publications_eyebrow', 'type' => 'text' ],
        [
            'key'          => 'field_za_publications_cards',
            'label'        => 'Cards',
            'name'         => 'publications_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_za_pub_card' ),
        ],

        [ 'key' => 'field_za_facilitation_tab', 'label' => 'Facilitation & community', 'type' => 'tab' ],
        [ 'key' => 'field_za_facilitation_eyebrow', 'label' => 'Eyebrow', 'name' => 'facilitation_eyebrow', 'type' => 'text' ],
        [
            'key'          => 'field_za_facilitation_cards',
            'label'        => 'Cards',
            'name'         => 'facilitation_cards',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add card',
            'sub_fields'   => zoe_acf_card_subfields( 'field_za_fac_card' ),
        ],

        [ 'key' => 'field_za_closing_tab', 'label' => 'Closing', 'type' => 'tab' ],
        [ 'key' => 'field_za_closing_heading', 'label' => 'Heading', 'name' => 'closing_heading', 'type' => 'text' ],
        [ 'key' => 'field_za_closing_text', 'label' => 'Text', 'name' => 'closing_text', 'type' => 'textarea', 'rows' => 2 ],
        zoe_acf_cta_field( 'field_za_closing_cta_primary', 'closing_cta_primary', 'Primary CTA' ),
        zoe_acf_cta_field( 'field_za_closing_cta_secondary', 'closing_cta_secondary', 'Secondary CTA' ),
    ],
    'location' => [
        [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ] ],
    ],
] );
