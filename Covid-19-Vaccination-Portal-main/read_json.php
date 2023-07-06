<?php
error_reporting(E_ERROR | E_PARSE);
/*if (!defined('browsable')) {
    header("location:javascript://history.go(-1)");
}*/

$str = file_get_contents('local.json');
$json = json_decode($str, true); // decode the JSON into an associative array
?>

<html lang="en">
<?php
echo '<pre>' . print_r($json, true) . '</pre>';
?>

</html>