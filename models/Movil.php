<?php
class Movil extends Conectar
{



    public function get_area(){
        $cnn=parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM tb_dependencia";
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
    where tb_marca.marc_id=?";
        $sql=$con->prepare($sql);
        $sql->bindValue(1,$marc_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }




public function get_tipo(){
    $con=parent::conexion();
    parent::set_names();
    $sql="SELECT * FROM sc_residuos_solidos.tb_tipo_unidad ORDER BY tiun_descripcion ASC";
    $sql=$con->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}



public function get_color(){
   $con=parent::conexion();
   parent::set_names();
   $sql="SELECT * FROM sc_residuos_solidos.tb_color ORDER BY colo_descripcion ASC"; 
    $sql=$con->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}


public function get_combustible(){
    $con=parent::Conexion();
    parent::set_names();
    $sql="SELECT * FROM sc_residuos_solidos.tb_combustible ORDER BY comb_descripcion DESC";
    $sql=$con->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}

    public function get_lista_movil()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = " SELECT 
	tb_unidad.unid_codigo,
	tb_dependencia.depe_denominacion,
	tb_tipo_unidad.tiun_descripcion,
	tb_marca.marc_descripcion,
	tb_modelo.mode_descripcion,
	tb_unidad.unid_adquisicion,
	tb_unidad.unid_estado,
	tb_color.colo_descripcion,
	tb_combustible.comb_descripcion
 FROM sc_residuos_solidos.tb_unidad
INNER JOIN sc_residuos_solidos.tb_tipo_unidad ON 
	sc_residuos_solidos.tb_unidad.tiun_id = sc_residuos_solidos.tb_tipo_unidad.tiun_id
INNER JOIN sc_residuos_solidos.tb_modelo ON
     sc_residuos_solidos.tb_unidad.mode_id = sc_residuos_solidos.tb_modelo.mode_id
INNER JOIN sc_residuos_solidos.tb_marca ON
	sc_residuos_solidos.tb_modelo.marc_id = sc_residuos_solidos.tb_marca.marc_id

inner join sc_residuos_solidos.tb_unidad_combustible on 
		sc_residuos_solidos.tb_unidad.unid_id = sc_residuos_solidos.tb_unidad_combustible.unid_id
inner join sc_residuos_solidos.tb_combustible on
		sc_residuos_solidos.tb_unidad_combustible.comb_id = sc_residuos_solidos.tb_combustible.comb_id
left join sc_residuos_solidos.tb_unidad_color on
		sc_residuos_solidos.tb_unidad.unid_id = sc_residuos_solidos.tb_unidad_color.unid_id
left join 	sc_residuos_solidos.tb_color on
	sc_residuos_solidos.tb_unidad_color.colo_id = sc_residuos_solidos.tb_color.colo_id

inner join public.tb_dependencia  on
	sc_residuos_solidos.tb_unidad.unid_id = public.tb_dependencia.depe_id
	
	where tb_unidad.unid_estado=1";

        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    


    




    /* TODO LISTANDO MODELO DE MOVILIDAD */
    /* TODO LISTANDO MODELO DE MOVILIDAD */
    /* TODO LISTANDO MODELO DE MOVILIDAD */
    public function get_modelotabla()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        tb_modelo.mode_id,
    tb_modelo.mode_descripcion,
    tb_modelo.mode_estado,
    tb_marca.marc_descripcion
 FROM sc_residuos_solidos.tb_modelo
 inner join sc_residuos_solidos.tb_marca  on
     sc_residuos_solidos.tb_modelo.marc_id=sc_residuos_solidos.tb_marca.marc_id
ORDER BY mode_id DESC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


}
