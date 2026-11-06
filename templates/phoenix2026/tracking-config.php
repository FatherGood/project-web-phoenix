<?php
defined('_JEXEC') or die;

/*
|--------------------------------------------------------------------------
| PHOENIX TRACKING CONFIG
|--------------------------------------------------------------------------
|
| Ganti placeholder di bawah dengan ID asli.
|
| Google Analytics 4:
|   Contoh: G-ABC123DE45
|
| Meta Pixel:
|   Contoh: 123456789012345
|
| enabled:
|   true  = tracking aktif jika ID valid + user memberi consent
|   false = seluruh tracking mati
|
*/

return array(

    'enabled' => true,

    'google_analytics_id' =>
        'G-XXXXXXXXXX',

    'meta_pixel_id' =>
        '28449317151351805',

    /*
     * Aktifkan hanya saat testing.
     * Untuk production sebaiknya false.
     */
    'debug' => false,

    /*
     * Versi consent.
     * Naikkan angka jika kebijakan tracking berubah dan
     * Anda ingin meminta consent ulang.
     */
    'consent_version' =>
        '2026-09-04-v1'

);
