<?php

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
  case 'GET':
    if($type === 'goods') {
      if(isset($id)) {
        getGood($DATABASE, $id);
      }
      else {
        getGoods($DATABASE);  /* Получение всех товаров */
      }
    }
    break;
  case 'POST':
    if($type === 'goods') {
      addGood($DATABASE, $_POST);
    }
    break;
  case 'PATCH':
    if($type === 'goods') {
      if(isset($id)) {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true); /* преобразование json в обычный ассоциативный php массив, 
        потому что метод PATCH не поддерживает form-дату из метода POST */
        updateGood($DATABASE, $data, $id);
      }
    }
    break;
  case 'DELETE':
    if($type === 'goods') {
      if(isset($id)) {
        deleteGood($DATABASE, $id);
      }
    }
    break;
}