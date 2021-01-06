<?php 

//hide all error
error_reporting(0);
ini_set('display_errors', 0);

//show all error
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


$module = $_GET['module'];
$function = $_GET['function'];

//flag to give the response to the client
$response = array(
    "responseInfo" => array(
        "module" => $module,
        "function" => $function,
        "status" => null,
        "message" => null,
    ),
);


if($module == "firebase"){
     include './route/firebase_module.php';
}

?>