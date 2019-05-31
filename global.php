<?php
if(!session_id()) session_start();
$Username = "Hello";
if(!isset($_SESSION['filename'])) {
    $_SESSION['filename'] = $Username;
}
?>