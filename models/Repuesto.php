<?php

class Repuesto extends Conectar
{

    public function insert_repuesto(
        $repu_codigo,
        $repu_descripcion,
        $alma_id,
        $repu_stock,
        $repu_precio_unitario,
        $repu_stock_total,
        $repu_ultimo_ingreso,
        $unme_id,
        $repu_situacion
   
    ) {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_repuesto(repu_codigo, repu_descripcion, 
                alma_id, repu_stock,
				repu_precio_unitario, repu_estado, repu_stock_total, repu_ultimo_ingreso, unme_id,repu_situacion)
	            VALUES (?,?,?, ?, ?, 1, (SELECT SUM(repu_stock) FROM sc_residuos_solidos.tb_repuesto 
                where repu_descripcion=? and repu_estado=1 ), ?,?,'A');";



        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $repu_codigo);
        $sql->bindValue(2, $repu_descripcion);
        $sql->bindValue(3, $alma_id);
        $sql->bindValue(4, $repu_stock);
        $sql->bindValue(5, $repu_precio_unitario);
        $sql->bindValue(6, $repu_descripcion); 
        $sql->bindValue(7, $repu_ultimo_ingreso);
        $sql->bindValue(8, $unme_id);
     
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_repuesto(
        $repu_id,
        $repu_codigo,
        $repu_descripcion,
        $alma_id,
        $repu_stock,
        $repu_precio_unitario,
        //$repu_stock_total,
        $repu_ultimo_ingreso,
        $unme_id,
        $repu_situacion
    ) {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "UPDATE sc_residuos_solidos.tb_repuesto 
	         SET 
             repu_codigo=?,
             repu_descripcion=?,
             alma_id=?,            
             repu_stock=?,
             repu_precio_unitario=?,
             /* repu_stock_total=?,  */
             repu_ultimo_ingreso=?,
              unme_id=?,
              repu_situacion=?
	      WHERE repu_id=?";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $repu_codigo);
        $sql->bindValue(2, $repu_descripcion);
        $sql->bindValue(3, $alma_id);       
        $sql->bindValue(4, $repu_stock);
        $sql->bindValue(5, $repu_precio_unitario);
       // $sql->bindValue(7, $repu_stock_total);
        $sql->bindValue(6, $repu_ultimo_ingreso);
        $sql->bindValue(7, $unme_id);
        $sql->bindValue(8, $repu_situacion);
        $sql->bindValue(9, $repu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }


    public function listar_UnidadMedidad()
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                tb_unidad_medida.unme_id,
                tb_unidad_medida.unme_codigo,
                 tb_unidad_medida.unme_descripcion
                FROM sc_residuos_solidos.tb_unidad_medida where unme_estado=1";
        $sql = $conx->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function listar_respuesto()
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "SELECT tb_repuesto.repu_id,
                        tb_repuesto.repu_codigo,
	                    tb_repuesto.repu_descripcion,
	                    tb_repuesto.alma_id,
	                    
	                    tb_repuesto.repu_stock,
	                    tb_repuesto.repu_stock_total,
	                    tb_repuesto.repu_ultimo_ingreso,
	                    tb_repuesto.repu_situacion,
                        tb_repuesto.unme_id
	            FROM sc_residuos_solidos.tb_repuesto where repu_estado=1
                ORDER BY repu_id desc";
        $sql = $conx->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_respuesto_x_id($repu_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "UPDATE sc_residuos_solidos.tb_repuesto
	            SET repu_estado=0
	            WHERE repu_id=?";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $repu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function mostrar_editar($repu_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_repuesto where repu_id =? and repu_estado=1";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $repu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_respondableAlmacen()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT alma_id, alma_responsable FROM sc_residuos_solidos.tb_almacen where alma_estado=1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function combo_unidad_medida()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_unidad_medida where unme_estado=1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function ultimoStock($repu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT tb_repuesto.repu_stock 
	        FROM sc_residuos_solidos.tb_repuesto  where repu_estado=1 and repu_id=?
	        ORDER BY repu_id DESC LIMIT 1 ";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $repu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function eliminarMedida($unme_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "UPDATE  sc_residuos_solidos.tb_unidad_medida
	            SET unme_estado=0
	            WHERE unme_id=?";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $unme_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }




    public function insert_unidad_medida(
        $unme_codigo,
        $unme_descripcion
      
    ) {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_residuos_solidos.tb_unidad_medida(unme_codigo, unme_descripcion,unme_estado)
	            VALUES (?,?,1);";



        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $unme_codigo);
        $sql->bindValue(2, $unme_descripcion);
       
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_unidad_medida(
        $unme_id,
        $unme_codigo,
        $unme_descripcion
      
    ) {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "UPDATE sc_residuos_solidos.tb_unidad_medida
	         SET 
             unme_codigo=?,
             unme_descripcion=?
           
	      WHERE unme_id=?";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $unme_codigo);
        $sql->bindValue(2, $unme_descripcion);
  
        $sql->bindValue(3, $unme_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }



    public function mostrar_unidad_medida($unme_id)
    {
        $conx = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_unidad_medida where unme_id =? and unme_estado=1";
        $sql = $conx->prepare($sql);
        $sql->bindValue(1, $unme_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function combo_stok_repuesto()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_repuesto where repu_estado=1 order by repu_id desc ";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_repuestostock_x_id($repu_descripcion){
        $conectar = parent::conexion(); 
        parent::set_names();
        $sql = "SELECT  
                        tb_repuesto.repu_id,
                        tb_repuesto.repu_codigo,
		                tb_repuesto.repu_descripcion,
		                tb_repuesto.repu_stock,
		                tb_repuesto.repu_ultimo_ingreso,
		                tb_repuesto.repu_situacion
	                                from sc_residuos_solidos.tb_repuesto 
                                    where tb_repuesto.repu_descripcion=? 
                                    and tb_repuesto.repu_estado=1 ";
          

        $sql = $conectar->prepare($sql); //preparamos la sentencia
        $sql->bindValue(1, $repu_descripcion);    //obtenemos el parametro 
        $sql->execute();               //lo ejecutamos
        $resultado = $sql->fetchAll();   //lo guardamos en una variable
        return $resultado;              //retornamos los resultados
    }

}