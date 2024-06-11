<?php
class Movil extends Conectar{

    public function insert_movil($unid_anio,$unid_placa,$unid_motor,$unid_adquisicion,$unid_observacion,$tiun_id,$area_id,$mode_id,$unid_codigo,$colo_id,$comb_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="INSERT INTO sc_residuos_solidos.tb_unidad(
	                unid_anio, unid_placa, unid_motor, unid_adquisicion, unid_observacion, tiun_id, area_id, mode_id,
                    unid_estado, unid_codigo, unid_operatividad, colo_id,comb_id)
	                VALUES (?, ?, ?, ?, ?, ?, ?, ?, '1', ?, '1', ?, ?)";
        $sql=$conectar->prepare($sql);
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
        return $resultado=$sql->fetchAll();
    }
 
    public function update_movil($unid_id,$unid_anio,$unid_placa,$unid_motor,$unid_adquisicion,$unid_observacion,$tiun_id,$area_id,$mode_id,$unid_codigo,$colo_id,$comb_id){
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




/* 
    public function insert_movil($unid_anio, $unid_placa, $unid_motor, $unid_adquisicion, 
                                 $unid_observacion,$tiun_id, $area_id, $mode_id,
                                 $unid_codigo, $comb_id){
        $conx = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO sc_residuos_solidos.tb_unidad (
                unid_anio, unid_placa, unid_motor, unid_adquisicion, unid_observacion,
                tiun_id, area_id, mode_id, unid_codigo, comb_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING unid_id";
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
            $sql->bindValue(10, $comb_id);                      
            $sql->execute();

            // Recuperar el unid_id del registro insertado
            $result = $sql->fetch(PDO::FETCH_ASSOC);
        
            return $result['unid_id'];
    }

    public function actualizarColor($unid_id, $colo_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_unidad_color(unid_id, colo_id)
        VALUES (?, ?)";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $unid_id);                    
        $sql->bindValue(2, $colo_id);                   
        $sql->execute();
        return $resultado = $sql->fetchALL();

    } */
/* public function update_movil($unid_id,$unid_anio, $unid_placa, $unid_motor, $unid_adquisicion, 
                            $unid_observacion,$tiun_id, $area_id, $mode_id,
                            $unid_codigo, $unco_id,$comb_id){
        $conx = parent::conexion();
        parent::set_names();
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
                        unid_operatividad=?,
                        unco_id=?,
                        comb_id=?
                        WHERE 
                         unid_id=?,";
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
            $sql->bindValue(10, $unco_id);
            $sql->bindValue(11, $comb_id);
            $sql->bindValue(12, $unid_id);
            $sql->execute();
            return $resultado = $sql->fetchALL();   
}
 */

    public function get_area(){
        $cnn=parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tb_dependencia where depe_estado='A' order by depe_id desc  ";
        $sql=$cnn->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }




    public function get_marca(){
        $con=parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM sc_residuos_solidos.tb_marca WHERE marc_estado=1  ORDER BY marc_id DESC";
        $sql=$con->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public  function insert_marca($marc_descripcion){
        $con=parent::conexion();
        parent::set_names();
        $sql="INSERT INTO sc_residuos_solidos.tb_marca(
            marc_descripcion, marc_estado)
                VALUES (?, 1)";
        $sql=$con->prepare($sql);
        $sql->bindValue(1,$marc_descripcion);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function update_marca($marc_id,$marc_descripcion){
        $con=parent::conexion();
        parent::set_names();
        $sql="UPDATE sc_residuos_solidos.tb_marca
        SET  marc_descripcion=?
        WHERE  marc_id=?";
        $sql=$con->prepare($sql);
        $sql->bindValue(1,$marc_descripcion);
        $sql->bindValue(2,$marc_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }


    public function get_modelo($marc_id){
        $con=parent::conexion();
        parent::set_names();
        $sql="SELECT 
        tb_modelo.mode_id,
        tb_modelo.mode_descripcion
    FROM sc_residuos_solidos.tb_marca
    INNER JOIN sc_residuos_solidos.tb_modelo on
            sc_residuos_solidos.tb_marca.marc_id =sc_residuos_solidos.tb_modelo.marc_id 
    where tb_modelo.mode_estado=1 and tb_marca.marc_id=?";
        $sql=$con->prepare($sql);
        $sql->bindValue(1,$marc_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }



public function get_tipo(){
    $con=parent::conexion();
    parent::set_names();
    $sql="SELECT * FROM sc_residuos_solidos.tb_tipo_unidad where tiun_estado=1 ORDER BY tiun_descripcion desc";
    $sql=$con->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}



public function get_color(){
   $con=parent::conexion();
   parent::set_names();
   $sql="SELECT * FROM sc_residuos_solidos.tb_color where colo_estado=1 ORDER BY colo_descripcion desc"; 
    $sql=$con->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}


public function get_combustible(){
    $con=parent::Conexion();
    parent::set_names();
    $sql="SELECT * FROM sc_residuos_solidos.tb_combustible where comb_estado=1 ORDER BY comb_descripcion DESC";
    $sql=$con->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}

    public function get_lista_movil(){
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
    
        where tb_unidad.unid_estado=1 order by  unid_id desc   ";

        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_unidad($unid_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE sc_residuos_solidos.tb_unidad
            SET
                unid_estado = 0
            WHERE
                unid_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $unid_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
}  


public function get_movil_id($unid_id){
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
   

}
