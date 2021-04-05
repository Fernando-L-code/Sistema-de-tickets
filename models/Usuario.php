<?php 

    class Usuario extends Connect{
        public function login(){
            $connect= parent::Conexion();
            parent::set_names();

            if(isset($_POST["enviar"])){
                $email = $_POST["user_email"];
                $password = $_POST["user_password"];
                // $rol = $_POST["user_rol"];
                if (empty($email) and empty($password)) {
                    header("Location:".connect::ruta()."index.php?m=2");
                }else{
                    $sql = "SELECT * FROM tm_usuario WHERE user_email=? and user_password = ? and user_rol  and status = 1";
                    $stmt = $connect->prepare($sql);
                    $stmt -> bindValue(1,$email);
                    $stmt -> bindValue(2,$password);
                    // $stmt -> bindValue(3,$rol);
                    $stmt -> execute();
                    $result = $stmt->fetch();
                    echo $result;
                    if (is_array($result) and count($result)>0) {
                        $_SESSION["user_id"]=$result["user_id"];
                        $_SESSION["user_name"]=$result["user_name"];
                        $_SESSION["user_email"]=$result["user_email"];
                        $_SESSION["user_rol"]=$result["user_rol"];
                        header("Location:".connect::ruta()."view/Home");
                    } else {
                        header("Location:".connect::ruta()."index.php?m=1");
                    }
                    
                }
                
            }
        }

        public function insert_user($user_name, $user_email, $user_password, $user_rol ){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "INSERT INTO tm_usuario (user_id, user_name, user_email, user_password, user_rol, date_create, date_update, date_delete, status) 
                    VALUES (NULL,?,?,?,?, now(), NULL, NULL, '1');";
            $sql = $connect->prepare($sql);
            $sql->bindValue(1, $user_name);
            $sql->bindValue(2, $user_email);
            $sql->bindValue(3, $user_password);
            $sql->bindValue(4, $user_rol);

            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_user($user_id,$user_name, $user_email, $user_password, $user_rol ){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "UPDATE tm_usuario 
                    SET 
                    user_name = ?, 
                    user_email = ?,
                    user_password = ?, 
                    user_rol = ?
                    WHERE tm_usuario.user_id = ?;";
            $sql = $connect->prepare($sql);
            $sql->bindValue(1, $user_name);
            $sql->bindValue(2, $user_email);
            $sql->bindValue(3, $user_password);
            $sql->bindValue(4, $user_rol);
            $sql->bindValue(5, $user_id);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function delete_user($user_id){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "UPDATE  tm_usuario 
            SET 
                status='0', 
                date_delete=now() 
                WHERE 
            user_id=?;";
            $sql = $connect->prepare($sql);
            $sql->bindValue(1, $user_id);

            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_user(){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "SELECT * FROM  tm_usuario  where status=1 ;";
            $sql = $connect->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_userById($user_id){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "SELECT * FROM  tm_usuario  where user_id=? ;";
            $sql = $connect->prepare($sql);
            $sql->bindValue(1, $user_id);

            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_userById_count($user_id){
            $connect = parent::Conexion();
            parent::set_names();

            $sql = "SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE user_id =1;";
            $sql = $connect->prepare($sql);
            $sql->bindValue(1, $user_id);

            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

    }
?>