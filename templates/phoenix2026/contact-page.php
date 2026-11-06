<?php defined('_JEXEC') or die; ?>

<section class="contact-page">
    <div class="contact-hero">
        <div class="phoenix-container">
            <span class="contact-eyebrow">KONTAK PHOENIX KIAN JAYA</span>
            <h1>Mari Wujudkan Ide<br>Printing Anda.</h1>
            <p>Konsultasikan kebutuhan digital printing, acrylic, branding, banner dan media promosi bersama tim kami.</p>
        </div>
    </div>

    <div class="contact-main">
        <div class="phoenix-container contact-layout">
            <div class="contact-info">
                <span class="section-label">HUBUNGI KAMI</span>
                <h2>Ada yang ingin<br>Anda tanyakan?</h2>
                <p class="contact-intro">Hubungi Phoenix Kian Jaya melalui kanal berikut. Tim kami siap membantu kebutuhan produk dan konsultasi Anda.</p>

                <div class="contact-info-list">
                    <a href="<?php echo $whatsappUrl; ?>" target="_blank" rel="noopener noreferrer" class="contact-info-card">
                        <span class="contact-info-icon">WA</span>
                        <span><small>WHATSAPP</small><strong>+6289643402214 </strong><em>Konsultasi cepat dengan tim kami</em></span>
                    </a>
                    <a href="tel:+6289643402214" class="contact-info-card">
                        <span class="contact-info-icon">TEL</span>
                        <span><small>TELEPON</small><strong>+62 21 2944 8544</strong><em>Hubungi kantor Phoenix Kian Jaya</em></span>
                    </a>
                    <a href="mailto:admin@phoenixdigiprint.com" class="contact-info-card">
                        <span class="contact-info-icon">@</span>
                        <span><small>EMAIL</small><strong>admin@phoenixdigiprint.com</strong><em>Kirim kebutuhan atau file Anda</em></span>
                    </a>
                </div>
            </div>

            <div class="contact-form-card">
                <div class="contact-form-heading">
                    <span>SAMPAIKAN PESAN ANDA</span>
                    <h2>Ceritakan kebutuhan Anda.</h2>
                    <p>Isi form di bawah dan pesan akan diteruskan ke WhatsApp Phoenix Kian Jaya.</p>
                </div>

                <form class="contact-form" id="phoenixContactForm">
                    <div class="contact-form-row">
                        <div class="contact-field">
                            <label for="contactName">Nama</label>
                            <input type="text" id="contactName" placeholder="Nama Anda" required>
                        </div>
                        <div class="contact-field">
                            <label for="contactPhone">Nomor WhatsApp</label>
                            <input type="tel" id="contactPhone" placeholder="08xxxxxxxxxx" required>
                        </div>
                    </div>

                    <div class="contact-form-row">
                        <div class="contact-field">
                            <label for="contactEmail">Email</label>
                            <input type="email" id="contactEmail" placeholder="email@contoh.com">
                        </div>
                        <div class="contact-field">
                            <label for="contactSubject">Subjek</label>
                            <select id="contactSubject" required>
                                <option value="">Pilih kebutuhan</option>
                                <option>Digital Printing</option>
                                <option>Acrylic</option>
                                <option>Branding</option>
                                <option>Banner & Display</option>
                                <option>Produk Custom</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="contact-field">
                        <label for="contactMessage">Pesan</label>
                        <textarea id="contactMessage" rows="6" placeholder="Jelaskan kebutuhan printing Anda..." required></textarea>
                    </div>

                    <button type="submit" class="contact-submit">Kirim via WhatsApp <span>→</span></button>
                </form>
            </div>
        </div>
    </div>

    <section class="contact-quick-help">
        <div class="phoenix-container">
            <div class="contact-section-heading">
                <div>
                    <span class="section-label">INFORMASI</span>
                    <h2>Sebelum menghubungi kami.</h2>
                </div>
                <p>Beberapa informasi singkat yang membantu agar konsultasi dan penawaran dapat diproses lebih cepat.</p>
            </div>

            <div class="contact-help-grid">
                <article><span>01</span><h3>Siapkan ukuran produk</h3><p>Sertakan ukuran atau perkiraan dimensi produk yang ingin dibuat.</p></article>
                <article><span>02</span><h3>Kirim desain atau referensi</h3><p>Anda dapat mengirim file desain, foto, atau referensi visual melalui WhatsApp.</p></article>
                <article><span>03</span><h3>Jelaskan jumlah kebutuhan</h3><p>Jumlah produk membantu tim kami memberikan rekomendasi yang lebih sesuai.</p></article>
            </div>
        </div>
    </section>

    <section class="contact-faq">
        <div class="phoenix-container contact-faq-layout">
            <div class="contact-faq-title">
                <span class="section-label">FAQ</span>
                <h2>Pertanyaan yang<br>sering ditanyakan.</h2>
                <p>Masih ada pertanyaan? Hubungi tim kami melalui WhatsApp.</p>
                <a href="<?php echo $whatsappUrl; ?>" target="_blank" rel="noopener noreferrer" class="contact-faq-button">Hubungi Kami →</a>
            </div>

            <div class="contact-faq-list">
                <details><summary>Apakah bisa membuat produk custom?<span>+</span></summary><p>Bisa. Jelaskan ukuran, jumlah, material, serta referensi produk yang Anda butuhkan agar tim kami dapat membantu memberikan solusi.</p></details>
                <details><summary>Apakah saya bisa mengirim desain sendiri?<span>+</span></summary><p>Bisa. Anda dapat mengirim desain atau referensi melalui WhatsApp maupun email untuk dilakukan pengecekan sebelum proses produksi.</p></details>
                <details><summary>Bagaimana jika saya belum memiliki desain?<span>+</span></summary><p>Sampaikan konsep dan kebutuhan Anda terlebih dahulu. Tim kami dapat membantu mengarahkan kebutuhan file dan spesifikasi produk yang sesuai.</p></details>
                <details><summary>Bagaimana cara mendapatkan penawaran harga?<span>+</span></summary><p>Kirim nama produk, ukuran, jumlah, material jika ada, serta file atau referensi desain melalui form atau WhatsApp.</p></details>
            </div>
        </div>
    </section>
</section>

<script>
(function () {
    var form = document.getElementById('phoenixContactForm');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var name = document.getElementById('contactName').value.trim();
        var phone = document.getElementById('contactPhone').value.trim();
        var email = document.getElementById('contactEmail').value.trim();
        var subject = document.getElementById('contactSubject').value.trim();
        var message = document.getElementById('contactMessage').value.trim();

        var text = 'Halo Phoenix Kian Jaya, saya ingin konsultasi.\n\n' +
            'Nama: ' + name + '\n' +
            'WhatsApp: ' + phone + '\n' +
            'Email: ' + (email || '-') + '\n' +
            'Kebutuhan: ' + subject + '\n\n' +
            'Pesan:\n' + message;

        window.open('https://wa.me/6287880500744?text=' + encodeURIComponent(text), '_blank', 'noopener');
    });
})();
</script>
