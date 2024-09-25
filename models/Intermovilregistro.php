<?php

class Intermovilregistro  extends Conectar
{
    public function insert_movil($unid_anio, $unid_placa, $unid_motor, $unid_adquisicion, $unid_observacion, $tiun_id, $area_id, $mode_id, $unid_codigo, $colo_id, $comb_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_unidad(
	                unid_anio, unid_placa, unid_motor, unid_adquisicion, unid_observacion, tiun_id, area_id, mode_id,
                    unid_estado, unid_codigo, unid_operatividad, colo_id,comb_id)
	                VALUES (?, ?, ?, ?, ?, ?, ?, ?, '1', ?, '1', ?, ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $unid_anio);
        $sql->bindValue(2, $unid_placa);
        $sql->bindValue(3, $unid_motor);
        $sql->bindValue(4, $unid_adquisicion);
        $sql->bindValue(5, $unid_observacion);
        $sql->bindValue(6, $tiun_id);
        $sql->bindValue(7, $area_id);
        $sql->bindValue(8, $mode_id);
        $sql->bindValue(9, $unid_codigo);
        $sql->bindValue(10, $colo_id);
        $sql->bindValue(11, $comb_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_movil($unid_id, $unid_anio, $unid_placa, $unid_motor, $unid_adquisicion, $unid_observacion, $tiun_id, $area_id, $mode_id, $unid_codigo, $colo_id, $comb_id)
    {
        $conx = parent::conexion();
        $sql = "UPDATE sc_residuos_solidos.tb_unidad
	                SET 
                        unid_anio=?,
                        unid_placa=?,
                        unid_motor=?,
                        unid_adquisicion=?, 
                        unid_observacion=?,
                        tiun_id=?, 
                        area_id=?, 
                        mode_id=?,
                        unid_codigo=?, 
                        colo_id=?, 
                        comb_id=?
	                WHERE 
                        unid_id=?;";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $unid_anio);
        $sql->bindValue(2, $unid_placa);
        $sql->bindValue(3, $unid_motor);
        $sql->bindValue(4, $unid_adquisicion);
        $sql->bindValue(5, $unid_observacion);
        $sql->bindValue(6, $tiun_id);
        $sql->bindValue(7, $area_id);
        $sql->bindValue(8, $mode_id);
        $sql->bindValue(9, $unid_codigo);
        $sql->bindValue(10, $colo_id);
        $sql->bindValue(11, $comb_id);
        $sql->bindValue(12, $unid_id);
        $sql->execute();
        return $resultado = $sql->fetchALL();
    }





    public function get_lista_intermovil()
    {

        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        tb_unidad.unid_id,
        tb_unidad.area_id,
        tb_unidad.unid_codigo,
        tb_dependencia.depe_denominacion,
        tb_tipo_unidad.tiun_descripcion,
        tb_marca.marc_descripcion,
        tb_modelo.mode_descripcion,
        tb_unidad.unid_adquisicion,
        tb_unidad.unid_estado,
        tb_color.colo_descripcion, 
        tb_unidad.comb_id,
        tb_unidad.unid_motor,
        tb_combustible.comb_descripcion,
        tb_unidad.unid_observacion
     FROM sc_residuos_solidos.tb_unidad
    left JOIN sc_residuos_solidos.tb_tipo_unidad ON 
        sc_residuos_solidos.tb_unidad.tiun_id = sc_residuos_solidos.tb_tipo_unidad.tiun_id
    left JOIN sc_residuos_solidos.tb_modelo ON
         sc_residuos_solidos.tb_unidad.mode_id = sc_residuos_solidos.tb_modelo.mode_id
    left JOIN sc_residuos_solidos.tb_marca ON
        sc_residuos_solidos.tb_modelo.marc_id = sc_residuos_solidos.tb_marca.marc_id
    left join sc_residuos_solidos.tb_unidad_combustible on 
            sc_residuos_solidos.tb_unidad.unid_id = sc_residuos_solidos.tb_unidad_combustible.unid_id
    left join sc_residuos_solidos.tb_combustible on
            sc_residuos_solidos.tb_unidad.comb_id = sc_residuos_solidos.tb_combustible.comb_id
    
    left join 	sc_residuos_solidos.tb_color on
        sc_residuos_solidos.tb_unidad.colo_id = sc_residuos_solidos.tb_color.colo_id
    left join public.tb_dependencia  on
        sc_residuos_solidos.tb_unidad.area_id = public.tb_dependencia.depe_id
    
        where tb_unidad.unid_estado=1 order by  unid_id desc   ";

        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_tipo()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_tipo_unidad where tiun_estado=1 ORDER BY tiun_descripcion desc";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function combo_marca()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_marca WHERE marc_estado=1  ORDER BY marc_id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function combo_modelo($marc_id)
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        tb_modelo.mode_id,
        tb_modelo.mode_descripcion
    FROM sc_residuos_solidos.tb_marca
    INNER JOIN sc_residuos_solidos.tb_modelo on
            sc_residuos_solidos.tb_marca.marc_id =sc_residuos_solidos.tb_modelo.marc_id 
    where tb_modelo.mode_estado=1 and tb_marca.marc_id=?";
        $sql = $con->prepare($sql);
        $sql->bindValue(1, $marc_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_area()
    {
        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tb_dependencia where depe_estado='A' order by depe_id desc  ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }



    public function combo_color()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_color where colo_estado=1 ORDER BY colo_descripcion desc";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function combo_combustible()
    {
        $con = parent::Conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_combustible where comb_estado=1 ORDER BY comb_descripcion DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function get_movil_id($unid_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
            tb_unidad.unid_id, 
            tb_unidad.unid_codigo,
            tb_unidad.tiun_id,
            tb_unidad.area_id,
            tb_unidad.unid_placa,
            tb_unidad.unid_motor,
            
            tb_unidad.mode_id,
            tb_unidad.unid_anio,
            tb_unidad.comb_id,
            tb_unidad.colo_id,
            tb_dependencia.depe_denominacion,
            tb_tipo_unidad.tiun_descripcion,
            tb_marca.marc_id,
            tb_marca.marc_descripcion,
            tb_modelo.mode_descripcion,
            tb_unidad.unid_adquisicion,
            tb_unidad.unid_estado,
            tb_color.colo_descripcion, 
            tb_combustible.comb_descripcion,
            tb_unidad.unid_observacion
         FROM sc_residuos_solidos.tb_unidad
        left JOIN sc_residuos_solidos.tb_tipo_unidad ON 
            sc_residuos_solidos.tb_unidad.tiun_id = sc_residuos_solidos.tb_tipo_unidad.tiun_id
        left JOIN sc_residuos_solidos.tb_modelo ON
             sc_residuos_solidos.tb_unidad.mode_id = sc_residuos_solidos.tb_modelo.mode_id
        left JOIN sc_residuos_solidos.tb_marca ON
            sc_residuos_solidos.tb_modelo.marc_id = sc_residuos_solidos.tb_marca.marc_id
        left join sc_residuos_solidos.tb_unidad_combustible on 
                sc_residuos_solidos.tb_unidad.unid_id = sc_residuos_solidos.tb_unidad_combustible.unid_id
        left join sc_residuos_solidos.tb_combustible on
                sc_residuos_solidos.tb_unidad_combustible.comb_id = sc_residuos_solidos.tb_combustible.comb_id
       
        left join 	sc_residuos_solidos.tb_color on
            sc_residuos_solidos.tb_unidad.colo_id = sc_residuos_solidos.tb_color.colo_id
        left join public.tb_dependencia  on
            sc_residuos_solidos.tb_unidad.area_id = public.tb_dependencia.depe_id
        
            where tb_unidad.unid_estado=1 and tb_unidad.unid_id=? order by  unid_id desc";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $unid_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    function eliminar_movil($unid_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE sc_residuos_solidos.tb_unidad
        SET
            unid_estado = 0
        WHERE
            unid_id = ?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $unid_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_lista_intermovilPDF()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        tb_unidad.unid_id,
        tb_unidad.area_id,
        tb_unidad.unid_codigo,
        tb_dependencia.depe_denominacion,
        tb_tipo_unidad.tiun_descripcion,
        tb_marca.marc_descripcion,
        tb_modelo.mode_descripcion,
        tb_unidad.unid_adquisicion,
        tb_unidad.unid_estado,
        tb_color.colo_descripcion, 
        tb_unidad.comb_id,
        tb_combustible.comb_descripcion,
        tb_unidad.unid_observacion
     FROM sc_residuos_solidos.tb_unidad
    left JOIN sc_residuos_solidos.tb_tipo_unidad ON 
        sc_residuos_solidos.tb_unidad.tiun_id = sc_residuos_solidos.tb_tipo_unidad.tiun_id
    left JOIN sc_residuos_solidos.tb_modelo ON
         sc_residuos_solidos.tb_unidad.mode_id = sc_residuos_solidos.tb_modelo.mode_id
    left JOIN sc_residuos_solidos.tb_marca ON
        sc_residuos_solidos.tb_modelo.marc_id = sc_residuos_solidos.tb_marca.marc_id
    left join sc_residuos_solidos.tb_unidad_combustible on 
            sc_residuos_solidos.tb_unidad.unid_id = sc_residuos_solidos.tb_unidad_combustible.unid_id
    left join sc_residuos_solidos.tb_combustible on
            sc_residuos_solidos.tb_unidad.comb_id = sc_residuos_solidos.tb_combustible.comb_id
    
    left join 	sc_residuos_solidos.tb_color on
        sc_residuos_solidos.tb_unidad.colo_id = sc_residuos_solidos.tb_color.colo_id
    left join public.tb_dependencia  on
        sc_residuos_solidos.tb_unidad.area_id = public.tb_dependencia.depe_id
    
        where tb_unidad.unid_estado=1 order by  unid_id desc"; // Tu consulta SQL completa
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_unidadMovil()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT unid_id, tiun_descripcion, unid_placa, mode_descripcion
                FROM sc_residuos_solidos.tb_unidad 
                INNER JOIN sc_residuos_solidos.tb_tipo_unidad ON sc_residuos_solidos.tb_tipo_unidad.tiun_id = sc_residuos_solidos.tb_unidad.tiun_id
                INNER JOIN sc_residuos_solidos.tb_modelo ON sc_residuos_solidos.tb_unidad.mode_id = sc_residuos_solidos.tb_modelo.mode_id
                WHERE unid_estado = '1' 
                ORDER BY unid_id ASC";
        $sql = $con->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll();

        if ($resultado) {
            return $resultado;
        } else {
            print_r($con->errorInfo()); // Mostrar errores en la consulta SQL
            return array(); // Devolver un array vacío si falla
        }
    }

    public function combo_espec()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_especialidad_mecanica
            ORDER BY esme_id ASC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    /*TODO aqui guardamos el la Programacion de Mantenimiento */

    public function GuardarProgramacionMant($prma_diagnostico_inicial, $prma_fecha, $prma_hora, $unid_id, $esme_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_programacion_mantenimiento(
            prma_diagnostico_inicial, prma_fecha, prma_hora, unid_id, prma_estado, esme_id)
            VALUES (?, ?, ?, ?, '1', ?)";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $prma_diagnostico_inicial);
        $sql->bindValue(2, $prma_fecha);
        $sql->bindValue(3, $prma_hora);
        $sql->bindValue(4, $unid_id);
        $sql->bindValue(5, $esme_id);

        if ($sql->execute()) {
            // Captura el ID inmediatamente después de la inserción
            $lastInsertId = $conx->lastInsertId();
            return $lastInsertId;
        } else {
            print_r($sql->errorInfo()); // Imprime los detalles del error SQL
            return false;
        }
    }



    /*TODO aqui guardamos ya el ingreso de Vehiculos*/
    public function GuardarRegistroVehiculo($inun_fecha, $inun_hora, $inun_diagnostico, $unid_id, $inun_diagnostico_especializado, $inun_fecha_diagnostico_especializado, $inun_estado)
    {
        $con = parent::conexion();
        parent::set_names();

        // Primero, obtén el último prma_id
        $sql = "SELECT MAX(prma_id) AS last_prma_id FROM sc_residuos_solidos.tb_programacion_mantenimiento";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $prma_id = $result['last_prma_id'];

        // Ahora, usa ese prma_id en tu inserción
        $sql = "INSERT INTO sc_residuos_solidos.tb_ingreso_unidad(
            inun_fecha, inun_hora, inun_diagnostico, inun_estado, unid_id, inun_diagnostico_especializado, inun_fecha_diagnostico_especializado, prma_id, inun_estado_atencion)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, '1')";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $inun_fecha);
        $stmt->bindValue(2, $inun_hora);
        $stmt->bindValue(3, $inun_diagnostico);
        $stmt->bindValue(4, $inun_estado); // Aquí guardamos el estado como 1 o 0
        $stmt->bindValue(5, $unid_id);
        $stmt->bindValue(6, $inun_diagnostico_especializado);
        $stmt->bindValue(7, $inun_fecha_diagnostico_especializado);
        $stmt->bindValue(8, $prma_id);

        if ($stmt->execute()) {
            return $con->lastInsertId(); // Retornar el ID del último registro insertado
        } else {
            return false; // Manejo de errores
        }
    }

    public function combo_tipo_busquedad()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_tipo_unidad
            ORDER BY tiun_id ASC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_modelo_busquedad()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_modelo where   mode_estado=1
        ORDER BY mode_id ASC ";
        $sql = $conectar->prepare($sql);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function combo_marca_busquedad()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_marca
            ORDER BY marc_id ASC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function listar_bitacora()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT u.unid_placa, tu.tiun_descripcion, mo.mode_descripcion, ma.marc_descripcion,
	   iu.inun_fecha,iu.inun_diagnostico,iu.inun_fecha_diagnostico_especializado,
		pm.prma_fecha
	FROM sc_residuos_solidos.tb_unidad u
				inner join sc_residuos_solidos.tb_tipo_unidad tu on 
				u.tiun_id = tu.tiun_id
				inner join sc_residuos_solidos.tb_modelo mo on
				u.mode_id=mo.mode_id
				inner join sc_residuos_solidos.tb_marca ma on
				mo.marc_id=ma.marc_id
				inner join sc_residuos_solidos.tb_ingreso_unidad iu on
				u.unid_id=iu.unid_id
				inner join sc_residuos_solidos.tb_programacion_mantenimiento pm on
				u.unid_id=pm.unid_id
ORDER BY iu.inun_fecha desc";
        // Preparar la consulta
        $sql = $con->prepare($sql);

        // Ejecutar la consulta
        $sql->execute();

        // Obtener los resultados como array asociativo
        $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Retornar los resultados para usarlos en el controlador o vista
        return $resultado;
    }








    /*TODO =============================================================  EMPEZAMOS CON LLENADO DE MIS COMBOX EN MI 
        ====================================================================  EN MI FORMULARIO TICKET*/

    public function combo_tipo_componente()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * from sc_residuos_solidos.tb_componente where comp_estado=1 ";
        $sql = $conectar->prepare($sql);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function combo_tipo_componente_especifico($componente_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        // Filtrar los componentes específicos basados en el componente_id
        $sql = "SELECT * FROM sc_residuos_solidos.tb_componente_tipos 
                WHERE comp_id = ? AND coti_estado = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute([$componente_id]);  // Pasar el componente_id para filtrar los resultados
        return $sql->fetchAll();
    }
    public function combo_lubricadormecanico()
    {
        try {
            $con = parent::conexion();
            parent::set_names();

            $sql = "SELECT d.direct_id, 
                           CONCAT(p.pers_nombre, ' ', p.pers_apelpat, ' ', p.pers_apelmat) AS nombres 
                    FROM sc_residuos_solidos.tb_directorio d 
                    INNER JOIN sc_escalafon.tb_persona p ON d.pers_id = p.pers_id
                    WHERE d.direct_estado = 1";

            $sql = $con->prepare($sql);
            $sql->execute();

            return $sql->fetchAll();
        } catch (Exception $e) {
            error_log("Error al consultar responsables: " . $e->getMessage());
            return [];
        }
    }




    //para validar mi token con mi  responsable
    public function verificarToken($direct_id, $token)
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "SELECT direct_id FROM sc_residuos_solidos.tb_directorio 
                WHERE direct_id = ? AND direct_token = ?";

        $stmt = $con->prepare($sql);
        $stmt->execute([$direct_id, $token]);

        return $stmt->fetchAll(); // Retorna los resultados si existen
    }


    /*TODO generando el codigo del ticket */
    public function generarCodigoTicket()
    {
        $con = parent::conexion();
        parent::set_names();

        // Obtener el último número de ticket registrado
        $sql = "SELECT tickdo_numtick FROM sc_residuos_solidos.tb_ticket_dotacion ORDER BY tickdo_id DESC LIMIT 1";
        $sql = $con->prepare($sql);
        $sql->execute();

        $ultimoTicket = $sql->fetch(PDO::FETCH_ASSOC);
        $anioActual = date('Y'); // Obtener el año actual

        // Generar el nuevo número de ticket
        if ($ultimoTicket) {
            $ultimoNumero = intval(substr($ultimoTicket['tickdo_numtick'], 0, 5)); // Extraer el número
            $nuevoNumero = $ultimoNumero + 1; // Incrementar el número
        } else {
            $nuevoNumero = 1; // Si no hay tickets previos, empezar en 1
        }

        // Formatear el nuevo número a 5 dígitos y añadir el año y sufijo 'ASI'
        $nuevoCodigoTicket = str_pad($nuevoNumero, 5, '0', STR_PAD_LEFT) . '-' . $anioActual . 'ASI';

        return $nuevoCodigoTicket;
    }

    /*TODO buscar a la persona con ese dni */
    public function buscarChoferPorDNI($dni)
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "SELECT pers_id, CONCAT(pers_nombre, ' ', pers_apelpat, ' ', pers_apelmat) AS nombre_completo 
                FROM sc_escalafon.tb_persona 
                WHERE pers_dni = ?";

        $sql = $con->prepare($sql);
        $sql->bindValue(1, $dni);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /*TODO guardamoe el formulario de tickets  */
    // Función para validar el token del responsable
    public function validarToken($direct_id, $token)
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "SELECT * FROM sc_residuos_solidos.tb_directorio WHERE direct_id = ? AND direct_token = ?";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $direct_id);
        $stmt->bindValue(2, $token);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    // Función para obtener el último número de ticket
    public function obtenerUltimoTicket()
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "SELECT MAX(tickdo_numtick) AS ultimo_ticket FROM sc_residuos_solidos.tb_ticket_dotacion";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado['ultimo_ticket'] ? intval(explode('-', $resultado['ultimo_ticket'])[0]) : 0;
    }

    /*TODO obteniendo el ultimo ID de mi inun_id */
    public function obtenerUltimoIngresoUnidad()
    {
        $con = parent::conexion();
        parent::set_names();
        
        // Obtener el último inun_id
        $sql = "SELECT MAX(inun_id) as ultimo_id FROM sc_residuos_solidos.tb_ingreso_unidad";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retornar el último inun_id o false si no hay registros
        return $resultado ? $resultado['ultimo_id'] : false;
    }
    
    
