<?php

if (! function_exists('formatRupiah')) {
    function formatRupiah($amount) {
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, 'IDR');
    }
}
