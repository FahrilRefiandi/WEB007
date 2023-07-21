<?php

use Config\Database;
use Config\Session;
use Controllers\CourseController;
use Validation\Validation;

require_once('layouts/template.php');

require_once(__DIR__ . "../../../config/config.php");
$id = $_GET['id'];
$data = Database::getFirst("
SELECT * FROM learning_materials
WHERE id = '$id';
");
var_dump($data);

?>