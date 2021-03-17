<?php 

    class Ticket extends Connect{

        public function insertTicket($user_id,$categori_id,$ticket_title,$ticket_description){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "INSERT INTO tm_ticket (ticket_id, user_id, categori_id, ticket_title, ticket_description, status) VALUES (NULL, ?, ?, ?, ?, '1');";
            $sql = $connect->prepare($sql);
            $sql -> bindValue(1,$user_id);
            $sql -> bindValue(2,$categori_id);
            $sql -> bindValue(3,$ticket_title);
            $sql -> bindValue(4,$ticket_description);

            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>
