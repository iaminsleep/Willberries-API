<?php

/************************ ORDERS ********************/
/************************ ORDERS ********************/
/************************ ORDERS ********************/
/************************ ORDERS ********************/

function placeOrder($postArray) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("INSERT INTO `order` (`user_id`, `total`, `created_at`, `comment`) VALUES (?, ?, ?, ?);");
  $stmt->bind_param('iiss', $postArray['user_id'], $postArray['total'], $postArray['created_at'], $postArray['comment']);
  if($stmt->execute()) {
    $order_id = mysqli_insert_id($mysqli);
  };

  $decodedJWTData = getUserData();
  $cart_id = $decodedJWTData->user_data->cart_id;

  $stmt = $mysqli->prepare("SELECT * FROM `cart_item` WHERE `shopping_cart_id` = (?);");
  $stmt->bind_param('i', $cart_id);
  $stmt->execute();
  $result = $stmt->get_result();

  $cartItemsList = [];

  while($cartItem = $result->fetch_assoc()) {
    $cartItemsList[] = $cartItem;
  }

  foreach($cartItemsList as $cartItem) {
    $stmt = $mysqli->prepare("INSERT INTO 
      `order_item` (`product_id`, `order_id`, `name`, `quantity`, `price`, `img`) 
        VALUES (?, ?, ?, ?, ?, ?);");
    $stmt->bind_param('iisiis', $cartItem['product_id'], $order_id, $cartItem['name'], 
      $cartItem['quantity'], $cartItem['price'], $cartItem['img']);
    if(!$stmt->execute()) {
      $res = [
        "status" => false,
        "message" => 'Unexpected error during order submit. Try again later.',
      ];
      return sendReply(400, $res);
    };
  }

  $stmt = $mysqli->prepare("DELETE FROM `cart_item` WHERE `shopping_cart_id` = (?);");
  $stmt->bind_param('i', $cart_id);
  $stmt->execute();
  
  $res = [
    "status" => true,
    "order_id" => $order_id,
    "message" => "Your order has been created successfully. Expect a call from our manager!",
  ];
  sendReply(201, $res);
}

function getAllOrders() {
  $mysqli = DataBase::getInstance();
  
  $stmt = $mysqli->prepare("SELECT * FROM `order`;");
  $stmt->execute();
  $result = $stmt->get_result();

  $ordersList = [];

  while($order = $result->fetch_assoc()) {
    $ordersList[] = $order;
  }

  $fullOrdersInfo = []; //array with order information

  foreach($ordersList as $order) {
    $userData = getUser($order['user_id']);

    //create new array with only selected keys from an existing array
    $specificUserData = array_intersect_key($userData, array_flip(array('name', 'email', 'phone'))); 
    
    $stmt = $mysqli->prepare("SELECT * FROM `order_item` WHERE `order_id` = (?);");
    $stmt->bind_param('i', $order['id']);

    if(!$stmt->execute()) {
      $res = [
        "status" => false,
        "message" => 'Failed to fetch order items.',
      ];
      return sendReply(500, $res);
    }

    $orderItemsList = [];
    $result = $stmt->get_result();
    
    while($orderItem = $result->fetch_assoc()) {
      $orderItemsList[] = $orderItem;
    }

    $res = [
      "order_info" => $order,
      "order_items" => $orderItemsList,
      "user_info" => $specificUserData,
    ];

    $fullOrdersInfo[] = $res; //push this value to the array with the order info 
  }

  http_response_code(200);
  echo json_encode($fullOrdersInfo);
}