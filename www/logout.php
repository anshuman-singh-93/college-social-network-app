<?php
require_once"functions.php";
session_start();
if (isset($_SESSION['user_name'])||isset($_COOKIE['user_name']))
{
destroySession();
}
?>