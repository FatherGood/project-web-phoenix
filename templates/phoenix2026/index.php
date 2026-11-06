<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PWLD1W1PDK"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PWLD1W1PDK');
</script>
<?php
defined('_JEXEC') or die;

/* =========================================================
   JOOMLA CORE
========================================================= */

$doc  = JFactory::getDocument();
$app  = JFactory::getApplication();
$menu = $app->getMenu();

/* =========================================================
   EARLY QUOTATION API HANDLER
========================================================= */

$quotationHandlerFile =
    JPATH_THEMES
    . '/'
    . $this->template
    . '/quotation-handler.php';

if (
    $app->input->getMethod() === 'POST'
    &&
    $app->input->post->getInt(
        'phoenix_quotation_submit',
        0
    ) === 1
) {

    if (
        !file_exists(
            $quotationHandlerFile
        )
    ) {

        /*
         * Jangan biarkan frontend menerima halaman HTML jika file handler
         * hilang. Kembalikan JSON error yang bisa dibaca quotation-page.php.
         */
        $app->setHeader(
            'Content-Type',
            'application/json; charset=utf-8',
            true
        );

        echo json_encode(
            array(
                'success' => false,
                'message' => 'Quotation handler belum ditemukan di template.'
            ),
            JSON_UNESCAPED_UNICODE
            |
            JSON_UNESCAPED_SLASHES
        );

        $app->close();

    }

    require $quotationHandlerFile;

    /*
     * quotation-handler.php normalnya menutup aplikasi sendiri setelah
     * mengirim JSON. Ini hanya pengaman agar template tidak lanjut render
     * apabila handler kembali tanpa menutup aplikasi.
     */
    $app->setHeader(
        'Content-Type',
        'application/json; charset=utf-8',
        true
    );

    echo json_encode(
        array(
            'success' => false,
            'message' => 'Quotation handler tidak mengembalikan response yang valid.'
        ),
        JSON_UNESCAPED_UNICODE
        |
        JSON_UNESCAPED_SLASHES
    );

    $app->close();

}

/* =========================================================
   PHASE 10.2 — CONTENT MANAGER FRONTEND BRIDGE
   WAJIB setelah EARLY QUOTATION API HANDLER.
========================================================= */

$phoenixContentProviderFile =
    JPATH_THEMES . '/' . $this->template . '/phoenix-content-provider.php';

if (file_exists($phoenixContentProviderFile)) {
    require_once $phoenixContentProviderFile;
}

$phoenixContentDb = JFactory::getDbo();
$phoenixContentReady =
    function_exists('phxContentReady')
    && phxContentReady($phoenixContentDb);

$phxGlobalBusinessName = $phoenixContentReady
    ? phxContentSetting($phoenixContentDb, 'global', 'business_name', 'Phoenix Kian Jaya')
    : 'Phoenix Kian Jaya';

$phxGlobalLegalName = $phoenixContentReady
    ? phxContentSetting($phoenixContentDb, 'global', 'legal_name', 'PT Phoenix Kian Jaya')
    : 'PT Phoenix Kian Jaya';

$phxGlobalWhatsapp = $phoenixContentReady
    ? preg_replace('/\D+/', '', phxContentSetting($phoenixContentDb, 'global', 'whatsapp', '6289643402214'))
    : '6289643402214';

$phxGlobalEmail = $phoenixContentReady
    ? phxContentSetting($phoenixContentDb, 'global', 'email', 'phoenix@phoenixdigiprint.com')
    : 'phoenix@phoenixdigiprint.com';

$phxHomepage = array(
    'hero_eyebrow' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','hero_eyebrow','DIGITAL PRINTING & ACRYLIC') : 'DIGITAL PRINTING & ACRYLIC',
    'hero_title' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','hero_title','Percetakan & Digital Printing Jakarta untuk Bisnis & Perusahaan') : 'Percetakan & Digital Printing Jakarta untuk Bisnis & Perusahaan',
    'hero_description' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','hero_description','Solusi digital printing, acrylic, banner, sticker, branding dan media promosi untuk perusahaan, bisnis dan event di Jakarta serta melayani kebutuhan pelanggan di seluruh Jabodetabek.') : 'Solusi digital printing, acrylic, banner, sticker, branding dan media promosi untuk perusahaan, bisnis dan event di Jakarta serta melayani kebutuhan pelanggan di seluruh Jabodetabek.',
    'primary_cta' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','primary_cta','Lihat Produk') : 'Lihat Produk',
    'secondary_cta' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','secondary_cta','Request Penawaran') : 'Request Penawaran',
    'hero_image' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','hero_image','') : '',
    'about_title' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','about_title','Partner Printing Untuk Bisnis Anda') : 'Partner Printing Untuk Bisnis Anda',
    'about_text' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','about_text','Phoenix Kian Jaya hadir sebagai solusi kebutuhan digital printing, acrylic, branding dan berbagai media promosi.') : 'Phoenix Kian Jaya hadir sebagai solusi kebutuhan digital printing, acrylic, branding dan berbagai media promosi.',
    'about_image' => $phoenixContentReady ? phxContentSetting($phoenixContentDb,'homepage','about_image','') : ''
);

/* =========================================================
   TEMPLATE PATH
========================================================= */

$templatePath =
    $this->baseurl
    . '/templates/'
    . $this->template;

$templateImages =
    $templatePath
    . '/images';
    
$productThumbnailPath =
    $templateImages
    . '/product_thumbnail';    

/* =========================================================
   TEMPLATE CSS
========================================================= */

$doc->addStyleSheet(
    $templatePath
    . '/css/template.min.css?v=20260903-05'
);

$doc->addStyleSheet(
    $templatePath
    . '/css/tracking.css?v=20260904-01'
);

/* =========================================================
   HOMEPAGE
========================================================= */

$activeMenu  = $menu->getActive();
$defaultMenu = $menu->getDefault();

$isHome = false;

if ($activeMenu && $defaultMenu) {

    $isHome =
        (int) $activeMenu->id
        ===
        (int) $defaultMenu->id;
}

/* =========================================================
   CURRENT PATH
========================================================= */

$currentUri =
    JUri::getInstance();

$currentPath =
    trim(
        $currentUri->getPath(),
        '/'
    );

/* =========================================================
   CUSTOM ROUTES
========================================================= */

$isProductPage =
    (
        $currentPath === 'product'
    );

$isAcrylicPage =
    (
        $currentPath === 'product/acrylic'
    );

$isIndoorOutdoorPage =
    (
        $currentPath ===
        'product/indoor-outdoor-printing'
    );

$isBrandingPage =
    (
        $currentPath ===
        'product/branding'
    );

$isContactPage =
    (
        $currentPath === 'kontak'
    );

/* =========================================================
   SEO PHASE 3 — HIGH-VALUE LANDING PAGES
   Hanya halaman dengan intent berbeda; tidak membuat doorway page
   untuk setiap kota Jabodetabek.
========================================================= */
$seoLandingKey = '';
$seoLandingRoutes = array(
    'percetakan-jakarta' => 'percetakan-jakarta',
    'digital-printing-jakarta' => 'digital-printing-jakarta',
    'percetakan-jakarta-barat' => 'percetakan-jakarta-barat',
    'layanan-printing-jabodetabek' => 'layanan-printing-jabodetabek'
);
if (isset($seoLandingRoutes[$currentPath])) {
    $seoLandingKey = $seoLandingRoutes[$currentPath];
}
$isSeoLandingPage = ($seoLandingKey !== '');
    
$isPortfolioPage =
    (
        $currentPath === 'portfolio'
        ||
        $app->input->getCmd('phoenix_page') === 'portfolio'
    );
$isQuotationPage =
    (
        $app->input->getCmd('phoenix_page') === 'quotation'
    );

$isLegacyAboutPath = ($currentPath === 'about-us');

$isAboutPage =
    (
        $app->input->getCmd('phoenix_page') === 'about'
        || $isLegacyAboutPath
    );
/* =========================================================
   GENERIC PRODUCT DETAIL ROUTES
========================================================= */

$productSlug = '';

if (
    strpos(
        $currentPath,
        'product/'
    ) === 0
) {

    $productSlug =
        substr(
            $currentPath,
            strlen('product/')
        );

}

$productDetailSlugs =
    array(
        'x-banner',
        'y-banner',
        'mini-x-banner',
        'roll-up-banner',
        'tripod-banner',
        'jumbo-banner',
        'spanduk-backdrop-t-banner',
        'vehicle-branding',
        'display-branding',
        'pvc',
        'foam-board',
        'impraboard'
    );

$isGenericProductDetail =
    in_array(
        $productSlug,
        $productDetailSlugs,
        true
    );

/* =========================================================
   GLOBAL LINKS
========================================================= */

$homeUrl =
    $this->baseurl . '/';

$productsUrl =
    $this->baseurl . '/product';

$acrylicUrl =
    $this->baseurl
    . '/product/acrylic';

$indoorOutdoorUrl =
    $this->baseurl
    . '/product/indoor-outdoor-printing';

$brandingUrl =
    $this->baseurl
    . '/product/branding';

$spandukBackdropUrl =
    $this->baseurl
    . '/product/spanduk-backdrop-t-banner';

$vehicleBrandingUrl =
    $this->baseurl
    . '/product/vehicle-branding';

$displayBrandingUrl =
    $this->baseurl
    . '/product/display-branding';

$aboutUrl =
    $this->baseurl
    . '/?phoenix_page=about';

$portfolioUrl =
    $this->baseurl
    . '/?phoenix_page=portfolio';

$contactUrl =
    $this->baseurl
    . '/kontak';

$quotationUrl =
    $this->baseurl
    . '/?phoenix_page=quotation';

$percetakanJakartaUrl = $this->baseurl . '/percetakan-jakarta';
$digitalPrintingJakartaUrl = $this->baseurl . '/digital-printing-jakarta';
$percetakanJakartaBaratUrl = $this->baseurl . '/percetakan-jakarta-barat';
$jabodetabekServiceUrl = $this->baseurl . '/layanan-printing-jabodetabek';

/* =========================================================
   WHATSAPP
========================================================= */

$whatsappNumber =
    $phxGlobalWhatsapp !== '' ? $phxGlobalWhatsapp : '6289643402214';

$whatsappMessage =
    rawurlencode(
        'Halo Phoenix Kian jaya, saya ingin konsultasi mengenai kebutuhan printing.'
    );

$whatsappUrl =
    'https://wa.me/'
    . $whatsappNumber
    . '?text='
    . $whatsappMessage;


/* =========================================================
   SEO PHASE 1 — JAKARTA & JABODETABEK
   IMPORTANT:
   - staging.* tetap NOINDEX
   - production otomatis INDEX,FOLLOW
   - EARLY QUOTATION API HANDLER di atas TIDAK DIUBAH
========================================================= */

$siteName = $phxGlobalBusinessName;
$currentHost = strtolower((string) JUri::getInstance()->getHost());
$isStagingHost = ($currentHost === 'staging.phoenixdigiprint.com' || strpos($currentHost, 'staging.') === 0);

$siteBaseUrl = $isStagingHost
    ? 'https://staging.phoenixdigiprint.com'
    : 'https://www.phoenixdigiprint.com';

