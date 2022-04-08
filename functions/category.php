<?php

function getCategories() {
  $mysqli = DataBase::getInstance();
  
  $stmt = $mysqli->prepare("SELECT * FROM `category`;");
  $stmt->execute();
  $result = $stmt->get_result();

  $categoriesList = [];

  while($category = $result->fetch_assoc()) {
    $categoriesList[] = $category;
  }

  echo json_encode($categoriesList);
}

function getCategory($id) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("SELECT * FROM `category` WHERE `id` = (?);");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $category = $stmt->get_result();
  
  if(mysqli_num_rows($category) === 0) {
    $res = [
      "status" => false,
      "message" => "Category wasn't found!",
    ];
    sendReply(404, $res);
  }
  else {
    $category = $category->fetch_assoc();
    echo json_encode($category);
  }
}