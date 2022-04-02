<?php

function getCartItems() {
  $mysqli = DataBase::getInstance();
  
  $stmt = $mysqli->prepare("SELECT * FROM `cart_item`;");
  $stmt->execute();
  $result = $stmt->get_result();

  $cartItemsList = [];

  while($good = $result->fetch_assoc()) {
    $cartItemsList[] = $good;
  }

  echo json_encode($cartItemsList);
}

function getCartItem($id) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("SELECT * FROM `cart_item` WHERE `id` = (?);");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $cartItem = $stmt->get_result();
  
  if(mysqli_num_rows($cartItem) === 0) {
    $res = [
      "status" => false,
      "message" => "Cart item wasn't found!",
    ];
    sendReply(404, $res);
  }
  else {
    $cartItem = $cartItem->fetch_assoc();
    echo json_encode($cartItem);
  }
}

function getUserCartItems() {
  $mysqli = DataBase::getInstance();

  $decodedJWTData = getUserData();
  
  $stmt = $mysqli->prepare("SELECT * FROM `cart_item` WHERE `shopping_cart_id` = (?);");
  $stmt->bind_param('i', $decodedJWTData->user_data->cart_id);
  $stmt->execute();
  $result = $stmt->get_result();

  $cartItemsList = [];

  while($cartItem = $result->fetch_assoc()) {
    $cartItemsList[] = $cartItem;
  }

  echo json_encode($cartItemsList);
}

function addToCart($postData) {
  
}