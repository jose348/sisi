<?php
class Usuario extends Conectar{

public function Login(){
    $conectar=parent::Conexion();
    parent::set_names();
    if(isset($_POST["enviar"])){
        $dni=$_POST["dni"];
        $pass=$_POST["pass"];
        if(empty($dni) and empty($pass)  ){
            header("Location:".conectar::ruta()."index.php?m=2");
            exit();
        }else{
            $sql="SELECT * FROM tm_usuario WHERE usu_dni=? AND usu_pass=? AND usu_estado=1";
            $stmt = $conectar->prepare($sql);
            $stmt -> bindValue(1,$dni);
            $stmt -> bindValue(2,$pass);
            $stmt->execute();
            $resultado = $stmt->fetch();
             
            if(is_array($resultado) and count($resultado) >0){
                $_SESSION["usu_id"]=$resultado["usu_id"];
                $_SESSION["usu_nom"]=$resultado["usu_nom"];
                $_SESSION["usu_apep"]=$resultado["usu_apep"];
                $_SESSION["usu_apem"]=$resultado["usu_apem"];
                $_SESSION["usu_rol"]=$resultado["usu_rol"];
                
                header("Location:".Conectar::ruta()."view/Home/home.php");

            }else{
                header("Location:".Conectar::ruta()."index.php?m=1");
                exit();
            }
        
        }
    }
}

}
?>