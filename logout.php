<?php
session_start();

session_unset();

session_destroy();
echo"<script>alert('logout sucessfully');</script>";
echo"<script> window.location.assign('login.php');</script>";




?>