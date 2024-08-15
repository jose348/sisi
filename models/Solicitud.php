<?php
class Solicitud extends Conectar
{
    public function detalle_soli_x_id($deso_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT      				
        tb_detalle_solicitud.deso_id,
        tb_solicitud_repuesto.sore_id,
        tb_solicitud_repuesto.sore_titulo, 
        tb_repuesto.repu_id,
        tb_solicitud_repuesto.sore_estado,
        tb_repuesto.repu_descripcion,
        tb_solicitud_repuesto.sore_fecha,  
        tb_detalle_solicitud.deso_cantidad,
       tb_detalle_solicitud.deso_estado
from        sc_residuos_solidos.tb_detalle_solicitud
inner join  sc_residuos_solidos.tb_repuesto 
on          sc_residuos_solidos.tb_detalle_solicitud.repu_id=
        sc_residuos_solidos.tb_repuesto.repu_id
inner join  sc_residuos_solidos.tb_solicitud_repuesto 
on          sc_residuos_solidos.tb_detalle_solicitud.sore_id=
        sc_residuos_solidos.tb_solicitud_repuesto.sore_id where deso_id=?
order by    deso_id desc";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $deso_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_repuesto()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT tb_repuesto.repu_id,
        tb_repuesto.repu_codigo, tb_repuesto.repu_descripcion,
        tb_repuesto.repu_stock,tb_repuesto.repu_estado
	FROM sc_residuos_solidos.tb_repuesto where repu_estado=1
ORDER BY repu_id desc";
        $sql = $conectar->prepare($sql);


        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function rechazarSolicitud($deso_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE sc_residuos_solidos.tb_detalle_solicitud
	SET deso_estado=0
	WHERE deso_id=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $deso_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
