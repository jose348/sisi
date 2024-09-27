<?php

class Mecanico  extends Conectar
{

    public function combo_motivo_de_mantenimiento()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_especialidad_mecanica where esme_estado=1 ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    // Función para buscar ticketclass Mecanico extends Conectar {
    // Función para buscar ticket
    public function buscar_ticket($ticketNumber)
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "SELECT td.tickdo_numtick, td.tickdo_fecha, td.tickdo_hora, td.tickdo_cantidad, 
                       td.tickdo_estado, -- Incluimos el estado del ticket
                       tu.tiun_descripcion || ' - ' || mo.mode_descripcion || ' - ' || n.unid_placa || ' - ' || n.unid_motor AS unidad
                FROM sc_residuos_solidos.tb_ticket_dotacion td
                JOIN sc_residuos_solidos.tb_ingreso_unidad iu ON td.inun_id = iu.inun_id
                JOIN sc_residuos_solidos.tb_unidad n ON iu.unid_id = n.unid_id
                JOIN sc_residuos_solidos.tb_tipo_unidad tu ON n.tiun_id = tu.tiun_id
                JOIN sc_residuos_solidos.tb_modelo mo ON n.mode_id = mo.mode_id
                WHERE td.tickdo_numtick = ?";

        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $ticketNumber);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function actualizar_estado_ticket($ticketNumber, $nuevo_estado)
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "UPDATE sc_residuos_solidos.tb_ticket_dotacion 
                SET tickdo_estado = ?
                WHERE tickdo_numtick = ?";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $nuevo_estado);
        $stmt->bindValue(2, $ticketNumber);

        return $stmt->execute();
    }



    // Función para obtener los mecánicos
    public function combo_mecanicos()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT d.direct_id, p.pers_nombre || ' ' || p.pers_apelpat || ' ' || p.pers_apelmat AS mecanico
            FROM sc_residuos_solidos.tb_directorio d
            JOIN sc_escalafon.tb_persona p ON d.pers_id = p.pers_id
            WHERE d.direct_estado = 1
            AND d.func_id NOT IN (2, 3, 4, 5, 6) 
            ORDER BY d.direct_id ASC"; // Filtramos solo mecánicos activos

        $sql = $con->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
