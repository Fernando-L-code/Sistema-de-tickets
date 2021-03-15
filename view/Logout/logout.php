<?php
    require_once('../../config/conexion.php');
    session_destroy();
    header("Location:".connect::ruta()."index.php?m=2");
    exit();
?>