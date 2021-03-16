<?php 

    class Categoria extends Connect{

        public function get_categoria(){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "SELECT * FROM tm_categoria WHERE status=1";
            $sql = $connect->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>
