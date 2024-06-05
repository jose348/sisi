<?php
class Marca extends Conectar{

    
    public function insert_marca($marc_descripcion)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_marca( marc_descripcion, marc_estado)  VALUES (?, '1')";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1,  $marc_descripcion);
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }


    public function update_marca($marc_id, $marc_descripcion)
    {
        $conx = parent::conexion();
        $sql = "UPDATE sc_residuos_solidos.tb_marca
                SET                 
                marc_descripcion=?
                WHERE 
                marc_id=?";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $marc_descripcion);
        $sql->bindValue(2, $marc_id);
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }




   /*  TODO ELIMINAR MARCA  */
    public function delete_marca($marc_id){
        $con=parent::conexion();
        parent::set_names();
        $sql="UPDATE sc_residuos_solidos.tb_marca
        SET
            marc_estado = 0
        WHERE
            marc_id = ?";
        $sql=$con->prepare($sql);
        $sql->bindValue(1,$marc_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();

    }

/* TODO PARA MI COMBO DE MI MODAL adminMarcaModal.js */
    public function get_marca_modal(){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM sc_residuos_solidos.tb_marca WHERE marc_estado=1
        ORDER BY marc_id DESC";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }


    public function get_marca_id($marc_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM sc_residuos_solidos.tb_marca WHERE marc_estado=1 and marc_id=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $marc_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }


    /* TODO LISTANDO MARCA DE MOVILIDAD */
    /* TODO LISTANDO MARCA DE MOVILIDAD */
    /* TODO LISTANDO MARCA DE MOVILIDAD */
    public function get_marcalist()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = " SELECT * FROM sc_residuos_solidos.tb_marca where marc_estado=1
    ORDER BY marc_id DESC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


}



?>