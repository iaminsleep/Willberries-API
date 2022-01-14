<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Creditentials: true');
header('Content-Type: application/json');

require_once 'cfg/config.php';
require_once 'cfg/functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$query = $_GET['q'];

$params = explode('/', $query); /* Запрос к определённому товару как в REST API, например goods/2 */

$type = $params[0];
$id = $params[1];

switch($method) {
  case 'GET':
    if($type === 'goods') {
      if(isset($id)) {
        getGood($database, $id);
      }

      else {
        getGoods($database);  /* Получение всех товаров */
      }
    }
    break;
  case 'POST':
    if($type === 'goods') {
      addGood($database, $_POST);
    }
    break;
  case 'PATCH':
    if($type === 'goods') {
      if(isset($id)) {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true); /* преобразование json в обычный ассоциативный php массив, 
        потому что метод PATCH не поддерживает form-дату из метода POST */
        updateGood($database, $data, $id);
      }
    }
    break;
  case 'DELETE':
    if($type === 'goods') {
      if(isset($id)) {
        deleteGood($database, $id);
      }
    }
    break;
}