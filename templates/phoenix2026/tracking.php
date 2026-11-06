<?php
defined('_JEXEC') or die;

$configFile =
    __DIR__
    . '/tracking-config.php';

$trackingConfig =
    file_exists($configFile)
        ? require $configFile
        : array();

$trackingEnabled =
    !empty($trackingConfig['enabled']);

$gaId =
    isset($trackingConfig['google_analytics_id'])
        ? trim($trackingConfig['google_analytics_id'])
        : '';

$metaPixelId =
    isset($trackingConfig['meta_pixel_id'])
        ? trim($trackingConfig['meta_pixel_id'])
        : '';

$debug =
    !empty($trackingConfig['debug']);

$consentVersion =
    isset($trackingConfig['consent_version'])
        ? trim($trackingConfig['consent_version'])
        : 'v1';

$validGaId =
    preg_match(
        '/^G-[A-Z0-9]+$/',
        $gaId
    );

$validMetaId =
    preg_match(
        '/^[0-9]{6,25}$/',
        $metaPixelId
    )
    &&
    $metaPixelId !==
        '000000000000000';

$clientConfig =
    array(
        'enabled' =>
            $trackingEnabled,
        'gaId' =>
            $validGaId
                ? $gaId
                : '',
        'metaPixelId' =>
            $validMetaId
                ? $metaPixelId
                : '',
        'debug' =>
            $debug,
        'consentVersion' =>
            $consentVersion
    );

?>

<div
    class="phoenix-consent"
    id="phoenixConsent"
    hidden
    role="dialog"
    aria-modal="false"
    aria-labelledby="phoenixConsentTitle"
    aria-describedby="phoenixConsentText"
>

    <div class="phoenix-consent__content">

        <div class="phoenix-consent__copy">

            <strong id="phoenixConsentTitle">
                Cookie & Tracking
            </strong>

            <p id="phoenixConsentText">
                Kami menggunakan Google Analytics dan Meta Pixel
                untuk mengukur performa website dan efektivitas iklan.
                Tracking iklan hanya aktif setelah Anda mengizinkannya.
            </p>

        </div>

        <div class="phoenix-consent__actions">

            <button
                type="button"
                class="phoenix-consent__reject"
                id="phoenixConsentReject"
            >
                Tolak
            </button>

            <button
                type="button"
                class="phoenix-consent__accept"
                id="phoenixConsentAccept"
            >
                Izinkan
            </button>

        </div>

    </div>

</div>


<button
    type="button"
    class="phoenix-privacy-trigger"
    id="phoenixPrivacyTrigger"
    aria-label="Ubah pengaturan cookie dan tracking"
    title="Pengaturan Cookie"
>
    Privasi
</button>


