<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function gestVentas(){
        $datosProd=DB::select("SELECT * FROM producto");
        $datosVentas=DB::select("SELECT * FROM ventas");
        return view("ventas", ["datosVentas" => $datosVentas, "datosProd"=>$datosProd]);
    }

    public function createVenta(Request $request){
            $valorTotalVenta = $request->txtPrecioVenta * $request->txtCantidadVenta;
            $sql= DB::insert("INSERT INTO ventas(nombre_prod,marca,precio,cantidad,fecha,nombre_tercero,
            identificacion_tercero,correo,direccion,tipo_tercero,id_producto,total_venta,telefono) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)",[
                $request->txtNomProdVenta,
                $request->txtMarcaVenta,
                $request->txtPrecioVenta,
                $request->txtCantidadVenta,
                $request->txtFechaVenta,
                $request->txtNombreVenta,
                $request->txtIdentificacionVenta,
                $request->txtCorreoVenta,
                $request->txtDireccionVenta,
                $request->txtTipoVenta,
                $request->txtIdProductoVenta,
                $valorTotalVenta,
                $request->txtTelefonoVenta
            ]);
            $this->updateCantidadProd($request);

        if($sql== true){
            return back()->with("correcto","Producto registrado correctamente");
        }else{
            return back()->with("incorrecto","Error al registrar");
        }
    }

    public function añadirCliente(Request $request){
        try {
            $sql = DB::insert("INSERT INTO tercero(nombre,identificacion,correo,telefono,direccion,tipoTercero,id_ventas) VALUES (?,?,?,?,?,?,?)",[
                $request->txtNombreTer,
                $request->txtIdentificacionTer,
                $request->txtCorreoTer,
                $request->txtTelefonoTer,
                $request->txtDireccionTer,
                $request->txtTipoTer,
                $request->txtidVentaTer
            ]);
        } catch (\Throwable $th) {
            $sql =0;
        }
        if($sql==1){
            return back()->with("correcto","Registrado modificado correctamnente");
        }else{
            return back()->with("incorrecto","Modificiación incorrecta");
        }
    }

    public function updateCantidadProd(Request $request){
        $totalProdActulizado = 0;
        $stock = DB::select("SELECT stock FROM producto WHERE id=$request->txtIdProductoVenta");
        $stockActual = $stock[0]->stock; // Accede al stock actual del primer resultado
        $totalProdActulizado = $stockActual - $request->txtCantidadVenta;
        $productoActualizado = DB::update("UPDATE producto SET stock=? WHERE id=?",[
            $totalProdActulizado,
            $request->txtIdProductoVenta
        ]);
    } 

    public function updateVenta(Request $request){
        try {
            $valorCantidadSinModificar = DB::select("SELECT cantidad FROM ventas WHERE id=?",[
                $request->txtidVenta
            ]);
            $valorCantidadPrevio = $valorCantidadSinModificar[0]->cantidad; // Accede al stock actual del primer resultado


            Log::info('updateVenta request parameters', $request->all());
            $sql = DB::update("UPDATE ventas SET cantidad=? WHERE id=?",[
                $request->txtProCant,
                $request->txtidVenta
            ]);

            //Log::info('Ventas actualizadas', ['sql' => $sql]);
            $this->correccionCantidadProd($request,$valorCantidadPrevio);

            if($sql==0){
                $sql=1;
            }        
        } catch (\Throwable $th) {
            Log::error('Error en updateVenta', ['exception' => $th]);

            $sql =0;
        }
        if($sql==1){
            return back()->with("correcto","Registrado modificado correctamnente");
        }else{
            return back()->with("incorrecto","Modificiación incorrecta");
        }
    }

    public function correccionCantidadProd(Request $request,$valorCantidadPrevio){
        Log::info('Resultado de cantidad de producto', ['cantidad' => $valorCantidadPrevio]);

        $totalProdCorreccion=0;
        $stock = DB::select("SELECT stock FROM producto WHERE id=$request->txtIdProd");

        Log::info('Resultado de stock de producto', ['stock' => $stock]);

        $stockActual = $stock[0]->stock; // Accede al stock actual del primer resultado
        
        if($request->txtProCant != $valorCantidadPrevio){
            if($request->txtProCant > $valorCantidadPrevio){
                $valorCorreccion = $request->txtProCant - $valorCantidadPrevio;
                $totalProdCorreccion = $stockActual - $valorCorreccion;
                Log::info('Resultado de if', ['totalProdCorreccion' => $totalProdCorreccion]);

            }else{
                $valorCorreccion = $valorCantidadPrevio - $request->txtProCant;
                $totalProdCorreccion = $stockActual + $valorCorreccion;
                Log::info('Resultado de else', ['totalProdCorreccion' => $totalProdCorreccion]);
        }}
        $productoActualizado = DB::update("UPDATE producto SET stock=? WHERE id=?",[
            $totalProdCorreccion,
            $request->txtIdProd
        ]);
    } 
}
