<?php
    require_once("../config/conexion.php");
    require_once("../models/ticket.php");
    $ticket = new Ticket();

    switch($_GET["options"]){
        case "insert":
            $ticket->insertTicket($_POST["user_id"],$_POST["categori_id"],$_POST["ticket_title"],$_POST["ticket_description"]);
        break;
        
        case "listByUser":
            $datos =  $ticket->listByUser($_POST["user_id"]);
            $data  = Array();
            
            foreach($datos as $row ){
                $sub_array = array();
                $sub_array[] = $row["ticket_id"];
                $sub_array[] = $row["categori_name"];
                $sub_array[] = $row["ticket_title"];
                if($row["ticket_status"]=='Nuevo'){

                    $sub_array[] = '<span class="label label-pill label-success">Nuevo</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">terminado</span>';
                }
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["date_create"]));
                $sub_array[] = '<button type="button" onClick="ver('.$row["ticket_id"].');"  id="'.$row["ticket_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

        break;

        case "list":
            $datos =  $ticket->list();
            $data  = Array();
            
            foreach($datos as $row ){
                $sub_array = array();
                $sub_array[] = $row["ticket_id"];
                $sub_array[] = $row["categori_name"];
                $sub_array[] = $row["ticket_title"];
                $sub_array[] = $row["ticket_description"];

                if($row["ticket_status"]=='Nuevo'){

                    $sub_array[] = '<span class="label label-pill label-success">Nuevo</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">terminado</span>';
                }

                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["date_create"]));
                $sub_array[] = '<button type="button" onClick="ver('.$row["ticket_id"].');"  id="'.$row["ticket_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

        break;

        case "listDetail":
                $datos = $ticket->listTicketDetailByTicket($_POST["ticket_id"]);
                ?>
                <?php
                    foreach($datos as $row){
                        ?>
                            <article class="activity-line-item box-typical">
                                <div class="activity-line-date">
                                    <?php echo date("d/m/Y", strtotime($row["date_create"]));?>
                                </div>
                                <header class="activity-line-item-header">
                                    <div class="activity-line-item-user">
                                        <div class="activity-line-item-user-photo">
                                            <a href="#">
                                                <img src="../../public/<?php echo $row['user_rol'] ?>.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="activity-line-item-user-name"><?php echo $row['user_name']?></div>
                                        <div class="activity-line-item-user-status">
                                            <?php 
                                                if ($row['user_rol']==1){
                                                    echo 'Usuario';
                                                }else{
                                                    echo 'Soporte';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </header>
                                <div class="activity-line-action-list">
                                    <section class="activity-line-action">
                                        <div class="time"><?php echo date("H:i:s", strtotime($row["date_create"]));?></div>
                                        <div class="cont">
                                            <div class="cont-in">
                                                <p>
                                                    <?php echo $row["ticket_description"];?>
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </article>
                        <?php
                    }
                ?>
            <?php
        break;

        case "mostrar";
            $datos=$ticket->listTicketById($_POST["ticket_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["ticket_id"] = $row["ticket_id"];
                    $output["user_id"] = $row["user_id"];
                    $output["categori_id"] = $row["categori_id"];

                    $output["ticket_title"] = $row["ticket_title"];
                    $output["ticket_description"] = $row["ticket_description"];

                    if ($row["ticket_status"]=="Nuevo"){
                        $output["ticket_status"] = '<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $output["ticket_status"] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }

                    // $output["tick_estado_texto"] = $row["tick_estado"];

                    $output["date_create"] = date("d/m/Y H:i:s", strtotime($row["date_create"]));
                    $output["user_name"] = $row["user_name"];
                    $output["categori_name"] = $row["categori_name"];
                }
                echo json_encode($output);
            }   
        break;

    }

?>