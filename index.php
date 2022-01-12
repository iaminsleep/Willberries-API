<?php

header('Content-Type: application/json');

require_once 'cfg/config.php';
require_once 'cfg/functions.php';

$query = $_GET['q'];

$params = explode('/', $query); /* Запрос к определённому товару как в REST API, например goods/2 */

$type = $params[0];
$id = $params[1];

if($type === 'goods') {

  if(isset($id)) {
    getGood($database, $id);
  }

  else {
    getGoods($database);  /* Получение всех товаров */
  }

}