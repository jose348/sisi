<?php
class Solicitud extends Conectar
{
        public function detalle_soli_x_id($sore_id)
        {
                $conectar = parent::conexion();
                parent::set_names();
                $sql = " SELECT tb_solicitud_repuesto.sore_id,
               tb_repuesto.repu_id,
               tb_solicitud_repuesto.sore_estado,
               tb_solicitud_repuesto.sore_titulo,
               tb_solicitud_repuesto.sore_cantidad,
               tb_repuesto.repu_descripcion,
               tb_solicitud_repuesto.sore_fecha
        FROM sc_residuos_solidos.tb_solicitud_repuesto
        INNER JOIN sc_residuos_solidos.tb_repuesto
        ON sc_residuos_solidos.tb_solicitud_repuesto.repu_id = sc_residuos_solidos.tb_repuesto.repu_id
        WHERE sore_id=?";
                $sql = $conectar->prepare($sql);

                $sql->bindValue(1, $sore_id);
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


        public function rechazarSolicitud($sore_id)
        {
                $conectar = parent::conexion();
                parent::set_names();
                $sql = "UPDATE sc_residuos_solidos.tb_solicitud_repuesto
	SET sore_estado=0
	WHERE sore_id=?";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $sore_id);
                $sql->execute();
                return $resultado = $sql->fetchAll();
        }
}
