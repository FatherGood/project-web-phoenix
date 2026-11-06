<?php

defined('_JEXEC') or die;

/* =========================================================
   BREADCRUMB PRODUCT NAME
========================================================= */

$breadcrumbProductNames = array(

    'x-banner' =>
        'X Banner',

    'y-banner' =>
        'Y Banner',

    'mini-x-banner' =>
        'Mini X Banner',

    'roll-up-banner' =>
        'Roll Up Banner',

    'tripod-banner' =>
        'Tripod Banner',

    'jumbo-banner' =>
        'Jumbo Banner',

    'spanduk-backdrop-t-banner' =>
        'Spanduk / Backdrop / T Banner',

    'vehicle-branding' =>
        'Vehicle Branding',

    'display-branding' =>
        'Display Branding'

);

$breadcrumbProductName =
    isset(
        $breadcrumbProductNames[$productSlug]
    )
        ? $breadcrumbProductNames[$productSlug]
        : 'Produk';

/* =========================================================
   TEMPLATE IMAGES
========================================================= */

$templateImages =
    $this->baseurl
    . '/templates/'
    . $this->template
    . '/images';


/* =========================================================
   PRODUCT IMAGE RESOLVER
   Prioritas:
   1. /templates/phoenix2026/images/produk/
   2. /images/produk/

   Dengan cache-buster supaya gambar baru langsung terlihat.
========================================================= */

$productImage = function ($relativePath) {

    $relativePath = ltrim((string) $relativePath, '/');
    $version = '20260908-02';

    $templateFs =
        JPATH_THEMES
        . '/'
        . $this->template
        . '/images/produk/'
        . $relativePath;

    if (file_exists($templateFs)) {
        return
            $this->baseurl
            . '/templates/'
            . $this->template
            . '/images/produk/'
            . $relativePath
            . '?v='
            . $version;
    }

    return
        $this->baseurl
        . '/images/produk/'
        . $relativePath
        . '?v='
        . $version;
};


/* =========================================================
   PRODUCT DETAIL DATABASE
   Untuk tahap pertama hanya X Banner
========================================================= */

