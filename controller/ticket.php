<?php
    require_once("../config/conexion.php");
    require_once("../models/ticket.php");
    $ticket = new Ticket();

    switch($_GET["options"]){
        case "insert":
            $ticket->insertTicket($_POST["user_id"],$_POST["categori_id"],$_POST["ticket_title"],$_POST["ticket_description"]);
        break;
        
        case "listByUser":
            $datos =  $ticket->listarByUser($_POST["user_id"]);
            $data  = Array();
            
            foreach($datos as $row ){
                $sub_array = array();
                $sub_array[] = $row["ticket_id"];
                $sub_array[] = $row["categori_name"];
                $sub_array[] = $row["ticket_title"];
                $sub_array[] = '<button type="button" onClick="ver('.$row["ticket_id"].');"  id="'.$row["ticket_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["date_create"]));
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

        break;

    }

?>