<?php
defined('_JEXEC') or die;

$app = JFactory::getApplication();

/* =========================================================
   PAGE DATA
========================================================= */

$prefilledProduct =
    trim(
        $app->input->getString(
            'product',
            ''
        )
    );

$productOptions =
    array(
        'Spanduk / Backdrop / T Banner',
        'X Banner',
        'Y Banner',
        'Mini X Banner',
        'Roll Up Banner',
        'Tripod Banner',
        'Jumbo Banner',
        'Acrylic',
        'Vehicle Branding',
        'Door Frame',
        'Custom / Lainnya'
    );

?>

<section class="quotation-page">
    <section class="quotation-hero">
        <div class="phoenix-container quotation-hero-grid">
            <div>
                <span class="quotation-eyebrow">REQUEST FOR QUOTATION</span>
                <h1>Minta Penawaran<br>Untuk Project Anda.</h1>
                <p>Isi kebutuhan project Anda secara singkat. Tim Phoenix Digi Print akan membantu menyiapkan rekomendasi produk dan penawaran yang sesuai.</p>
            </div>
            <div class="quotation-hero-card">
                <span>B2B QUOTATION</span>
                <strong>Brief lebih jelas.<br>Penawaran lebih cepat.</strong>
                <p>Cocok untuk kebutuhan corporate, event, branding, display dan custom printing.</p>
            </div>
        </div>
    </section>

    <section class="quotation-form-section">
        <div class="phoenix-container">
            <form
                class="quotation-form"
                id="quotationForm"
                method="post"
                novalidate
            >

                <input
                    type="hidden"
                    name="phoenix_quotation_submit"
                    value="1"
                >

                <?php echo JHtml::_('form.token'); ?>

                <div
                    class="quotation-honeypot"
                    aria-hidden="true"
                    style="display:none !important;"
                >
                    <label for="website">
                        Website
                    </label>

                    <input
                        type="text"
                        id="website"
                        name="website"
                        tabindex="-1"
                        autocomplete="off"
                    >
                </div>

                <div class="quotation-block">
                    <div class="quotation-block-heading">
                        <span>01</span>
                        <div><h2>Informasi Perusahaan</h2><p>Data PIC yang dapat kami hubungi.</p></div>
                    </div>
                    <div class="quotation-grid">
                        <div class="quotation-field"><label for="companyName">Nama Perusahaan *</label><input type="text" id="companyName" name="company_name" placeholder="PT / CV / Instansi" required></div>
                        <div class="quotation-field"><label for="picName">Nama PIC *</label><input type="text" id="picName" name="pic_name" placeholder="Nama lengkap PIC" required></div>
                        <div class="quotation-field"><label for="businessEmail">Email Perusahaan *</label><input type="email" id="businessEmail" name="email" placeholder="nama@perusahaan.com" required></div>
                        <div class="quotation-field"><label for="businessPhone">WhatsApp / Telepon *</label><input type="tel" id="businessPhone" name="phone" placeholder="08xxxxxxxxxx" required></div>
                        <div class="quotation-field quotation-field-full"><label for="position">Jabatan / Divisi</label><input type="text" id="position" name="position" placeholder="Purchasing / Marketing / GA / Procurement"></div>
                    </div>
                </div>

                <div class="quotation-block">
                    <div class="quotation-block-heading">
                        <span>02</span>
                        <div><h2>Detail Kebutuhan</h2><p>Informasi dasar produk yang dibutuhkan.</p></div>
                    </div>
                    <div class="quotation-grid">
                        <div class="quotation-field">
                            <label for="productCategory">Kategori Produk *</label>
                            <select id="productCategory" name="category" required>
                                <option value="">Pilih kategori</option>
                                <option value="Indoor & Outdoor Printing">Indoor & Outdoor Printing</option>
                                <option value="Acrylic">Acrylic</option>
                                <option value="Branding">Branding</option>
                                <option value="Display & Promotion">Display & Promotion</option>
                                <option value="Custom / Lainnya">Custom / Lainnya</option>
                            </select>
                        </div>

                        <div class="quotation-field">
                            <label for="productName">Produk *</label>
                            <select id="productName" name="product" required>
                                <option value="">Pilih produk</option>
                                <?php foreach ($productOptions as $productOption) : ?>
                                    <option value="<?php echo htmlspecialchars($productOption, ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($prefilledProduct === $productOption) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($productOption, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="quotation-field"><label for="quantity">Quantity *</label><input type="number" id="quantity" name="quantity" min="1" placeholder="Contoh: 100" required></div>
                        <div class="quotation-field"><label for="size">Ukuran</label><input type="text" id="size" name="size" placeholder="Contoh: 80 x 200 cm"></div>
                        <div class="quotation-field"><label for="material">Material</label><input type="text" id="material" name="material" placeholder="Jika sudah mengetahui material"></div>
                        <div class="quotation-field"><label for="deadline">Deadline Kebutuhan</label><input type="date" id="deadline" name="deadline"></div>
                    </div>
                </div>

                <div class="quotation-block">
                    <div class="quotation-block-heading">
                        <span>03</span>
                        <div><h2>Brief Project</h2><p>Semakin lengkap brief, semakin cepat kami memahami kebutuhan Anda.</p></div>
                    </div>
                    <div class="quotation-grid">
                        <div class="quotation-field quotation-field-full">
                            <label for="projectBrief">Deskripsi Kebutuhan *</label>
                            <textarea id="projectBrief" name="brief" rows="7" placeholder="Jelaskan kebutuhan, penggunaan produk, jumlah lokasi, spesifikasi khusus, atau referensi yang Anda miliki." required></textarea>
                        </div>

                        <div class="quotation-field">
                            <label for="budget">Estimasi Budget</label>
                            <select id="budget" name="budget">
                                <option value="">Pilih estimasi budget</option>
                                <option value="< 5 Juta">&lt; Rp5 Juta</option>
                                <option value="5 - 10 Juta">Rp5 - 10 Juta</option>
                                <option value="10 - 25 Juta">Rp10 - 25 Juta</option>
                                <option value="25 - 50 Juta">Rp25 - 50 Juta</option>
                                <option value="> 50 Juta">&gt; Rp50 Juta</option>
                            </select>
                        </div>

                        <div class="quotation-field"><label for="referenceLink">Link File / Referensi</label><input type="url" id="referenceLink" name="reference_link" placeholder="Google Drive / Dropbox / WeTransfer"></div>
                    </div>
                </div>

                <div class="quotation-submit-area">
                    <label class="quotation-consent">
                        <input type="checkbox" id="quotationConsent" required>
                        <span>Saya menyetujui data ini digunakan untuk proses konsultasi dan penawaran.</span>
                    </label>
                    <button type="submit" class="quotation-submit-button">Request Penawaran <span>→</span></button>
                </div>

                <div class="quotation-status" id="quotationStatus" role="status" aria-live="polite"></div>
            </form>
        </div>
    </section>

    <section class="quotation-benefits">
        <div class="phoenix-container">
            <div class="quotation-benefits-heading">
                <span class="section-label">UNTUK KEBUTUHAN B2B</span>
                <h2>Dibuat Untuk Project<br>Yang Lebih Terstruktur.</h2>
            </div>
            <div class="quotation-benefits-grid">
                <article><span>01</span><h3>Brief Lebih Jelas</h3><p>Tim kami menerima informasi kebutuhan dengan format yang lebih terstruktur.</p></article>
                <article><span>02</span><h3>Respon Lebih Cepat</h3><p>Informasi produk, jumlah dan deadline membantu proses konsultasi lebih efisien.</p></article>
                <article><span>03</span><h3>Cocok Untuk Corporate</h3><p>Ideal untuk kebutuhan purchasing, procurement, marketing, GA dan event.</p></article>
            </div>
        </div>
    </section>
