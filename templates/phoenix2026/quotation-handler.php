<?php
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$db = JFactory::getDbo();
$config = JFactory::getConfig();
$session = JFactory::getSession();

/* =========================================================
   PHASE 8 — ADMIN EMAIL NOTIFICATION
   Kosongkan untuk memakai Joomla Global Configuration > Mail From.
   Atau isi email khusus penerima notifikasi quotation.
========================================================= */

$quotationAdminEmail =
    'kirayrizqi00@gmail.com'; // contoh: admin@phoenixdigiprint.com


/* =========================================================
   QUOTATION BACKEND
   - Validasi server-side
   - CSRF protection
   - Honeypot anti-spam
   - Rate limit sederhana
   - Simpan ke database Joomla
   - Kirim email HTML notifikasi ke administrator
   - Response JSON untuk AJAX
========================================================= */

if (
    $app->input->getMethod() === 'POST'
    &&
    $app->input->post->getInt(
        'phoenix_quotation_submit',
        0
    ) === 1
) {

    $app->setHeader(
        'Content-Type',
        'application/json; charset=utf-8',
        true
    );

    $respond =
        function (
            $success,
            $message,
            $extra = array()
        ) use ($app) {

            echo json_encode(
                array_merge(
                    array(
                        'success' =>
                            (bool) $success,
                        'message' =>
                            (string) $message
                    ),
                    $extra
                ),
                JSON_UNESCAPED_UNICODE
                |
                JSON_UNESCAPED_SLASHES
            );

            $app->close();

        };


    /* CSRF */

    if (!JSession::checkToken('post')) {

        $respond(
            false,
            'Sesi formulir sudah kedaluwarsa. Silakan refresh halaman lalu coba lagi.'
        );

    }


    /* HONEYPOT */

    $websiteField =
        trim(
            $app->input->post->getString(
                'website',
                ''
            )
        );

    if ($websiteField !== '') {

        $respond(
            true,
            'Request berhasil diterima.'
        );

    }


    /* RATE LIMIT */

    $now =
        time();

    $lastSubmit =
        (int) $session->get(
            'phoenix.last_quotation_submit',
            0
        );

    if (
        $lastSubmit > 0
        &&
        ($now - $lastSubmit) < 8
    ) {

        $respond(
            false,
            'Mohon tunggu beberapa detik sebelum mengirim request lagi.'
        );

    }


    /* INPUT */

    $companyName =
        trim(
            $app->input->post->getString(
                'company_name',
                ''
            )
        );

    $picName =
        trim(
            $app->input->post->getString(
                'pic_name',
                ''
            )
        );

    $email =
        trim(
            $app->input->post->getString(
                'email',
                ''
            )
        );

    $phone =
        trim(
            $app->input->post->getString(
                'phone',
                ''
            )
        );

    $position =
        trim(
            $app->input->post->getString(
                'position',
                ''
            )
        );

    $category =
        trim(
            $app->input->post->getString(
                'category',
                ''
            )
        );

    $product =
        trim(
            $app->input->post->getString(
                'product',
                ''
            )
        );

    $quantity =
        (int) $app->input->post->getInt(
            'quantity',
            0
        );

    $size =
        trim(
            $app->input->post->getString(
                'size',
                ''
            )
        );

    $material =
        trim(
            $app->input->post->getString(
                'material',
                ''
            )
        );

    $deadline =
        trim(
            $app->input->post->getString(
                'deadline',
                ''
            )
        );

    $budget =
        trim(
            $app->input->post->getString(
                'budget',
                ''
            )
        );

    $referenceLink =
        trim(
            $app->input->post->getString(
                'reference_link',
                ''
            )
        );

    $brief =
        trim(
            $app->input->post->getString(
                'brief',
                ''
            )
        );


    /* SERVER VALIDATION */

    if (
        $companyName === ''
        ||
        $picName === ''
        ||
        $email === ''
        ||
        $phone === ''
        ||
        $category === ''
        ||
        $product === ''
        ||
        $quantity < 1
        ||
        $brief === ''
    ) {

        $respond(
            false,
            'Mohon lengkapi semua field wajib.'
        );

    }

    if (
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $respond(
            false,
            'Format email belum valid.'
        );

    }

    if (
        $referenceLink !== ''
        &&
        !filter_var(
            $referenceLink,
            FILTER_VALIDATE_URL
        )
    ) {

        $respond(
            false,
            'Link referensi belum valid.'
        );

    }


    /* CREATE TABLE IF NEEDED */

    $tableName =
        $db->quoteName(
            '#__phoenix_quotations'
        );

    $createQuery =
        'CREATE TABLE IF NOT EXISTS '
        . $tableName
        . ' ('
        . '`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,'
        . '`quote_code` VARCHAR(32) NOT NULL,'
        . '`company_name` VARCHAR(190) NOT NULL,'
        . '`pic_name` VARCHAR(190) NOT NULL,'
        . '`email` VARCHAR(190) NOT NULL,'
        . '`phone` VARCHAR(80) NOT NULL,'
        . '`position` VARCHAR(190) NULL,'
        . '`category` VARCHAR(190) NOT NULL,'
        . '`product` VARCHAR(190) NOT NULL,'
        . '`quantity` INT UNSIGNED NOT NULL DEFAULT 1,'
        . '`size` VARCHAR(190) NULL,'
        . '`material` VARCHAR(190) NULL,'
        . '`deadline` VARCHAR(32) NULL,'
        . '`budget` VARCHAR(100) NULL,'
        . '`reference_link` TEXT NULL,'
        . '`brief` TEXT NOT NULL,'
        . '`status` VARCHAR(30) NOT NULL DEFAULT "new",'
        . '`ip_address` VARCHAR(64) NULL,'
        . '`user_agent` VARCHAR(255) NULL,'
        . '`created_at` DATETIME NOT NULL,'
        . 'PRIMARY KEY (`id`),'
        . 'UNIQUE KEY `quote_code` (`quote_code`),'
        . 'KEY `status` (`status`),'
        . 'KEY `created_at` (`created_at`)'
        . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';

    try {

        $db->setQuery(
            $createQuery
        );

        $db->execute();

    } catch (Exception $e) {

        $respond(
            false,
            'Database belum dapat menyimpan request. Silakan coba kembali.'
        );

    }


    /* INSERT */

    $quoteCode =
        'PHX-'
        . date('ymd')
        . '-'
        . strtoupper(
            substr(
                md5(
                    uniqid(
                        '',
                        true
                    )
                ),
                0,
                6
            )
        );

    $record =
        new stdClass();

    $record->quote_code =
        $quoteCode;

    $record->company_name =
        $companyName;

    $record->pic_name =
        $picName;

    $record->email =
        $email;

    $record->phone =
        $phone;

    $record->position =
        $position;

    $record->category =
        $category;

    $record->product =
        $product;

    $record->quantity =
        $quantity;

    $record->size =
        $size;

    $record->material =
        $material;

    $record->deadline =
        $deadline;

    $record->budget =
        $budget;

    $record->reference_link =
        $referenceLink;

    $record->brief =
        $brief;

    $record->status =
        'new';

    $record->ip_address =
        isset($_SERVER['REMOTE_ADDR'])
            ? substr(
                (string) $_SERVER['REMOTE_ADDR'],
                0,
                64
            )
            : '';

    $record->user_agent =
        isset($_SERVER['HTTP_USER_AGENT'])
            ? substr(
                (string) $_SERVER['HTTP_USER_AGENT'],
                0,
                255
            )
            : '';

    $record->created_at =
        JFactory::getDate()
        ->toSql();


    try {

        $db->insertObject(
            '#__phoenix_quotations',
            $record
        );

    } catch (Exception $e) {

        $respond(
            false,
            'Request belum berhasil disimpan. Silakan coba kembali.'
        );

    }


    /* =========================================================
       PHASE 8 — PROFESSIONAL ADMIN EMAIL NOTIFICATION
       Email gagal tidak membatalkan quotation karena data
       sudah lebih dulu berhasil tersimpan ke database.
    ========================================================= */

    $mailSent =
        false;

    try {

        $mailer =
            JFactory::getMailer();

        $mailFrom =
            trim(
                (string) $config->get(
                    'mailfrom'
                )
            );

        $fromName =
            trim(
                (string) $config->get(
                    'fromname'
                )
            );

        $adminEmail =
            trim(
                (string) $quotationAdminEmail
            );

        if ($adminEmail === '') {

            $adminEmail =
                $mailFrom;

        }

        if (
            $mailFrom !== ''
            &&
            $adminEmail !== ''
            &&
            filter_var(
                $adminEmail,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            $mailer->setSender(
                array(
                    $mailFrom,
                    $fromName !== ''
                        ? $fromName
                        : 'Phoenix Digi Print'
                )
            );

            $mailer->addRecipient(
                $adminEmail
            );

            if (
                filter_var(
                    $email,
                    FILTER_VALIDATE_EMAIL
                )
            ) {

                $mailer->addReplyTo(
                    array(
                        $email,
                        $picName
                    )
                );

            }

            $mailer->setSubject(
                '[PHOENIX] Quotation Baru - '
                . $quoteCode
                . ' - '
                . $companyName
            );


            /* ADMIN DASHBOARD URL */

            $adminQuotationUrl =
                rtrim(
                    JUri::root(),
                    '/'
                )
                . '/administrator/index.php'
                . '?option=com_phoenixquotations';


            /* CUSTOMER WHATSAPP URL */

            $customerDigits =
                preg_replace(
                    '/\D+/',
                    '',
                    (string) $phone
                );

            if (
                strpos(
                    $customerDigits,
                    '0'
                ) === 0
            ) {

                $customerDigits =
                    '62'
                    . substr(
                        $customerDigits,
                        1
                    );

            } elseif (
                $customerDigits !== ''
                &&
                strpos(
                    $customerDigits,
                    '62'
                ) !== 0
            ) {

                $customerDigits =
                    '62'
                    . $customerDigits;

            }

            $customerWhatsAppMessage =
                'Halo '
                . $picName
                . ', kami dari Phoenix Digi Print menindaklanjuti request '
                . 'penawaran '
                . $quoteCode
                . ' untuk '
                . $product
                . '.';

            $customerWhatsAppUrl =
                'https://wa.me/'
                . rawurlencode(
                    $customerDigits
                )
                . '?text='
                . rawurlencode(
                    $customerWhatsAppMessage
                );


            /* SAFE HTML */

            $h =
                function ($value) {

                    return htmlspecialchars(
                        (string) $value,
                        ENT_QUOTES,
                        'UTF-8'
                    );

                };

            $hQuoteCode =
                $h($quoteCode);

            $hCompanyName =
                $h($companyName);

            $hPicName =
                $h($picName);

            $hEmail =
                $h($email);

            $hPhone =
                $h($phone);

            $hPosition =
                $h(
                    $position !== ''
                        ? $position
                        : '-'
                );

            $hCategory =
                $h($category);

            $hProduct =
                $h($product);

            $hQuantity =
                $h($quantity);

            $hSize =
                $h(
                    $size !== ''
                        ? $size
                        : '-'
                );

            $hMaterial =
                $h(
                    $material !== ''
                        ? $material
                        : '-'
                );

            $hDeadline =
                $h(
                    $deadline !== ''
                        ? $deadline
                        : '-'
                );

            $hBudget =
                $h(
                    $budget !== ''
                        ? $budget
                        : '-'
                );

            $hReference =
                $h(
                    $referenceLink !== ''
                        ? $referenceLink
                        : '-'
                );

            $hBrief =
                nl2br(
                    $h(
                        $brief
                    )
                );

            $hAdminUrl =
                $h(
                    $adminQuotationUrl
                );

            $hWhatsAppUrl =
                $h(
                    $customerWhatsAppUrl
                );


            /* HTML EMAIL */

            $mailBody =
                '<!doctype html>'
                . '<html>'
                . '<head>'
                . '<meta charset="utf-8">'
                . '<meta name="viewport" content="width=device-width,initial-scale=1">'
                . '</head>'
                . '<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#161b22;">'

                . '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f4f6f8;padding:30px 12px;">'
                . '<tr><td align="center">'

                . '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:720px;background:#ffffff;border:1px solid #e4e8eb;border-radius:18px;overflow:hidden;">'

                . '<tr>'
                . '<td style="padding:25px 28px;background:#151a20;color:#ffffff;">'
                . '<div style="font-size:11px;font-weight:700;letter-spacing:1.2px;color:#ff5a64;margin-bottom:8px;">PHOENIX DIGI PRINT</div>'
                . '<div style="font-size:25px;font-weight:800;line-height:1.2;">Quotation Baru Masuk</div>'
                . '<div style="font-size:12px;color:#bdc5cc;margin-top:7px;">'
                . $hQuoteCode
                . '</div>'
                . '</td>'
                . '</tr>'

                . '<tr>'
                . '<td style="padding:28px;">'

                . '<div style="font-size:11px;font-weight:800;letter-spacing:.8px;color:#e30613;margin-bottom:8px;">PERUSAHAAN</div>'
                . '<div style="font-size:23px;font-weight:800;margin-bottom:22px;">'
                . $hCompanyName
                . '</div>'

                . '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;margin-bottom:24px;">'

                . '<tr>'
                . '<td style="width:50%;padding:12px;border:1px solid #e7eaed;vertical-align:top;">'
                . '<div style="font-size:9px;font-weight:800;color:#818991;text-transform:uppercase;margin-bottom:5px;">PIC</div>'
                . '<div style="font-size:13px;font-weight:700;">' . $hPicName . '</div>'
                . '</td>'
                . '<td style="width:50%;padding:12px;border:1px solid #e7eaed;vertical-align:top;">'
                . '<div style="font-size:9px;font-weight:800;color:#818991;text-transform:uppercase;margin-bottom:5px;">Jabatan / Divisi</div>'
                . '<div style="font-size:13px;font-weight:700;">' . $hPosition . '</div>'
                . '</td>'
                . '</tr>'

                . '<tr>'
                . '<td style="padding:12px;border:1px solid #e7eaed;vertical-align:top;">'
                . '<div style="font-size:9px;font-weight:800;color:#818991;text-transform:uppercase;margin-bottom:5px;">Email</div>'
                . '<div style="font-size:13px;">' . $hEmail . '</div>'
                . '</td>'
                . '<td style="padding:12px;border:1px solid #e7eaed;vertical-align:top;">'
                . '<div style="font-size:9px;font-weight:800;color:#818991;text-transform:uppercase;margin-bottom:5px;">WhatsApp / Telepon</div>'
                . '<div style="font-size:13px;">' . $hPhone . '</div>'
                . '</td>'
                . '</tr>'

                . '</table>'

                . '<div style="font-size:11px;font-weight:800;letter-spacing:.8px;color:#e30613;margin-bottom:10px;">DETAIL KEBUTUHAN</div>'

                . '<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;margin-bottom:24px;">'

                . '<tr>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Kategori</strong><br><span style="font-size:12px;">' . $hCategory . '</span></td>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Produk</strong><br><span style="font-size:12px;">' . $hProduct . '</span></td>'
                . '</tr>'

                . '<tr>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Quantity</strong><br><span style="font-size:12px;">' . $hQuantity . '</span></td>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Ukuran</strong><br><span style="font-size:12px;">' . $hSize . '</span></td>'
                . '</tr>'

                . '<tr>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Material</strong><br><span style="font-size:12px;">' . $hMaterial . '</span></td>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Deadline</strong><br><span style="font-size:12px;">' . $hDeadline . '</span></td>'
                . '</tr>'

                . '<tr>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Budget</strong><br><span style="font-size:12px;">' . $hBudget . '</span></td>'
                . '<td style="padding:11px;border:1px solid #e7eaed;"><strong style="font-size:10px;">Referensi</strong><br><span style="font-size:12px;word-break:break-word;">' . $hReference . '</span></td>'
                . '</tr>'

                . '</table>'

                . '<div style="font-size:11px;font-weight:800;letter-spacing:.8px;color:#e30613;margin-bottom:9px;">BRIEF PROJECT</div>'
                . '<div style="padding:15px;border:1px solid #e7eaed;border-radius:10px;background:#f9fafb;font-size:12px;line-height:1.7;margin-bottom:25px;">'
                . $hBrief
                . '</div>'

                . '<table role="presentation" cellspacing="0" cellpadding="0" border="0">'
                . '<tr>'

                . '<td style="padding-right:8px;">'
                . '<a href="' . $hAdminUrl . '" style="display:inline-block;padding:13px 17px;border-radius:9px;background:#e30613;color:#ffffff;font-size:11px;font-weight:800;text-decoration:none;">'
                . 'Buka Admin Quotation'
                . '</a>'
                . '</td>'

                . '<td>'
                . '<a href="' . $hWhatsAppUrl . '" style="display:inline-block;padding:12px 16px;border:1px solid #dfe4e7;border-radius:9px;background:#ffffff;color:#161b22;font-size:11px;font-weight:800;text-decoration:none;">'
                . 'Hubungi Customer via WhatsApp'
                . '</a>'
                . '</td>'

                . '</tr>'
                . '</table>'

                . '</td>'
                . '</tr>'

                . '<tr>'
                . '<td style="padding:16px 28px;border-top:1px solid #edf0f2;background:#fafbfc;color:#8b939a;font-size:10px;line-height:1.5;">'
                . 'Email otomatis dari sistem Phoenix Quotation. '
                . 'Quotation sudah tersimpan di database sebelum email ini dikirim.'
                . '</td>'
                . '</tr>'

                . '</table>'

                . '</td></tr>'
                . '</table>'

                . '</body>'
                . '</html>';


            $mailer->isHtml(
                true
            );

            $mailer->setBody(
                $mailBody
            );

            $mailSent =
                (bool) $mailer->Send();

        }

    } catch (Exception $e) {

        /*
         * Jangan gagalkan lead hanya karena email bermasalah.
         */
        $mailSent =
            false;

    }


    $session->set(
        'phoenix.last_quotation_submit',
        $now
    );


    $respond(
        true,
        'Request penawaran berhasil diterima.',
        array(
            'quote_code' =>
                $quoteCode,
            'mail_sent' =>
                $mailSent
        )
    );

}
