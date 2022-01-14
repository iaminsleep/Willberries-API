<?php

require 'config.php';

function getGoods($db) {
  $posts = mysqli_query($db, "SELECT * FROM `goods`;");

  $postsList = [];

  while($post = mysqli_fetch_assoc($posts)) {
    $postsList[] = $post;
  }

  echo json_encode($postsList); /* Данные переводятся в JSON формат */
}

function getGood($db, $id) {
  $post = mysqli_query($db, "SELECT * FROM `goods` WHERE `id` = '$id';");
  
  if(mysqli_num_rows($post) === 0) {
    http_response_code(404);
    $res = [
      "status" => false,
      "message" => "Post not found"
    ];
    echo json_encode($res);
  }
  else {
    $post = mysqli_fetch_assoc($post); /* Преобразование в обычный ассоциативный массив */
    echo json_encode($post);
  }
}

function addGood($db, $data) {

  $name = $data['name'];
  $description = $data['description'];
  $category = $data['category'];
  $gender = $data['gender'];
  $price = $data['price'];
  $img = $data['img'];
  $label = $data['label'];
  $offer = $data['offer'];

  mysqli_query($db, "INSERT INTO `goods` (`id`, `name`, `description`, `category`, `gender`, `price`, `img`, `label`, `offer`) VALUES (NULL, '$name', '$description', '$category', '$gender', '$price', '$img', '$label', '$offer');");

  http_response_code(201);

  $res = [
    "status" => true,
    "good_id" => mysqli_insert_id($db)
  ];

  echo json_encode($res);
}

function updateGood($db, $data, $goodId) {

  $name = $data['name'];
  $description = $data['description'];
  $category = $data['category'];
  $gender = $data['gender'];
  $price = $data['price'];
  $img = $data['img'];
  $label = $data['label'];
  $offer = $data['offer'];

  mysqli_query($db, "UPDATE `goods` SET `name` = '$name', `description` = '$description', `category` = '$category', `gender` = '$gender', `price` = '$price', `img` = '$img', `label` = '$label', `offer` = '$offer' WHERE `goods`.`id` = '$goodId';");

  http_response_code(200);

  $res = [
    "status" => true,
    "message" => "Good has been updated successfully"
  ];

  echo json_encode($res);
}

function deleteGood($db, $goodId) {
  mysqli_query($db, "DELETE FROM `goods` WHERE `goods`.`id` = '$goodId';");

  http_response_code(200);

  $res = [
    "status" => true,
    "message" => "Good was successfully deleted"
  ];

  echo json_encode($res);
}