<?php
session_start();
$_SESSION = [];
session_unset();

echo '<script>window.location="../login.php"</script>';
