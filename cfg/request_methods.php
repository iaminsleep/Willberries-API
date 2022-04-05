<?php

//get parameters

$query = $_GET['q'] ?? null;

$params = explode('/', $query); /* Запрос к определённому товару как в REST API, например goods/2 */

$type = $params[0];
$id = $params[1] ?? null;

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
  case 'GET':
    if($type === 'goods') {
      if(isset($id)) {
        getGood($id); /* Retrieve one good by its ID */
      } else {
        getGoods();  /* Retrieve all of the goods */
      }
    }
    if($type === 'orders') {
      if(isset($id)) {
        getOrder($id);
      } else {
        getOrders();
      }
    }
    if($type === 'users') {
      if(isset($id)) {
        getUser($id);
      } else {
        getUsers();
      }
    }
    if($type === 'categories') {
      if(isset($id)) {
        getCategory($id);
      } else {
        getCategories();
      }
    }
    if($type === 'genders') {
      if(isset($id)) {
        getGender($id);
      } else {
        getGenders();
      }
    }
    if($type === 'carts') {
      if(isset($id)) {
        getUserCart($id);
      } else {
        getUserCarts();
      }
    }
    if($type === 'cart_items') {
      if(isAuth()) getUserCartItems();
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
      if(isset($_POST["confirm_password"])) registerUser($_POST);
      else if(!isset($_POST["confirm_password"]) && isset($_POST["password"], $_POST["email"])) login($_POST);
      else if(!isset($_POST["email"], $_POST["password"])) logout();
    }
    if($type === 'cart_items') {
      if(isAuth()) addToCart($_POST);
    }
    break;
  case 'PATCH':
    if($type === 'goods') {
      if(isset($id)) {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true); /* преобразование json в обычный ассоциативный php массив, 
        потому что метод PATCH не поддерживает form-дату из метода POST */
        updateGood($data, $id);
      }
    }
    break;
  case 'DELETE':
    if($type === 'goods') {
      if(isset($id)) {
        deleteGood($id);
      }
    }
    break;
}