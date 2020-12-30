<?php

if(!defined('PER_PAGE')) define('PER_PAGE', 20);

if(!defined('ORDER_FAILURE')) define('ORDER_FAILURE', 0);
if(!defined('ORDER_SUCCESS')) define('ORDER_SUCCESS', 1);
if(!defined('ORDER_PAID')) define('ORDER_PAID', 2);

if(!defined('ACTION_TYPE')) define('ACTION_TYPE', [
    'CREATE_PRODUCT_ACTION' => 1,
    'UPDATE_INFO_ACTION' => 2,
    'UPDATE_PRICE_ACTION' => 3,
    'DELETE_PRODUCT_ACTION' => 4,
    'DELETE_PRODUCTS_ACTION' => 5
]);
