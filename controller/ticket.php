<?php
    require_once("../config/conexion.php");
    require_once("../models/ticket.php");
    $ticket = new Ticket();

    switch($_GET["options"]){
        case "insert":
            $ticket->insertTicket($_POST["user_id"],$_POST["categori_id"],$_POST["ticket_title"],$_POST["ticket_description"]);
            
            
        break;
    }

?>