/* SEO PHASE 4A — LEGACY ABOUT + DOMAIN NORMALIZATION
   - URL About lama diarahkan permanen ke URL About canonical.
   - Domain production dinormalisasi ke HTTPS + www.
   - Staging tidak diarahkan ke production.
*/
if (!$isStagingHost && !headers_sent()) {
    $requestScheme = strtolower((string) $currentUri->getScheme());
    $requestHost = strtolower((string) $currentUri->getHost());

    if ($isLegacyAboutPath) {
        header('Location: ' . $siteBaseUrl . '/?phoenix_page=about', true, 301);
        exit;
    }

    if ($requestScheme !== 'https' || $requestHost !== 'www.phoenixdigiprint.com') {
        $requestPath = '/' . ltrim((string) $currentUri->getPath(), '/');
        $requestQuery = (string) $currentUri->getQuery();
        $targetUrl = $siteBaseUrl . $requestPath;
        if ($requestQuery !== '') {
            $targetUrl .= '?' . $requestQuery;
        }
        header('Location: ' . $targetUrl, true, 301);
        exit;
    }
}

$defaultOgImage = $siteBaseUrl . '/templates/' . $this->template . '/images/og-phoenix.jpg';

/* SEO PHASE 4 — XML SITEMAP ENDPOINT (QA FIX)
   - Hanya URL publik yang memang layak diindeks
   - Quotation/admin tidak dimasukkan ke sitemap
   - Host otomatis staging / production
   - XML valid dengan header yang eksplisit
   - Staging diberi X-Robots-Tag noindex agar sitemap test tidak ikut diindeks
*/
if (
    $currentPath === 'sitemap.xml'
    || $app->input->getInt('phoenix_sitemap', 0) === 1
    || $app->input->getInt('phoenix_sitemap_v2', 0) === 1
) {
    $sitemapUrls = array(
        '/',
        '/product',
        '/product/acrylic',
        '/product/indoor-outdoor-printing',
        '/product/branding',
        '/product/x-banner',
        '/product/y-banner',
        '/product/mini-x-banner',
        '/product/roll-up-banner',
        '/product/tripod-banner',
        '/product/jumbo-banner',
        '/product/spanduk-backdrop-t-banner',
        '/product/vehicle-branding',
        '/product/display-branding',
        '/product/pvc',
        '/product/foam-board',
        '/product/impraboard',
        '/percetakan-jakarta',
        '/digital-printing-jakarta',
        '/percetakan-jakarta-barat',
        '/layanan-printing-jabodetabek',
        '/kontak',
        '/?phoenix_page=about',
        '/?phoenix_page=portfolio'
    );

    while (ob_get_level() > 0) { @ob_end_clean(); }

    // Pakai native PHP headers + exit supaya output XML tidak diteruskan ke renderer Joomla/Quix.
    if (!headers_sent()) {
        header('Content-Type: application/xml; charset=UTF-8', true);
        header('X-Content-Type-Options: nosniff', true);
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0', true);
        header('Pragma: no-cache', true);
        header('X-Phoenix-Sitemap-Version: PHX-SITEMAP-V2', true);
        if ($isStagingHost) {
            header('X-Robots-Tag: noindex, nofollow', true);
        }
    }

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<!-- PHX-SITEMAP-V2 -->' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($sitemapUrls as $path) {
        $absoluteUrl = $siteBaseUrl . $path;
        echo "  <url>\n";
        echo '    <loc>' . htmlspecialchars($absoluteUrl, ENT_QUOTES | ENT_XML1, 'UTF-8') . '</loc>' . "\n";
        echo "  </url>\n";
    }
    echo '</urlset>' . "\n";
    exit;
}

$seoTitle = 'Percetakan & Digital Printing Jakarta | Phoenix Kian Jaya';
$seoDescription = 'Phoenix Kian Jaya melayani percetakan, digital printing, banner, acrylic, sticker dan branding untuk bisnis, perusahaan dan event di Jakarta serta Jabodetabek.';
$seoCanonical = $siteBaseUrl . '/';

if ($isProductPage) {
    $seoTitle = 'Produk Percetakan & Digital Printing Jakarta | Phoenix Kian Jaya';
    $seoDescription = 'Produk digital printing, acrylic, banner, display dan branding untuk kebutuhan bisnis, perusahaan dan event di Jakarta dan Jabodetabek.';
    $seoCanonical = $siteBaseUrl . '/product';
} elseif ($isAcrylicPage) {
    $seoTitle = 'Cetak Acrylic Custom Jakarta | Phoenix Kian Jaya';
    $seoDescription = 'Jasa acrylic custom, display acrylic dan signage untuk kebutuhan promosi, retail, event dan perusahaan di Jakarta dan Jabodetabek.';
    $seoCanonical = $siteBaseUrl . '/product/acrylic';
} elseif ($isIndoorOutdoorPage) {
    $seoTitle = 'Indoor & Outdoor Printing Jakarta | Phoenix Kian Jaya';
    $seoDescription = 'Jasa indoor dan outdoor printing untuk banner, display, event dan media promosi bisnis di Jakarta dan Jabodetabek.';
    $seoCanonical = $siteBaseUrl . '/product/indoor-outdoor-printing';
} elseif ($isBrandingPage) {
    $seoTitle = 'Jasa Branding & Vehicle Branding Jakarta | Phoenix Kian Jaya';
    $seoDescription = 'Layanan branding, vehicle branding dan display branding untuk perusahaan, bisnis dan event di Jakarta serta Jabodetabek.';
    $seoCanonical = $siteBaseUrl . '/product/branding';
} elseif ($isGenericProductDetail) {
    $seoProductNames = array(
        'x-banner' => 'X Banner',
        'y-banner' => 'Y Banner',
        'mini-x-banner' => 'Mini X Banner',
        'roll-up-banner' => 'Roll Up Banner',
        'tripod-banner' => 'Tripod Banner',
        'jumbo-banner' => 'Jumbo Banner',
        'spanduk-backdrop-t-banner' => 'Spanduk, Backdrop & T Banner',
        'vehicle-branding' => 'Vehicle Branding',
        'display-branding' => 'Display Branding',
        'pvc' => 'PVC Board Printing',
        'foam-board' => 'Foam Board Printing',
        'impraboard' => 'Impraboard Printing'
    );
    $seoProductName = isset($seoProductNames[$productSlug]) ? $seoProductNames[$productSlug] : 'Produk Printing';

    $seoProductDescriptions = array(
        'pvc' => 'PVC board printing custom untuk display promosi, signage, panel informasi, dekorasi booth dan kebutuhan branding perusahaan. Konsultasikan ukuran dan spesifikasi dengan Phoenix Kian Jaya.',
        'foam-board' => 'Foam board printing custom untuk display indoor, presentasi, pameran, materi promosi dan kebutuhan visual perusahaan. Konsultasikan ukuran serta finishing dengan Phoenix Kian Jaya.',
        'impraboard' => 'Impraboard printing custom untuk display promosi, signage, materi event, kebutuhan retail dan komunikasi visual. Hubungi Phoenix Kian Jaya untuk konsultasi ukuran dan spesifikasi.'
    );

    $seoTitle = $seoProductName . ' Jakarta | Phoenix Kian Jaya';
    $seoDescription = isset($seoProductDescriptions[$productSlug])
        ? $seoProductDescriptions[$productSlug]
        : $seoProductName . ' untuk kebutuhan promosi, branding, perusahaan dan event di Jakarta serta Jabodetabek bersama Phoenix Kian Jaya.';
    $seoCanonical = $siteBaseUrl . '/product/' . rawurlencode($productSlug);
} elseif ($isSeoLandingPage) {
    $landingSeoMeta = array(
        'percetakan-jakarta' => array(
            'Percetakan Jakarta untuk Bisnis & Perusahaan | Phoenix Kian Jaya',
            'Layanan percetakan Jakarta untuk kebutuhan perusahaan, event dan promosi: banner, acrylic, sticker, display dan branding dari Phoenix Kian Jaya.'
        ),
        'digital-printing-jakarta' => array(
            'Digital Printing Jakarta untuk Corporate & Event | Phoenix Kian Jaya',
            'Digital printing Jakarta untuk banner, display, sticker, media promosi dan kebutuhan corporate dengan konsultasi spesifikasi dan produksi.'
        ),
        'percetakan-jakarta-barat' => array(
            'Percetakan Jakarta Barat | Workshop Phoenix Kian Jaya',
            'Percetakan dan digital printing Jakarta Barat dengan workshop Phoenix Kian Jaya di Jelambar Baru untuk kebutuhan bisnis, event dan perusahaan.'
        ),
        'layanan-printing-jabodetabek' => array(
            'Layanan Printing Jabodetabek | Phoenix Kian Jaya',
            'Layanan printing untuk Jakarta, Tangerang, Tangerang Selatan, Bekasi, Depok dan Bogor untuk kebutuhan perusahaan, event dan media promosi.'
        )
    );
    $seoTitle = $landingSeoMeta[$seoLandingKey][0];
    $seoDescription = $landingSeoMeta[$seoLandingKey][1];
    $seoCanonical = $siteBaseUrl . '/' . $seoLandingKey;
} elseif ($isPortfolioPage) {
    $seoTitle = 'Portfolio Percetakan & Branding Jakarta | Phoenix Kian Jaya';
    $seoDescription = 'Lihat hasil project digital printing, acrylic, banner dan branding Phoenix Kian Jaya untuk bisnis, perusahaan dan event.';
    $seoCanonical = $siteBaseUrl . '/?phoenix_page=portfolio';
} elseif ($isContactPage) {
    $seoTitle = 'Percetakan Jakarta Barat - Hubungi Phoenix Kian Jaya';
    $seoDescription = 'Hubungi Phoenix Kian Jaya di Jakarta Barat untuk konsultasi digital printing, acrylic, banner, sticker dan branding area Jakarta dan Jabodetabek.';
    $seoCanonical = $siteBaseUrl . '/kontak';
} elseif ($isQuotationPage) {
    $seoTitle = 'Request Penawaran Percetakan B2B Jakarta | Phoenix Kian Jaya';
    $seoDescription = 'Ajukan penawaran digital printing, acrylic, branding dan media promosi untuk perusahaan dan project B2B di Jakarta serta Jabodetabek.';
    $seoCanonical = $siteBaseUrl . '/?phoenix_page=quotation';
} elseif ($isAboutPage) {
    $seoTitle = 'Tentang Phoenix Kian Jaya | Percetakan Jakarta';
    $seoDescription = 'Kenali PT Phoenix Kian Jaya, penyedia solusi digital printing, acrylic dan branding yang berlokasi di Jakarta Barat dan melayani Jabodetabek.';
    $seoCanonical = $siteBaseUrl . '/?phoenix_page=about';
}

$phxSeoLandingContent = null;
if ($phoenixContentReady && $isSeoLandingPage) {
    $phxSeoLandingContent = phxContentSeoPage($phoenixContentDb, $seoLandingKey);
    if ($phxSeoLandingContent) {
        if (trim((string)$phxSeoLandingContent->meta_title) !== '') {
            $seoTitle = $phxSeoLandingContent->meta_title;
        }
        if (trim((string)$phxSeoLandingContent->meta_description) !== '') {
            $seoDescription = $phxSeoLandingContent->meta_description;
        }
    }
}

