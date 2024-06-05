<?php


class Area extends Conectar
{



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

}