$productDetails = array(


/* =====================================================
   X BANNER
====================================================== */

'x-banner' => array(

    'name' =>
        'X Banner',

    'category' =>
        'INDOOR & OUTDOOR',

    'image' =>
        $productImage('02.jpg'),

    'intro' =>
        'Media display portable yang praktis untuk kebutuhan promosi, pameran, event dan branding perusahaan.',

    'description_title' =>
        'X Banner untuk Kebutuhan Promosi dan Event',

    'description_1' =>
        'X Banner merupakan media display yang ringan, praktis dan mudah dipasang untuk berbagai kebutuhan promosi indoor maupun event.',

    'description_2' =>
        'Desain cetak dapat disesuaikan dengan kebutuhan promosi, identitas visual perusahaan serta konsep event Anda.'

),

/* =====================================================
   Y BANNER
====================================================== */

'y-banner' => array(

    'name' =>
        'Y Banner',

    'category' =>
        'INDOOR & OUTDOOR',

    'image' =>
        $productImage('03.jpg'),

    'intro' =>
        'Media display portable dengan konstruksi penyangga berbentuk Y untuk kebutuhan promosi, event, pameran dan branding perusahaan.',

    'description_title' =>
        'Y Banner untuk Promosi yang Praktis dan Fleksibel',

    'description_1' =>
        'Y Banner merupakan media promosi yang mudah dipasang dan dipindahkan, sehingga cocok digunakan untuk kebutuhan event, pameran, booth maupun area promosi indoor.',

    'description_2' =>
        'Desain dan materi visual dapat disesuaikan dengan kebutuhan kampanye, informasi produk maupun identitas visual perusahaan Anda.'

),


/* =====================================================
   MINI X BANNER
====================================================== */

'mini-x-banner' => array(

    'name' =>
        'Mini X Banner',

    'category' =>
        'INDOOR & OUTDOOR',

    'image' =>
        $productImage('04.jpg'),

    'gallery' => array(
        $productImage('04.jpg'),
        $productImage('gallery/mini-x-banner-brother-multi-angle.jpg'),
        $productImage('gallery/mini-x-banner-brother-transparent-view.jpg')
    ),

    'intro' =>
        'Media display berukuran compact untuk kebutuhan promosi di meja, counter, booth dan area display dengan ruang terbatas.',

    'description_title' =>
        'Mini X Banner untuk Display Promosi yang Compact',

    'description_1' =>
        'Mini X Banner cocok digunakan sebagai media promosi berukuran kecil pada meja, counter, booth, display produk maupun area pelayanan pelanggan.',

    'description_2' =>
        'Desain visual dapat disesuaikan dengan kebutuhan promosi, informasi produk serta identitas visual perusahaan Anda.'

),
    
/* =====================================================
   ROLL UP BANNER
====================================================== */

'roll-up-banner' => array(

    'name' =>
        'Roll Up Banner',

    'category' =>
        'INDOOR & OUTDOOR',

    'image' =>
        $productImage('05.jpg'),

    'intro' =>
        'Media display portable dengan sistem roll yang praktis untuk kebutuhan promosi, pameran, event, booth dan branding perusahaan.',

    'description_title' =>
        'Roll Up Banner untuk Display Promosi yang Praktis',

    'description_1' =>
        'Roll Up Banner merupakan media promosi yang mudah dipasang, mudah dibawa dan cocok digunakan untuk pameran, event, booth, area reception maupun kebutuhan promosi indoor.',

    'description_2' =>
        'Desain visual dapat disesuaikan dengan kebutuhan kampanye, informasi produk serta identitas visual perusahaan Anda.'

),
    
/* =====================================================
   TRIPOD BANNER
====================================================== */

'tripod-banner' => array(

    'name' =>
        'Tripod Banner',

    'category' =>
        'INDOOR & OUTDOOR',

    'image' =>
        $productImage('06.jpg'),

    'gallery' => array(
        $productImage('06.jpg')
    ),

    'intro' =>
        'Media display dengan penyangga tripod yang fleksibel untuk kebutuhan promosi, pameran, event dan berbagai aktivitas branding.',

    'description_title' =>
        'Tripod Banner untuk Display Promosi yang Fleksibel',

    'description_1' =>
        'Tripod Banner cocok digunakan sebagai media promosi untuk event, pameran, area display, booth maupun kebutuhan komunikasi visual perusahaan.',

    'description_2' =>
        'Desain visual dapat disesuaikan dengan kebutuhan promosi, informasi produk dan identitas visual perusahaan Anda.'

),
    
/* =====================================================
   JUMBO BANNER
====================================================== */

'jumbo-banner' => array(

    'name' =>
        'Jumbo Banner',

    'category' =>
        'INDOOR & OUTDOOR',

    'image' =>
        $productImage('JumboBanner.jpg'),

    'intro' =>
        'Media display berukuran besar untuk kebutuhan promosi, event, pameran dan komunikasi visual yang membutuhkan area tampil lebih luas.',

    'description_title' =>
        'Jumbo Banner untuk Promosi dengan Visibilitas Maksimal',

    'description_1' =>
        'Jumbo Banner merupakan media display berukuran besar yang cocok digunakan untuk event, pameran, area promosi maupun kebutuhan komunikasi visual dengan jangkauan pandang yang lebih luas.',

    'description_2' =>
        'Ukuran dan desain visual dapat disesuaikan dengan kebutuhan promosi, lokasi pemasangan serta identitas visual perusahaan Anda.'

),
    

    /* =====================================================
   SPANDUK / BACKDROP / T BANNER
====================================================== */

'spanduk-backdrop-t-banner' => array(

    'name' =>
        'Spanduk / Backdrop / T Banner',

    'category' =>
        'INDOOR & OUTDOOR',

    'image' =>
        $productImage('01.jpg'),

    'gallery' => array(
        $productImage('01.jpg')
    ),

    'intro' =>
        'Solusi media cetak untuk kebutuhan promosi, event, backdrop, branding dan berbagai komunikasi visual perusahaan.',

    'description_title' =>
        'Spanduk, Backdrop dan T Banner untuk Berbagai Kebutuhan Promosi',

    'description_1' =>
        'Spanduk, Backdrop dan T Banner dapat digunakan untuk berbagai kebutuhan promosi seperti acara perusahaan, event, pameran, branding booth maupun penyampaian informasi.',

    'description_2' =>
        'Ukuran, desain dan kebutuhan pemasangan dapat disesuaikan dengan konsep acara maupun identitas visual perusahaan Anda.'

),  
        
/* =====================================================
   VEHICLE BRANDING
====================================================== */

'vehicle-branding' => array(

    'name' =>
        'Vehicle Branding',

    'category' =>
        'BRANDING',

    'image' =>
        $templateImages
        . '/hero-branding-hisense.png',

    'intro' =>
        'Solusi branding kendaraan untuk meningkatkan visibilitas brand saat kendaraan beroperasi di jalan maupun berada di area perusahaan.',

    'description_title' =>
        'Vehicle Branding untuk Meningkatkan Visibilitas Brand Anda',

    'description_1' =>
        'Vehicle Branding memanfaatkan area kendaraan sebagai media komunikasi visual untuk memperkuat identitas perusahaan dan meningkatkan eksposur brand.',

    'description_2' =>
        'Desain branding dapat disesuaikan dengan identitas visual perusahaan, kebutuhan kampanye serta area pemasangan pada kendaraan.'

),
            
/* =====================================================
   DISPLAY BRANDING
====================================================== */

'display-branding' => array(

    'name' =>
        'Display Branding',

    'category' =>
        'BRANDING',

    'image' =>
        $templateImages
        . '/product-banner-display-pharos.png',

    'intro' =>
        'Media display branding untuk membantu meningkatkan visibilitas brand pada event, pameran, booth, area promosi dan kebutuhan komunikasi visual perusahaan.',

    'description_title' =>
        'Display Branding untuk Memperkuat Identitas Brand Anda',

    'description_1' =>
        'Display Branding dapat digunakan sebagai media komunikasi visual untuk memperkuat identitas perusahaan pada berbagai kebutuhan promosi, event, booth dan pameran.',

    'description_2' =>
        'Desain visual dapat disesuaikan dengan identitas brand, kebutuhan kampanye, konsep event serta area pemasangan yang tersedia.'

)

);