$doc->setTitle($seoTitle);
$doc->setDescription($seoDescription);
$doc->addHeadLink($seoCanonical, 'canonical');

$escapeMeta = function ($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
};

$doc->addCustomTag('<meta property="og:title" content="' . $escapeMeta($seoTitle) . '">');
$doc->addCustomTag('<meta property="og:description" content="' . $escapeMeta($seoDescription) . '">');
$doc->addCustomTag('<meta property="og:type" content="website">');
$doc->addCustomTag('<meta property="og:url" content="' . $escapeMeta($seoCanonical) . '">');
$doc->addCustomTag('<meta property="og:image" content="' . $escapeMeta($defaultOgImage) . '">');
$doc->addCustomTag('<meta property="og:site_name" content="' . $escapeMeta($siteName) . '">');
$doc->addCustomTag('<meta property="og:locale" content="id_ID">');

$doc->setMetaData('twitter:card', 'summary_large_image');
$doc->setMetaData('twitter:title', $seoTitle);
$doc->setMetaData('twitter:description', $seoDescription);
$doc->setMetaData('twitter:image', $defaultOgImage);

/* Staging tidak boleh masuk Google. Saat dipindah ke domain utama,
   aturan otomatis berubah menjadi index, follow. */
$doc->setMetaData('robots', $isStagingHost ? 'noindex, nofollow' : 'index, follow, max-image-preview:large');

/*
 * GEO / ENTITY STRUCTURED DATA
 * Organization = identitas badan usaha dan alamat kantor terdaftar.
 * ProfessionalService = layanan operasional dengan alamat workshop.
 * Area lain dicantumkan sebagai area layanan, bukan cabang.
 */

$organizationSchema = array(
    '@type' => 'Organization',
    '@id' => $siteBaseUrl . '/#organization',
    'name' => $phxGlobalBusinessName,
    'legalName' => $phxGlobalLegalName,
    'url' => $siteBaseUrl . '/',
    'logo' => array(
        '@type' => 'ImageObject',
        'url' => $siteBaseUrl . '/images/Logo-PKJ.png'
    ),
    'email' => $phxGlobalEmail,
    'telephone' => '+' . $phxGlobalWhatsapp,
    'address' => array(
        '@type' => 'PostalAddress',
        'streetAddress' => 'Grand Slipi Tower Lt. 5 Unit F, Jl. Letjen S. Parman Kav. 22–24',
        'addressLocality' => 'Palmerah, Jakarta Barat',
        'addressRegion' => 'DKI Jakarta',
        'postalCode' => '11480',
        'addressCountry' => 'ID'
    ),
    'contactPoint' => array(
        '@type' => 'ContactPoint',
        'telephone' => '+' . $phxGlobalWhatsapp,
        'contactType' => 'sales',
        'areaServed' => 'ID',
        'availableLanguage' => array('Indonesian')
    )
);

$localBusinessSchema = array(
    '@type' => 'ProfessionalService',
    '@id' => $siteBaseUrl . '/#business',
    'name' => $phxGlobalBusinessName,
    'url' => $siteBaseUrl . '/',
    'telephone' => '+' . $phxGlobalWhatsapp,
    'email' => $phxGlobalEmail,
    'image' => $defaultOgImage,
    'description' => 'Layanan percetakan dan digital printing untuk kebutuhan bisnis, perusahaan, retail dan event di Jakarta serta Jabodetabek.',
    'parentOrganization' => array(
        '@id' => $siteBaseUrl . '/#organization'
    ),
    'address' => array(
        '@type' => 'PostalAddress',
        'streetAddress' => 'Jl. Jelambar Selatan XI No. 30, RT.005/RW.005, Jelambar Baru, Grogol Petamburan',
        'addressLocality' => 'Jakarta Barat',
        'addressRegion' => 'DKI Jakarta',
        'postalCode' => '11460',
        'addressCountry' => 'ID'
    ),
    'areaServed' => array(
        array('@type' => 'City', 'name' => 'Jakarta Barat'),
        array('@type' => 'City', 'name' => 'Jakarta Pusat'),
        array('@type' => 'City', 'name' => 'Jakarta Selatan'),
        array('@type' => 'City', 'name' => 'Jakarta Timur'),
        array('@type' => 'City', 'name' => 'Jakarta Utara'),
        array('@type' => 'City', 'name' => 'Tangerang'),
        array('@type' => 'City', 'name' => 'Tangerang Selatan'),
        array('@type' => 'City', 'name' => 'Bekasi'),
        array('@type' => 'City', 'name' => 'Depok'),
        array('@type' => 'City', 'name' => 'Bogor')
    )
);

$websiteSchema = array(
    '@type' => 'WebSite',
    '@id' => $siteBaseUrl . '/#website',
    'url' => $siteBaseUrl . '/',
    'name' => $phxGlobalBusinessName,
    'inLanguage' => 'id-ID',
    'publisher' => array(
        '@id' => $siteBaseUrl . '/#organization'
    )
);

/*
 * FAQPage hanya ditampilkan di homepage dan harus sama dengan FAQ
 * yang benar-benar terlihat oleh pengunjung.
 */
$faqSchema = array(
    '@type' => 'FAQPage',
    'mainEntity' => array(
        array(
            '@type' => 'Question',
            'name' => 'Apakah Phoenix Kian Jaya melayani percetakan untuk perusahaan di Jakarta?',
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => 'Ya. Kami melayani kebutuhan digital printing, acrylic, banner, display, sticker dan branding untuk perusahaan, bisnis, retail dan event.'
            )
        ),
        array(
            '@type' => 'Question',
            'name' => 'Apakah layanan hanya tersedia di Jakarta Barat?',
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => 'Tidak. Workshop kami berada di Jakarta Barat dan kami melayani kebutuhan pelanggan di Jakarta, Tangerang, Tangerang Selatan, Bekasi, Depok dan Bogor.'
            )
        ),
        array(
            '@type' => 'Question',
            'name' => 'Bagaimana cara meminta quotation atau penawaran?',
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => 'Gunakan menu Request Penawaran dan isi kebutuhan produk, jumlah, ukuran, material, deadline dan brief. Tim kami akan meninjau kebutuhan tersebut sebelum menindaklanjuti penawaran.'
            )
        ),
        array(
            '@type' => 'Question',
            'name' => 'Apakah bisa konsultasi sebelum menentukan material dan spesifikasi?',
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => 'Bisa. Anda dapat menghubungi tim kami untuk mendiskusikan kebutuhan project, penggunaan produk, ukuran, material dan jumlah sebelum produksi.'
            )
        )
    )
);

$structuredDataGraph = array(
    '@context' => 'https://schema.org',
    '@graph' => array(
        $organizationSchema,
        $localBusinessSchema,
        $websiteSchema
    )
);

$doc->addCustomTag(
    '<script type="application/ld+json">'
    . json_encode(
        $structuredDataGraph,
        JSON_UNESCAPED_UNICODE
        | JSON_UNESCAPED_SLASHES
        | JSON_HEX_TAG
        | JSON_HEX_AMP
        | JSON_HEX_APOS
        | JSON_HEX_QUOT
    )
    . '</script>'
);

if ($isHome) {
    $faqStructuredData = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqSchema['mainEntity']
    );

    $doc->addCustomTag(
        '<script type="application/ld+json">'
        . json_encode(
            $faqStructuredData,
            JSON_UNESCAPED_UNICODE
            | JSON_UNESCAPED_SLASHES
            | JSON_HEX_TAG
            | JSON_HEX_AMP
            | JSON_HEX_APOS
            | JSON_HEX_QUOT
        )
        . '</script>'
    );
}

?>

<!DOCTYPE html>

<html
    lang="<?php echo $this->language; ?>"
    dir="<?php echo $this->direction; ?>"
>

<head>
    <meta name="facebook-domain-verification" content="wgaiyul4poux3hxzxo1a5trakcjds3" />

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <jdoc:include type="head" />

</head>

<body>

<!-- =========================================================
     NAVBAR
========================================================= -->

<header class="phoenix-header">

    <div class="phoenix-nav-shell">

        <nav
            class="phoenix-nav-left"
            aria-label="Navigasi kiri"
        >

            <a
                href="<?php echo $aboutUrl; ?>"
                class="<?php echo ($isHome ? '' : ''); ?>"
            >
                TENTANG KAMI
            </a>

            <a
                href="<?php echo $productsUrl; ?>"
                class="<?php echo (
                    $isProductPage
                    || $isAcrylicPage
                    || $isIndoorOutdoorPage
                    || $isBrandingPage
                    || $isGenericProductDetail
                ) ? 'is-active' : ''; ?>"
            >
                PRODUK
            </a>

        </nav>

        <a
            href="<?php echo $homeUrl; ?>"
            class="phoenix-center-logo"
            aria-label="Phoenix Kian Jaya"
        >

            <img
                src="<?php echo $this->baseurl; ?>/images/Logo-PKJ.png"
                alt="Phoenix Kian Jaya"
            >

        </a>

        <nav
            class="phoenix-nav-right"
            aria-label="Navigasi kanan"
        >

            <a
                href="<?php echo $portfolioUrl; ?>"
                class="<?php echo $isPortfolioPage ? 'is-active' : ''; ?>"
            >
                PORTFOLIO
            </a>

            <a
                href="<?php echo $contactUrl; ?>"
                class="<?php echo $isContactPage ? 'is-active' : ''; ?>"
            >
                KONTAK
            </a>

        </nav>

        <button
            class="promindo-menu-toggle"
            type="button"
            aria-label="Buka menu"
            aria-expanded="false"
        >

            <span></span>
            <span></span>
            <span></span>

        </button>

    </div>

    <div class="promindo-mobile-menu">

        <a href="<?php echo $homeUrl; ?>">
            HOME
        </a>

        <a href="<?php echo $aboutUrl; ?>">
            TENTANG KAMI
        </a>

        <a href="<?php echo $productsUrl; ?>">
            PRODUK
        </a>

        <a href="<?php echo $portfolioUrl; ?>">
            PORTFOLIO
        </a>

        <a href="<?php echo $contactUrl; ?>">
            KONTAK
        </a>

        <a
            href="<?php echo $whatsappUrl; ?>"
            target="_blank"
            rel="noopener noreferrer"
            class="mobile-wa-link"
        >
            HUBUNGI KAMI
        </a>

    </div>

</header>

<!-- =========================================================
     HOMEPAGE
========================================================= -->

<?php if (
    $isHome
    &&
    !$isProductPage
    &&
    !$isAcrylicPage
    &&
    !$isIndoorOutdoorPage
    &&
    !$isBrandingPage
    &&
    !$isContactPage
    &&
    !$isPortfolioPage
    &&
    !$isQuotationPage
    &&
    !$isAboutPage
) : ?>

<!-- HERO -->

