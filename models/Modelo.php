<?php
class Modelo extends Conectar{

    public function insert_modelo($mode_descripcion,$marc_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_modelo(
             mode_descripcion, mode_estado, marc_id)
            VALUES (?, '1', ?)";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $mode_descripcion);
        $sql->bindValue(2, $marc_id);
      
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }

    public function update_modelo($mode_id,$mode_descripcion,$marc_id)
    {
        $conx = parent::conexion();

        $sql = "UPDATE sc_residuos_solidos.tb_modelo
                SET 
                mode_descripcion=?,
                marc_id=?
              
        WHERE mode_id=?";

        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $mode_descripcion);
        $sql->bindValue(2, $marc_id);
        $sql->bindValue(3, $mode_id);
   
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }



     /* TODO LISTANDO MODELO DE MOVILIDAD */
    /* TODO LISTANDO MODELO DE MOVILIDAD */
    /* TODO LISTANDO MODELO DE MOVILIDAD */
    public function get_modelotabla()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        tb_modelo.mode_id,
    tb_modelo.mode_descripcion,
    tb_modelo.mode_estado,
    tb_marca.marc_descripcion
 FROM sc_residuos_solidos.tb_modelo
 inner join sc_residuos_solidos.tb_marca  on
     sc_residuos_solidos.tb_modelo.marc_id=sc_residuos_solidos.tb_marca.marc_id where tb_marca.marc_estado=1 and tb_modelo.mode_estado=1
ORDER BY mode_id DESC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


/* TODO COMBO DE LA MARCA DEL MODAL AdminModeloModal.php */
    public function combo_marca()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_marca where marc_estado=1
        ORDER BY marc_id ASC ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    
    public function get_modelo_id($mode_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_modelo where mode_id=? and mode_estado=1
        ORDER BY mode_id ASC ";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $mode_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_modelo($mode_id){
        $con=parent::conexion();
        parent::set_names();
        $sql="UPDATE sc_residuos_solidos.tb_modelo
            SET  
                mode_estado=0
            WHERE 
                mode_id=?";
            $sql=$con->prepare($sql);
            $sql->bindValue(1,$mode_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();

    }


}