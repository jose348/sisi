<?php

class Rutas extends Conectar
{

    public function obtenerHorarios()
    {
        try {
            $conexion = Conectar::conexion();
            $sql = "SELECT hora_id, hora_titulo, hora_inicio, hora_fin 
                    FROM sc_residuos_solidos.tb_horario WHERE hora_estado = 1";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function guardarRuta($nombre, $estado, $geojson, $horarioId, $ubicaciones) {
        try {
            $conexion = Conectar::conexion();
            $sql = "INSERT INTO sc_residuos_solidos.tb_ubicacion 
                    (ubic_nombre, ubic_estado, ubic_geojon, hora_id, ubic_ubicaciones) 
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $estado);
            $stmt->bindParam(3, $geojson);
            $stmt->bindParam(4, $horarioId);
            $stmt->bindParam(5, json_encode($ubicaciones)); // Guardamos las ubicaciones como JSON

            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}
