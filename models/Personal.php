<?php
class Personal extends Conectar
{
    public function get_personal()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = " SELECT perm.pers_id,
                    depe.depe_denominacion,
                carg.carg_denominacion,
                perf.perf_nombre,
                sist.sist_denominacion,
                per.pers_dni,
                concat(per.pers_apelpat, ' ', per.pers_apelmat, ' ', per.pers_nombre) AS nombre_persona
                FROM sc_seguridad.tb_permiso perm
                 JOIN sc_escalafon.tb_persona per ON per.pers_id = perm.pers_id
                 JOIN tb_dependencia depe ON depe.depe_id = perm.depe_id
                 JOIN sc_escalafon.tb_cargo carg ON carg.carg_id = perm.carg_id
                 JOIN sc_seguridad.tb_perfil perf ON perf.perf_id = perm.perf_id
                 JOIN sc_seguridad.tb_sistema sist ON sist.sist_id = perm.sist_id
                WHERE perm.sist_id = 5  and per.pers_estado='A' order by pers_id desc;";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_personal_modal($pers_id)
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "  SELECT perm.pers_id,
    concat(per.pers_apelpat, ' ', per.pers_apelmat, ' ', per.pers_nombre) AS nombre_persona,
	per.pers_dni,
	perm.depe_id,
    depe.depe_denominacion,
	perm.carg_id,
    carg.carg_denominacion,
    perf.perf_nombre,
	perm.sist_id,
    sist.sist_denominacion,
    perm.perm_fechacrea
    
   FROM sc_seguridad.tb_permiso perm
     JOIN sc_escalafon.tb_persona per ON per.pers_id = perm.pers_id
     JOIN tb_dependencia depe ON depe.depe_id = perm.depe_id
     JOIN sc_escalafon.tb_cargo carg ON carg.carg_id = perm.carg_id
     JOIN sc_seguridad.tb_perfil perf ON perf.perf_id = perm.perf_id
     JOIN sc_seguridad.tb_sistema sist ON sist.sist_id = perm.sist_id
  WHERE per.pers_id=? and perm.sist_id = 5  and per.pers_estado='A'";
        $sql = $con->prepare($sql);
        $sql->bindValue(1, $pers_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function combo_cargo()
    {
        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_escalafon.tb_cargo WHERE carg_estado='A' 
            ORDER BY carg_id asc";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function update_personal($pers_id, $carg_id)
    {
        try {
            $cnn = parent::conexion();
            parent::set_names();

            $sql = "UPDATE sc_seguridad.tb_permiso
                    SET carg_id = ?
                    WHERE pers_id = ?;";
            $sql = $cnn->prepare($sql);
            $sql->bindValue(1, $carg_id);
            $sql->bindValue(2, $pers_id);

            $success = $sql->execute();

            if ($success && $sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Handle any exceptions here, such as logging the error
            return false;
        }
    }

    public function update_personal_perfil($pers_id, $perf_id)
    {
        try {
            $cnn = parent::conexion();
            parent::set_names();

            $sql = "UPDATE sc_seguridad.tb_permiso
                    SET perf_id = ?
                    WHERE pers_id = ?;";
            $sql = $cnn->prepare($sql);
            $sql->bindValue(1, $perf_id);
            $sql->bindValue(2, $pers_id);

            $success = $sql->execute();

            if ($success && $sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // Handle any exceptions here, such as logging the error
            return false;
        }
    }

    public function combo_perfil()
    {
        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_seguridad.tb_perfil where perf_estado='A'
        ORDER BY perf_id ASC";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function dar_baja_personal($pers_id)
    {
        $cnn = parent::conexion();
        parent::set_names();
        $sql = "UPDATE sc_escalafon.tb_persona
	    SET  pers_estado='I'
	    WHERE pers_id=?;";
        $sql=$cnn->prepare($sql);
        $sql->bindValue(1,$pers_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
}
