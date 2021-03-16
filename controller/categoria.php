<?php
    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    $categoria = new Categoria();

    switch($_GET["options"]){
        case "combo":
            $datos = $categoria->get_categoria();
            if(is_array($datos)==true and count($datos)>0){
                // $html = "<option></option>";
                foreach($datos as $row){
                    $html.="<option value='".$row['categori_id']."'>". $row['categori_name'] ."</option>";
                }
                echo $html;
            }
            
        break;
    }

?>