<?php
class Tipo extends Conectar{

    public function insert_tipo($tiun_descripcion,$tiun_codigo){
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_tipo_unidad( tiun_descripcion, tiun_estado,tiun_codigo,tiun_correlativo)  VALUES (?, '1',?,'1')";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1,  $tiun_descripcion);
        $sql->bindValue(2,  $tiun_codigo);
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }


    public function update_tipo($tiun_id, $tiun_descripcion,$tiun_codigo)
    {
        $conx = parent::conexion();
        $sql = "UPDATE sc_residuos_solidos.tb_tipo_unidad
                SET                 
                tiun_descripcion=?,
                tiun_codigo=?
                WHERE 
                tiun_id=?";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $tiun_descripcion);
        $sql->bindValue(2, $tiun_codigo);
        $sql->bindValue(3, $tiun_id);
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }
    public function get_tipo_id($tiun_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM sc_residuos_solidos.tb_tipo_unidad WHERE tiun_estado=1 and tiun_id=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $tiun_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }





    /* TODO LISTANDO TIPO MOVILIDAD */
    /* TODO LISTANDO TIPO MOVILIDAD */
    /* TODO LISTANDO TIPO MOVILIDAD */
    public function get_tipoLista(){
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_tipo_unidad WHERE tiun_estado=1
        ORDER BY tiun_id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function delete_tipo($tiun_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE sc_residuos_solidos.tb_tipo_unidad
            SET
                tiun_estado = 0
            WHERE
                tiun_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $tiun_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
}   

}
?>  