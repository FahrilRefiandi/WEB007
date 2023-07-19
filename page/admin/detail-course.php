<?php
require_once(__DIR__ . "../../../config/config.php");
$id = $_GET['id'];
$data=getFirst("SELECT * FROM course WHERE id='$id'");
var_dump($data);

?>