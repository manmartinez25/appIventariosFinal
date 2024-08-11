<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


use function Laravel\Prompts\select;

class IngrController extends Controller
{
    public function ingresoProducts(){
        $datosProd=DB::select("SELECT * FROM producto");
        $datosIngresos=DB::select("SELECT * FROM produccion_compras");
        return view("ingresoProducts", ["datosIngresos" => $datosIngresos, "datosProd"=>$datosProd]);
    }

    public function createIngr(Request $request){
        Log::info('Resultado solicitud crear ingreso');
        try{
            $sql = DB::insert("INSERT INTO produccion_compras(num_lote,fecha,tipo_prod,cantidad,id_Producto) VALUES (?,?,?,?,?)",[
                $request->txtLoteIngreso,
                $request->txtFecha,
                $request->txtTipoProd,
                $request->txtCantidad,
                $request->txtIdProd
            ]);
            $this->updateCantidadProd($request);
            Log::info('resultado inserción ingreso',['datosIngreso' => $request]);
            if($sql==0){
                $sql=1;
            }
        }catch(\Throwable $th){
            $sql= 0;
        }      
        if($sql == 1){
            return back()->with("correcto","Ingreso registrado correctamnente");
        }else{
            return back()->with("incorrecto","Registro incorrecto");
        }
    }

    public function updateCantidadProd(Request $request){
        $totalProdActulizado = 0;
        $stock = DB::select("SELECT stock FROM producto WHERE id=$request->txtIdProd");
        $stockActual = $stock[0]->stock; // Accede al stock actual del primer resultado
        $totalProdActulizado = $request->txtCantidad + $stockActual;
        $productoActualizado = DB::update("UPDATE producto SET stock=? WHERE id=?",[
            $totalProdActulizado,
            $request->txtIdProd
        ]);
    } 

    public function updateIngr(Request $request){
        try {
            $valorCantidadSinModificar = DB::select("SELECT cantidad FROM produccion_compras WHERE id=?",[
                $request->txtidIngreso
            ]);
            $valorCantidadPrevio = $valorCantidadSinModificar[0]->cantidad; // Accede al stock actual del primer resultado

            $sql = DB::update("UPDATE produccion_compras SET num_lote=?,cantidad=? WHERE id=?",[
                $request->txtLoteIngreso,
                $request->txtCantidad,
                $request->txtidIngreso
            ]);
            $this->correccionCantidadProd($request,$valorCantidadPrevio);
            if($sql==0){
                $sql=1;
            }        
        } catch (\Throwable $th) {
            Log::error('Error en la actualización:', ['error' => $th->getMessage()]);
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

        $totalProdCorreccion = 0;
        $stock = DB::select("SELECT stock FROM producto WHERE id=$request->txtIdProduct");
        $stockActual = $stock[0]->stock; // Accede al stock actual del primer resultado
        Log::info('Valor de $sql después de la actualización:', ['stockActual' => $stock]);

        if($request->txtCantidad != $valorCantidadPrevio){
            if($request->txtCantidad > $valorCantidadPrevio){
                $valorCorreccion = $request->txtCantidad - $valorCantidadPrevio;
                $totalProdCorreccion = $valorCorreccion + $stockActual;
                Log::info('Resultado de cantidad if',['totalProdCorreccion' => $totalProdCorreccion]);

            }else{
                $valorCorreccion = $valorCantidadPrevio - $request->txtCantidad;
                $totalProdCorreccion = $stockActual - $valorCorreccion;
                Log::info('Resultado de cantidad else',['totalProdCorreccion' => $totalProdCorreccion]);

        }}
        $productoActualizado = DB::update("UPDATE producto SET stock=? WHERE id=?",[
            $totalProdCorreccion,
            $request->txtIdProduct
        ]);
    } 
    
}
