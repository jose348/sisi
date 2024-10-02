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

    /*TODO GUARDAMOS FORMULARIO  */
   

    public function insertar_mantenimiento(
        $fecha, $hora, $mecanico_id, $diagnostico, $accion, $esme_id, 
        $foto_vehiculo, $imagen_salida, $tickdo_id, $tercerizar, $empresa, $informe
    ) {
        $con = parent::conexion();
        parent::set_names();

        // Construimos la consulta SQL
        $sql = "INSERT INTO sc_residuos_solidos.tb_mantenimiento (
                    mant_fech, mant_hora, direct_id, mant_diagnostico_especializado, mant_accion_realizada, 
                    esme_id, mant_img_inicial, mant_img_final, tickdo_id, mant_empresa_terceriza, mant_informe_tercerizado, mant_estado
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $con->prepare($sql);

        // Estado por defecto "activo"
        $mant_estado = 'activo';

        // Asignamos null a la empresa e informe si no se tercerizó
        if ($tercerizar !== 'si') {
            $empresa = null;
            $informe = null;
        }

        // Asignamos los valores a la declaración
        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $hora);
        $stmt->bindParam(3, $mecanico_id);
        $stmt->bindParam(4, $diagnostico);
        $stmt->bindParam(5, $accion);
        $stmt->bindParam(6, $esme_id);
        $stmt->bindParam(7, $foto_vehiculo);         // Imagen inicial
        $stmt->bindParam(8, $imagen_salida);         // Imagen final
        $stmt->bindParam(9, $tickdo_id);             // ID del ticket
        $stmt->bindParam(10, $empresa);              // Empresa tercerizada (opcional)
        $stmt->bindParam(11, $informe, PDO::PARAM_LOB); // Informe en formato binario (opcional)
        $stmt->bindParam(12, $mant_estado);          // Estado del mantenimiento ("activo")

        // Ejecutar la consulta
        return $stmt->execute();
    }
    
    
}