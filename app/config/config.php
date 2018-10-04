<?php
session_start();
if((!isset($_SESSION) == true) || empty($_SESSION))
{
  unset($_SESSION);
  header('Location: ../login/');
}
?>