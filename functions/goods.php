<?php

/************************ GOODS ********************/
/************************ GOODS ********************/
/************************ GOODS ********************/
/************************ GOODS ********************/

function getGoods() {
  $mysqli = DataBase::getInstance();
  
  $stmt = $mysqli->prepare("SELECT * FROM `goods`;");
  $stmt->execute();
  $result = $stmt->get_result();

  $goodsList = [];

  while($good = $result->fetch_assoc()) {
    $goodsList[] = $good;
  }

  echo json_encode($goodsList); /* Данные переводятся в JSON формат */
}

function getGood($id) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("SELECT * FROM `goods` WHERE `id` = (?);");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $good = $stmt->get_result();
  
  if(mysqli_num_rows($good) === 0) {
    $res = [
      "status" => false,
      "message" => "Good wasn't found!",
    ];
    sendReply(404, $res);
  }
  else {
    $good = $good->fetch_assoc(); /* Преобразование в обычный ассоциативный массив */
    echo json_encode($good);
  }
}

function addGood($db, $data) {

  $name = $data["name"] ? $data["name"] : "Name";
  $description = $data["description"] ? $data["description"] : "Description";
  $category = $data["category"] ? $data["category"] : "Category";
  $gender = $data["gender"] ? $data["gender"] : "Gender";
  $price = $data["price"] ? $data["price"] : 0;
  $img = $data["img"] ? $data["img"] : "img/no-image.png";
  $label = $data["label"] ? $data["label"] : "";
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