</section>

<script>
(function () {

    'use strict';

    var form =
        document.getElementById(
            'quotationForm'
        );

    var status =
        document.getElementById(
            'quotationStatus'
        );

    if (!form) {
        return;
    }

    var submitButton =
        form.querySelector(
            '.quotation-submit-button'
        );

    function setStatus(
        message,
        type
    ) {

        if (!status) {
            return;
        }

        status.textContent =
            message;

        status.classList.remove(
            'is-success',
            'is-error'
        );

        if (type) {
            status.classList.add(
                type
            );
        }

    }

    form.addEventListener(
        'submit',
        function (event) {

            event.preventDefault();

            if (!form.checkValidity()) {

                form.reportValidity();

                return;
            }

            if (submitButton) {

                submitButton.disabled =
                    true;

                submitButton.classList.add(
                    'is-loading'
                );

            }

            setStatus(
                'Mengirim request penawaran...',
                ''
            );

            var formData =
                new FormData(
                    form
                );

            fetch(
                window.location.href,
                {
                    method:
                        'POST',
                    body:
                        formData,
                    credentials:
                        'same-origin',
                    headers:
                        {
                            'X-Requested-With':
                                'XMLHttpRequest'
                        }
                }
            )
            .then(
                function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'HTTP '
                            + response.status
                        );

                    }

                    return response.json();

                }
            )
            .then(
                function (result) {

                    if (!result.success) {

                        throw new Error(
                            result.message
                            ||
                            'Request gagal dikirim.'
                        );

                    }

                    var quoteCode =
                        result.quote_code
                        ||
                        '';

                    setStatus(
                        'Request berhasil diterima'
                        + (
                            quoteCode
                                ? ' dengan kode '
                                  + quoteCode
                                  + '.'
                                : '.'
                        ),
                        'is-success'
                    );


                    /*
                     * BARU SEKARANG DIANGGAP LEAD:
                     * server sudah mengonfirmasi bahwa
                     * quotation tersimpan di database.
                     */
                    if (
                        window.PhoenixTracking
                        &&
                        typeof window.PhoenixTracking.track
                            === 'function'
                    ) {

                        window.PhoenixTracking.track(
                            'generate_lead',
                            {
                                form_name:
                                    'quotation',
                                quote_code:
                                    quoteCode,
                                product_name:
                                    (
                                        document.getElementById(
                                            'productName'
                                        )
                                        ||
                                        {}
                                    ).value
                                    ||
                                    '',
                                category:
                                    (
                                        document.getElementById(
                                            'productCategory'
                                        )
                                        ||
                                        {}
                                    ).value
                                    ||
                                    ''
                            },
                            'Lead'
                        );

                    }


                    /*
                     * Optional:
                     * tombol WhatsApp tetap berguna,
                     * tapi backend sudah menyimpan lead
                     * sebelum user membuka WhatsApp.
                     */
                    var productName =
                        (
                            document.getElementById(
                                'productName'
                            )
                            ||
                            {}
                        ).value
                        ||
                        '';

                    var waMessage =
                        'Halo Phoenix Digi Print, '
                        + 'saya sudah mengirim request penawaran'
                        + (
                            quoteCode
                                ? ' dengan kode '
                                  + quoteCode
                                : ''
                        )
                        + (
                            productName
                                ? ' untuk produk '
                                  + productName
                                : ''
                        )
                        + '.';

                    var waUrl =
                        'https://wa.me/6287880500744?text='
                        +
                        encodeURIComponent(
                            waMessage
                        );

                    var waLink =
                        document.createElement(
                            'a'
                        );

                    waLink.href =
                        waUrl;

                    waLink.target =
                        '_blank';

                    waLink.rel =
                        'noopener noreferrer';

                    waLink.className =
                        'quotation-success-whatsapp';

                    waLink.textContent =
                        'Lanjutkan via WhatsApp →';

                    if (
                        status
                        &&
                        !status.querySelector(
                            '.quotation-success-whatsapp'
                        )
                    ) {

                        status.appendChild(
                            document.createTextNode(
                                ' '
                            )
                        );

                        status.appendChild(
                            waLink
                        );

                    }

                    form.reset();

                }
            )
            .catch(
                function (error) {

                    setStatus(
                        error.message
                        ||
                        'Terjadi kesalahan. Silakan coba kembali.',
                        'is-error'
                    );

                }
            )
            .finally(
                function () {

                    if (submitButton) {

                        submitButton.disabled =
                            false;

                        submitButton.classList.remove(
                            'is-loading'
                        );

                    }

                }
            );

        }
    );

})();
</script>
