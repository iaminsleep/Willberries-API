<?php

function getGenders() {
  $mysqli = DataBase::getInstance();
  
  $stmt = $mysqli->prepare("SELECT * FROM `gender`;");
  $stmt->execute();
  $result = $stmt->get_result();

  $genderList = [];

  while($gender = $result->fetch_assoc()) {
    $genderList[] = $gender;
  }

  echo json_encode($genderList);
}

function getGender($id) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("SELECT * FROM `gender` WHERE `id` = (?);");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $gender = $stmt->get_result();
  
  if(mysqli_num_rows($gender) === 0) {
    $res = [
      "status" => false,
      "message" => "Gender wasn't found!",
    ];
    sendReply(404, $res);
  }
  else {
    $gender = $gender->fetch_assoc();
    echo json_encode($gender);
  }
}