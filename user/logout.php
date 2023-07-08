<?php
    session_start();
    // session_destroy();
    unset($_SESSION["auth_user"]);
    echo'<script>window.location=history.back()</script>';

    // header("location:index.php");
?>