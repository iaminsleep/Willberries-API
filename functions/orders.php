<?php

/************************ ORDERS ********************/
/************************ ORDERS ********************/
/************************ ORDERS ********************/
/************************ ORDERS ********************/

function placeOrder($db, $data) {
  $personName = $data["name"];
  $email = $data["email"];
  $phone = $data["phone"];
  $goods = $data["goods"];

  // foreach($goods as $good) {
  //   mysqliQuery($db, "INSERT INTO `orders` (`good_id`, `user_id`, `email`, `price`, `date`) VALUES (`$good['id']`, ")
  // }
  // if(mysqliQuery($db, "INSERT INTO `goods` (`id`, `name`, `description`, `category`, `gender`, `price`, `img`, `label`, `offer`) VALUES (NULL, '$name', '$description', '$category', '$gender', '$price', '$img', '$label', '$offer');")) 
  // {
  //   http_response_code(201); /* ответ 201 - Created */
  //   $res = [
  //     "status" => true,
  //     "good_id" => mysqli_insert_id($db)
  //   ];
  // }

  // else {
  //   http_response_code(401); /* Bad request */
  //   $res = [
  //     "status" => false,
  //     "message" => "Bad Request!"
  //   ];
  // }

  // echo json_encode($res);
}

function getOrders($db) {
  $orders = mysqliQuery($db, "SELECT * FROM `orders`;");

  $ordersList = [];

  while($order = mysqli_fetch_assoc($orders)) {
    $ordersList[] = $order;
  }

  echo json_encode($ordersList); /* Данные переводятся в JSON формат */
}

function getOrder($db, $id) {
  $order = mysqliQuery($db, "SELECT * FROM `orders` WHERE `id` = '$id';");
  
  if(mysqli_num_rows($order) === 0) {
    http_response_code(404);
    $res = [
      "status" => false,
      "message" => "Order wasn't found!"
    ];
    echo json_encode($res);
  }
  else {
    $order = mysqli_fetch_assoc($order); /* Преобразование в обычный ассоциативный массив */
    echo json_encode($order);
  }
}