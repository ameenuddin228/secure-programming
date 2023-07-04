<?php
session_start();
session_destroy();
$_SESSION = array();
session_regenerate_id(true);
header('location: index.php');
exit();
?>