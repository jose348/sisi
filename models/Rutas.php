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
    // Función para guardar la ruta en la base de datos 

    public function guardarRuta($nombre, $estado, $geojson, $horarioId, $ubicaciones)
    {
        try {
            $conectar = parent::conexion();

            // Convertir array PHP a formato de array de PostgreSQL
            $ubicacionesArray = '{' . implode(',', array_map(fn($u) => "\"$u\"", $ubicaciones)) . '}';

            $sql = "INSERT INTO sc_residuos_solidos.tb_ubicacion 
                (ubic_nombre, ubic_estado, ubic_geojson, hora_id, ubic_ubicaciones) 
                VALUES (?, ?, ?, ?, ?)";

            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $nombre);
            $stmt->bindValue(2, $estado);
            $stmt->bindValue(3, $geojson);
            $stmt->bindValue(4, $horarioId);
            $stmt->bindValue(5, $ubicacionesArray); // Almacenar como array en PostgreSQL

            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en guardarRuta: " . $e->getMessage());
            return false;
        }
    }



    public function obtenerRutas()
    {
        try {
            $conexion = parent::conexion();
            $sql = "SELECT ubic_id, ubic_nombre, ubic_geojson, hora_id FROM sc_residuos_solidos.tb_ubicacion WHERE ubic_estado = 1";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error al obtener rutas: " . $e->getMessage());
            return [];
        }
    }

    // Editar una ruta
    public function editarRuta($id, $nombre, $geojson, $horarioId)
    {
        try {
            $conexion = parent::conexion();
            $sql = "UPDATE sc_residuos_solidos.tb_ubicacion 
                    SET ubic_nombre = ?, ubic_geojson = ?, hora_id = ? 
                    WHERE ubic_id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$nombre, $geojson, $horarioId, $id]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Error al editar la ruta: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar una ruta (cambia el estado a 0)
    public function eliminarRuta($id)
    {
        try {
            $conexion = parent::conexion();
            $sql = "UPDATE sc_residuos_solidos.tb_ubicacion 
                SET ubic_estado = 0 
                WHERE ubic_id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Error al eliminar la ruta: " . $e->getMessage());
            return false;
        }
    }
}