/* =========================================================
   VALIDATE CURRENT PRODUCT
========================================================= */

if (
    !isset($productSlug)
    ||
    !isset($productDetails[$productSlug])
) {

    echo '<main class="phoenix-component">';
    echo '<h1>Produk tidak ditemukan.</h1>';
    echo '</main>';

    return;

}


/* =========================================================
   CURRENT PRODUCT
========================================================= */

$product =
    $productDetails[$productSlug];

/* =========================================================
   PRODUCT GALLERY
   Produk tanpa gallery tetap memakai image utama.
========================================================= */

$productGallery =
    (
        isset($product['gallery'])
        &&
        is_array($product['gallery'])
        &&
        !empty($product['gallery'])
    )
        ? $product['gallery']
        : array($product['image']);



/* =========================================================
   WHATSAPP
========================================================= */

$whatsappProduct =
    'https://wa.me/6287880500744?text='
    . rawurlencode(
        'Halo Phoenix Kian Jaya, saya ingin konsultasi mengenai produk '
        . $product['name']
        . '.'
    );

?>


<main class="detail-product-page">


    <!-- =====================================================
         BREADCRUMB
    ====================================================== -->

    <section class="detail-breadcrumb">

        <div class="phoenix-container">


            <a href="<?php echo $this->baseurl; ?>/">
                Home
            </a>


            <span>
                ›
            </span>


            <a href="<?php echo $this->baseurl; ?>/product">
                Produk
            </a>


            <span>
                ›
            </span>


            <strong>

                <?php
                echo htmlspecialchars(
                    $product['name'],
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>

            </strong>


        </div>

    </section>



    <!-- =====================================================
         PRODUCT HERO
    ====================================================== -->

    <section class="detail-product-hero">

        <div class="phoenix-container detail-product-grid">


            <!-- IMAGE -->

            <div class="detail-product-gallery">

                <div class="detail-main-image">

                    <img
                        src="<?php echo htmlspecialchars(
                            $productGallery[0],
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>"
                        alt="<?php echo htmlspecialchars(
                            $product['name'] . ' Phoenix Kian Jaya',
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>"
                        id="phoenixProductMainImage"
                    >

                </div>

                <?php if (count($productGallery) >= 1) : ?>

                    <div class="detail-thumbnails">

                        <?php foreach ($productGallery as $galleryIndex => $galleryImage) : ?>

                            <button
                                type="button"
                                class="detail-thumb<?php echo $galleryIndex === 0 ? ' active' : ''; ?>"
                                data-product-image="<?php echo htmlspecialchars(
                                    $galleryImage,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"
                                aria-label="<?php echo htmlspecialchars(
                                    'Lihat foto ' . ($galleryIndex + 1) . ' ' . $product['name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"
                            >

                                <img
                                    src="<?php echo htmlspecialchars(
                                        $galleryImage,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                                    alt="<?php echo htmlspecialchars(
                                        $product['name'] . ' foto ' . ($galleryIndex + 1),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                                    loading="lazy"
                                    decoding="async"
                                >

                            </button>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            </div>



            <!-- PRODUCT INFORMATION -->

            <div class="detail-product-info">


                <span class="detail-product-category">

                    <?php
                    echo htmlspecialchars(
                        $product['category'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </span>


                <h1>

                    <?php
                    echo htmlspecialchars(
                        $product['name'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </h1>


                <p class="detail-product-intro">

                    <?php
                    echo htmlspecialchars(
                        $product['intro'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </p>



                <div class="detail-product-features">


                    <div class="detail-feature">

                        <span class="detail-feature-icon">
                            ✓
                        </span>

                        <div>

                            <strong>
                                Custom Design
                            </strong>

                            <p>

                                Desain dapat disesuaikan
                                dengan kebutuhan promosi
                                dan branding Anda.

                            </p>

                        </div>

                    </div>



                    <div class="detail-feature">

                        <span class="detail-feature-icon">
                            ✓
                        </span>

                        <div>

                            <strong>
                                Praktis Digunakan
                            </strong>

                            <p>

                                Cocok digunakan untuk
                                event, pameran, promosi
                                maupun display perusahaan.

                            </p>

                        </div>

                    </div>



                    <div class="detail-feature">

                        <span class="detail-feature-icon">
                            ✓
                        </span>

                        <div>

                            <strong>
                                Printing Berkualitas
                            </strong>

                            <p>

                                Diproduksi untuk menghasilkan
                                tampilan visual yang rapi
                                dan profesional.

                            </p>

                        </div>

                    </div>


                </div>



                <!-- ACTIONS -->

                <div class="detail-product-actions">


                    <a
                        href="<?php echo $whatsappProduct; ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="detail-primary-button"
                    >

                        Hubungi Kami

                        <span>
                            →
                        </span>

                    </a>


                    <a
                        href="<?php echo $this->baseurl; ?>/product"
                        class="detail-secondary-button"
                    >

                        Lihat Produk Lain

                    </a>


                </div>


            </div>


        </div>

    </section>



    <!-- =====================================================
         DESCRIPTION
    ====================================================== -->

    <section class="detail-product-description">

        <div class="phoenix-container detail-description-grid">


            <div>


                <span class="detail-section-label">
                    PHOENIX KIAN JAYA
                </span>


                <h2>

                    <?php
                    echo htmlspecialchars(
                        $product['description_title'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </h2>


            </div>



            <div class="detail-description-copy">


                <p>

                    <?php
                    echo htmlspecialchars(
                        $product['description_1'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </p>


                <p>

                    <?php
                    echo htmlspecialchars(
                        $product['description_2'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </p>


            </div>


        </div>

    </section>



    <!-- =====================================================
         SHOWCASE
    ====================================================== -->

    <section class="detail-product-showcase">

        <div class="phoenix-container">

            <div class="detail-showcase-heading">

                <span class="detail-section-label">
                    HASIL PRODUKSI
                </span>

                <h2>
                    <?php echo htmlspecialchars(
                        $product['name'],
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>
                    Phoenix Kian Jaya
                </h2>

            </div>

            <div class="detail-showcase-grid">

                <?php foreach ($productGallery as $galleryIndex => $galleryImage) : ?>

                    <article class="detail-showcase-card">

                        <img
                            src="<?php echo htmlspecialchars(
                                $galleryImage,
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            alt="<?php echo htmlspecialchars(
                                $product['name']
                                . ' Phoenix Kian Jaya - foto '
                                . ($galleryIndex + 1),
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            loading="lazy"
                            decoding="async"
                        >

                        <div>

                            <span>
                                <?php echo htmlspecialchars(
                                    $product['category'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </span>

                            <h3>
                                <?php echo htmlspecialchars(
                                    $product['name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </h3>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>



    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="detail-product-cta">


        <div class="phoenix-container detail-product-cta-inner">


            <div>


                <span>

                    BUTUH
                    <?php
                    echo strtoupper(
                        htmlspecialchars(
                            $product['name'],
                            ENT_QUOTES,
                            'UTF-8'
                        )
                    );
                    ?>?

                </span>


                <h2>

                    Konsultasikan kebutuhan

                    <?php
                    echo htmlspecialchars(
                        $product['name'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                    Anda bersama kami.

                </h2>


                <p>

                    Tim Phoenix Kian Jaya siap membantu
                    kebutuhan desain dan produksi Anda.

                </p>


            </div>



            <a
                href="<?php echo $whatsappProduct; ?>"
                target="_blank"
                rel="noopener noreferrer"
            >

                Hubungi Kami →

            </a>


        </div>


    </section>


</main>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var mainImage = document.getElementById('phoenixProductMainImage');
    var thumbnails = document.querySelectorAll('.detail-thumb[data-product-image]');

    if (!mainImage || !thumbnails.length) {
        return;
    }

    thumbnails.forEach(function (thumbnail) {
        thumbnail.addEventListener('click', function () {
            var imageUrl = this.getAttribute('data-product-image');

            if (!imageUrl) {
                return;
            }

            mainImage.setAttribute('src', imageUrl);

            thumbnails.forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');
        });
    });
});
</script>

