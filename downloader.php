<?php
if (!array_key_exists('url', $_GET) or !array_key_exists('name', $_GET)) {
    echo 'plase input name and url';
    die();
}
$url = $_GET['url'];
$url = rawurldecode($url);
$name = $_GET['name'];
$name = rawurldecode($name);
$str = file_get_contents($url);
$fileName = __DIR__ . '/' . $name;
$myFile = fopen($fileName, 'w+');
fwrite($myFile, $str);
fclose($myFile);
echo 'success! this file url you can copy :' . '<br \><br \>';
$uri = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/'), 1) . $name;
echo $uri . '<br \>';
echo '<br \>or<br \> <br \> click :<a target="_blank" href="' . $uri . '">go it\'s</a>';