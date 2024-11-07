<?php


class Asignacionrutachofer  extends Conectar
{
 
    public function buscarchofer($term)
    {
        $conexion = parent::conexion();
        parent::set_names();

        $sql = "SELECT pers_id AS id, CONCAT(pers_nombre, ' ', pers_apelpat, ' ', pers_apelmat) AS text 
                FROM sc_escalafon.tb_persona 
                WHERE pers_nombre ILIKE ? OR pers_apelpat ILIKE ? OR pers_apelmat ILIKE ?
                LIMIT 5";

        $stmt = $conexion->prepare($sql);

        // Verifica que `$term` no esté vacío
        $searchTerm = "%{$term}%";
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]); // Asegura que estás pasando 3 parámetros

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
     // Método similar para buscar ayudantes
     public function buscarAyudantes($term)
     {
         $conexion = parent::conexion();
         parent::set_names();
 
         $sql = "SELECT pers_id AS id, CONCAT(pers_nombre, ' ', pers_apelpat, ' ', pers_apelmat) AS text 
                FROM sc_escalafon.tb_persona 
                WHERE pers_nombre ILIKE ? OR pers_apelpat ILIKE ? OR pers_apelmat ILIKE ?
                LIMIT 5";
 
         $stmt = $conexion->prepare($sql);
         $searchTerm = "%{$term}%";
         $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
 
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }


     public function listarRutasDisponibles() {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT ubic_id, ubic_nombre AS ruta, hora_inicio, hora_fin
                FROM sc_residuos_solidos.tb_ubicacion ub
                INNER JOIN sc_residuos_solidos.tb_horario ho ON ub.hora_id = ho.hora_id
                WHERE ubic_estado = 1";
        
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }



    public function obtenerGeoJSONPorId($ubic_id) {
        try {
            $conexion = parent::conexion();
            $sql = "SELECT ubic_geojson FROM sc_residuos_solidos.tb_ubicacion WHERE ubic_id = ? AND ubic_estado = 1";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$ubic_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error al obtener GeoJSON: " . $e->getMessage());
            return false;
        }
    }
    
    


    public function listarUnidades() {
        $conexion = parent::conexion();
        $sql = "SELECT 
                    tb_unidad.unid_id,
                    tb_unidad.unid_placa,
                     
                    tb_tipo_unidad.tiun_descripcion,
                    tb_marca.marc_descripcion,
                    tb_modelo.mode_descripcion
                    
                FROM sc_residuos_solidos.tb_unidad
                LEFT JOIN sc_residuos_solidos.tb_tipo_unidad 
                    ON sc_residuos_solidos.tb_unidad.tiun_id = sc_residuos_solidos.tb_tipo_unidad.tiun_id
                LEFT JOIN sc_residuos_solidos.tb_modelo 
                    ON sc_residuos_solidos.tb_unidad.mode_id = sc_residuos_solidos.tb_modelo.mode_id
                LEFT JOIN sc_residuos_solidos.tb_marca 
                    ON sc_residuos_solidos.tb_modelo.marc_id = sc_residuos_solidos.tb_marca.marc_id
                LEFT JOIN sc_residuos_solidos.tb_combustible 
                    ON sc_residuos_solidos.tb_unidad.comb_id = sc_residuos_solidos.tb_combustible.comb_id
                LEFT JOIN sc_residuos_solidos.tb_color 
                    ON sc_residuos_solidos.tb_unidad.colo_id = sc_residuos_solidos.tb_color.colo_id
                LEFT JOIN public.tb_dependencia  
                    ON sc_residuos_solidos.tb_unidad.area_id = public.tb_dependencia.depe_id
                WHERE tb_unidad.unid_estado=1 AND tb_unidad.area_id=148 
                ORDER BY unid_id DESC";
        
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    

}