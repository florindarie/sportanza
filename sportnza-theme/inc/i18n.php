<?php
/**
 * Sportnza Internationalization (i18n) Helper
 *
 * Provides translation functions based on ?lang= query parameter.
 * Supported languages: en (default), de, fr, it, hu
 *
 * @package Sportnza
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get the current language from the ?lang= query parameter.
 *
 * @return string Language code (en, de, fr, it, hu)
 */
function sportnza_get_lang() {
    static $lang = null;
    if ( $lang !== null ) {
        return $lang;
    }

    $supported = array( 'en', 'de', 'fr', 'it', 'hu' );
    $requested = isset( $_GET['lang'] ) ? sanitize_text_field( $_GET['lang'] ) : 'en';
    $lang = in_array( $requested, $supported, true ) ? $requested : 'en';
    return $lang;
}

/**
 * Load translations from the JSON file.
 *
 * @return array Translations array keyed by English text.
 */
function sportnza_load_translations() {
    static $translations = null;
    if ( $translations !== null ) {
        return $translations;
    }

    $file = SPORTNZA_DIR . '/translations.json';
    if ( file_exists( $file ) ) {
        $json = file_get_contents( $file );
        $translations = json_decode( $json, true );
        if ( ! is_array( $translations ) ) {
            $translations = array();
        }
    } else {
        $translations = array();
    }

    return $translations;
}

/**
 * Translate a string based on the current language.
 * Falls back to the English (original) string if no translation is found.
 *
 * @param string $text The English text to translate.
 * @return string The translated text, or the original English text.
 */
function sportnza_t( $text ) {
    $lang = sportnza_get_lang();

    // English is the default — return as-is
    if ( $lang === 'en' ) {
        return $text;
    }

    $translations = sportnza_load_translations();

    if ( isset( $translations[ $text ][ $lang ] ) ) {
        return $translations[ $text ][ $lang ];
    }

    // Fallback to English
    return $text;
}

/**
 * Get translations array for the current language, suitable for passing to JS.
 *
 * @return array Key-value pairs of English => translated text for current language.
 */
function sportnza_translations_for_js() {
    $lang = sportnza_get_lang();

    if ( $lang === 'en' ) {
        return array();
    }

    $translations = sportnza_load_translations();
    $js_translations = array();

    foreach ( $translations as $english => $langs ) {
        if ( isset( $langs[ $lang ] ) ) {
            $js_translations[ $english ] = $langs[ $lang ];
        }
    }

    return $js_translations;
}

/**
 * Get the list of supported languages with their labels.
 *
 * @return array Language code => label pairs.
 */
function sportnza_get_languages() {
    return array(
        'en' => 'EN',
        'de' => 'DE',
        'fr' => 'FR',
        'it' => 'IT',
        'hu' => 'HU',
    );
}
