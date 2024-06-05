<?php
class Color extends Conectar{

    public function insert_color($colo_descripcion){
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_color(
            colo_descripcion, colo_estado)
           VALUES (?, 1);";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $colo_descripcion);
       
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }


    public function update_color($colo_id, $colo_descripcion){
        $conx = parent::conexion();
        $sql = "UPDATE sc_residuos_solidos.tb_color
                SET 
                colo_descripcion=?
                WHERE 
                colo_id=?";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $colo_descripcion);
        $sql->bindValue(2, $colo_id);
        
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }






        
/* TODO LISTANDO COLORES DE MOVILIDAD */
    /* TODO LISTANDO COLORES DE MOVILIDAD */
    /* TODO LISTANDO COLORES DE MOVILIDAD */
    public function get_colorestabla()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_color WHERE colo_estado=1
        ORDER BY colo_id DESC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_color($colo_id)
    {
        $cnx = parent::conexion();
        parent::set_names();
        $sql = "UPDATE sc_residuos_solidos.tb_color
        SET 
         colo_estado=0
        WHERE 
          colo_id=?";
        $sql = $cnx->prepare($sql);
        $sql->bindValue(1, $colo_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_color_id($colo_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM sc_residuos_solidos.tb_color WHERE colo_estado= 1 AND colo_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $colo_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }


}

?>
