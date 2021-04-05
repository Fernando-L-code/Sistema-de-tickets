<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $user = new Usuario();

    switch($_GET["options"]){
        case "saveEdit":
            if(empty($_POST["user_id"])){
                    $user->insert_user($_POST["user_name"],$_POST["user_email"],$_POST["user_password"],$_POST["user_rol"]);
            }else{
                     $user->update_user($_POST["user_id"],$_POST["user_name"],$_POST["user_email"],$_POST["user_password"],$_POST["user_rol"]);
            }
            
        break;

        case "list":
            $datos =  $user->get_user();
            $data  = Array();
            
            foreach($datos as $row ){
                $sub_array = array();
                $sub_array[] = $row["user_name"];
                $sub_array[] = $row["user_email"];
                $sub_array[] = $row["user_password"];
                // $sub_array[] = $row["user_rol"];
                if ($row["user_rol"]==1){
                    $sub_array[] = '<span class="label label-pill label-primary">Usuario</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
                }
                $sub_array[] = '<button type="button" onClick="editar('.$row["user_id"].');"  id="'.$row["user_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["user_id"].');"  id="'.$row["user_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

        break;

        case "delete":
            $user->delete_user($_POST["user_id"]);
        break;

        case "show";
        $datos=$user->get_userById($_POST["user_id"]);  
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row)
            {
                $output["user_id"] = $row["user_id"];
                $output["user_name"] = $row["user_name"];

                $output["user_email"] = $row["user_email"];
                $output["user_password"] = $row["user_password"];
                $output["user_rol"] = $row["user_rol"];

                // $output["date_create"] = date("d/m/Y H:i:s", strtotime($row["date_create"]));
            }
            echo json_encode($output);
        }   
    break;

    }

?>