/*TODO GUARDAR TICKETE */
public function guardarTicket($ticketNumber, $fecha, $horaIngreso, $coti_id, $cantidad, $pers_id, $direct_id, $inun_id) {
    $con = parent::conexion();
    parent::set_names();

    // Consulta SQL para insertar el nuevo ticket
    $sql = "INSERT INTO sc_residuos_solidos.tb_ticket_dotacion 
            (tickdo_numtick, tickdo_fecha, tickdo_hora, coti_id, tickdo_cantidad, pers_id, direct_id, inun_id, tickdo_estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'A')"; // 'A' representa el estado Activo
    $stmt = $con->prepare($sql);
    $stmt->bindValue(1, $ticketNumber);
    $stmt->bindValue(2, $fecha);
    $stmt->bindValue(3, $horaIngreso);
    $stmt->bindValue(4, $coti_id);
    $stmt->bindValue(5, $cantidad);
    $stmt->bindValue(6, $pers_id); // Aquí se guarda el `pers_id` (ID de la persona, no el DNI)
    $stmt->bindValue(7, $direct_id);
    $stmt->bindValue(8, $inun_id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

/* TODO taremos el componente y tipo en  PDF  */
  // Obtener el ticket por número 
  public function getTicketByNumber($ticketNumber) {
    $con = parent::conexion();
    parent::set_names();

    $sql = "SELECT 
                t.tickdo_numtick,
                t.tickdo_fecha,
                t.tickdo_hora,
                t.coti_id,
                t.tickdo_cantidad,
                p.pers_id,
                CONCAT(p.pers_nombre, ' ', p.pers_apelpat, ' ', p.pers_apelmat) AS nombre_chofer,
                d.direct_id,
                CONCAT(d.direct_nombre, ' ', d.direct_apelpat, ' ', d.direct_apelmat) AS nombre_responsable,
                t.inun_id,
                c.coti_descrip AS componente_especifico,
                comp.comp_descrip AS tipo_componente
            FROM 
                sc_residuos_solidos.tb_ticket_dotacion t
            JOIN 
                sc_escalafon.tb_persona p ON t.pers_id = p.pers_id
            JOIN 
                sc_residuos_solidos.tb_directorio d ON t.direct_id = d.direct_id
            JOIN 
                sc_residuos_solidos.tb_componente_tipos c ON t.coti_id = c.coti_id
            JOIN 
                sc_residuos_solidos.tb_componente comp ON c.comp_id = comp.comp_id
            WHERE 
                t.tickdo_numtick = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bindValue(1, $ticketNumber);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}





// Obtener la descripción del componente y tipo de componente
public function getComponenteById($coti_id) {
    $con = parent::conexion();
    parent::set_names();

    // Consulta que une las tablas `tb_componente` y `tb_componente_tipos`
    $sql = "SELECT coti.coti_descrip, comp.comp_descr
            FROM sc_residuos_solidos.tb_componente_tipos AS coti
            JOIN sc_residuos_solidos.tb_componente AS comp ON coti.comp_id = comp.comp_id
            WHERE coti.coti_id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bindValue(1, $coti_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


     
    
}
