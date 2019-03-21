<!DOCTYPE html>
<html>
<head>
<title>Caddy Web Server with PHP running on Alpine Linux.</title>
<style>
body { text-align: center; font-family:Tahoma, Geneva, Verdana, sans-serif; }
</style>
</head>
<body>
<h1>Caddy Web Server with PHP running on Alpine Linux.</h1>
<p>If you see this page, Caddy Web Server with PHP running on Alpine Linux in a Docker container works.</p>
<p>More instructions about Caddy is <a href="//caddyserver.com/docs" target="_blank">here</a>.<p>
<?php
    phpinfo()
?>
</body>
</html>
