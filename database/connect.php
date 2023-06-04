<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "fresh_portal";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags)
    {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
};

try {
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
    if($conn){
        console_log("You are connected to the database running at: $db_server");
    };
} catch (mysqli_sql_exception $e) {
    echo "Could not connect to Database! Error: " . $e->getMessage();
}
