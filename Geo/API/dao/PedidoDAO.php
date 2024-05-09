<?php

require("./modelo/Pedido.php");
require("./modelo/Producto.php");
require("./modelo/DetallePedido.php");
require_once("./dao/factoryBD.php");

class PedidoDAO{

    public static function findAll(){
        $sql = "select * from Pedido";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql,$parametros);
        $arrayPedidos = array();
        while ($pedidoStd = $result->fetchObject()) {
            $pedido = new Pedido(
                $pedidoStd->Id,
                $pedidoStd->Fecha,
                $pedidoStd->Direccion,
                $pedidoStd->PagoTotal,
                $pedidoStd->Borrado,
                $pedidoStd->contrasena
            );
            array_push($arrayPedidos, $pedido);
        }
        return $arrayPedidos;
    }
    public static function ultimoIDpedido() {
        $sql = "SELECT * FROM Pedido ORDER BY Id DESC LIMIT 1";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $ultimoPedido = $result->fetchObject();
        return $ultimoPedido;
    }

    
    public static function insert($pedido, $detalle) {
  
            $sqlPedido = "INSERT INTO Pedido (Fecha, Direccion, PagoTotal, Borrado) VALUES (?, ?, ?, ?)";
            $parametrosPedido = array(
                $pedido->Fecha,
                $pedido->Direccion,
                $pedido->PagoTotal,
                $pedido->Borrado
            );
            $pedidoInsertado=FactoryBd::realizarConsulta($sqlPedido, $parametrosPedido);
    
            $ultimoPedido = self::ultimoIDpedido();
            $ultimoId = $ultimoPedido->Id;
    
            $sqlDetalle = "INSERT INTO DetallePedido (IdPedido, IdProducto, Cantidad, PrecioUnidad, Total, Borrado) VALUES (?, ?, ?, ?, ?, ?)";
            $parametrosDetalle = array(
                $ultimoId,
                $detalle->IdProducto,
                $detalle->Cantidad,
                $detalle->PrecioUnidad,
                $detalle->Total,
                $detalle->Borrado
            );
            $detalleInsertado=FactoryBd::realizarConsulta($sqlDetalle, $parametrosDetalle);
           if($pedidoInsertado && $detalleInsertado){
            return true;
           }
    }
    
}
    





    


?>