<?php

/************************ USERS ********************/
/************************ USERS ********************/
/************************ USERS ********************/
/************************ USERS ********************/

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function getUsers() {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("SELECT * FROM `user`;");
  $stmt->execute();
  $result = $stmt->get_result();

  $usersList = [];

  while($user = $result->fetch_assoc()) {
    $usersList[] = $user;
  }

  echo json_encode($usersList);
}

function getUser($id) {
  $mysqli = DataBase::getInstance();

  $stmt = $mysqli->prepare("SELECT * FROM `user` WHERE `id` = (?);");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $user = $stmt->get_result();

  if(mysqli_num_rows($user) === 0) {
    $res = [
      "status" => false,
      "message" => "The user wasn't found!",
    ];
    sendReply(404, $res);
  }
  else {
    $user = $user->fetch_assoc();
    echo json_encode($user);
  }
}

function registerUser($postData) {
  $mysqli = DataBase::getInstance();
 
  $email = mysqli_real_escape_string($mysqli, $postData["email"]);
  $password = mysqli_real_escape_string($mysqli, $postData["password"]);
  $confirm_password = mysqli_real_escape_string($mysqli, $postData["confirm_password"]);

  if(empty($postData) || !isset($email) || empty($email) || !isset($password) || empty($password) 
  || !isset($confirm_password) || empty($confirm_password)) return false;

  if($password !== $confirm_password) {
    $res = [
      "status" => false,
      "message" => "Passwords don't match!",
    ];
    sendReply(403, $res);
  }

  $stmt = $mysqli->prepare("SELECT * FROM `user` WHERE `email` = (?);");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $user = $stmt->get_result();

  if(mysqli_num_rows($user) > 0) {
    $res = [
      "status" => false,
      "message" => 'User with such email already exists!',
    ];
    sendReply(422, $res);
  };

  $date = date("Y-m-d H:i:s");
  $hashPass = password_hash($password, PASSWORD_DEFAULT);
  $nameFromEmail = strstr($email, '@', true);
  
  $stmt = $mysqli->prepare("INSERT INTO `user` (`email`, `password`, `registered_at`, `name`) 
  VALUES (?, ?, ?, ?);");
  $stmt->bind_param('ssss', $email, $hashPass, $date, $nameFromEmail);

  if($stmt->execute()) {
    $res = [
      "status" => true,
      "user_id" => mysqli_insert_id($mysqli),
    ];
    $stmt = $mysqli->prepare("INSERT INTO `shopping_cart` (`user_id`) VALUES (?);");
    $stmt->bind_param('i', mysqli_insert_id($mysqli));
    if($stmt->execute()) {
      sendReply(201, $res);
    };
  } else {
    $res = [
      "status" => false,
      "message" => 'Bad Request!',
    ];
    sendReply(401, $res);
  }
}

function login($postData) {
  $mysqli = DataBase::getInstance();
 
  $email = mysqli_real_escape_string($mysqli, $postData["email"]);
  $password = mysqli_real_escape_string($mysqli, $postData["password"]);

  if(empty($postData) || !isset($email) || empty($email) || !isset($password) || empty($password)) return false;

  $stmt = $mysqli->prepare("SELECT * FROM `user` WHERE `email` = (?);");
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if(mysqli_num_rows($result) > 0) {
    $data = $result->fetch_assoc();
    $isValid = password_verify($password, $data["password"]);

    if(!$isValid) {
      $res = [
        "status" => false,
        "message" => "Invalid username or password!",
      ];
      sendReply(403, $res);
    } 

    else {
      $cart = getUserCart($data["id"]);

      $secret_key = 'authkey456';
      $iat = time();
      $exp = $iat + 60 * 60 * 10 * 10 * 10 * 10;
      $user_data = [
        "id" => $data["id"],
        "email" => $data["email"],
        "cart_id" => $cart["id"],
      ];
      
      $payload = array(
        'iss' => 'http://willberries-api/',
        'aud' => 'http://localhost:3000/',
        // 'iss' => 'https://willberries-api.herokuapp.com/',
        // 'aud' => 'https://willberries.herokuapp.com/',
        'iat' => $iat,
        'exp' => $exp,
        'user_data' => $user_data,
      );
      
      $jwt = JWT::encode($payload, $secret_key, 'HS512');

      $res = [
        "status" => true,
        "user_id" => $user_data["id"],
        "token" => $jwt,
        "expires" => $exp,
      ];   
      sendReply(200, $res);
    }
  }

  else {
    $res = [
      "status" => false,
      "message" => 'User with email '.$postData['email'].' was not found!',
    ];
    sendReply(404, $res);
  }
}

function logout() {
  if(isAuth()) {
    try {
      header_remove('Authorization');

      $res = [
        "status" => true,
        "message" => "You have been logged out.",
      ];
      
      sendReply(200, $res);
    }
    catch(Exception $ex) {
      $res = [
        "status" => false,
        "message" => $ex->getMessage(),
      ];
      sendReply(500, $res); // error 500 - internal server error
    }
  }
  else {
    $res = [
      "status" => false,
      "message" => "You are not logged in!",
    ];
      
    sendReply(401, $res);
  }

  die;
}

function isAuth() {
  $headers = getallheaders();
  $token = str_replace('Bearer ', '', $headers['Authorization']);
  return $token !== '';
}

function getUserData() {
  $headers = apache_request_headers();
  $jwt = str_replace('Bearer ', '', $headers['Authorization']);
  $secret_key = "authkey456";
  try {
    $decoded_data = JWT::decode($jwt, new Key($secret_key, 'HS512'));
  }
  catch(\Exception $e) {
    $res = [
      "status" => false,
      "message" => $e->getMessage(), ". You have been logged out.",
    ];
    logout();
    sendReply(401, $res);
  }
  return $decoded_data;
}