<?php

defined('_JEXEC') or die;


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


/* =========================================================
   PRODUCT URLS
========================================================= */

$acrylicUrl =
    $this->baseurl
    . '/product/acrylic';

$indoorOutdoorUrl =
    $this->baseurl
    . '/product?phoenix_category=indoor-outdoor';

$brandingUrl =
    $this->baseurl
    . '/product?phoenix_category=branding';


/* =========================================================
   WHATSAPP
========================================================= */

$whatsappNumber =
    '6289643402214';

$whatsappMessage =
    rawurlencode(
        'Halo Phoenix Digi Print, saya ingin konsultasi mengenai produk printing.'
    );

$whatsappUrl =
    'https://wa.me/'
    . $whatsappNumber
    . '?text='
    . $whatsappMessage;


/* =========================================================
   PRODUCT DATA
========================================================= */

$products = array(


    /* =====================================================
       INDOOR & OUTDOOR PRINTING
    ====================================================== */

    array(
        'name' => 'Spanduk / Backdrop / T Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => '/images/produk/01.jpg',
        'url' => $this->baseurl . '/product/spanduk-backdrop-t-banner'
    ),


    array(
        'name' => 'X Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => '/images/produk/02.jpg',
        'url' => $this->baseurl . '/product?phoenix_product=x-banner'
    ),


    array(
        'name' => 'Y Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => '/images/produk/03.jpg',
        'url' => $this->baseurl . '/product?phoenix_product=y-banner'
    ),


    array(
        'name' => 'Mini X Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => '/images/produk/04.jpg',
        'url' => $this->baseurl . '/product?phoenix_product=mini-x-banner'
    ),


    array(
        'name' => 'Roll Up Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => '/images/produk/05.jpg',
        'url' => $this->baseurl . '/product?phoenix_product=roll-up-banner'
    ),


    array(
        'name' => 'Tripod Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => '/images/produk/06.jpg',
        'url' => $this->baseurl . '/product?phoenix_product=tripod-banner'
    ),


    array(
        'name' => 'Jumbo Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => '/images/produk/JumboBanner.jpg',
        'url' => $this->baseurl . '/product?phoenix_product=jumbo-banner'
    ),



    /* =====================================================
       ACRYLIC
       Semua produk Acrylic menuju /product/acrylic
    ====================================================== */

    array(
        'name' => 'Acrylic',
        'category' => 'acrylic',
        'category_label' => 'Acrylic',
        'image' => $templateImages . '/product-acrylic-asus.png',
        'url' => $acrylicUrl
    ),


    /* =====================================================
       BRANDING
    ====================================================== */

    array(
        'name' => 'Vehicle Branding',
        'category' => 'branding',
        'category_label' => 'Branding',
        'image' => $templateImages . '/hero-branding-hisense.png',
        'url' => $this->baseurl . '/product?phoenix_product=vehicle-branding'
    ),


    array(
        'name' => 'Display Branding',
        'category' => 'branding',
        'category_label' => 'Branding',
        'image' => $templateImages . '/product-banner-display-pharos.png',
        'url' => $this->baseurl . '/product/display-branding'
    ),

    /* =====================================================
       DISPLAY BRANDING — SUB-PRODUCTS
       Placeholder foto dapat diganti melalui folder:
       /templates/NAMA_TEMPLATE/images/product-placeholders/
    ====================================================== */

    array(
        'name' => 'PVC',
        'category' => 'display-branding',
        'category_label' => 'Display Branding',
        'image' => $templateImages . '/product-placeholders/pvc.svg',
        'url' => $this->baseurl . '/product/pvc'
    ),

    array(
        'name' => 'Foam Board',
        'category' => 'display-branding',
        'category_label' => 'Display Branding',
        'image' => $templateImages . '/product-placeholders/foam-board.svg',
        'url' => $this->baseurl . '/product/foam-board'
    ),

    array(
        'name' => 'Impraboard',
        'category' => 'display-branding',
        'category_label' => 'Display Branding',
        'image' => $templateImages . '/product-placeholders/impraboard.svg',
        'url' => $this->baseurl . '/product/impraboard'
    )

);

?>



<!-- =========================================================
     PRODUCT HERO
========================================================= -->

<section class="product-page-hero">

    <div class="phoenix-container">


        <span class="product-page-label">

            PRODUK PHOENIX DIGI PRINT

        </span>


        <h1>

            Solusi Printing Untuk
            Setiap Kebutuhan Bisnis.

        </h1>


        <p>

            Temukan berbagai kebutuhan digital printing,
            acrylic, branding dan media promosi
            Phoenix Digi Print.

        </p>


    </div>

</section>




<!-- =========================================================
     PRODUCT CATALOG
========================================================= -->

