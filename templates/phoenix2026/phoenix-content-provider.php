<?php
defined('_JEXEC') or die;

if (!function_exists('phxContentTableExists')) {
    function phxContentTableExists($db, $shortName) {
        $real = $db->getPrefix() . ltrim($shortName, '#_');
        return in_array($real, $db->getTableList(), true);
    }
}

if (!function_exists('phxContentReady')) {
    function phxContentReady($db) {
        return phxContentTableExists($db, 'phoenix_content_settings')
            && phxContentTableExists($db, 'phoenix_content_products')
            && phxContentTableExists($db, 'phoenix_content_seo_pages');
    }
}

if (!function_exists('phxContentSetting')) {
    function phxContentSetting($db, $section, $key, $fallback = '') {
        if (!phxContentTableExists($db, 'phoenix_content_settings')) {
            return $fallback;
        }
        try {
            $q = $db->getQuery(true)
                ->select($db->quoteName('field_value'))
                ->from($db->quoteName('#__phoenix_content_settings'))
                ->where($db->quoteName('section_key') . '=' . $db->quote($section))
                ->where($db->quoteName('field_key') . '=' . $db->quote($key));
            $db->setQuery($q);
            $v = $db->loadResult();
            return ($v === null || trim((string)$v) === '') ? $fallback : (string)$v;
        } catch (Exception $e) {
            return $fallback;
        }
    }
}

if (!function_exists('phxContentProduct')) {
    function phxContentProduct($db, $slug) {
        if (!phxContentTableExists($db, 'phoenix_content_products')) return null;
        try {
            $q = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__phoenix_content_products'))
                ->where($db->quoteName('slug') . '=' . $db->quote($slug))
                ->where($db->quoteName('is_published') . '=1');
            $db->setQuery($q, 0, 1);
            return $db->loadObject();
        } catch (Exception $e) {
            return null;
        }
    }
}

if (!function_exists('phxContentProducts')) {
    function phxContentProducts($db) {
        if (!phxContentTableExists($db, 'phoenix_content_products')) return array();
        try {
            $q = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__phoenix_content_products'))
                ->where($db->quoteName('is_published') . '=1')
                ->order($db->quoteName('sort_order') . ' ASC, ' . $db->quoteName('name') . ' ASC');
            $db->setQuery($q);
            return (array)$db->loadObjectList();
        } catch (Exception $e) {
            return array();
        }
    }
}

if (!function_exists('phxContentProductImages')) {
    function phxContentProductImages($db, $productId) {
        if (!phxContentTableExists($db, 'phoenix_content_product_images')) return array();
        try {
            $q = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__phoenix_content_product_images'))
                ->where($db->quoteName('product_id') . '=' . (int)$productId)
                ->order($db->quoteName('sort_order') . ' ASC, ' . $db->quoteName('id') . ' ASC');
            $db->setQuery($q);
            return (array)$db->loadObjectList();
        } catch (Exception $e) {
            return array();
        }
    }
}

if (!function_exists('phxContentSeoPage')) {
    function phxContentSeoPage($db, $slug) {
        if (!phxContentTableExists($db, 'phoenix_content_seo_pages')) return null;
        try {
            $q = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__phoenix_content_seo_pages'))
                ->where($db->quoteName('slug') . '=' . $db->quote($slug))
                ->where($db->quoteName('is_published') . '=1');
            $db->setQuery($q, 0, 1);
            return $db->loadObject();
        } catch (Exception $e) {
            return null;
        }
    }
}

if (!function_exists('phxContentPortfolio')) {
    function phxContentPortfolio($db, $limit = 0) {
        if (!phxContentTableExists($db, 'phoenix_content_portfolio')) return array();
        try {
            $q = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__phoenix_content_portfolio'))
                ->where($db->quoteName('is_published') . '=1')
                ->order($db->quoteName('sort_order') . ' ASC, ' . $db->quoteName('id') . ' DESC');
            $db->setQuery($q, 0, $limit > 0 ? (int)$limit : 0);
            return (array)$db->loadObjectList();
        } catch (Exception $e) {
            return array();
        }
    }
}
