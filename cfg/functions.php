<?php

require 'config.php';

function mysqliQuery($db, $sql = "") {
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  if(empty($sql)) return false;

  $query = mysqli_query($db, $sql) or die("Ошибка запроса: ".mysqli_error());

  return $query;
}

/************************ GOODS ********************/
/************************ GOODS ********************/
/************************ GOODS ********************/
/************************ GOODS ********************/

function getGoods($db) {
  $posts = mysqliQuery($db, "SELECT * FROM `goods`;");

  $postsList = [];

  while($post = mysqli_fetch_assoc($posts)) {
    $postsList[] = $post;
  }

  echo json_encode($postsList); /* Данные переводятся в JSON формат */
}

function getGood($db, $id) {
  $post = mysqliQuery($db, "SELECT * FROM `goods` WHERE `id` = '$id';");
  
  if(mysqli_num_rows($post) === 0) {
    http_response_code(404);
    $res = [
      "status" => false,
      "message" => "Good wasn't found!"
    ];
    echo json_encode($res);
  }
  else {
    $post = mysqli_fetch_assoc($post); /* Преобразование в обычный ассоциативный массив */
    echo json_encode($post);
  }
}

function addGood($db, $data) {

  $name = $data["name"] ? $data["name"] : "Name";
  $description = $data["description"] ? $data["description"] : "Description";
  $category = $data["category"] ? $data["category"] : "Category";
  $gender = $data["gender"] ? $data["gender"] : "Gender";
  $price = $data["price"] ? $data["price"] : 0;
  $img = $data["img"] ? $data["img"] : "img/no-image.png";
  $label = $data["label"] ? $data["label"] : NULL;
  $offer = $data["offer"] ? $data["offer"] : 0;

  if(mysqliQuery($db, "INSERT INTO `goods` (`id`, `name`, `description`, `category`, `gender`, `price`, `img`, `label`, `offer`) VALUES (NULL, '$name', '$description', '$category', '$gender', '$price', '$img', '$label', '$offer');")) 
  {
    http_response_code(201); /* ответ 201 - Created */
    $res = [
      "status" => true,
      "good_id" => mysqli_insert_id($db)
    ];
  }

  else {
    http_response_code(401); /* Bad request */
    $res = [
      "status" => false,
      "message" => "Bad Request!"
    ];
  }

  echo json_encode($res);
}

function updateGood($db, $data, $goodId) {

  $name = $data["name"] ? $data["name"] : "Name";
  $description = $data["description"] ? $data["description"] : "Description";
  $category = $data["category"] ? $data["category"] : "Category";
  $gender = $data["gender"] ? $data["gender"] : "Gender";
  $price = $data["price"] ? $data["price"] : 0;
  $img = $data["img"] ? $data["img"] : "Img";
  $label = $data["label"] ? $data["label"] : "Label";
  $offer = $data["offer"] ? $data["offer"] : 0;

  if(mysqliQuery($db, "UPDATE `goods` SET `name` = '$name', `description` = '$description', `category` = '$category', `gender` = '$gender', `price` = '$price', `img` = '$img', `label` = '$label', `offer` = '$offer' WHERE `goods`.`id` = '$goodId';")) 
  {
    http_response_code(200); /* ответ 204 работает также как и ответ 200, но при этом ничего не возвращает (работает как return и всё что после не работает) */
    $res = [
      "status" => true,
      "message" => "The good has been successfully updated.",
    ];
  }

  else {
    http_response_code(401); /* Bad request */
    $res = [
      "status" => false,
      "message" => "Bad Request!"
    ];
  }
  
  echo json_encode($res);
}

function deleteGood($db, $goodId) {
  if(mysqliQuery($db, "DELETE FROM `goods` WHERE `goods`.`id` = '$goodId';")) 
  {
    http_response_code(200); /* ответ 204 работает также как и ответ 200, но при этом ничего не возвращает (работает как return и всё что после не работает) */
    $res = [
      "status" => true,
      "message" => "Good was successfully deleted."
    ];
  }

  else {
    http_response_code(403); /* Bad request */
    $res = [
      "status" => false,
      "message" => "Forbidden!"
    ];
  }

  echo json_encode($res);
}
