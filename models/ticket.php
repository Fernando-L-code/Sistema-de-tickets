<?php

class Ticket extends Connect
{

    public function insertTicket($user_id, $categori_id, $ticket_title, $ticket_description)
    {
        $connect = parent::Conexion();
        parent::set_names();

        $sql = "INSERT INTO tm_ticket (ticket_id, user_id, categori_id, ticket_title, ticket_description, ticket_status,date_create, status) 
        VALUES (NULL, ?, ?, ?, ?,Nuevo, now(), '1');";
        $sql = $connect->prepare($sql);
        $sql->bindValue(1, $user_id);
        $sql->bindValue(2, $categori_id);
        $sql->bindValue(3, $ticket_title);
        $sql->bindValue(4, $ticket_description);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listByUser($user_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
            tm_ticket.ticket_id, 
            tm_ticket.user_id, 
            tm_ticket.categori_id, 
            tm_ticket.ticket_title, 
            tm_ticket.ticket_description,
            tm_ticket.ticket_status,
            tm_ticket.date_create, 
            tm_ticket.status, 
            tm_usuario.user_name, 
            tm_categoria.categori_name
        FROM tm_ticket 
        INNER join tm_categoria on tm_ticket.categori_id = tm_categoria.categori_id 
        INNER join tm_usuario on tm_ticket.user_id = tm_usuario.user_id
        WHERE tm_ticket.status = 1 
        AND tm_usuario.user_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function list()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
            tm_ticket.ticket_id, 
            tm_ticket.user_id, 
            tm_ticket.categori_id, 
            tm_ticket.ticket_title, 
            tm_ticket.ticket_description,
            tm_ticket.ticket_status,
            tm_ticket.date_create, 
            tm_ticket.status, 
            tm_usuario.user_name, 
            tm_categoria.categori_name
        FROM tm_ticket 
        INNER join tm_categoria on tm_ticket.categori_id = tm_categoria.categori_id 
        INNER join tm_usuario on tm_ticket.user_id = tm_usuario.user_id
        WHERE tm_ticket.status = 1 ";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listTicketDetailByTicket($ticket_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
        td_ticketdetalle.detail_id,
        td_ticketdetalle.ticket_id,
        td_ticketdetalle.ticket_description,
        td_ticketdetalle.date_create,
        tm_usuario.user_name,
        tm_usuario.user_rol
        FROM 
        td_ticketdetalle
        INNER join tm_usuario on td_ticketdetalle.user_id = tm_usuario.user_id
        WHERE 
        ticket_id =?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ticket_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listTicketById($ticket_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            tm_ticket.ticket_id ,
            tm_ticket.user_id, 
            tm_ticket.categori_id, 
            tm_ticket.ticket_title, 
            tm_ticket.ticket_description, 
            tm_ticket.ticket_status, 
            tm_ticket.date_create, 
            tm_usuario.user_name, 
            tm_categoria.categori_name 
            FROM tm_ticket 
            INNER join tm_categoria on tm_ticket.categori_id = tm_categoria.categori_id 
            INNER join tm_usuario on tm_ticket.user_id = tm_usuario.user_id 
            WHERE tm_ticket.status = 1 
            AND tm_ticket.ticket_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $ticket_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}
