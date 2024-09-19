<?php

class Directorio extends Conectar
{
    public function combo_trabajador()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT  tp.pers_id,
	CONCAT(tp.pers_nombre,' ',tp.pers_apelpat,' ', tp.pers_apelmat ) as pers_nombre_completo
	FROM sc_residuos_solidos.tb_directorio td 
	inner join sc_escalafon.tb_persona  tp on tp.pers_id= td.pers_id
	where td.direct_estado=1";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function combo_funciones()
    {

        $cnn = parent::conexion();
        parent::set_names();
        $sql = "SELECT func_id, func_descrip FROM sc_residuos_solidos.tb_funciones where func_estado=1
ORDER BY func_id ASC ";
        $sql = $cnn->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_directorio()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT  td.direct_id,
		CONCAT(tp.pers_nombre,' ',tp.pers_apelpat,' ', tp.pers_apelmat ) as pers_nombre_completo,
		tf.func_descrip,
		td.direct_descrip, td.direct_fecha
		FROM sc_residuos_solidos.tb_directorio td 
		inner join sc_escalafon.tb_persona  tp on tp.pers_id= td.pers_id
		inner join sc_residuos_solidos.tb_funciones tf on td.func_id=tf.func_id
		where td.direct_estado=1
		order by direct_id desc";
        $sql = $con->prepare($sql);
        $sql->execute();
        return  $sql->fetchAll();
    }





    public function get_directorio_by_id($direct_id)
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_directorio WHERE direct_id = ?";
        $sql = $con->prepare($sql);
        $sql->bindValue(1, $direct_id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);  // Devuelve un solo registro como array asociativo
    }



    public function update_directorio($direct_id, $pers_id, $func_id, $direct_descrip, $direct_fecha)
    {
        $conx = parent::conexion();
        $sql = "UPDATE sc_residuos_solidos.tb_directorio
                SET pers_id = ?, func_id = ?, 
                    direct_descrip = ?, 
                    direct_fecha = ?
                WHERE direct_id = ?";

        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $pers_id);
        $sql->bindValue(2, $func_id);
        $sql->bindValue(3, $direct_descrip);
        $sql->bindValue(4, $direct_fecha);
        $sql->bindValue(5, $direct_id);  // Condición para actualizar el registro

        $sql->execute();  // Ejecutar la consulta para actualizar
        return $sql->rowCount();  // Puedes devolver el número de filas afectadas
    }


    public function delete_directorio($direct_id) {
        $con = parent::conexion();
        $sql = "DELETE FROM sc_residuos_solidos.tb_directorio WHERE direct_id = ?";
        $sql = $con->prepare($sql);
        $sql->bindValue(1, $direct_id);
        $sql->execute();
        return $sql->rowCount();  // Devolver el número de filas eliminadas
    }
    
}
