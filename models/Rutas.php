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
}
