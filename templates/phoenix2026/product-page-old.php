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
    . '/product/indoor-outdoor-printing';

$brandingUrl =
    $this->baseurl
    . '/product/branding';

$quotationUrl =
    $this->baseurl
    . '/?phoenix_page=quotation';


/* =========================================================
   WHATSAPP
========================================================= */

$whatsappNumber =
    '6287880500744';

$whatsappMessage =
    rawurlencode(
        'Halo Phoenix Kian Jaya, saya ingin konsultasi mengenai produk printing.'
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
       INDOOR & OUTDOOR
    ====================================================== */

    array(
        'name' => 'Spanduk / Backdrop / T Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => $templateImages . '/spanduk.png',
        'url' => $this->baseurl . '/product/spanduk-backdrop-t-banner'
    ),

    array(
        'name' => 'X Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => $templateImages . '/x_banner.png',
        'url' => $this->baseurl . '/product/x-banner'
    ),

    array(
        'name' => 'Y Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => $templateImages . '/y_banner.png',
        'url' => $this->baseurl . '/product/y-banner'
    ),

    array(
        'name' => 'Mini X Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => $templateImages . '/mini_banner.png',
        'url' => $this->baseurl . '/product/mini-x-banner'
    ),

    array(
        'name' => 'Roll Up Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => $templateImages . '/roll_banner.png',
        'url' => $this->baseurl . '/product/roll-up-banner'
    ),

    array(
        'name' => 'Tripod Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => $templateImages . '/tripod_banner.png',
        'url' => $this->baseurl . '/product/tripod-banner'
    ),

    array(
        'name' => 'Jumbo Banner',
        'category' => 'indoor-outdoor',
        'category_label' => 'Indoor & Outdoor',
        'image' => $templateImages . '/jumbo_banner.png',
        'url' => $this->baseurl . '/product/jumbo-banner'
    ),


    /* =====================================================
       ACRYLIC
    ====================================================== */

    array(
        'name' => 'Acrylic',
        'category' => 'acrylic',
        'category_label' => 'Acrylic',
        'image' => $templateImages . '/acrylic.png',
        'url' => $acrylicUrl
    ),


    /* =====================================================
       BRANDING
    ====================================================== */

    array(
        'name' => 'Vehicle Branding',
        'category' => 'branding',
        'category_label' => 'Branding',
        'image' => $templateImages . '/branding_mobil.png',
        'url' => $this->baseurl . '/product/vehicle-branding'
    ),

    array(
        'name' => 'Display Branding',
        'category' => 'branding',
        'category_label' => 'Branding',
        'image' => $templateImages . '/display_branding.png',
        'url' => $this->baseurl . '/product/display-branding'
    )

);

?>



<!-- =========================================================
     PRODUCT HERO
========================================================= -->

<!-- =========================================================
     BREADCRUMB
    ========================================================= -->
        
        <div class="product-breadcrumb">
            <div class="phoenix-container">
        
                <nav aria-label="Breadcrumb">
        
                    <a href="<?php echo $homeUrl; ?>">
                        Home
                    </a>
        
                    <span>/</span>
        
                    <span aria-current="page">
                        Produk
                    </span>
        
                </nav>
        
            </div>
        </div>

    
<section class="product-page-hero">
    <div class="phoenix-container">


        <span class="product-page-label">

            PRODUK PHOENIX KIAN JAYA

        </span>


        <h1>

            Solusi Printing Untuk
            Setiap Kebutuhan Bisnis.

        </h1>


        <p>

            Temukan berbagai kebutuhan digital printing,
            acrylic, branding dan media promosi
            Phoenix Kian Jaya.

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

        <div class="catalog-mobile-tools">

    <button
        type="button"
        class="catalog-mobile-filter-button"
        id="catalogMobileFilterButton"
        aria-expanded="false"
        aria-controls="catalogSidebar"
    >
        <span>Filter Kategori</span>
        <span>☰</span>
    </button>

</div>

        <!-- =================================================
             CATALOG LAYOUT
        ================================================== -->

        <div class="catalog-layout">



            <!-- =================================================
                 SIDEBAR
            ================================================== -->

            <aside
                class="catalog-sidebar"
                id="catalogSidebar"
            >


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



        <div class="product-page-cta-actions">

            <a
                href="<?php echo $quotationUrl; ?>"
                class="product-page-cta-primary"
            >
                Request Penawaran →
            </a>

            <a
                href="<?php echo $whatsappUrl; ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="product-page-cta-secondary"
            >
                WhatsApp
            </a>

        </div>


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

    var mobileFilterButton =
    document.getElementById(
        'catalogMobileFilterButton'
    );

    var sidebar =
        document.getElementById(
            'catalogSidebar'
        );

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
    
    if (
    mobileFilterButton
    &&
    sidebar
) {

    mobileFilterButton.addEventListener(
        'click',
        function () {

            var open =
                sidebar.classList.toggle(
                    'is-open'
                );

            mobileFilterButton.setAttribute(
                'aria-expanded',
                open
                    ? 'true'
                    : 'false'
            );

        }
    );

}


/* Tutup filter setelah kategori dipilih */

filters.forEach(
    function (button) {

        button.addEventListener(
            'click',
            function () {

                if (
                    window.innerWidth <= 760
                    &&
                    sidebar
                    &&
                    mobileFilterButton
                ) {

                    sidebar.classList.remove(
                        'is-open'
                    );

                    mobileFilterButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );

    }
);

})();

</script>