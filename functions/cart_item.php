<?php

/********************** CART ITEMS ********************/
/********************** CART ITEMS ********************/
/********************** CART ITEMS ********************/
/********************** CART ITEMS ********************/

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
  $mysqli = DataBase::getInstance();

  $decodedJWTData = getUserData();

  $stmt = $mysqli->prepare("INSERT INTO 
    `cart_item` (`product_id`, `name`, `quantity`, `price`, `img`, `shopping_cart_id`) 
    VALUES (?, ?, ?, ?, ?, ?);");   
  $stmt->bind_param('isiisi', $postData['product_id'], $postData['name'], $postData['quantity'], 
  $postData['price'], $postData['img'], $decodedJWTData->user_data->cart_id);

  if($stmt->execute()) {
    $res = [
      "status" => true,
      "item_id" => mysqli_insert_id($mysqli),
    ];
    sendReply(201, $res);
  }
  else {
    $res = [
      "status" => false,
      "message" => 'Failed to add item to cart. Please try again.',
    ];
    sendReply(400, $res);
  }
}

function changeQtyInCart($postData) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("UPDATE `cart_item` SET `quantity` = (?) WHERE `id` = (?)");  
  $stmt->bind_param('ii', $postData['quantity'], $postData['id']);

  if($stmt->execute()) {
    $res = [
      "status" => true,
      "item_id" => $postData['id'],
      "quantity" => $postData['quantity'],
    ];
    sendReply(200, $res);
  }
  else {
    $res = [
      "status" => false,
      "message" => 'Failed to change the quantity of the item. Please try later.',
    ];
    sendReply(400, $res);
  }
} 

function deleteFromCart($postData) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("DELETE FROM `cart_item` WHERE `id` = (?)");  
  $stmt->bind_param('i', $postData['id']);

  if($stmt->execute()) {
    $res = [
      "status" => true,
      "item_id" => $postData['id'],
    ];
    sendReply(200, $res);
  }
  else {
    $res = [
      "status" => false,
      "message" => 'Failed to delete item from the cart. Please try later.',
    ];
    sendReply(400, $res);
  }
} 