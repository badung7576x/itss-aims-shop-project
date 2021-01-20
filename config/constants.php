<?php

if(!defined('PER_PAGE')) define('PER_PAGE', 20);

if(!defined('ORDER_WAITING')) define('ORDER_WAITING', 0);
if(!defined('ORDER_CONFIRM')) define('ORDER_CONFIRM', 1);
if(!defined('ORDER_SHIPPING')) define('ORDER_SHIPPING', 2);
if(!defined('ORDER_SUCCESS')) define('ORDER_SUCCESS', 3);
if(!defined('ORDER_FAILURE')) define('ORDER_FAILURE', 4);
if(!defined('ORDER_STATUS_MESSAGES')) define('ORDER_STATUS_MESSAGES', [
    0 => 'Đang chờ xử lý',
    1 => 'Đã xác nhận',
    2 => 'Đang giao hàng',
    3 => 'Đặt hàng thành công',
    4 => 'Đơn hàng đã bị hủy'
]);

if(!defined('HISTORY_STATUS_MESSAGES')) define('HISTORY_STATUS_MESSAGES', [
    'create_product' => 'Thêm sản phẩm',
    'edit_product' => 'Sửa thông tin sản phẩm',
    'delete_product' => 'Xóa sản phẩm',
]);

if(!defined('PAYMENT_STATUS_MESSAGES')) define('PAYMENT_STATUS_MESSAGES', [
    0 => 'Thanh toán thất bại',
    1 => 'Thanh toán thành công'
]);

if(!defined('PAYMENT_TYPE')) define('PAYMENT_TYPE', [
    'payment' => 'payment',
    'refund' => 'refund'
]);



if(!defined('ACTION_TYPE')) define('ACTION_TYPE', [
    'CREATE_PRODUCT_ACTION' => 1,
    'UPDATE_INFO_ACTION' => 2,
    'UPDATE_PRICE_ACTION' => 3,
    'DELETE_PRODUCT_ACTION' => 4,
    'DELETE_PRODUCTS_ACTION' => 5
]);

if(!defined('ADDRESS')) define('ADDRESS',
    [ 'An Giang', 'Bà rịa – Vũng tàu', 'Bắc Giang', 'Bắc Kạn', 'Bạc Liêu', 'Bắc Ninh', 'Bến Tre', 'Bình Định',
        'Bình Dương', 'Bình Phước', 'Bình Thuận', 'Cà Mau', 'Cần Thơ', 'Cao Bằng', 'Đà Nẵng', 'Đắk Lắk', 'Đắk Nông',
        'Điện Biên', 'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Nội', 'Hà Tĩnh', 'Hải Dương',
        'Hải Phòng', 'Hậu Giang', 'Hòa Bình', 'Hưng Yên', 'Khánh Hòa', 'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lâm Đồng',
        'Lạng Sơn', 'Lào Cai', 'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Phú Yên',
        'Quảng Bình', 'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị', 'Sóc Trăng', 'Sơn La', 'Tây Ninh',
        'Thái Bình', 'Thái Nguyên', 'Thanh Hóa', 'Thừa Thiên Huế', 'Tiền Giang', 'Thành phố Hồ Chí Minh',
        'Trà Vinh', 'Tuyên Quang', 'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái']);

if(!defined('FREESHIP_MINIMUM_AMOUNT')) define('FREESHIP_MINIMUM_AMOUNT', 500000);
if(!defined('DEFAULT_WEIGHT_UNIT')) define('DEFAULT_WEIGHT_UNIT', 'g');

if(!defined('VAT')) define('VAT', 1.1);
