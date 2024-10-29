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
   
  
    // Método para insertar los datos del mantenimiento
    public function insertar_mantenimiento(
        $inun_id, $esme_id, $sore_id, $foto_vehiculo, $fecha, $hora,
        $mecanico_id, $diagnostico, $accion, $tercerizar, $empresa,
        $informe, $imagen_salida, $fecha_salida, $hora_salida
    ) {
        $con = parent::conexion();
        parent::set_names();
    
        try {
            $con->beginTransaction();
    
            $sql = "INSERT INTO sc_residuos_solidos.tb_mantenimiento (
                        inun_id, esme_id, sore_id, mant_img_inicial, 
                        mant_fech, mant_hora, direct_id, 
                        mant_diagnostico_especializado, mant_accion_realizada, 
                        mant_empresa_terceriza, mant_informe_tercerizado, 
                        mant_img_final, mant_fecha_salida, mant_hora_salida, mant_estado
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            $stmt = $con->prepare($sql);
    
            if ($tercerizar !== 'si') {
                $empresa = null;
                $informe = null;
            }
    
            $mant_estado = 'activo';
    
            $stmt->execute([
                $inun_id, $esme_id, $sore_id, $foto_vehiculo, $fecha, $hora,
                $mecanico_id, $diagnostico, $accion, $empresa, $informe,
                $imagen_salida, $fecha_salida, $hora_salida, $mant_estado
            ]);
    
            $con->commit();
            return true;
        } catch (Exception $e) {
            $con->rollBack();
            throw new Exception("Error al guardar mantenimiento: " . $e->getMessage());
        }
    }
    
    
    



    /*TODO LISTAR MI MODAL */

      // Método para listar los ingresos de vehículos
      public function listar_ingresos() {
        $conectar = parent::conexion();
        $sql = "SELECT (u.unid_placa ||'  '|| tu.tiun_descripcion ||'  '|| m.mode_descripcion||'  '|| ma.marc_descripcion )as Vehiculo ,
                       (i.inun_fecha) as FechadeIngreso, 
                        i.inun_hora as HoradeIngreso,
                       i.inun_id
                FROM sc_residuos_solidos.tb_ingreso_unidad i
                LEFT JOIN sc_residuos_solidos.tb_unidad u ON i.unid_id = u.unid_id
                LEFT JOIN sc_residuos_solidos.tb_tipo_unidad tu ON u.tiun_id = tu.tiun_id
                LEFT JOIN sc_residuos_solidos.tb_modelo m ON u.mode_id = m.mode_id
                LEFT JOIN sc_residuos_solidos.tb_marca ma ON m.marc_id = ma.marc_id
                LEFT JOIN sc_residuos_solidos.tb_programacion_mantenimiento pm ON i.prma_id = pm.prma_id
                LEFT JOIN sc_residuos_solidos.tb_ticket_dotacion t ON i.inun_id = t.inun_id
                LEFT JOIN sc_residuos_solidos.tb_mantenimiento tm ON i.inun_id = tm.inun_id
                ORDER BY i.inun_fecha desc ";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


/* TODO LISTADO DE REPUESTO DE ALMACEN  */
    public function listar_respuesto()
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "SELECT tb_repuesto.repu_id,
                        tb_repuesto.repu_codigo,
	                    tb_repuesto.repu_descripcion,
	                    tb_repuesto.alma_id,
	                    
	                    tb_repuesto.repu_stock,
	                    tb_repuesto.repu_stock_total,
	                    tb_repuesto.repu_ultimo_ingreso,
	                    tb_repuesto.repu_situacion,
                        tb_repuesto.unme_id
	            FROM sc_residuos_solidos.tb_repuesto where repu_estado=1
                ORDER BY repu_id desc";
        $sql = $conx->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function fetch_correlativo() {
        $conectar = parent::conexion();
        $sql = "SELECT MAX(sore_id) as max_id FROM sc_residuos_solidos.tb_solicitud_repuesto";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verifica si se obtuvo algún resultado
        if ($result && isset($result['max_id'])) {
            // Retorna el siguiente correlativo
            return $result['max_id'] + 1;
        } else {
            // Si no hay registros, retorna 1 como primer correlativo
            return 1;
        }
    }
    
    public function combolistarRepuestos() {
        $conectar = parent::conexion();
        $sql = "SELECT repu_id, repu_descripcion FROM sc_residuos_solidos.tb_repuesto WHERE repu_estado = 1";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }






    public function insertarSolicitud($sore_fecha, $sore_titulo, $repu_id, $sore_cantidad, $sore_estado = 1) {
        try {
            $conectar = parent::conexion();
            $sql = "INSERT INTO sc_residuos_solidos.tb_solicitud_repuesto 
                    (sore_fecha, sore_titulo, repu_id, sore_cantidad, sore_estado) 
                    VALUES (?, ?, ?, ?, ?)";
                    
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $sore_fecha);
            $stmt->bindParam(2, $sore_titulo);
            $stmt->bindParam(3, $repu_id);
            $stmt->bindParam(4, $sore_cantidad);
            $stmt->bindParam(5, $sore_estado);
            $stmt->execute();
        
            // Retornar el ID de la solicitud recién creada
            return $conectar->lastInsertId();
        } catch (Exception $e) {
            // Lanzar una excepción si hay un error en la consulta
            throw new Exception("Error al insertar la solicitud: " . $e->getMessage());
        }
    }
    
    
    
    
    

}