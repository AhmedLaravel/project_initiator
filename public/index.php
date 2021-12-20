<?php 
//show All Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//Include initiators
require_once __DIR__ . "/../src/Support/helpers.php";
require_once base_path() . "/vendor/autoload.php";
require_once base_path() . "/routes/web.php";
app()->run();
load_env();

?>