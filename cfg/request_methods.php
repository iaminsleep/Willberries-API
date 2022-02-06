<?php

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
  case 'GET':
    if($type === 'goods') {
      if(isset($id)) {
        getGood($id); /* Retrieve one good by its ID */
      }
      else {
        getGoods();  /* Retrieve all of the goods */
      }
    }
    if($type === 'orders') {
      if(isset($id)) {
        getOrder($DATABASE, $id);
      }
      else {
        getOrders($DATABASE);
      }
    }
    if($type === 'users') {
      if(isset($id)) {
        getUser($id);
      }
      else {
        getUsers();
      }
    }
    break;
  case 'POST':
    if($type === 'goods') {
      addGood($_POST);
    }
    if($type === 'orders') {
      placeOrder($_POST);
    }
    if($type === 'users') {
      registerUser($_POST);
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