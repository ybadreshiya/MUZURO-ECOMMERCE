<?php require_once('..\kresources\config.php'); ?>
<?php 
// Destroy the session and redirect
session_destroy();
set_message("You have been logged out successfully!");
redirect("index.php");
?>
