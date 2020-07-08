<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Crud
 *
 * @author JuvenaL
 */
class Crud extends CI_Model {

    public function iniciarSesion($rut, $password) {
        $this->db->where("rut", $rut);
        $this->db->where("password", $password);
        return $this->db->get("usuario")->result();
    }

    public function addUsuario($rut, $nombre, $apellido_pat, $apellido_mat, $telefono, $institucion, $direccion, $password, $ciudad, $tipo, $idcuenta) {
        $fecha = strftime("%Y-%m-%d", time());   
        
        $datos = array(
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'telefono' => $telefono,
            'institucion' => $institucion,
            'direccion' => $direccion,
            'password' => sha1(md5($password)),
            'ciudad' => $ciudad,
            'tipo' => $tipo,
            'activo' => 'SI',
            'fecha' => $fecha,
            'cuenta_idcuenta' => $idcuenta
        );
        $this->db->insert('usuario', $datos);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function addCuenta($ncuenta) {
        $fecha = strftime("%Y-%m-%d", time());
        $datos = array(
            'ncuenta' => $ncuenta,
            'fecha' => $fecha,
            'saldo' => 32000
        );
        return $this->db->insert('cuenta', $datos);
    }

    public function addCategoria($nombre, $descripcion, $imagenCat) {
        $datos = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'imagenCat' => $imagenCat,
            'estado' => 'ACTIVO'
        );

        $this->db->insert('categoria', $datos);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getCuenta($ncuenta) 
    {
        $this->db->where('ncuenta', $ncuenta);
        return $this->db->get("cuenta")->result();
    }
    
    public function getCuentaId($idcuenta) 
    {
        $this->db->where('idcuenta', $idcuenta);
        return $this->db->get("cuenta")->result();
    }
    
    
   

    public function getUsuarios() {
        $query = ('SELECT * FROM usuario INNER JOIN cuenta on usuario.cuenta_idcuenta = cuenta.idcuenta ORDER BY cuenta_idcuenta DESC');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getCategorias() {
        $query = ('SELECT * FROM categoria ORDER BY idcategoria DESC');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function editarCategoria($idcategoria, $nombre, $descripcion) {

        $data = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion
        );

        $this->db->where('idcategoria', $idcategoria);
        $this->db->update('categoria', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
     public function eliminarCategoria($idcategoria) {
        $data = array(
            'estado' => 'INACTIVO'
        );
        $this->db->where('idcategoria', $idcategoria);
        $this->db->update('categoria', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function addProveedor($rut, $nombre, $apellido_pat, $apellido_mat, $telefono, $direccion, $ciudad) {
        
        $rut = str_replace('-', "", $rut);
        $rut = str_replace('.', "", $rut);
        $data = array(
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'estado' => 'ACTIVO'
        );

        $this->db->insert('proveedor', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getProveedores() {
        $query = ('SELECT * FROM proveedor ORDER BY idproveedor DESC');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function editProveedor($idproveedor, $rut, $nombre, $apellido_pat, $apellido_mat, $telefono, $direccion, $ciudad) {
        $data = array(
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'ciudad' => $ciudad
        );

        $this->db->where('idproveedor', $idproveedor);
        $this->db->update('proveedor', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function eliminarProveedor($idproveedor) {
        $data = array(
            'estado' => 'INACTIVO'
        );
        $this->db->where('idproveedor', $idproveedor);
        $this->db->update('proveedor', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function addProducto($nombre, $codigo, $stock, $p_compra, $p_venta, $descripcion, $imagen, $idcategoria, $idproveedor) {

        $fecha = strftime("%Y-%m-%d", time());

        $data = array(
            'nombre' => $nombre,
            'codigo' => $codigo,
            'stock' => $stock,
            'p_compra' => $p_compra,
            'p_venta' => $p_venta,
            'fecha' => $fecha,
            'estado' => 'ACTIVO',
            'descripcion' => $descripcion,
            'imagen' => $imagen,
            'categoria_idcategoria' => $idcategoria,
            'proveedor_idproveedor' => $idproveedor
        );
        $this->db->insert('producto', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function editProducto( $idproducto, $nombre, $codigo, $stock, $p_compra, $p_venta, $descripcion) {
    
        $datas = array(
            'nombre' => $nombre,
            'codigo' => $codigo,
            'stock' => $stock,
            'p_compra' => $p_compra,
            'p_venta' => $p_venta,   
            'descripcion' => $descripcion            
        );
        $this->db->where('idproducto', $idproducto);
        $this->db->update('producto', $datas);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function getProductos() {
        $query = ('SELECT *, producto.nombre AS productoNombre, producto.descripcion AS productoDescripcion, producto.estado AS productoEstado, proveedor.nombre AS proveedorNombre, proveedor.apellido_pat AS proveedorApellido_pat, proveedor.estado AS proveedorEstado, categoria.nombre AS categoriaNombre FROM producto INNER JOIN proveedor ON producto.proveedor_idproveedor = proveedor.idproveedor INNER JOIN categoria ON producto.categoria_idcategoria = categoria.idcategoria ORDER BY idproducto DESC');
        $res = $this->db->query($query);
        return $res->result();
    }
    
     public function eliminarProducto($idproducto) {
        $data = array(
            'estado' => 'INACTIVO'
        );
        $this->db->where('idproducto', $idproducto);
        $this->db->update('producto', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function listaProdCat($idcategoria)
    {
        $this->db->where('categoria_idcategoria', $idcategoria);
        return $this->db->get('producto')->result();
    }
    
    public function addCompra($totalU, $total, $largo, $idusuario) {
       $fecha = strftime("%Y-%m-%d", time());        
        $data = array(
            'nombre' => 'COMPRA CASINO',
            'fecha' => $fecha,
            'estado' => 'ACTIVA',
            'cantidad_u' => $totalU,
            'total' => $total,
            'cantidad_p' => $largo,
            'usuario_idusuario' => $idusuario
        );
        $this->db->insert('compra', $data);        
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function getProducto($idproducto)
    {
        $this->db->where('idproducto', $idproducto);
        return $this->db->get('producto')->result();
    }
    
    public function ultimaCompra() {
        $query = 'SELECT * FROM compra order by idcompra desc limit 1';
        $res = $this->db->query($query);
        return $res->result();
    }
    
    public function addDetalleCompra($precio, $descripcion, $nombre, $cantidad, $totalCompra, $ultimaCompra, $productosAgregados)
    {
        $fecha = strftime("%Y-%m-%d %H:%M:%S", time());   
        $data = array(
            'precio' => $precio,
            'fecha' => $fecha,
            'descripcion' => $descripcion,
            'nombreProducto' => $nombre,
            'cantidadProducto' => $cantidad,
            'totalCompra' => $totalCompra,
            'compra_idcompra' => $ultimaCompra,
            'producto_idproducto' => $productosAgregados
        );
        $this->db->insert('compra_detalle', $data);   
         return ($this->db->affected_rows() != 1) ? false : true;   
    }
    
    public function descontarStock($idproducto, $nuevoStock)
    {
        $data = array(
            'stock' => $nuevoStock
        );
        
        $this->db->where('idproducto', $idproducto);
        $this->db->update('producto', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function descontarSaldo($idcuenta, $nuevoSaldo)
    {
        $data = array(
            'saldo' => $nuevoSaldo
        );
        
        $this->db->where('idcuenta', $idcuenta);
        $this->db->update('cuenta', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function contarUsuarios() {
        $query = 'SELECT * FROM usuario;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }
    
    public function contarProductos() {
        $query = 'SELECT * FROM producto;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }
   
    public function contarCategorias() {
        $query = 'SELECT * FROM categoria;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }
    
    public function contarVentas() {
        $query = 'SELECT Sum(totalCompra) AS total FROM compra_detalle';
        $res = $this->db->query($query);
        $cont = $res->result();
        return $cont;
    }
    
    public function contarProveedores() {
        $query = 'SELECT * FROM proveedor;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }
    
    public function cantidadProdComprados() {
        $query = 'SELECT Sum(cantidadProducto) AS total FROM compra_detalle';
        $res = $this->db->query($query);
        $cont = $res->result();
        return $cont;
    }
    
    public function getInformeVentas($dia1, $mes1, $ano1, $dia2, $mes2, $ano2)
    {
        $query = 'SELECT compra.idcompra AS compraIdcompra, compra.nombre AS compraNombre, compra.fecha AS compraFecha, compra.cantidad_u AS compraCantidad_u, compra.total AS compraTotal, compra.cantidad_p AS compraCantidad_p, compra.usuario_idusuario AS compraUsuario_idusuario, usuario.idusuario AS usuarioIdusuario, usuario.rut AS usuarioRut, usuario.nombre AS usuarioNombre, usuario.apellido_pat AS usuarioApellido_pat, usuario.telefono AS usuarioTelefono, usuario.cuenta_idcuenta AS usuarioCuenta_idcuenta, cuenta.ncuenta AS cuentaNcuenta, cuenta.saldo AS cuentaSaldo FROM compra INNER JOIN usuario ON compra.usuario_idusuario = usuario.idusuario INNER JOIN cuenta ON usuario.cuenta_idcuenta = cuenta.idcuenta WHERE compra.fecha BETWEEN"' . $ano1 . $mes1 . $dia1 . '" AND "' . $ano2 . $mes2 . $dia2 . '" ORDER BY idcompra DESC';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }
    
    public function getUsuarioCuenta($idcuenta) 
    {
        $query = 'SELECT * FROM usuario INNER JOIN cuenta ON usuario.cuenta_idcuenta = cuenta.idcuenta WHERE usuario.cuenta_idcuenta = "'.$idcuenta.'"';
        $res = $this->db->query($query);
        return $res->result();     
    }
    
    public function getComprasUsuario($idusuario)
    {
        $this->db->where('usuario_idusuario', $idusuario);
        return $this->db->get('compra')->result();
    }
    
    public function getDetalleCompra($idcompra)
    {
        $this->db->where('compra_idcompra', $idcompra);
        return $this->db->get('compra_detalle')->result();
    }
    
    public function getProductosCat()
    {
        $query = ('SELECT producto.idproducto AS productoIdproducto, producto.nombre AS productoNombre, producto.descripcion AS productoDescripcion, producto.estado AS productoEstado, producto.codigo AS productoCodigo, producto.stock AS productoStock, producto.p_compra AS productoP_compra, producto.p_venta AS productoP_venta, producto.fecha AS productoFecha, proveedor.idproveedor AS proveedorIdproveedor, proveedor.rut AS proveedorRut, proveedor.nombre AS proveedorNombre, proveedor.apellido_pat AS proveedorApellido_pat, proveedor.direccion AS proveedorDireccion, proveedor.estado AS proveedorEstado, proveedor.telefono AS proveedorTelefono, proveedor.ciudad AS proveedorCiudad, categoria.idcategoria AS categoriaIdcategoria, categoria.nombre AS categoriaNombre, categoria.descripcion AS categoriaDescripcion FROM producto INNER JOIN proveedor ON producto.proveedor_idproveedor = proveedor.idproveedor INNER JOIN categoria ON producto.categoria_idcategoria = categoria.idcategoria ORDER BY idproducto DESC');
        $res = $this->db->query($query);
        return $res->result(); 
    }
    
    public function getCountCategorias($idcategoria)
    {
        $query = 'SELECT * FROM producto WHERE producto.categoria_idcategoria = "'.$idcategoria.'";';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }
    
    public function getAllProductos()
    {
        $query = ('SELECT * FROM producto');
        $res = $this->db->query($query);
        return $res->result(); 
    }
    
    public function addSaldo($idcuenta, $saldo)
    {
            $data = array(
            'saldo' => $saldo                      
        );
        $this->db->where('idcuenta', $idcuenta);
        $this->db->update('cuenta', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
  
    
   

}
