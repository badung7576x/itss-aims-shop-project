<?php
namespace App\Helpers;

if (!function_exists('format_currency')) {

    function format_currency($amount)
    {
        $result = is_numeric($amount) ? number_format($amount) : $amount;
        $result .= "đ";
        return $result;
    }
}

if (!function_exists('calculate_total_price')) {

    function calculate_total_price($quantity, $price)
    {
        $total = (int) $quantity * (int) $price;
        $result = format_currency($total);
        return $result;
    }
}

if (!function_exists('get_order_status')) {

    function get_order_status($orderStatus)
    {
        $message = '';
        if($orderStatus === ORDER_SUCCESS) $message = "Đặt hàng thành công";
        if($orderStatus === ORDER_FAILURE) $message = "Đặt hàng thất bại";
        if($orderStatus === ORDER_PAID) $message = "Thanh toán thành công";
        return $message;
    }
}

if (!function_exists('cal_price_promotion')) {

    function cal_price_promotion($price, $discount)
    {
        return $price*(100-$discount)/100;
    }
}

if (!function_exists('cal_percent')) {

    function cal_percent($num1, $num2)
    {
        return $num1/$num2*100;
    }
}