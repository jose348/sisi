<?php

class Bita  extends Conectar
{


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
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_modelo where   mode_estado=1
        ORDER BY mode_id ASC ";
        $sql = $con->prepare($sql);

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
 

  // Otras funciones ya existentes...

  public function get_lista_bitacora($tiun_id, $mode_id, $marc_id, $placaUnidad)
  {
      $con = parent::conexion();
      parent::set_names();
  
      $sql = "SELECT u.unid_placa, 
                     tu.tiun_descripcion, 
                     m.mode_descripcion,
                     ma.marc_descripcion, 
                     i.inun_fecha, 
                     pm.prma_fecha,
                     t.tickdo_numtick,
                     tm.mant_fech,
                     u.unid_id
              FROM sc_residuos_solidos.tb_ingreso_unidad i
              LEFT JOIN sc_residuos_solidos.tb_unidad u ON i.unid_id = u.unid_id
              LEFT JOIN sc_residuos_solidos.tb_tipo_unidad tu ON u.tiun_id = tu.tiun_id
              LEFT JOIN sc_residuos_solidos.tb_modelo m ON u.mode_id = m.mode_id
              LEFT JOIN sc_residuos_solidos.tb_marca ma ON m.marc_id = ma.marc_id
              LEFT JOIN sc_residuos_solidos.tb_programacion_mantenimiento pm ON i.prma_id = pm.prma_id
              LEFT JOIN sc_residuos_solidos.tb_ticket_dotacion t ON i.inun_id = t.inun_id
              LEFT JOIN sc_residuos_solidos.tb_mantenimiento tm ON t.tickdo_id = tm.tickdo_id
               ";
  
      if (!empty($tiun_id)) {
          $sql .= " AND tu.tiun_id = :tiun_id";
      }
      if (!empty($mode_id)) {
          $sql .= " AND m.mode_id = :mode_id";
      }
      if (!empty($marc_id)) {
          $sql .= " AND ma.marc_id = :marc_id";
      }
      if (!empty($placaUnidad)) {
          $sql .= " AND u.unid_placa LIKE :placaUnidad";
      }
  
      $sql .= " ORDER BY i.inun_fecha DESC";
  
      $query = $con->prepare($sql);
  
      // Vinculamos los parámetros si existen
      if (!empty($tiun_id)) {
          $query->bindValue(':tiun_id', $tiun_id);
      }
      if (!empty($mode_id)) {
          $query->bindValue(':mode_id', $mode_id);
      }
      if (!empty($marc_id)) {
          $query->bindValue(':marc_id', $marc_id);
      }
      if (!empty($placaUnidad)) {
        $query->bindValue(':placaUnidad', "%$placaUnidad%", PDO::PARAM_STR);  // Buscamos por coincidencia parcial
    }

  
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function get_movimientos_unidad($unid_id)
  {
      $con = parent::conexion();
      parent::set_names();
  
      $sql = "SELECT 
                  m.mant_fech AS fecha_mantenimiento,
                  m.mant_diagnostico AS diagnostico,
                  pm.prma_fecha AS fecha_programacion,
                  t.tickdo_numtick AS ticket,
                  t.tickdo_fecha AS fecha_ticket,
                  e.esme_descripcion AS especialidad
              FROM sc_residuos_solidos.tb_mantenimiento m
              LEFT JOIN sc_residuos_solidos.tb_ticket_dotacion t ON m.tickdo_id = t.tickdo_id
              LEFT JOIN sc_residuos_solidos.tb_programacion_mantenimiento pm ON t.tickdo_id = pm.tickdo_id
              LEFT JOIN sc_residuos_solidos.tb_especialidad_mantenimiento e ON pm.esme_id = e.esme_id
              WHERE m.unid_id = :unid_id
              ORDER BY m.mant_fech DESC";
  
      $query = $con->prepare($sql);
      $query->bindValue(':unid_id', $unid_id, PDO::PARAM_INT);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  

  /*TODO DETALLE DE MI HISTORIAL EN MI MODAL */
  public function get_historial_unidad($unid_id) {
    $con = parent::conexion();
    parent::set_names();

    $sql = "SELECT i.inun_id,
                   u.unid_placa,
                   (per.pers_nombre || ' ' || per.pers_apelpat || ' ' || per.pers_apelmat) as chofer,
                   tu.tiun_descripcion, 
                   m.mode_descripcion,
                   ma.marc_descripcion, 
                   i.inun_fecha, 
                   i.inun_hora, 
                   i.inun_diagnostico, 
                   pm.prma_fecha,
                   t.tickdo_numtick,
                   tm.mant_fech,
                   u.unid_id
            FROM sc_residuos_solidos.tb_ingreso_unidad i
            LEFT JOIN sc_residuos_solidos.tb_unidad u ON i.unid_id = u.unid_id
            LEFT JOIN sc_residuos_solidos.tb_tipo_unidad tu ON u.tiun_id = tu.tiun_id
            LEFT JOIN sc_residuos_solidos.tb_modelo m ON u.mode_id = m.mode_id
            LEFT JOIN sc_residuos_solidos.tb_marca ma ON m.marc_id = ma.marc_id
            LEFT JOIN sc_residuos_solidos.tb_programacion_mantenimiento pm ON i.prma_id = pm.prma_id
            LEFT JOIN sc_residuos_solidos.tb_ticket_dotacion t ON i.inun_id = t.inun_id
            LEFT JOIN sc_residuos_solidos.tb_mantenimiento tm ON t.tickdo_id = tm.tickdo_id
            LEFT JOIN sc_escalafon.tb_persona per ON t.pers_id = per.pers_id
            WHERE u.unid_id = ?
            ORDER BY i.inun_fecha DESC";

    $sql = $con->prepare($sql);
    $sql->bindValue(1, $unid_id, PDO::PARAM_INT);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}




}