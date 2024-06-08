<?php


class Area extends Conectar
{

    public function insert_area($depe_codigo, $depe_denominacion, $depe_abreviatura, $depe_siglasdoc, $depe_representante, $depe_cargo, $depe_direccion, $depe_telefono, $depe_anexo, $depe_codrof, $depe_superior, $nior_id, $tpor_id, $tpde_id, $lomu_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO public.tb_dependencia(
         depe_codigo, depe_denominacion, depe_abreviatura, depe_siglasdoc, depe_representante, depe_cargo, depe_direccion, depe_telefono, depe_anexo, depe_codrof, depe_superior, depe_estado, nior_id, tpor_id, tpde_id, lomu_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'A', ?, ?, ?, ?);";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $depe_codigo);
        $sql->bindValue(2, $depe_denominacion);
        $sql->bindValue(3, $depe_abreviatura);
        $sql->bindValue(4, $depe_siglasdoc);
        $sql->bindValue(5, $depe_representante);
        $sql->bindValue(6, $depe_cargo);
        $sql->bindValue(7, $depe_direccion);
        $sql->bindValue(8, $depe_telefono);
        $sql->bindValue(9, $depe_anexo);
        $sql->bindValue(10, $depe_codrof);
        $sql->bindValue(11, $depe_superior);
        $sql->bindValue(12, $nior_id);
        $sql->bindValue(13, $tpor_id);
        $sql->bindValue(14, $tpde_id);
        $sql->bindValue(15, $lomu_id);
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }

    public function update_area($depe_id,$depe_codigo, $depe_denominacion, $depe_abreviatura, $depe_siglasdoc, $depe_representante, $depe_cargo, $depe_direccion, $depe_telefono, $depe_anexo, $depe_codrof, $depe_superior, $nior_id, $tpor_id, $tpde_id, $lomu_id)
    {
        $conx = parent::conexion();

        $sql = "UPDATE public.tb_dependencia
                SET 
                 depe_codigo=?,
                 depe_denominacion=?, 
                 depe_abreviatura=?, 
                 depe_siglasdoc=?, 
                 depe_representante=?, 
                 depe_cargo=?, 
                 depe_direccion=?, 
                 depe_telefono=?, 
                 depe_anexo=?, 
                 depe_codrof=?, 
                 depe_superior=?,
                 nior_id=?, 
                 tpor_id=?, 
                 tpde_id=?, 
                 lomu_id=?
        WHERE depe_id=?";

        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $depe_codigo);
        $sql->bindValue(2, $depe_denominacion);
        $sql->bindValue(3, $depe_abreviatura);
        $sql->bindValue(4, $depe_siglasdoc);
        $sql->bindValue(5, $depe_representante);
        $sql->bindValue(6, $depe_cargo);
        $sql->bindValue(7, $depe_direccion);
        $sql->bindValue(8, $depe_telefono);
        $sql->bindValue(9, $depe_anexo);
        $sql->bindValue(10, $depe_codrof);
        $sql->bindValue(11, $depe_superior);
        $sql->bindValue(12, $nior_id);
        $sql->bindValue(13, $tpor_id);
        $sql->bindValue(14, $tpde_id);
        $sql->bindValue(15, $lomu_id);
        $sql->bindValue(16, $depe_id);
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }


    public function delete_area($depe_id)
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tb_dependencia
    SET
        depe_estado = 'I'
    WHERE
        depe_id = ?";
        $sql = $con->prepare($sql);
        $sql->bindValue(1, $depe_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    /* TODO LISTANDO AREAS */
    /* TODO LISTANDO AREAS */
    /* TODO LISTANDO AREAS */
    /* TODO LISTANDO AREAS */
    public function get_areaLista()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM public.tb_dependencia where depe_estado='A'
        ORDER BY depe_id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }



    /* TODO llammos a los combox de mi modal */
    public function combo_unidad()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_escalafon.tb_tipo_dependencia where tpde_estado='A'
        ORDER BY tpde_id ASC ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_nivel_organizacional()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_escalafon.tb_nivel_organizacional where nior_estado='A'
        ORDER BY nior_id ASC ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function combo_organo()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_escalafon.tb_tipo_organo where tpor_estado='A'
        ORDER BY tpor_id ASC ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function comobo_local_municipal()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_escalafon.tb_local_municipal where lomu_estado='A'
        ORDER BY lomu_id ASC ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    /* TODO MOSTRAR EN EL MODAL */
    public function get_area_id($depe_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM public.tb_dependencia where depe_estado='A' and depe_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $depe_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
