<?php

use Config\Session;

require_once(__DIR__."../../../config/config.php");
middleware(["auth","student"]);
var_dump(Session::auth());

?>