<section class="phoenix-hero">

    <div class="phoenix-container hero-grid">

        <div class="hero-copy">

            <div class="hero-eyebrow">

                <span></span>

                <?php echo htmlspecialchars($phxHomepage['hero_eyebrow'], ENT_QUOTES, 'UTF-8'); ?>

            </div>

            <h1>

                <?php echo nl2br(htmlspecialchars($phxHomepage['hero_title'], ENT_QUOTES, 'UTF-8')); ?>

                <strong>
                    <?php echo htmlspecialchars($phxGlobalBusinessName, ENT_QUOTES, 'UTF-8'); ?>
                </strong>

            </h1>

            <p class="hero-description">

                <?php echo htmlspecialchars(
                    $phxHomepage['hero_description'],
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>

            </p>

            <div class="hero-actions">

                <a
                    href="<?php echo $productsUrl; ?>"
                    class="btn-primary"
                >
                    <?php echo htmlspecialchars($phxHomepage['primary_cta'], ENT_QUOTES, 'UTF-8'); ?>
                    <span>→</span>
                </a>

                <a
                    href="<?php echo $quotationUrl; ?>"
                    class="btn-secondary"
                >
                    <?php echo htmlspecialchars($phxHomepage['secondary_cta'], ENT_QUOTES, 'UTF-8'); ?>
                </a>

            </div>

            <div class="hero-benefits">

                <div class="benefit-item">

                    <div class="benefit-icon">
                        ✓
                    </div>

                    <div>

                        <strong>
                            Hasil Berkualitas
                        </strong>

                        <span>
                            Produksi rapi dan presisi
                        </span>

                    </div>

                </div>

                <div class="benefit-item">

                    <div class="benefit-icon">
                        ⚡
                    </div>

                    <div>

                        <strong>
                            Produksi Cepat
                        </strong>

                        <span>
                            Proses efisien dan tepat waktu
                        </span>

                    </div>

                </div>

                <div class="benefit-item">

                    <div class="benefit-icon">
                        ★
                    </div>

                    <div>

                        <strong>
                            Tim Profesional
                        </strong>

                        <span>
                            Siap membantu kebutuhan Anda
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <div class="hero-visual">

            <img
                src="<?php echo $templateImages; ?>/hero-homepage.png"
                alt="Custom Pop Box Phoenix Kian Jaya"
                class="hero-image"
            >

            <div class="hero-floating-card">

                <small>
                    PRINTING SOLUTION
                </small>

                <strong>
                    Your Idea.<br>
                    Your Print.
                </strong>

                <span>
                    Banner • Acrylic • Sticker • Branding
                </span>

            </div>

        </div>

    </div>

</section>

<!-- TRUST -->

<section class="trust-section">

    <div class="phoenix-container">

        <p>
            Dipercaya untuk kebutuhan printing, branding dan media promosi berbagai bisnis
        </p>

    </div>

</section>

<!-- =========================================================
     HOMEPAGE MONTHLY BANNER
========================================================= -->
<?php

/*
|--------------------------------------------------------------------------
| MONTHLY WEB BANNER CONFIG
|--------------------------------------------------------------------------
| Untuk mengganti banner bulan berikutnya, cukup ubah 3 baris ini.
|
| IMAGE:
| Simpan banner di:
| /templates/NAMA_TEMPLATE/images/monthly-banner/
|
| Ukuran desktop yang disarankan: 1920 x 650 px
| Untuk mobile, desain penting sebaiknya tetap berada di area tengah.
|--------------------------------------------------------------------------
*/

$monthlyBanner = array(
    'image' => 'web-banner.png',
    'url'   => $productsUrl,
    'alt'   => 'Banner informasi produk dan layanan Phoenix Kian Jaya'
);

$monthlyBannerImage =
    $templateImages
    . '/monthly-banner/'
    . rawurlencode($monthlyBanner['image']);

?>

<section
    class="monthly-banner-section"
    id="produk"
>
    <div class="phoenix-container">

        <a
            href="<?php echo htmlspecialchars(
                $monthlyBanner['url'],
                ENT_QUOTES,
                'UTF-8'
            ); ?>"
            class="monthly-banner-link"
            aria-label="<?php echo htmlspecialchars(
                $monthlyBanner['alt'],
                ENT_QUOTES,
                'UTF-8'
            ); ?>"
        >

            <img
                src="<?php echo htmlspecialchars(
                    $monthlyBannerImage,
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>"
                alt="<?php echo htmlspecialchars(
                    $monthlyBanner['alt'],
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>"
                class="monthly-banner-image"
                loading="eager"
                decoding="async"
            >

        </a>

    </div>
</section>

<style>
/* =========================================================
   MONTHLY WEB BANNER
========================================================= */

.monthly-banner-section {
    padding: 54px 0 70px;
    background: #fff;
}

.monthly-banner-link {
    display: block;
    width: 100%;
    overflow: hidden;
    border-radius: 22px;
    background: #f3f4f5;
    box-shadow: 0 12px 34px rgba(17, 24, 39, .08);
    text-decoration: none;
}

.monthly-banner-image {
    display: block;
    width: 100%;
    height: auto;
    aspect-ratio: 1920 / 650;
    object-fit: cover;
    object-position: center;
    transition:
        transform .35s ease,
        filter .35s ease;
}

.monthly-banner-link:hover .monthly-banner-image {
    transform: scale(1.01);
    filter: brightness(.985);
}

@media (max-width: 900px) {
    .monthly-banner-section {
        padding: 40px 0 56px;
    }

    .monthly-banner-link {
        border-radius: 18px;
    }

    .monthly-banner-image {
        aspect-ratio: 16 / 6;
    }
}

@media (max-width: 600px) {
    .monthly-banner-section {
        padding: 30px 0 42px;
    }

    .monthly-banner-link {
        border-radius: 14px;
    }

    .monthly-banner-image {
        aspect-ratio: 4 / 3;
    }
}
</style>

<!-- =========================================================
     ABOUT — HOMEPAGE
========================================================= -->

<section
    class="about-section"
    id="tentang"
