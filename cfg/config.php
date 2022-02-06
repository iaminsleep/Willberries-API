<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "api_willberries";

class DataBase
{
  /* variable (storing db connection) is static */
  private static $mysqli;

  /* constructor function is private (cannot be called) (final that cannot be overridden) */
  final private function __construct() {}

  /* function returning object is static as well (usually function getInstance as here) */
  public static function getInstance()
  {
    if (!is_object(self::$mysqli)) self::$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    return self::$mysqli;
  }

  /* destructor function __destruct is called by garbage collector and should finalize state */
  private function __destruct()
  {
    if (self::$mysqli) self::$mysqli->close();
  }

  /* cloning of singleton classes is not allowed so __clone() function must be empty */
  private function __clone() {}
}