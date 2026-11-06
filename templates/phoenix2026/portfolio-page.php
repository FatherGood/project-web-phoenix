<?php
defined('_JEXEC') or die;

/* =========================================================
   PORTFOLIO DATA
========================================================= */

$portfolioItems = array(

    array(
        'title' => 'Vehicle Branding',
        'category' => 'Branding',
        'image' => $templateImages . '/hero-branding-hisense.png',
        'url' => $vehicleBrandingUrl
    ),

    array(
        'title' => 'Custom Acrylic Display',
        'category' => 'Acrylic',
        'image' => $templateImages . '/portfolio-acrylic-asus-detail.png',
        'url' => $acrylicUrl
    ),

    array(
        'title' => 'Custom Event Banner',
        'category' => 'Banner',
        'image' => $templateImages . '/portfolio-banner-birthday.jpg',
        'url' => $spandukBackdropUrl
    ),

    array(
        'title' => 'Custom Promotional Product',
        'category' => 'Custom Printing',
        'image' => $templateImages . '/portfolio-custom-printing.png',
        'url' => $productsUrl
    ),

    array(
        'title' => 'Display Branding',
        'category' => 'Display',
        'image' => $templateImages . '/display_branding.png',
        'url' => $displayBrandingUrl
    ),

    array(
        'title' => 'Acrylic Product Display',
        'category' => 'Acrylic',
        'image' => $templateImages . '/acrylic.png',
        'url' => $acrylicUrl
    )

);


/* =========================================================
   CLIENT LOGOS
   Simpan semua file logo di:
   /templates/phoenix2026/images/clients/
========================================================= */

$clients = array(

    array(
        'name' => 'AEON',
        'image' => 'aeon.png'
    ),

    array(
        'name' => 'HP',
        'image' => 'hp.png'
    ),

    array(
        'name' => 'Indofood',
        'image' => 'indofood.png'
    ),

    array(
        'name' => 'Burger King',
        'image' => 'burger-king.png'
    ),

    array(
        'name' => 'ASUS',
        'image' => 'asus.png'
    ),

    array(
        'name' => 'Super Air Jet',
        'image' => 'super-air-jet.png'
    ),

    array(
        'name' => 'Roti O',
        'image' => 'rotio.png'
    ),

    array(
        'name' => 'Avian Brands',
        'image' => 'avian.png'
    ),

    array(
        'name' => 'Republic of Gamers',
        'image' => 'rog.png'
    ),

    array(
        'name' => 'Hisense',
        'image' => 'hisense.png'
    ),

    array(
        'name' => 'McAfee',
        'image' => 'mcafee.png'
    ),

    array(
        'name' => 'Metrodata',
        'image' => 'metrodata.png'
    ),

    array(
        'name' => 'Fiesta',
        'image' => 'fiesta.png'
    ),

    array(
        'name' => 'Pacific Garden',
        'image' => 'pacific-garden.png'
    )

);

?>