<section class="product-catalog-page">

    <div class="phoenix-container">



        <!-- =================================================
             SEARCH
        ================================================== -->

        <div class="catalog-search">

            <input
                type="search"
                id="catalogSearch"
                placeholder="Cari Produk..."
                autocomplete="off"
            >

            <span
                class="catalog-search-icon"
                aria-hidden="true"
            >
                ⌕
            </span>

        </div>



        <!-- =================================================
             CATALOG LAYOUT
        ================================================== -->

        <div class="catalog-layout">



            <!-- =================================================
                 SIDEBAR
            ================================================== -->

            <aside class="catalog-sidebar">


                <div class="catalog-sidebar-inner">


                    <h3>

                        Kategori Produk

                    </h3>



                    <!-- ALL -->

                    <button
                        class="catalog-filter active"
                        type="button"
                        data-category="all"
                    >

                        <span></span>

                        Semua Produk

                    </button>



                    <!-- INDOOR OUTDOOR -->

                    <button
                        class="catalog-filter"
                        type="button"
                        data-category="indoor-outdoor"
                    >

                        <span></span>

                        Indoor &amp; Outdoor Printing

                    </button>



                    <!-- ACRYLIC -->

                    <button
                        class="catalog-filter"
                        type="button"
                        data-category="acrylic"
                    >

                        <span></span>

                        Acrylic

                    </button>



                    <!-- BRANDING -->

                    <button
                        class="catalog-filter"
                        type="button"
                        data-category="branding"
                    >

                        <span></span>

                        Branding

                    </button>

                    <!-- DISPLAY BRANDING -->

                    <button
                        class="catalog-filter"
                        type="button"
                        data-category="display-branding"
                    >

                        <span></span>

                        Display Branding

                    </button>


                </div>


            </aside>



            <!-- =================================================
                 CATALOG CONTENT
            ================================================== -->

            <div class="catalog-content">



                <!-- TOP BAR -->

                <div class="catalog-topbar">


                    <span>

                        <strong id="productCount">

                            <?php echo count($products); ?>

                        </strong>

                        Produk

                    </span>



                    <select
                        id="catalogSort"
                        aria-label="Urutkan Produk"
                    >

                        <option value="default">

                            Urutkan

                        </option>


                        <option value="az">

                            Nama A - Z

                        </option>


                        <option value="za">

                            Nama Z - A

                        </option>

                    </select>


                </div>



                <!-- =================================================
                     PRODUCT GRID
                ================================================== -->

                <div
                    class="catalog-product-grid"
                    id="catalogProductGrid"
                >


                    <?php foreach ($products as $product) : ?>


                        <article
                            class="catalog-product-card"
                            data-category="<?php echo htmlspecialchars(
                                $product['category'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                            data-name="<?php echo htmlspecialchars(
                                strtolower($product['name']),
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>"
                        >



                            <!-- IMAGE -->

                            <a
                                href="<?php echo htmlspecialchars(
                                    $product['url'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"
                                class="catalog-product-image"
                            >

                                <img
                                    src="<?php echo htmlspecialchars(
                                        $product['image'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                                    alt="<?php echo htmlspecialchars(
                                        $product['name'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                                    loading="lazy"
                                >

                            </a>



                            <!-- PRODUCT INFO -->

                            <div class="catalog-product-content">


                                <span class="catalog-category">

                                    <?php echo htmlspecialchars(
                                        $product['category_label'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>

                                </span>



                                <!-- TITLE -->

                                <h2>

                                    <a
                                        href="<?php echo htmlspecialchars(
                                            $product['url'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ); ?>"
                                    >

                                        <?php echo htmlspecialchars(
                                            $product['name'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ); ?>

                                    </a>

                                </h2>



                                <!-- LINK -->

                                <a
                                    href="<?php echo htmlspecialchars(
                                        $product['url'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ); ?>"
                                    class="catalog-product-link"
                                >

                                    Lihat Produk →

                                </a>


                            </div>


                        </article>


                    <?php endforeach; ?>


                </div>



                <!-- EMPTY RESULT -->

                <div
                    class="catalog-empty"
                    id="catalogEmpty"
                >

                    Produk tidak ditemukan.

                </div>


            </div>


        </div>


    </div>

</section>




<!-- =========================================================
     PRODUCT CTA
========================================================= -->

<section class="product-page-cta">


    <div class="phoenix-container product-page-cta-inner">


        <div>


            <span>

                BUTUH PRODUK CUSTOM?

            </span>


            <h2>

                Konsultasikan kebutuhan printing
                Anda bersama kami.

            </h2>


        </div>



        <a
            href="<?php echo $whatsappUrl; ?>"
            target="_blank"
            rel="noopener noreferrer"
        >

            Hubungi Kami →

        </a>


    </div>


</section>




<!-- =========================================================
     PRODUCT FILTER / SEARCH / SORT SCRIPT
========================================================= -->

<script>

(function () {


    var search =
        document.getElementById(
            'catalogSearch'
        );


    var grid =
        document.getElementById(
            'catalogProductGrid'
        );


    var cards =
        Array.prototype.slice.call(
            document.querySelectorAll(
                '.catalog-product-card'
            )
        );


    var filters =
        document.querySelectorAll(
            '.catalog-filter'
        );


    var count =
        document.getElementById(
            'productCount'
        );


    var empty =
        document.getElementById(
            'catalogEmpty'
        );


    var sort =
        document.getElementById(
            'catalogSort'
        );


    var activeCategory =
        'all';

    try {
        var requestedCategory = new URLSearchParams(window.location.search).get('phoenix_category');
        if (['indoor-outdoor', 'acrylic', 'branding', 'display-branding'].indexOf(requestedCategory) !== -1) {
            activeCategory = requestedCategory;
            for (var filterIndex = 0; filterIndex < filters.length; filterIndex++) {
                if (filters[filterIndex].getAttribute('data-category') === requestedCategory) {
                    filters[filterIndex].classList.add('active');
                } else {
                    filters[filterIndex].classList.remove('active');
                }
            }
        }
    } catch (e) {
        activeCategory = 'all';
    }



    /* =====================================================
       UPDATE PRODUCTS
    ====================================================== */

    function updateProducts() {


        var keyword =
            search
                ? search.value
                    .toLowerCase()
                    .trim()
                : '';


        var visible =
            0;



        cards.forEach(
            function (card) {


                var category =
                    card.getAttribute(
                        'data-category'
                    );


                var name =
                    card.getAttribute(
                        'data-name'
                    );


                var categoryMatch =
                    activeCategory === 'all'
                    ||
                    category === activeCategory;


                var searchMatch =
                    !keyword
                    ||
                    name.indexOf(
                        keyword
                    ) !== -1;


                if (
                    categoryMatch
                    &&
                    searchMatch
                ) {


                    card.style.display =
                        '';


                    visible++;


                } else {


                    card.style.display =
                        'none';


                }


            }
        );



        if (count) {

            count.textContent =
                visible;

        }



        if (empty) {

            empty.style.display =
                visible === 0
                    ? 'block'
                    : 'none';

        }


    }



    /* =====================================================
       CATEGORY FILTER
    ====================================================== */

    for (
        var i = 0;
        i < filters.length;
        i++
    ) {


        filters[i].addEventListener(
            'click',
            function () {


                for (
                    var j = 0;
                    j < filters.length;
                    j++
                ) {


                    filters[j]
                        .classList
                        .remove(
                            'active'
                        );


                }


                this.classList.add(
                    'active'
                );


                activeCategory =
                    this.getAttribute(
                        'data-category'
                    );

                /* Sinkronkan filter kategori ke URL agar dapat dibagikan.
                   Parameter kategori tetap noindex secara kanonis ke /product. */
                try {
                    var currentUrl = new URL(window.location.href);
                    if (activeCategory === 'all') {
                        currentUrl.searchParams.delete('phoenix_category');
                    } else {
                        currentUrl.searchParams.set('phoenix_category', activeCategory);
                    }
                    window.history.replaceState({}, '', currentUrl.pathname + currentUrl.search + currentUrl.hash);
                } catch (e) {
                    /* Filter tetap berfungsi walau History API tidak tersedia. */
                }

                updateProducts();


            }
        );


    }



    /* =====================================================
       SEARCH
    ====================================================== */

    if (search) {


        search.addEventListener(
            'input',
            updateProducts
        );


    }



    /* =====================================================
       SORT
    ====================================================== */

    if (
        sort
        &&
        grid
    ) {


        sort.addEventListener(
            'change',
            function () {


                var sorted =
                    cards.slice();



                /* A → Z */

                if (
                    this.value === 'az'
                ) {


                    sorted.sort(
                        function (a, b) {


                            return a
                                .getAttribute(
                                    'data-name'
                                )
                                .localeCompare(
                                    b.getAttribute(
                                        'data-name'
                                    )
                                );


                        }
                    );


                }



                /* Z → A */

                if (
                    this.value === 'za'
                ) {


                    sorted.sort(
                        function (a, b) {


                            return b
                                .getAttribute(
                                    'data-name'
                                )
                                .localeCompare(
                                    a.getAttribute(
                                        'data-name'
                                    )
                                );


                        }
                    );


                }



                /* DEFAULT */

                if (
                    this.value === 'default'
                ) {


                    sorted =
                        cards.slice();


                }



                sorted.forEach(
                    function (card) {


                        grid.appendChild(
                            card
                        );


                    }
                );


                updateProducts();


            }
        );


    }



    /* =====================================================
       INITIAL UPDATE
    ====================================================== */

    updateProducts();


})();

</script>