<script>
(function () {

    'use strict';

    var config =
        <?php
        echo json_encode(
            $clientConfig,
            JSON_UNESCAPED_SLASHES
            |
            JSON_UNESCAPED_UNICODE
        );
        ?>;

    if (!config.enabled) {
        return;
    }

    var consentKey =
        'phoenix_tracking_consent_'
        + config.consentVersion;

    var attributionKey =
        'phoenix_marketing_attribution_v1';

    var banner =
        document.getElementById(
            'phoenixConsent'
        );

    var acceptButton =
        document.getElementById(
            'phoenixConsentAccept'
        );

    var rejectButton =
        document.getElementById(
            'phoenixConsentReject'
        );

    var privacyTrigger =
        document.getElementById(
            'phoenixPrivacyTrigger'
        );

    var trackersLoaded =
        false;


    function log() {

        if (!config.debug) {
            return;
        }

        var args =
            Array.prototype.slice.call(
                arguments
            );

        args.unshift(
            '[Phoenix Tracking]'
        );

        console.log.apply(
            console,
            args
        );

    }


    function getConsent() {

        try {

            return localStorage.getItem(
                consentKey
            );

        } catch (error) {

            return null;

        }

    }


    function saveConsent(value) {

        try {

            localStorage.setItem(
                consentKey,
                value
            );

        } catch (error) {

            log(
                'Consent storage unavailable.',
                error
            );

        }

    }


    function showBanner() {

        if (!banner) {
            return;
        }

        banner.hidden =
            false;

        requestAnimationFrame(
            function () {

                banner.classList.add(
                    'is-visible'
                );

            }
        );

    }


    function hideBanner() {

        if (!banner) {
            return;
        }

        banner.classList.remove(
            'is-visible'
        );

        window.setTimeout(
            function () {

                banner.hidden =
                    true;

            },
            220
        );

    }


    function captureAttribution() {

        var params =
            new URLSearchParams(
                window.location.search
            );

        var keys =
            [
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'utm_content',
                'utm_term',
                'gclid',
                'fbclid'
            ];

        var current =
            {};

        var hasData =
            false;

        keys.forEach(
            function (key) {

                var value =
                    params.get(key);

                if (value) {

                    current[key] =
                        value;

                    hasData =
                        true;

                }

            }
        );

        if (!hasData) {
            return;
        }

        current.landing_page =
            window.location.pathname
            +
            window.location.search;

        current.captured_at =
            new Date().toISOString();

        try {

            localStorage.setItem(
                attributionKey,
                JSON.stringify(
                    current
                )
            );

        } catch (error) {

            log(
                'Attribution storage unavailable.',
                error
            );

        }

    }


    function getAttribution() {

        try {

            var raw =
                localStorage.getItem(
                    attributionKey
                );

            return raw
                ? JSON.parse(raw)
                : {};

        } catch (error) {

            return {};

        }

    }


    function loadGoogleAnalytics() {

        if (!config.gaId) {
            return;
        }

        if (
            document.querySelector(
                'script[data-phoenix-ga]'
            )
        ) {
            return;
        }

        window.dataLayer =
            window.dataLayer
            ||
            [];

        window.gtag =
            window.gtag
            ||
            function () {

                window.dataLayer.push(
                    arguments
                );

            };

        window.gtag(
            'js',
            new Date()
        );

        window.gtag(
            'config',
            config.gaId,
            {
                'send_page_view': true,
                'anonymize_ip': true,
                'debug_mode': !!config.debug
            }
        );

        var script =
            document.createElement(
                'script'
            );

        script.async =
            true;

        script.src =
            'https://www.googletagmanager.com/gtag/js?id='
            +
            encodeURIComponent(
                config.gaId
            );

        script.setAttribute(
            'data-phoenix-ga',
            '1'
        );

        document.head.appendChild(
            script
        );

        log(
            'GA4 loaded:',
            config.gaId
        );

    }


    function loadMetaPixel() {

        if (!config.metaPixelId) {
            return;
        }

        if (window.fbq) {
            return;
        }

        !function(f,b,e,v,n,t,s) {

            if(f.fbq) return;

            n=f.fbq=function(){

                n.callMethod
                    ? n.callMethod.apply(n,arguments)
                    : n.queue.push(arguments);

            };

            if(!f._fbq) f._fbq=n;

            n.push=n;
            n.loaded=!0;
            n.version='2.0';
            n.queue=[];

            t=b.createElement(e);
            t.async=!0;
            t.src=v;

            t.setAttribute(
                'data-phoenix-meta',
                '1'
            );

            s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s);

        }(
            window,
            document,
            'script',
            'https://connect.facebook.net/en_US/fbevents.js'
        );

        window.fbq(
            'init',
            config.metaPixelId
        );

        window.fbq(
            'track',
            'PageView'
        );

        log(
            'Meta Pixel loaded:',
            config.metaPixelId
        );

    }


    function sendEvent(
        gaEvent,
        params,
        metaEvent
    ) {

        params =
            params
            ||
            {};

        params.page_location =
            window.location.href;

        if (
            config.gaId
            &&
            typeof window.gtag ===
                'function'
        ) {

            window.gtag(
                'event',
                gaEvent,
                params
            );

        }

        if (
            config.metaPixelId
            &&
            typeof window.fbq ===
                'function'
            &&
            metaEvent
        ) {

            window.fbq(
                'track',
                metaEvent,
                params
            );

        }

        log(
            'Event:',
            gaEvent,
            metaEvent || '',
            params
        );

    }


    function getProductNameFromPage() {

        var heading =
            document.querySelector(
                '.detail-product-info h1'
            );

        if (heading) {

            return heading
                .textContent
                .trim();

        }

        return '';

    }


    function trackInitialPage() {

        var path =
            window.location.pathname
            .replace(/\/+$/, '');

        var productName =
            getProductNameFromPage();

        if (
            /^\/product\/[^/]+$/i
                .test(path)
            &&
            productName
        ) {

            sendEvent(
                'view_item',
                {
                    item_name:
                        productName
                },
                'ViewContent'
            );

            return;

        }

        if (
            path ===
                '/product'
        ) {

            sendEvent(
                'view_item_list',
                {
                    item_list_name:
                        'Product Catalog'
                },
                null
            );

        }

    }


    function installInteractionTracking() {

        document.addEventListener(
            'click',
            function (event) {

                var link =
                    event.target.closest(
                        'a'
                    );

                if (!link) {
                    return;
                }

                var href =
                    link.getAttribute(
                        'href'
                    )
                    ||
                    '';

                var label =
                    link.textContent
                    .replace(/\s+/g, ' ')
                    .trim();

                if (
                    href.indexOf(
                        'wa.me/'
                    ) !== -1
                ) {

                    sendEvent(
                        'contact',
                        {
                            method:
                                'whatsapp',
                            link_text:
                                label
                        },
                        'Contact'
                    );

                    return;

                }

                if (
                    href.indexOf(
                        'phoenix_page=quotation'
                    ) !== -1
                ) {

                    sendEvent(
                        'request_quote_click',
                        {
                            link_text:
                                label,
                            product_name:
                                getProductNameFromPage()
                        },
                        null
                    );

                }

                if (
                    link.classList.contains(
                        'catalog-product-link'
                    )
                    ||
                    link.classList.contains(
                        'detail-related-card'
                    )
                ) {

                    sendEvent(
                        'select_item',
                        {
                            item_name:
                                label
                        },
                        null
                    );

                }

            },
            true
        );


        /*
         * Jangan kirim Meta Lead / GA4 generate_lead hanya karena
         * form menerima event submit.
         *
         * Lead harus dipicu oleh halaman/handler masing-masing
         * SETELAH aksi bisnis benar-benar berhasil.
         *
         * Quotation saat ini hanya membuka WhatsApp, sehingga
         * quotation-page.php mencatatnya sebagai Contact,
         * bukan Lead.
         */

    }


    function loadTrackers() {

        if (trackersLoaded) {
            return;
        }

        trackersLoaded =
            true;

        captureAttribution();

        loadGoogleAnalytics();
        loadMetaPixel();

        installInteractionTracking();

        window.setTimeout(
            trackInitialPage,
            250
        );

    }


    function grantConsent() {

        saveConsent(
            'granted'
        );

        hideBanner();
        loadTrackers();

    }


    function denyConsent() {

        saveConsent(
            'denied'
        );

        hideBanner();

        log(
            'Tracking denied by user.'
        );

    }


    if (acceptButton) {

        acceptButton.addEventListener(
            'click',
            grantConsent
        );

    }


    if (rejectButton) {

        rejectButton.addEventListener(
            'click',
            denyConsent
        );

    }


    if (privacyTrigger) {

        privacyTrigger.addEventListener(
            'click',
            function () {

                showBanner();

            }
        );

    }


    var currentConsent =
        getConsent();

    if (
        currentConsent ===
            'granted'
    ) {

        loadTrackers();

    } else if (
        currentConsent !==
            'denied'
    ) {

        showBanner();

    }


    window.PhoenixTracking = {

        track:
            sendEvent,

        grant:
            grantConsent,

        deny:
            denyConsent,

        showConsent:
            showBanner,

        getAttribution:
            getAttribution

    };

})();
</script>