<section class="portfolio-page">


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="portfolio-page-hero">

        <div class="phoenix-container portfolio-page-hero-grid">

            <div class="portfolio-page-hero-copy">

                <span class="portfolio-page-eyebrow">
                    PORTFOLIO PHOENIX DIGI PRINT
                </span>

                <h1>
                    Hasil Produksi<br>
                    Yang Bicara.
                </h1>

                <p>
                    Berbagai project digital printing, acrylic,
                    branding, banner dan media promosi yang telah
                    kami kerjakan untuk kebutuhan bisnis dan event.
                </p>

            </div>


            <div class="portfolio-page-hero-note">

                <span>
                    PROJECT HIGHLIGHT
                </span>

                <strong>
                    Printing • Acrylic • Branding • Display
                </strong>

                <p>
                    Dari kebutuhan sederhana hingga project corporate,
                    kami membantu menerjemahkan ide menjadi media promosi
                    yang siap digunakan.
                </p>

            </div>

        </div>

    </section>


    <!-- =====================================================
         SELECTED PROJECTS
    ====================================================== -->

    <section class="portfolio-showcase">

        <div class="phoenix-container">

            <div class="portfolio-section-heading">

                <div>

                    <span class="section-label">
                        HASIL PEKERJAAN
                    </span>

                    <h2>
                        Selected Projects
                    </h2>

                </div>

                <p>
                    Beberapa contoh hasil produksi yang mewakili
                    layanan utama Phoenix Digi Print.
                </p>

            </div>


            <div class="portfolio-masonry">

                <?php foreach ($portfolioItems as $index => $item) : ?>

                    <a
                        href="<?php echo htmlspecialchars(
                            $item['url'],
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>"
                        class="portfolio-project-card portfolio-project-card-<?php echo (int) ($index + 1); ?>"
                    >

                        <img
                            src="<?php echo htmlspecialchars(
                                $item['image'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            alt="<?php echo htmlspecialchars(
                                $item['title'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            loading="lazy"
                        >

                        <div class="portfolio-project-overlay">

                            <span>
                                <?php echo htmlspecialchars(
                                    $item['category'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </span>

                            <h3>
                                <?php echo htmlspecialchars(
                                    $item['title'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </h3>

                            <em>
                                View Project →
                            </em>

                        </div>

                    </a>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CLIENT MARQUEE
    ====================================================== -->

    <section class="portfolio-client-section">

        <div class="phoenix-container">

            <div class="portfolio-client-heading">

                <span class="section-label">
                    CLIENT & BRAND
                </span>

                <h2>
                    Dipercaya Oleh<br>
                    Berbagai Brand.
                </h2>

                <p>
                    Beberapa perusahaan dan brand yang pernah menjadi
                    bagian dari project dan kebutuhan produksi kami.
                </p>

            </div>

        </div>


        <div class="client-marquee">

            <div class="client-marquee-track">


                <!-- GROUP 1 -->

                <div class="client-marquee-group">

                    <?php foreach ($clients as $client) : ?>

                        <div class="client-logo-card">

                            <img
                                src="<?php echo $templateImages; ?>/clients/<?php echo rawurlencode($client['image']); ?>"
                                alt="<?php echo htmlspecialchars(
                                    $client['name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"
                                loading="lazy"
                                decoding="async"
                            >

                        </div>

                    <?php endforeach; ?>

                </div>


                <!-- GROUP 2 / DUPLICATE FOR SEAMLESS LOOP -->

                <div
                    class="client-marquee-group"
                    aria-hidden="true"
                >

                    <?php foreach ($clients as $client) : ?>

                        <div class="client-logo-card">

                            <img
                                src="<?php echo $templateImages; ?>/clients/<?php echo rawurlencode($client['image']); ?>"
                                alt=""
                                loading="lazy"
                                decoding="async"
                            >

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         PROCESS
    ====================================================== -->

    <section class="portfolio-process">

        <div class="phoenix-container">

            <div class="portfolio-section-heading portfolio-process-heading">

                <div>

                    <span class="section-label">
                        CARA KAMI BEKERJA
                    </span>

                    <h2>
                        Dari Brief Sampai Produksi.
                    </h2>

                </div>

            </div>


            <div class="portfolio-process-grid">

                <article>

                    <span>01</span>

                    <h3>
                        Konsultasi
                    </h3>

                    <p>
                        Kami memahami kebutuhan, ukuran, material,
                        jumlah dan target penggunaan produk.
                    </p>

                </article>


                <article>

                    <span>02</span>

                    <h3>
                        Persiapan File
                    </h3>

                    <p>
                        File dan spesifikasi dicek agar siap masuk
                        ke proses produksi.
                    </p>

                </article>


                <article>

                    <span>03</span>

                    <h3>
                        Produksi
                    </h3>

                    <p>
                        Proses dikerjakan sesuai material dan metode
                        produksi yang dibutuhkan.
                    </p>

                </article>


                <article>

                    <span>04</span>

                    <h3>
                        Quality Control
                    </h3>

                    <p>
                        Produk diperiksa sebelum diserahkan atau
                        dikirim kepada pelanggan.
                    </p>

                </article>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="portfolio-page-cta">

        <div class="phoenix-container portfolio-page-cta-inner">

            <div>

                <span>
                    PROJECT BERIKUTNYA BISA MILIK ANDA
                </span>

                <h2>
                    Punya project printing?<br>
                    Mari diskusikan.
                </h2>

            </div>


            <a
                href="<?php echo $whatsappUrl; ?>"
                target="_blank"
                rel="noopener noreferrer"
            >
                Konsultasi Sekarang →
            </a>

        </div>

    </section>


</section>
