<?php

/**
 * Extend the Editor role with capabilities commonly needed on client sites.
 *
 * Capabilities are stored in the database; has_cap() guards prevent a DB write
 * on every request once the capability is already set.
 */
add_action('init', function () {
    $editor = get_role('editor');
    if ( ! $editor ) return;

    $caps = [
        // Privacy Policy page (WP Settings > Privacy)
        'manage_privacy_options',

        // Gravity Forms — view and manage entries
        'gravityforms_view_entries',
        'gravityforms_edit_entries',
        'gravityforms_delete_entries',
        'gravityforms_view_entry_notes',
        'gravityforms_edit_entry_notes',
        'gravityforms_export_entries',
    ];

    foreach ( $caps as $cap ) {
        if ( ! $editor->has_cap( $cap ) ) {
            $editor->add_cap( $cap );
        }
    }
});
