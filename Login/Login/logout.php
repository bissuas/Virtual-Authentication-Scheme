<?php
    include_once("includes/application_start.php");
    session_destroy();
    redirect("login.php");
?>