>

    <div class="phoenix-container about-grid">

        <div class="about-image">

            <img
                src="<?php echo $templateImages; ?>/about-production-finishing.png"
                alt="Proses Produksi Phoenix Kian Jaya"
            >

        </div>

        <div class="about-content">

            <span class="section-label">
                TENTANG KAMI
            </span>

            <h2>
                <?php echo nl2br(htmlspecialchars(
                    $phxHomepage['about_title'],
                    ENT_QUOTES,
                    'UTF-8'
                )); ?>
            </h2>

            <p>
                <?php echo htmlspecialchars(
                    $phxHomepage['about_text'],
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>
            </p>

            <p>
                Kami mengutamakan kualitas produksi,
                pelayanan terbaik serta proses pengerjaan
                yang efisien.
            </p>

            <div class="about-quotation-cta">

                <a
                    href="<?php echo $aboutUrl; ?>"
                    class="about-quotation-button"
                >
                    Selengkapnya Tentang Kami
                    <span>→</span>
                </a>

                <small>
                    Kenali profil, layanan, keunggulan
                    dan brand partner kami.
                </small>

            </div>

            <div class="about-stats">

                <div>
                    <strong>14+</strong>
                    <span>Tahun Pengalaman</span>
                </div>

                <div>
                    <strong>24 Jam</strong>
                    <span>Produksi</span>
                </div>

                <div>
                    <strong>Profesional</strong>
                    <span>Tim Produksi</span>
                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================================================
     PORTFOLIO
========================================================= -->

<section
    class="portfolio-section"
    id="portfolio"
>

    <div class="phoenix-container">

        <div class="section-heading portfolio-heading">

            <div>

                <span class="section-label">
                    HASIL PEKERJAAN
                </span>

                <h2>
                    Project Yang Telah<br>
                    Kami Kerjakan
                </h2>

            </div>

            <p>

                Beberapa hasil produksi Phoenix Kian Jaya
                untuk kebutuhan branding, acrylic,
                banner dan custom printing.

            </p>

        </div>

        <div class="homepage-portfolio-topline">

            <a
                href="<?php echo $portfolioUrl; ?>"
                class="homepage-portfolio-link"
            >
                Lihat Semua Portfolio
                <span>→</span>
            </a>

        </div>

        <div class="portfolio-home-grid">

            <article class="portfolio-home-card">

                <img
                    src="<?php echo $templateImages; ?>/hero-branding-hisense.png"
                    alt="Vehicle Branding"
                >

                <div class="portfolio-overlay">

                    <span>
                        Branding
                    </span>

                    <h3>
                        Vehicle Branding
                    </h3>

                </div>

            </article>

            <!-- PORTFOLIO ACRYLIC JUGA CLICKABLE -->

            <a
                href="<?php echo $acrylicUrl; ?>"
                class="portfolio-home-card"
            >

                <img
                    src="<?php echo $templateImages; ?>/portfolio-acrylic-asus-detail.png"
                    alt="Custom Acrylic Display"
                >

                <div class="portfolio-overlay">

                    <span>
                        Acrylic
                    </span>

                    <h3>
                        Custom Acrylic Display
                    </h3>

                </div>

            </a>

            <article class="portfolio-home-card">

                <img
                    src="<?php echo $templateImages; ?>/portfolio-banner-birthday.jpg"
                    alt="Custom Event Banner"
                >

                <div class="portfolio-overlay">

                    <span>
                        Banner
                    </span>

                    <h3>
                        Custom Event Banner
                    </h3>

                </div>

            </article>

            <article class="portfolio-home-card">

                <img
                    src="<?php echo $templateImages; ?>/portfolio-custom-printing.png"
                    alt="Custom Promotional Product"
                >

                <div class="portfolio-overlay">

                    <span>
                        Custom Printing
                    </span>

                    <h3>
                        Custom Promotional Product
                    </h3>

                </div>

            </article>

        </div>

    </div>

</section>

<!-- =========================================================
     SEO PHASE 2–5 COMPLETE — JAKARTA & JABODETABEK
     Konten lokal dibuat untuk manusia + search intent, bukan keyword stuffing.
========================================================= -->
<section class="seo-local-section" aria-labelledby="seo-local-title">
    <div class="phoenix-container">
        <div class="seo-local-head">
            <span class="seo-local-label">PERCETAKAN JAKARTA &amp; JABODETABEK</span>
            <h2 id="seo-local-title">Solusi Printing untuk Bisnis di Jakarta dan Jabodetabek.</h2>
            <p>
                Phoenix Kian Jaya melayani kebutuhan digital printing, banner, acrylic, sticker,
                display dan branding untuk perusahaan, retail, event dan berbagai kebutuhan promosi.
                Workshop kami berada di Jakarta Barat dengan area layanan mencakup Jakarta dan Jabodetabek.
            </p>
        </div>

        <div class="seo-local-grid">
            <article>
                <strong>Jakarta</strong>
                <p>Jakarta Barat, Pusat, Selatan, Timur dan Utara.</p>
            </article>
            <article>
                <strong>Tangerang</strong>
                <p>Tangerang dan Tangerang Selatan untuk kebutuhan printing dan branding.</p>
            </article>
            <article>
                <strong>Bekasi &amp; Depok</strong>
                <p>Melayani kebutuhan perusahaan, event, retail dan media promosi.</p>
            </article>
            <article>
                <strong>Bogor</strong>
                <p>Konsultasikan spesifikasi, jumlah dan kebutuhan pengiriman project Anda.</p>
            </article>
        </div>

        <div class="seo-local-services">
            <h3>Layanan yang dapat Anda konsultasikan</h3>
            <div>
                <a href="<?php echo $indoorOutdoorUrl; ?>">Indoor &amp; Outdoor Printing</a>
                <a href="<?php echo $acrylicUrl; ?>">Custom Acrylic</a>
                <a href="<?php echo $brandingUrl; ?>">Branding</a>
                <a href="<?php echo $productsUrl; ?>">Banner &amp; Media Promosi</a>
                <a href="<?php echo $percetakanJakartaUrl; ?>">Percetakan Jakarta</a>
                <a href="<?php echo $digitalPrintingJakartaUrl; ?>">Digital Printing Jakarta</a>
            </div>
        </div>
    </div>
</section>

<section class="seo-faq-section" aria-labelledby="seo-faq-title">
    <div class="phoenix-container seo-faq-wrap">
        <div class="seo-faq-intro">
            <span class="seo-local-label">FAQ</span>
            <h2 id="seo-faq-title">Pertanyaan Seputar Layanan Printing Phoenix Kian Jaya.</h2>
            <p>Informasi singkat sebelum Anda mengirim kebutuhan atau meminta penawaran.</p>
        </div>
        <div class="seo-faq-list">
            <details>
                <summary>Apakah Phoenix Kian Jaya melayani percetakan untuk perusahaan di Jakarta?</summary>
                <p>Ya. Kami melayani kebutuhan digital printing, acrylic, banner, display, sticker dan branding untuk perusahaan, bisnis, retail dan event.</p>
            </details>
            <details>
                <summary>Apakah layanan hanya tersedia di Jakarta Barat?</summary>
                <p>Tidak. Workshop kami berada di Jakarta Barat dan kami melayani kebutuhan pelanggan di Jakarta, Tangerang, Tangerang Selatan, Bekasi, Depok dan Bogor.</p>
            </details>
            <details>
                <summary>Bagaimana cara meminta quotation atau penawaran?</summary>
                <p>Gunakan menu Request Penawaran dan isi kebutuhan produk, jumlah, ukuran, material, deadline dan brief. Tim kami akan meninjau kebutuhan tersebut sebelum menindaklanjuti penawaran.</p>
            </details>
            <details>
                <summary>Apakah bisa konsultasi sebelum menentukan material dan spesifikasi?</summary>
                <p>Bisa. Anda dapat menghubungi tim kami untuk mendiskusikan kebutuhan project, penggunaan produk, ukuran, material dan jumlah sebelum produksi.</p>
            </details>
        </div>
    </div>
</section>

<style>
.seo-local-section,.seo-faq-section{padding:72px 0;background:#fff}
.seo-local-section{border-top:1px solid #eef1f4}
.seo-local-head{max-width:820px;margin-bottom:30px}
.seo-local-label{display:block;margin-bottom:10px;font-size:11px;font-weight:800;letter-spacing:.14em;color:#e90024}
.seo-local-head h2,.seo-faq-intro h2{margin:0 0 14px;font-size:clamp(28px,3vw,44px);line-height:1.08;color:#111820}
.seo-local-head p,.seo-faq-intro p,.seo-local-grid p,.seo-faq-list p{color:#637083;line-height:1.75}
.seo-local-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px}
.seo-local-grid article{padding:22px;border:1px solid #e7ebef;border-radius:16px;background:#fafbfc}
.seo-local-grid strong{font-size:16px;color:#111820}.seo-local-grid p{margin:8px 0 0;font-size:13px}
.seo-local-services{margin-top:28px;padding:24px;border-radius:18px;background:#111820;color:#fff}
.seo-local-services h3{margin:0 0 15px;font-size:16px}.seo-local-services div{display:flex;gap:10px;flex-wrap:wrap}
.seo-local-services a{padding:10px 14px;border:1px solid rgba(255,255,255,.22);border-radius:999px;color:#fff;text-decoration:none;font-size:12px;font-weight:700}
.seo-faq-section{background:#f7f8fa}.seo-faq-wrap{display:grid;grid-template-columns:.8fr 1.2fr;gap:48px;align-items:start}
.seo-faq-list details{border-bottom:1px solid #dde2e7;padding:0}.seo-faq-list summary{cursor:pointer;padding:18px 34px 18px 0;font-weight:750;color:#111820;position:relative;list-style:none}
.seo-faq-list summary::-webkit-details-marker{display:none}.seo-faq-list summary:after{content:'+';position:absolute;right:4px;top:16px;font-size:22px;color:#e90024}.seo-faq-list details[open] summary:after{content:'–'}
.seo-faq-list p{margin:0;padding:0 34px 18px 0;font-size:13px}
@media(max-width:900px){.seo-local-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.seo-faq-wrap{grid-template-columns:1fr;gap:20px}}
@media(max-width:560px){.seo-local-section,.seo-faq-section{padding:48px 0}.seo-local-grid{grid-template-columns:1fr}.seo-local-head h2,.seo-faq-intro h2{font-size:30px}}
</style>

<!-- =========================================================
     SEO PHASE 5 — AUTHORITY / TRUST CONTENT
     Tidak memakai review/client palsu. Fokus pada bukti operasional nyata.
========================================================= -->
<section class="seo-authority-section" aria-labelledby="seo-authority-title">
    <div class="phoenix-container">
        <div class="seo-authority-head">
            <span class="seo-local-label">KENAPA PHOENIX KIAN JAYA</span>
            <h2 id="seo-authority-title">Partner Printing untuk Kebutuhan Bisnis dari Brief hingga Produksi.</h2>
            <p>Sejak memulai usaha printing pada 2012 dan berbadan hukum sebagai PT Phoenix Kian Jaya pada 2018, kami menangani kebutuhan digital printing, acrylic dan branding dengan workshop di Jakarta Barat.</p>
        </div>
        <div class="seo-authority-grid">
            <article><strong>2012</strong><span>Mulai melayani kebutuhan printing.</span></article>
            <article><strong>Jakarta Barat</strong><span>Workshop operasional di Jelambar Baru.</span></article>
            <article><strong>B2B &amp; Event</strong><span>Alur konsultasi, quotation, produksi dan pengiriman.</span></article>
            <article><strong>Jabodetabek</strong><span>Area layanan Jakarta dan kota penyangga.</span></article>
        </div>
        <div class="seo-authority-actions">
            <a href="<?php echo $portfolioUrl; ?>">Lihat Portfolio</a>
            <a href="<?php echo $quotationUrl; ?>" class="primary">Request Penawaran</a>
        </div>
    </div>
</section>
<style>
.seo-authority-section{padding:72px 0;background:#fff;border-top:1px solid #eef1f4}.seo-authority-head{max-width:800px}.seo-authority-head h2{margin:0 0 14px;font-size:clamp(28px,3vw,42px);line-height:1.1;color:#111820}.seo-authority-head p{color:#637083;line-height:1.75}.seo-authority-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-top:28px}.seo-authority-grid article{padding:22px;border:1px solid #e7ebef;border-radius:16px}.seo-authority-grid strong{display:block;font-size:20px;color:#111820;margin-bottom:7px}.seo-authority-grid span{font-size:12px;line-height:1.6;color:#637083}.seo-authority-actions{display:flex;gap:10px;margin-top:24px}.seo-authority-actions a{padding:12px 18px;border:1px solid #dfe4e8;border-radius:999px;text-decoration:none;font-weight:800;font-size:12px;color:#111820}.seo-authority-actions a.primary{background:#e90024;border-color:#e90024;color:#fff}@media(max-width:800px){.seo-authority-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:520px){.seo-authority-grid{grid-template-columns:1fr}.seo-authority-section{padding:48px 0}}
</style>

<!-- =========================================================
     CTA / CONTACT
========================================================= -->

<section
    class="cta-section"
    id="kontak"
>

    <div class="cta-office-wrap">

        <div class="cta-office-grid">

            <!-- LEFT CONTENT -->

            <div class="cta-office-copy">

                <span class="cta-office-label">
                    BUTUH PRODUK PRINTING?
                </span>

                <h2>
                    Konsultasikan Kebutuhan
                    Printing Anda Bersama Kami.
                </h2>

                <p>
                    Tim kami siap membantu kebutuhan
                    digital printing, acrylic, branding
                    dan media promosi Anda.
                </p>

                <a
                    href="<?php echo $whatsappUrl; ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="cta-office-button"
                >
                    Hubungi Kami →
                </a>

            </div>

            <!-- RIGHT VISUAL -->

            <div class="cta-office-visual">

                <img
                    src="<?php echo $templateImages; ?>/contact-office-cs.png"
                    alt="Customer Service Phoenix Kian Jaya"
                >

            </div>

        </div>

    </div>

</section>

<?php endif; ?>

<!-- =========================================================
     ABOUT PAGE — SIMPLE PROFESSIONAL
========================================================= -->
<?php if ($isAboutPage) : ?>

<?php
$aboutClients = array(
    array('name'=>'AEON','image'=>'aeon.png'),
    array('name'=>'HP','image'=>'hp.png'),
    array('name'=>'ASUS','image'=>'asus.png'),
    array('name'=>'Burger King','image'=>'burger-king.png'),
    array('name'=>'Hisense','image'=>'hisense.png'),
    array('name'=>'Metrodata','image'=>'metrodata.png'),
    array('name'=>'McAfee','image'=>'mcafee.png'),
    array('name'=>'Super Air Jet','image'=>'super-air-jet.png'),
    array('name'=>'Roti O','image'=>'rotio.png'),
    array('name'=>'Avian Brands','image'=>'avian.png'),
    array('name'=>'Republic of Gamers','image'=>'rog.png'),
    array('name'=>'Pacific Garden','image'=>'pacific-garden.png')
);

$serviceGroups = array(
    array(
        'title'=>'Indoor & Outdoor Printing',
        'items'=>'Banner, Backdrop, Roll Up Banner, X/Y Banner, Tripod, Jumbo Banner'
    ),
    array(
        'title'=>'Acrylic',
        'items'=>'Acrylic display, POP display, custom acrylic dan kebutuhan promosi'
    ),
    array(
        'title'=>'Branding',
        'items'=>'Car branding, store branding, sticker, cutting sticker dan display branding'
    )
);

$whyPhoenix = array(
    array(
        'title'=>'Produksi 24 Jam',
        'text'=>'Didukung produksi langsung untuk membantu kebutuhan dengan waktu pengerjaan yang cepat.'
    ),
    array(
        'title'=>'Kualitas Terjaga',
        'text'=>'Fokus pada hasil cetak, material dan finishing yang sesuai dengan kebutuhan project.'
    ),
    array(
        'title'=>'Harga Kompetitif',
        'text'=>'Solusi produksi disesuaikan dengan kebutuhan dan skala project bisnis Anda.'
    ),
    array(
        'title'=>'Pengiriman Tepat Waktu',
        'text'=>'Proses produksi dan pengiriman dijalankan sesuai jadwal yang telah disepakati.'
    )
);

$clientIndustries = array(
    'Maskapai',
    'Smartphone',
    'Komputer',
    'Property',
    'Universitas',
    'Farmasi',
    'Consumer Goods',
    'Mall',
    'Tour & Travel',
    'Elektronik',
    'Food & Beverage',
    'Asuransi',
    'Cat',
    'Keuangan',
    'Advertising'
);
?>

<main class="about-simple">

    <!-- HERO -->
    <section class="as-hero">
        <div class="phoenix-container as-hero-grid">

            <div class="as-hero-copy">
                <span class="section-label">TENTANG PHOENIX KIAN JAYA</span>

                <h1>
                    Partner Printing<br>
                    Untuk Bisnis Anda.
                </h1>

                <p>
                    Phoenix Kian Jaya menyediakan solusi digital printing,
                    acrylic dan branding untuk kebutuhan bisnis, promosi
                    serta event.
                </p>

                <div class="as-hero-actions">
                    <a href="<?php echo $quotationUrl; ?>" class="as-btn as-btn-red">
                        Request Penawaran
                        <span>→</span>
                    </a>

                    <a href="<?php echo $contactUrl; ?>" class="as-btn as-btn-white">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="as-hero-facts">

                <div class="as-fact-main">
                    <small>BERAWAL SEJAK</small>
                    <strong>2012</strong>
                    <span>Phoenix Print</span>
                </div>

                <div class="as-fact-small">
                    <small>RESMI BERBADAN HUKUM</small>
                    <strong>2018</strong>
                    <span>PT Phoenix Kian Jaya</span>
                </div>

                <div class="as-fact-small">
                    <small>PRODUKSI</small>
                    <strong>24 JAM</strong>
                    <span>Untuk kebutuhan project Anda</span>
                </div>

            </div>

        </div>
    </section>


    <!-- SHORT PROFILE -->
    <section class="as-profile">
        <div class="phoenix-container as-profile-grid">

            <div class="as-profile-image">
                <img
                    src="<?php echo $templateImages; ?>/about-production-finishing.png"
                    alt="Proses produksi Phoenix Kian Jaya"
                    loading="eager"
                >
            </div>

            <div class="as-profile-copy">
                <span class="section-label">SEKILAS PHOENIX</span>

                <h2>
                    Cepat. Tepat.<br>
                    Berkualitas.
                </h2>

                <p>
                    Berawal dengan nama Phoenix Print pada tahun 2012,
                    kemudian resmi berbadan hukum sebagai PT Phoenix Kian Jaya
                    pada tahun 2018.
                </p>

                <p>
                    Kami hadir untuk membantu kebutuhan promosi dengan proses
                    yang efisien, pelayanan responsif, harga kompetitif dan
                    mutu produksi yang terjaga.
                </p>

                <div class="as-mini-values">
                    <span>Digital Printing</span>
                    <span>Acrylic</span>
                    <span>Branding</span>
                </div>
            </div>

        </div>
    </section>


    <!-- SERVICES -->
    <section class="as-services">
        <div class="phoenix-container">

            <div class="as-section-head">
                <div>
                    <span class="section-label">LAYANAN UTAMA</span>
                    <h2>
                        Tiga Solusi Utama<br>
                        Untuk Kebutuhan Anda.
                    </h2>
                </div>

                <p>
                    Fokus layanan Phoenix Kian Jaya untuk kebutuhan
                    promosi, branding dan display bisnis.
                </p>
            </div>

            <div class="as-service-grid">

                <?php foreach ($serviceGroups as $i => $service) : ?>

                    <article class="as-service-card">

                        <span class="as-number">
                            <?php echo sprintf('%02d', $i + 1); ?>
                        </span>

                        <h3>
                            <?php echo htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>

                        <p>
                            <?php echo htmlspecialchars($service['items'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>
    </section>


    <!-- WHY US -->
    <section class="as-why">
        <div class="phoenix-container">

            <div class="as-section-head as-section-head-dark">
                <div>
                    <span class="section-label">MENGAPA PHOENIX?</span>
                    <h2>
                        Yang Kami Jaga<br>
                        Dalam Setiap Project.
                    </h2>
                </div>

                <p>
                    Proses kerja yang sederhana, transparan dan fokus
                    pada hasil.
                </p>
            </div>

            <div class="as-why-grid">

                <?php foreach ($whyPhoenix as $i => $item) : ?>

                    <article class="as-why-card">

                        <span>
                            <?php echo sprintf('%02d', $i + 1); ?>
                        </span>

                        <h3>
                            <?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </h3>

                        <p>
                            <?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>
    </section>


    <!-- CLIENT INDUSTRIES -->
    <section class="as-clients">
        <div class="phoenix-container as-clients-grid">

            <div class="as-section-head as-section-head-left">
                <div>
                    <span class="section-label">KLIEN KAMI</span>
                    <h2>
                        Melayani Berbagai<br>
                        Bidang Bisnis.
                    </h2>
                </div>

                <p>
                    Phoenix Kian Jaya telah menangani kebutuhan promosi
                    dari berbagai sektor industri.
                </p>
            </div>

            <div class="as-industry-list">
                <?php foreach ($clientIndustries as $industry) : ?>
                    <span>
                        <?php echo htmlspecialchars($industry, ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                <?php endforeach; ?>
            </div>

        </div>
    </section>


    <!-- BRAND PARTNER -->
    <section class="as-partners">
        <div class="phoenix-container">

            <div class="as-section-head">
                <div>
                    <span class="section-label">BRAND PARTNER</span>
                    <h2>
                        Beberapa Brand<br>
                        Yang Pernah Bersama Kami.
                    </h2>
                </div>

                <p>
                    Sebagian brand yang pernah menjadi bagian dari
                    project dan kebutuhan produksi Phoenix Kian Jaya.
                </p>
            </div>

            <div class="as-brand-grid">

                <?php foreach ($aboutClients as $client) : ?>

                    <div class="as-brand-card">

                        <img
                            src="<?php echo $templateImages; ?>/clients/<?php echo rawurlencode($client['image']); ?>"
                            alt="<?php echo htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8'); ?>"
                            loading="lazy"
                            decoding="async"
                        >

                    </div>

                <?php endforeach; ?>

            </div>

        </div>
    </section>


    <!-- CONTACT CTA -->
    <section class="as-contact">
        <div class="phoenix-container">

            <div class="as-contact-card">

                <div>
                    <span class="section-label">MULAI PROJECT ANDA</span>

                    <h2>
                        Ada Kebutuhan Printing?
                    </h2>

                    <p>
                        Konsultasikan kebutuhan digital printing,
                        acrylic atau branding bersama tim Phoenix.
                    </p>
                </div>

                <div class="as-contact-actions">

                    <a
                        href="https://wa.me/6289643402214"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="as-btn as-btn-contact"
                    >
                        WhatsApp
                        <span>→</span>
                    </a>

                    <a href="<?php echo $quotationUrl; ?>" class="as-btn as-btn-contact-outline">
                        Request Penawaran
                    </a>

                </div>

            </div>

        </div>
    </section>

</main>


<style>

/* =========================================================
   ABOUT PAGE — SIMPLE PROFESSIONAL
========================================================= */

.about-simple,
.about-simple * {
    box-sizing: border-box;
}

.about-simple {
    background: #fff;
    color: #151a20;
}


/* HERO */
.as-hero {
    padding: 92px 0 95px;
    background:
        radial-gradient(
            circle at 88% 8%,
            rgba(227, 6, 19, .08),
            transparent 30%
        ),
        #fff;
}

.as-hero-grid {
    display: grid;
    grid-template-columns:
        minmax(0, 1.25fr)
        minmax(340px, .75fr);
    gap: 75px;
    align-items: end;
}

.as-hero-copy {
    max-width: 760px;
}

.as-hero-copy h1 {
    margin: 15px 0 22px;
    max-width: 760px;
    font-size: clamp(54px, 6.5vw, 88px);
    line-height: .94;
    letter-spacing: -.06em;
}

.as-hero-copy p {
    max-width: 610px;
    margin: 0;
    color: #68717a;
    font-size: 15px;
    line-height: 1.75;
}

.as-hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 30px;
}

.as-btn {
    min-height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    padding: 0 20px;
    border-radius: 11px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 900;
}

.as-btn-red {
    background: #e30613;
    color: #fff;
}

.as-btn-white {
    border: 1px solid #dfe3e6;
    background: #fff;
    color: #151a20;
}

.as-hero-facts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.as-fact-main,
.as-fact-small {
    padding: 24px;
    border: 1px solid #e2e5e8;
    border-radius: 18px;
    background: #f8f9fa;
}

.as-fact-main {
    grid-column: 1 / -1;
    background: #151a20;
    color: #fff;
}

.as-hero-facts small,
.as-hero-facts span {
    display: block;
}

.as-hero-facts small {
    margin-bottom: 18px;
    color: #8b949c;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: .1em;
}

.as-fact-main small {
    color: #ff6570;
}

.as-hero-facts strong {
    display: block;
    margin-bottom: 5px;
    font-size: 38px;
    letter-spacing: -.04em;
}

.as-fact-main strong {
    font-size: 66px;
}

.as-hero-facts span {
    color: #747c84;
    font-size: 10px;
}

.as-fact-main span {
    color: #c9ced3;
}


/* PROFILE */
.as-profile {
    padding: 70px 0;
    background: #f5f6f7;
}

.as-profile-grid {
    display: grid;
    grid-template-columns:
        minmax(0, .95fr)
        minmax(0, 1fr);
    gap: 70px;
    align-items: center;
}

.as-profile-image {
    overflow: hidden;
    border-radius: 22px;
    box-shadow: 0 18px 42px rgba(17, 24, 39, .09);
}

.as-profile-image img {
    display: block;
    width: 100%;
    aspect-ratio: 4 / 3;
    object-fit: cover;
}

.as-profile-copy {
    max-width: 620px;
}

.as-profile-copy h2,
.as-section-head h2 {
    margin: 10px 0 14px;
    font-size: clamp(38px, 4.6vw, 60px);
    line-height: .98;
    letter-spacing: -.05em;
}

.as-profile-copy p {
    margin: 0 0 14px;
    color: #6e767e;
    font-size: 13px;
    line-height: 1.8;
}

.as-mini-values {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 24px;
}

.as-mini-values span {
    padding: 8px 11px;
    border: 1px solid #dfe3e6;
    border-radius: 999px;
    background: #fff;
    color: #373e45;
    font-size: 9px;
    font-weight: 900;
}


/* COMMON SECTION HEAD */
.as-section-head {
    display: grid;
    grid-template-columns:
        minmax(0, 1fr)
        minmax(280px, .6fr);
    gap: 42px;
    align-items: end;
    margin-bottom: 26px;
}

.as-section-head > p {
    margin: 0 0 5px;
    color: #747c84;
    font-size: 12px;
    line-height: 1.75;
}


/* SERVICES */
.as-services {
    padding: 64px 0 72px;
}

.as-service-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    align-items: stretch;
}

.as-service-card {
    min-height: 210px;
    display: flex;
    flex-direction: column;
    padding: 24px;
    border: 1px solid #e2e5e8;
    border-radius: 18px;
    background: #fff;
}

.as-number {
    color: #e30613;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: .1em;
}

.as-service-card h3 {
    max-width: 280px;
    margin: 42px 0 10px;
    font-size: 25px;
    line-height: 1.08;
}

.as-service-card p {
    margin: 0;
    color: #707880;
    font-size: 11px;
    line-height: 1.7;
}


/* WHY */
.as-why {
    padding: 68px 0 76px;
    background: #151a20;
}

.as-section-head-dark h2 {
    color: #fff;
}

.as-section-head-dark .section-label {
    color: #ff4b56;
}

.as-section-head-dark > p {
    color: #9da6ad;
}

.as-why-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
}

.as-why-card {
    min-height: 185px;
    padding: 22px;
    border: 1px solid rgba(255, 255, 255, .10);
    border-radius: 16px;
    background: rgba(255, 255, 255, .04);
}

.as-why-card > span {
    color: #ff4b56;
    font-size: 9px;
    font-weight: 900;
}

.as-why-card h3 {
    margin: 30px 0 8px;
    color: #fff;
    font-size: 18px;
}

.as-why-card p {
    margin: 0;
    color: #aeb6bd;
    font-size: 11px;
    line-height: 1.7;
}


/* CLIENTS */
.as-clients {
    padding: 70px 0;
}

.as-clients-grid {
    display: grid;
    grid-template-columns:
        minmax(0, .8fr)
        minmax(0, 1.2fr);
    gap: 70px;
    align-items: start;
}

.as-section-head-left {
    display: block;
    margin: 0;
}

.as-section-head-left > p {
    max-width: 430px;
    margin-top: 20px;
}

.as-industry-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.as-industry-list span {
    padding: 11px 14px;
    border: 1px solid #e1e4e7;
    border-radius: 999px;
    background: #f8f9fa;
    color: #4c555d;
    font-size: 10px;
    font-weight: 800;
}


/* PARTNERS */
.as-partners {
    padding: 72px 0 82px;
    background: #f6f7f8;
}

.as-brand-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 11px;
}

.as-brand-card {
    aspect-ratio: 1 / 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    border: 1px solid #e2e5e8;
    border-radius: 16px;
    background: #fff;
}

.as-brand-card img {
    display: block;
    width: auto;
    height: auto;
    max-width: 82%;
    max-height: 60%;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: .8;
    transition: .2s ease;
}

.as-brand-card:hover img {
    filter: none;
    opacity: 1;
    transform: scale(1.04);
}


/* CONTACT */
.as-contact {
    padding: 62px 0 76px;
}

.as-contact-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 45px;
    padding: 42px 46px;
    border-radius: 20px;
    background: #e30613;
    color: #fff;
}

.as-contact-card .section-label {
    color: #fff;
}

.as-contact-card h2 {
    margin: 10px 0 10px;
    font-size: clamp(34px, 4vw, 52px);
    line-height: 1;
    letter-spacing: -.04em;
}

.as-contact-card p {
    max-width: 520px;
    margin: 0;
    color: #ffe6e8;
    font-size: 12px;
    line-height: 1.7;
}

.as-contact-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.as-btn-contact {
    background: #fff;
    color: #e30613;
}

.as-btn-contact-outline {
    border: 1px solid rgba(255,255,255,.42);
    color: #fff;
}


/* RESPONSIVE */
@media (max-width: 1000px) {

    .as-hero-grid,
    .as-profile-grid,
    .as-clients-grid {
        grid-template-columns: 1fr;
        gap: 42px;
    }

    .as-hero-facts {
        max-width: 650px;
    }

    .as-section-head {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .as-service-grid {
        grid-template-columns: 1fr;
    }

    .as-service-card {
        min-height: 190px;
    }

    .as-why-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .as-brand-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }
}


@media (max-width: 700px) {

    .as-hero {
        padding: 58px 0 65px;
    }

    .as-hero-copy h1 {
        font-size: clamp(43px, 13vw, 58px);
    }

    .as-hero-copy p {
        font-size: 14px;
    }

    .as-hero-facts {
        grid-template-columns: 1fr;
    }

    .as-fact-main {
        grid-column: auto;
    }

    .as-fact-main strong {
        font-size: 52px;
    }

    .as-profile,
    .as-services,
    .as-why,
    .as-clients,
    .as-partners {
        padding: 48px 0 54px;
    }

    .as-profile-image {
        border-radius: 16px;
    }

    .as-profile-copy h2,
    .as-section-head h2 {
        font-size: clamp(36px, 10vw, 48px);
    }

    .as-service-card {
        min-height: 145px;
        padding: 20px;
    }

    .as-service-card h3 {
        margin-top: 24px;
        font-size: 22px;
    }

    .as-why-grid {
        grid-template-columns: 1fr;
    }

    .as-why-card {
        min-height: 155px;
    }

    .as-brand-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .as-brand-card {
        padding: 13px;
        border-radius: 11px;
    }

    .as-brand-card img {
        filter: none;
        opacity: 1;
        max-width: 90%;
    }

    .as-contact {
        padding: 55px 0 70px;
    }

    .as-contact-card {
        align-items: flex-start;
        flex-direction: column;
        padding: 27px;
        border-radius: 17px;
    }

    .as-contact-actions {
        width: 100%;
    }

    .as-contact-actions .as-btn {
        flex: 1 1 100%;
    }
}

</style>

<?php endif; ?>


<!-- =========================================================
     SEO PHASE 3 — LANDING PAGE RENDERER
========================================================= -->
<?php if ($isSeoLandingPage) : ?>
<?php
$landingContent = array(
 'percetakan-jakarta' => array(
   'eyebrow'=>'PERCETAKAN JAKARTA','h1'=>'Percetakan Jakarta untuk Bisnis, Perusahaan & Event',
   'intro'=>'Phoenix Kian Jaya membantu kebutuhan percetakan dan media promosi di Jakarta, mulai dari banner dan display hingga acrylic, sticker dan branding. Tim kami dapat membantu meninjau spesifikasi sebelum quotation dan produksi.',
   'why'=>'Cocok untuk kebutuhan corporate, activation, event, retail, promosi dan project custom yang membutuhkan koordinasi spesifikasi, jumlah, deadline dan pengiriman.',
   'area'=>'Workshop berada di Jelambar Baru, Jakarta Barat. Layanan mencakup Jakarta Barat, Pusat, Selatan, Timur dan Utara serta area Jabodetabek.'),
 'digital-printing-jakarta' => array(
   'eyebrow'=>'DIGITAL PRINTING JAKARTA','h1'=>'Digital Printing Jakarta untuk Kebutuhan Corporate & Promosi',
   'intro'=>'Layanan digital printing untuk media indoor dan outdoor, banner, display, sticker serta kebutuhan promosi perusahaan. Kebutuhan dapat dikonsultasikan berdasarkan ukuran, material, jumlah dan target penggunaan.',
   'why'=>'Digital printing cocok untuk project yang membutuhkan fleksibilitas ukuran dan jumlah, materi promosi event, display retail, branding dan kebutuhan komunikasi visual perusahaan.',
   'area'=>'Produksi ditangani melalui workshop Phoenix Kian Jaya di Jakarta Barat dengan layanan pengiriman dan project untuk Jakarta serta Jabodetabek.'),
 'percetakan-jakarta-barat' => array(
   'eyebrow'=>'WORKSHOP JAKARTA BARAT','h1'=>'Percetakan & Digital Printing Jakarta Barat',
   'intro'=>'Phoenix Kian Jaya memiliki workshop di Jelambar Baru, Grogol Petamburan, Jakarta Barat. Kami melayani digital printing, acrylic, banner, display, sticker dan branding untuk bisnis, perusahaan dan event.',
   'why'=>'Lokasi workshop di Jakarta Barat memudahkan koordinasi kebutuhan project di area Jakarta, termasuk konsultasi spesifikasi, pengecekan file, produksi, finishing dan pengiriman.',
   'area'=>'Workshop: Jl. Jelambar Selatan XI No.30 RT005/RW005, Jelambar Baru, Grogol Petamburan, Jakarta Barat 11460.'),
 'layanan-printing-jabodetabek' => array(
   'eyebrow'=>'AREA LAYANAN','h1'=>'Layanan Printing Jakarta & Jabodetabek',
   'intro'=>'Selain Jakarta, Phoenix Kian Jaya melayani kebutuhan printing dan branding untuk project di Tangerang, Tangerang Selatan, Bekasi, Depok dan Bogor. Lokasi tersebut adalah area layanan, bukan cabang fisik.',
   'why'=>'Untuk project di luar Jakarta Barat, tim dapat menyesuaikan proses konsultasi, quotation, produksi dan pengiriman berdasarkan jenis produk, volume serta deadline.',
   'area'=>'Area layanan: seluruh wilayah Jakarta, Tangerang, Tangerang Selatan, Bekasi, Depok dan Bogor.')
);
$lc = $landingContent[$seoLandingKey];

if ($phoenixContentReady) {
    $phxLandingDb = phxContentSeoPage($phoenixContentDb, $seoLandingKey);
    if ($phxLandingDb) {
        if (trim((string)$phxLandingDb->eyebrow) !== '') $lc['eyebrow'] = $phxLandingDb->eyebrow;
        if (trim((string)$phxLandingDb->h1) !== '') $lc['h1'] = $phxLandingDb->h1;
        if (trim((string)$phxLandingDb->intro) !== '') $lc['intro'] = $phxLandingDb->intro;
        if (trim((string)$phxLandingDb->body_1) !== '') $lc['why'] = $phxLandingDb->body_1;
        if (trim((string)$phxLandingDb->body_2) !== '') $lc['area'] = $phxLandingDb->body_2;
    }
}
?>
<main class="seo-landing-page">
 <section class="seo-landing-hero"><div class="phoenix-container"><span><?php echo htmlspecialchars($lc['eyebrow'],ENT_QUOTES,'UTF-8'); ?></span><h1><?php echo htmlspecialchars($lc['h1'],ENT_QUOTES,'UTF-8'); ?></h1><p><?php echo htmlspecialchars($lc['intro'],ENT_QUOTES,'UTF-8'); ?></p><div class="seo-landing-actions"><a class="primary" href="<?php echo $quotationUrl; ?>">Request Penawaran</a><a href="<?php echo $whatsappUrl; ?>" target="_blank" rel="noopener">Konsultasi WhatsApp</a></div></div></section>
 <section class="seo-landing-body"><div class="phoenix-container"><div class="seo-landing-grid"><article><small>KEBUTUHAN</small><h2>Solusi printing yang disesuaikan dengan project.</h2><p><?php echo htmlspecialchars($lc['why'],ENT_QUOTES,'UTF-8'); ?></p></article><article><small>AREA</small><h2>Lokasi & cakupan layanan yang jelas.</h2><p><?php echo htmlspecialchars($lc['area'],ENT_QUOTES,'UTF-8'); ?></p></article></div><h2 class="seo-service-title">Layanan Utama</h2><div class="seo-service-links"><a href="<?php echo $indoorOutdoorUrl; ?>">Indoor &amp; Outdoor Printing</a><a href="<?php echo $acrylicUrl; ?>">Custom Acrylic</a><a href="<?php echo $brandingUrl; ?>">Branding</a><a href="<?php echo $spandukBackdropUrl; ?>">Spanduk &amp; Backdrop</a></div><div class="seo-related"><strong>Jelajahi juga:</strong><a href="<?php echo $percetakanJakartaUrl; ?>">Percetakan Jakarta</a><a href="<?php echo $digitalPrintingJakartaUrl; ?>">Digital Printing Jakarta</a><a href="<?php echo $percetakanJakartaBaratUrl; ?>">Jakarta Barat</a><a href="<?php echo $jabodetabekServiceUrl; ?>">Jabodetabek</a></div></div></section>
</main>
<style>
.seo-landing-page{background:#fff}.seo-landing-hero{padding:100px 0 70px;background:linear-gradient(180deg,#f7f9fb,#fff)}.seo-landing-hero .phoenix-container{max-width:960px}.seo-landing-hero span,.seo-landing-body small{font-size:11px;font-weight:900;letter-spacing:.14em;color:#e90024}.seo-landing-hero h1{max-width:850px;margin:14px 0 18px;font-size:clamp(38px,5vw,68px);line-height:1.02;color:#111820}.seo-landing-hero p{max-width:760px;font-size:16px;line-height:1.8;color:#637083}.seo-landing-actions{display:flex;gap:10px;margin-top:28px;flex-wrap:wrap}.seo-landing-actions a{padding:13px 20px;border:1px solid #d9dfe4;border-radius:999px;text-decoration:none;color:#111820;font-size:12px;font-weight:850}.seo-landing-actions a.primary{background:#e90024;border-color:#e90024;color:#fff}.seo-landing-body{padding:65px 0 90px}.seo-landing-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}.seo-landing-grid article{padding:30px;border:1px solid #e6eaee;border-radius:18px}.seo-landing-grid h2{font-size:24px;line-height:1.2;margin:10px 0}.seo-landing-grid p{color:#637083;line-height:1.75}.seo-service-title{margin:48px 0 18px}.seo-service-links{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}.seo-service-links a{padding:22px;border-radius:14px;background:#111820;color:#fff;text-decoration:none;font-weight:800}.seo-related{display:flex;gap:12px;align-items:center;flex-wrap:wrap;margin-top:34px;padding-top:24px;border-top:1px solid #e8ecef}.seo-related a{color:#5d6875;font-size:12px}@media(max-width:760px){.seo-landing-hero{padding:70px 0 50px}.seo-landing-grid{grid-template-columns:1fr}.seo-service-links{grid-template-columns:1fr 1fr}}@media(max-width:480px){.seo-service-links{grid-template-columns:1fr}}
</style>
<?php endif; ?>

<!-- =========================================================
     PRODUCT CATALOG PAGE
========================================================= -->

<?php if ($isProductPage) : ?>

    <?php

    $productPageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/product-page.php';

    if (file_exists($productPageFile)) {

        require $productPageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Product page belum ditemukan.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>

<!-- =========================================================
     ACRYLIC DETAIL
========================================================= -->

<?php if ($isAcrylicPage) : ?>

    <?php

    $acrylicPageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/acrylic-page.php';

    if (file_exists($acrylicPageFile)) {

        require $acrylicPageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Acrylic page belum ditemukan.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>

<!-- =========================================================
     INDOOR OUTDOOR
========================================================= -->

<?php if ($isIndoorOutdoorPage) : ?>

    <?php

    $pageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/indoor-outdoor-page.php';

    if (file_exists($pageFile)) {

        require $pageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Indoor & Outdoor page belum dibuat.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>

<!-- =========================================================
     BRANDING
========================================================= -->

<?php if ($isBrandingPage) : ?>

    <?php

    $pageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/branding-page.php';

    if (file_exists($pageFile)) {

        require $pageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Branding page belum dibuat.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>
    
<!-- =========================================================
     CONTACT PAGE
========================================================= -->

<?php if ($isContactPage) : ?>

    <?php

    $contactPageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/contact-page.php';

    if (file_exists($contactPageFile)) {

        require $contactPageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Contact page belum ditemukan.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>    
    
<!-- =========================================================
     PORTFOLIO PAGE
========================================================= -->

<?php if ($isPortfolioPage) : ?>

    <?php

    $portfolioPageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/portfolio-page.php';

    if (file_exists($portfolioPageFile)) {

        require $portfolioPageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Portfolio page belum ditemukan.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>

<?php if ($isQuotationPage) : ?>

    <?php

    $quotationPageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/quotation-page.php';

    if (file_exists($quotationPageFile)) {

        require $quotationPageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Quotation page belum ditemukan.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>

<!-- =========================================================
     GENERIC PRODUCT DETAIL
========================================================= -->

<?php if ($isGenericProductDetail) : ?>

    <?php

    $productDetailPageFile =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/product-detail-page.php';

    if (
        file_exists(
            $productDetailPageFile
        )
    ) {

        require $productDetailPageFile;

    } else {

        echo '<main class="phoenix-component">';
        echo '<h1>Product detail page belum ditemukan.</h1>';
        echo '</main>';

    }

    ?>

<?php endif; ?>

<!-- =========================================================
     NORMAL JOOMLA PAGE
========================================================= -->

<?php if (
    !$isHome
    &&
    !$isProductPage
    &&
    !$isAcrylicPage
    &&
    !$isIndoorOutdoorPage
    &&
    !$isBrandingPage
    &&
    !$isGenericProductDetail
    &&
    !$isContactPage
    &&
    !$isPortfolioPage
    &&
    !$isQuotationPage
    &&
    !$isAboutPage
    &&
    !$isSeoLandingPage
) : ?>

    <main class="phoenix-component">

        <jdoc:include type="message" />

        <jdoc:include type="component" />

    </main>

<?php endif; ?>

<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="phoenix-footer">

    <div class="phoenix-container footer-grid">

        <div class="footer-brand">

            <a href="<?php echo $homeUrl; ?>">

                <img
                    src="<?php echo $this->baseurl; ?>/images/Logo-PKJ.png"
                    alt="Phoenix Kian Jaya"
                >

            </a>

            <p>

                Solusi digital printing,
                acrylic, branding dan media
                promosi untuk kebutuhan bisnis Anda.

            </p>

        </div>

        <div class="footer-column">

            <h4>
                Produk
            </h4>

            <a href="<?php echo $spandukBackdropUrl; ?>">
                Digital Printing
            </a>

            <!-- ACRYLIC FOOTER -->

            <a href="<?php echo $acrylicUrl; ?>">
                Acrylic
            </a>

            <a href="<?php echo $vehicleBrandingUrl; ?>">
                Branding
            </a>

            <a href="<?php echo $displayBrandingUrl; ?>">
                Banner &amp; Display
            </a>

        </div>

        <div class="footer-column">

            <h4>
                Perusahaan
            </h4>

            <a href="<?php echo $aboutUrl; ?>">
                Tentang Kami
            </a>

            <a href="<?php echo $productsUrl; ?>">
                Produk
            </a>

            <a href="<?php echo $portfolioUrl; ?>">
                Portfolio
            </a>

            <a href="<?php echo $contactUrl; ?>">
                Kontak
            </a>

            <a href="<?php echo $quotationUrl; ?>">
                Request Penawaran
            </a>

        </div>

        <div class="footer-column">

            <h4>
                Hubungi Kami
            </h4>

            <a
                href="<?php echo $whatsappUrl; ?>"
                target="_blank"
                rel="noopener noreferrer"
            >
                WhatsApp
            </a>

            <a href="mailto:admin@phoenixdigiprint.com">
                admin@phoenixdigiprint.com
            </a>

            <a href="tel:+622129448544">
                +62 21 2944 8544
            </a>

        </div>

    </div>

    <div class="footer-bottom">

        <div class="phoenix-container">

            <span>

                © <?php echo date('Y'); ?>
                Phoenix Kian Jaya.
                All Rights Reserved.

            </span>

        </div>

    </div>

</footer>

<!-- =========================================================
     FLOATING WHATSAPP
========================================================= -->

<a
    href="<?php echo $whatsappUrl; ?>"
    target="_blank"
    rel="noopener noreferrer"
    class="floating-whatsapp"
    aria-label="Hubungi Phoenix Kian Jaya melalui WhatsApp"
>

    <svg
        class="wa-svg"
        viewBox="0 0 32 32"
        aria-hidden="true"
    >

        <path
            fill="currentColor"
            d="M16.04 3C8.86 3 3.02 8.82 3.02 16c0 2.29.6 4.52 1.74 6.49L3 29l6.66-1.75A12.9 12.9 0 0 0 16.04 29C23.22 29 29 23.18 29 16S23.22 3 16.04 3Zm0 23.73c-2.06 0-4.07-.56-5.82-1.63l-.42-.25-3.95 1.04 1.05-3.84-.27-.44A10.7 10.7 0 0 1 5.3 16c0-5.93 4.82-10.75 10.74-10.75S26.78 10.07 26.78 16 21.96 26.73 16.04 26.73Zm5.9-8.04c-.32-.16-1.9-.94-2.2-1.05-.29-.1-.5-.16-.71.16-.21.32-.82 1.05-1 1.26-.19.21-.37.24-.69.08-.32-.16-1.34-.49-2.56-1.57-.95-.84-1.58-1.88-1.77-2.2-.18-.32-.02-.49.14-.65.14-.14.32-.37.48-.56.16-.19.21-.32.32-.53.1-.21.05-.4-.03-.56-.08-.16-.71-1.72-.98-2.35-.26-.62-.52-.54-.71-.55h-.6c-.21 0-.56.08-.85.4-.29.32-1.11 1.09-1.11 2.65 0 1.56 1.14 3.07 1.3 3.28.16.21 2.24 3.42 5.43 4.8.76.33 1.35.52 1.81.67.76.24 1.45.21 2 .13.61-.09 1.9-.78 2.17-1.53.27-.75.27-1.4.19-1.53-.08-.13-.29-.21-.61-.37Z"
        />

    </svg>

</a>

<!-- =========================================================
     INTERACTIONS
========================================================= -->
<script>
(function () {
    var header = document.querySelector('.phoenix-header');
    var toggle = document.querySelector('.promindo-menu-toggle');
    var menu = document.querySelector('.promindo-mobile-menu');
    var track = document.getElementById('homepageProductTrack');
    var timer = null;

    function updateNavbar() {
        if (!header) return;
        header.classList.toggle('is-scrolled', window.scrollY > 80);
    }

    updateNavbar();
    window.addEventListener('scroll', updateNavbar, { passive: true });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 760 && menu && toggle) {
            menu.classList.remove('is-open');
            toggle.classList.remove('is-active');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            var open = menu.classList.toggle('is-open');
            toggle.classList.toggle('is-active', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('is-open');
                toggle.classList.remove('is-active');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    if (track) {
        function cardStep() {
            var card = track.querySelector('.product-card');
            if (!card) return 0;
            var style = getComputedStyle(track);
            return card.offsetWidth + parseFloat(style.gap || style.columnGap || 0);
        }

        function nextProduct() {
            var step = cardStep();
            if (!step) return;

            var max = track.scrollWidth - track.clientWidth;
            if (track.scrollLeft >= max - 10) {
                track.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                track.scrollBy({ left: step, behavior: 'smooth' });
            }
        }

        function stopSlider() {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }
        }

        function startSlider() {
            stopSlider();
            timer = setInterval(nextProduct, 3500);
        }

        startSlider();
        track.addEventListener('mouseenter', stopSlider);
        track.addEventListener('mouseleave', startSlider);
        track.addEventListener('touchstart', stopSlider, { passive: true });
        track.addEventListener('touchend', startSlider, { passive: true });

        document.addEventListener('visibilitychange', function () {
            document.hidden ? stopSlider() : startSlider();
        });
    }
})();
</script>


<?php

/* =========================================================
   ANALYTICS / ADS TRACKING
========================================================= */

$trackingFile =
    JPATH_THEMES
    . '/'
    . $this->template
    . '/tracking.php';

if (file_exists($trackingFile)) {
    require $trackingFile;
}

?>

</body>

</html>
