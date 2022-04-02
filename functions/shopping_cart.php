<?php

/************************ CART ********************/
/************************ CART ********************/
/************************ CART ********************/
/************************ CART ********************/

function getUserCarts() {
  $mysqli = DataBase::getInstance();
  $stmt = $mysqli->prepare("SELECT * FROM `shopping_cart`;");
  $stmt->execute();
  $result = $stmt->get_result();
  $cartList = [];
  while($cart = $result->fetch_assoc()) {
      $cartList[] = $cart;
  }
  echo json_encode($cartList);
}
  

function getUserCart($userId) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("SELECT * FROM `shopping_cart` WHERE `user_id` = (?);");
  $stmt->bind_param('i', $userId);
  $stmt->execute();
  $cart = $stmt->get_result();
  
  if(mysqli_num_rows($cart) === 0) {
    $res = [
      "status" => false,
      "message" => "Cart wasn't found!",
    ];
    sendReply(404, $res);
  } else {
    $cart = $cart->fetch_array();
    return $cart;
  }
}