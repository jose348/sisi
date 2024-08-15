<?php
class Personal extends Conectar{
    public function get_personal(){
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
                WHERE perm.sist_id = 5  order by pers_id desc;";
        $sql=$con->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();

    }
}