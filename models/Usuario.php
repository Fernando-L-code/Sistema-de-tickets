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
    }
?>