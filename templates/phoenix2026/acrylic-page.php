<?php
defined('_JEXEC') or die;

$templateImages =
    $this->baseurl
    . '/templates/'
    . $this->template
    . '/images';

$whatsappAcrylic =
    'https://wa.me/6287880500744?text='
    . rawurlencode(
        'Halo Phoenix Kian Jaya, saya ingin konsultasi mengenai produk Acrylic.'
    );
?>


<!-- =========================================================
     ACRYLIC PRODUCT DETAIL
========================================================= -->

<main class="detail-product-page">


    <!-- =====================================================
         BREADCRUMB
    ====================================================== -->

    <section class="detail-breadcrumb">

        <div class="phoenix-container">

            <a href="<?php echo $this->baseurl; ?>/">
                Home
            </a>

            <span>›</span>

            <a href="<?php echo $this->baseurl; ?>/product">
                Produk
            </a>

            <span>›</span>

            <strong>
                Acrylic
            </strong>

        </div>

    </section>



    <!-- =====================================================
         PRODUCT HERO
    ====================================================== -->

    <section class="detail-product-hero">

        <div class="phoenix-container detail-product-grid">


            <!-- PRODUCT IMAGE -->

            <div class="detail-product-gallery">


                <div class="detail-main-image">

                    <img
                        src="<?php echo $templateImages; ?>/product-acrylic-asus.png"
                        alt="Acrylic Phoenix Kian Jaya"
                        id="acrylicMainImage"
                    >

                </div>


                <div class="detail-thumbnails">

                    <button type="button" class="detail-thumb active" data-image="<?php echo $templateImages; ?>/product-acrylic-asus.png">
                        <img src="<?php echo $templateImages; ?>/product-acrylic-asus.png" alt="Acrylic display ASUS">
                    </button>

                    <button type="button" class="detail-thumb" data-image="<?php echo $templateImages; ?>/portfolio-acrylic-asus-detail.png">
                        <img src="<?php echo $templateImages; ?>/portfolio-acrylic-asus-detail.png" alt="Acrylic display ROG">
                    </button>

                    <button type="button" class="detail-thumb" data-image="<?php echo $templateImages; ?>/product-acrylic-halal.png">
                        <img src="<?php echo $templateImages; ?>/product-acrylic-halal.png" alt="Acrylic display Halal Indonesia">
                    </button>

                    <button type="button" class="detail-thumb" data-image="<?php echo $templateImages; ?>/product-acrylic-crusita-hand.png">
                        <img src="<?php echo $templateImages; ?>/product-acrylic-crusita-hand.png" alt="Acrylic custom Crusita">
                    </button>

                    <button type="button" class="detail-thumb" data-image="<?php echo $templateImages; ?>/product-acrylic-crusita-display.png">
                        <img src="<?php echo $templateImages; ?>/product-acrylic-crusita-display.png" alt="Acrylic display Crusita">
                    </button>

                    <button type="button" class="detail-thumb" data-image="<?php echo $templateImages; ?>/product-acrylic-oto-display.png">
                        <img src="<?php echo $templateImages; ?>/product-acrylic-oto-display.png" alt="Acrylic display OTO">
                    </button>

                </div>


            </div>



            <!-- PRODUCT INFORMATION -->

            <div class="detail-product-info">


                <span class="detail-product-category">
                    ACRYLIC
                </span>


                <h1>
                    Acrylic
                </h1>


                <p class="detail-product-intro">

                    Solusi produk acrylic custom untuk kebutuhan
                    display, promosi, branding, informasi produk,
                    maupun kebutuhan perusahaan dan event.

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
                                Dapat disesuaikan dengan kebutuhan
                                desain dan branding perusahaan Anda.
                            </p>

                        </div>

                    </div>


                    <div class="detail-feature">

                        <span class="detail-feature-icon">
                            ✓
                        </span>

                        <div>

                            <strong>
                                Produksi Presisi
                            </strong>

                            <p>
                                Diproduksi menggunakan mesin acrylic
                                untuk mendapatkan hasil yang rapi dan presisi.
                            </p>

                        </div>

                    </div>


                    <div class="detail-feature">

                        <span class="detail-feature-icon">
                            ✓
                        </span>

                        <div>

                            <strong>
                                Cocok untuk Bisnis
                            </strong>

                            <p>
                                Digunakan untuk kebutuhan display,
                                media promosi dan kebutuhan branding.
                            </p>

                        </div>

                    </div>


                </div>



                <!-- CTA -->

                <div class="detail-product-actions">


                    <a
                        href="<?php echo $whatsappAcrylic; ?>"
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
         PRODUCT DESCRIPTION
    ====================================================== -->

    <section class="detail-product-description">

        <div class="phoenix-container detail-description-grid">


            <div>


                <span class="detail-section-label">
                    PHOENIX DIGI PRINT
                </span>


                <h2>
                    Acrylic Custom untuk
                    Kebutuhan Promosi Anda
                </h2>


            </div>



            <div class="detail-description-copy">


                <p>

                    Phoenix Kian Jaya menyediakan layanan produksi
                    acrylic untuk mendukung kebutuhan promosi,
                    display dan branding perusahaan.

                </p>


                <p>

                    Proses produksi didukung teknologi mesin acrylic.
                    Phoenix Kian Jaya mencantumkan HANNIU LASER
                    sebagai mesin yang digunakan untuk pengerjaan
                    acrylic.

                </p>


            </div>


        </div>

    </section>



    <!-- =====================================================
         PRODUCT EXAMPLES
    ====================================================== -->

    <section class="detail-product-showcase">

        <div class="phoenix-container">


            <div class="detail-showcase-heading">


                <span class="detail-section-label">
                    HASIL PRODUKSI
                </span>


                <h2>
                    Contoh Acrylic
                    Phoenix Kian Jaya
                </h2>


            </div>



            <div class="detail-showcase-grid">

                <article class="detail-showcase-card">
                    <img src="<?php echo $templateImages; ?>/product-acrylic-asus.png" alt="Custom acrylic display ASUS" loading="lazy" decoding="async">
                    <div><span>ACRYLIC</span><h3>Custom Acrylic Display ASUS</h3></div>
                </article>

                <article class="detail-showcase-card">
                    <img src="<?php echo $templateImages; ?>/portfolio-acrylic-asus-detail.png" alt="Custom acrylic display ROG" loading="lazy" decoding="async">
                    <div><span>DISPLAY</span><h3>Acrylic Display ROG</h3></div>
                </article>

                <article class="detail-showcase-card">
                    <img src="<?php echo $templateImages; ?>/product-acrylic-halal.png" alt="Acrylic signage Halal Indonesia" loading="lazy" decoding="async">
                    <div><span>SIGNAGE</span><h3>Acrylic Sign Halal Indonesia</h3></div>
                </article>

                <article class="detail-showcase-card">
                    <img src="<?php echo $templateImages; ?>/product-acrylic-crusita-hand.png" alt="Custom acrylic letter Crusita" loading="lazy" decoding="async">
                    <div><span>CUSTOM</span><h3>Custom Acrylic Letter Crusita</h3></div>
                </article>

                <article class="detail-showcase-card">
                    <img src="<?php echo $templateImages; ?>/product-acrylic-crusita-display.png" alt="Acrylic display Crusita" loading="lazy" decoding="async">
                    <div><span>DISPLAY</span><h3>Acrylic Display Crusita</h3></div>
                </article>

                <article class="detail-showcase-card">
                    <img src="<?php echo $templateImages; ?>/product-acrylic-oto-display.png" alt="Acrylic display OTO" loading="lazy" decoding="async">
                    <div><span>DISPLAY</span><h3>Acrylic Display OTO</h3></div>
                </article>

            </div>


        </div>

    </section>



    <!-- =====================================================
         PRODUCT CTA
    ====================================================== -->

    <section class="detail-product-cta">


        <div class="phoenix-container detail-product-cta-inner">


            <div>


                <span>
                    BUTUH PRODUK ACRYLIC CUSTOM?
                </span>


                <h2>

                    Konsultasikan kebutuhan
                    Acrylic Anda bersama kami.

                </h2>


                <p>

                    Tim Phoenix Kian Jaya siap membantu
                    kebutuhan desain dan produksi Anda.

                </p>


            </div>



            <a
                href="<?php echo $whatsappAcrylic; ?>"
                target="_blank"
                rel="noopener noreferrer"
            >

                Hubungi Kami →

            </a>


        </div>


    </section>


</main>



<!-- =========================================================
     IMAGE GALLERY SCRIPT
========================================================= -->

<script>

(function () {

    var mainImage =
        document.getElementById(
            'acrylicMainImage'
        );

    var thumbs =
        document.querySelectorAll(
            '.detail-thumb'
        );


    if (!mainImage || !thumbs.length) {
        return;
    }


    for (
        var i = 0;
        i < thumbs.length;
        i++
    ) {


        thumbs[i].addEventListener(
            'click',
            function () {


                for (
                    var j = 0;
                    j < thumbs.length;
                    j++
                ) {

                    thumbs[j]
                        .classList
                        .remove('active');

                }


                this.classList.add(
                    'active'
                );


                mainImage.src =
                    this.getAttribute(
                        'data-image'
                    );


            }
        );


    }


})();

</script>