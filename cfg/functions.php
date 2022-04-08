<?php

require_once 'config.php';

function sendReply($responseCode, $dataRes) {
  http_response_code($responseCode);
  echo json_encode($dataRes); 
  die;
}

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php'); //the first way of accessing root directory

require_once dirname(__DIR__).'/functions/product.php'; //the second way
require_once dirname(__DIR__).'/functions/user.php';
require_once dirname(__DIR__).'/functions/shopping_cart.php';
require_once dirname(__DIR__).'/functions/order.php';
require_once dirname(__DIR__).'/functions/category.php';
require_once dirname(__DIR__).'/functions/gender.php';
require_once dirname(__DIR__).'/functions/cart_item.php';