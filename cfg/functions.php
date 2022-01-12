<?php

require 'config.php';

function getGoods($db) {
  $posts = mysqli_query($db, "SELECT * FROM `goods`");

  $postsList = [];

  while($post = mysqli_fetch_assoc($posts)) {
    $postsList[] = $post;
  }

  echo json_encode($postsList); /* Данные переводятся в JSON формат */
}

function getGood($db, $id) {
  $post = mysqli_query($db, "SELECT * FROM `goods` WHERE `id` = '$id'");
  $post = mysqli_fetch_assoc($post); /* Преобразование в обычный ассоциативный массив */
  
  echo json_encode($post);
}