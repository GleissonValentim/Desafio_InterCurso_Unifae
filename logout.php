<?php
    session_start();
    unset($_SESSION['usuario']);

    header('location: index.php?status=success');