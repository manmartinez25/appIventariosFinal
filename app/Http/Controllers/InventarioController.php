<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\LOG;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class InventarioController extends Controller
{
    public function gestInventario(){
        $datosProduc=DB::select("SELECT * FROM producto");
        return view("inventario", ["datosProduc" => $datosProduc]);  
    }

    public function gestInvIngreso(){
        $datosIngresos=DB::select("SELECT * FROM produccion_compras");
        return view("tablaIngreso", ["datosIngresos" => $datosIngresos]);  
    }
    
    public function gestInvVenta(){
        $datosVentas=DB::select("SELECT * FROM ventas");
        return view("tablaVenta", ["datosVentas" => $datosVentas]);  
    }

    public function gestInvClientes(){
        $datosClientes=DB::select("SELECT * FROM tercero");
        return view("tablaClientes", ["datosClientes" => $datosClientes]);  
    }

    public function filtrarFecha(Request $request){
        Log::info('Resultado de cantidad de request', ['request' => $request]);

       try {
        $fechaInicial = $request->txtFechaInicial;
        $fechaFinal = $request->txtFechaFinal;

        $datosIngresos = DB::select("SELECT * FROM produccion_compras WHERE fecha BETWEEN ? AND ?", [$fechaInicial, $fechaFinal]);
        Log::info('Resultado de consulta fecha', ['datosIngresos' => $datosIngresos]);
        return view("tablaIngreso", ["datosIngresos" => $datosIngresos]);
        if($datosIngresos==0){
            $datosIngresos=1;
        }
        }catch(\Throwable $th){
            $datosIngresos= 0;
        }      
        if($datosIngresos == 1){
            return back()->with("correcto","Ingreso registrado correctamnente");
        }else{
            return back()->with("incorrecto","Registro incorrecto");
        }
       
    }

    public function filtrarFechaVenta(Request $request){
        Log::info('Resultado de cantidad de request', ['request' => $request]);

       try {
        $fechaInicial = $request->txtFechaInicial;
        $fechaFinal = $request->txtFechaFinal;

        $datosVentas = DB::select("SELECT * FROM ventas WHERE fecha BETWEEN ? AND ?", [$fechaInicial, $fechaFinal]);
        Log::info('Resultado de consulta fecha', ['datosVentas' => $datosVentas]);
        return view("tablaVenta", ["datosVentas" => $datosVentas]);
        if($datosVentas==0){
            $datosVentas=1;
        }
        }catch(\Throwable $th){
            $datosVentas= 0;
        }      
        if($datosVentas == 1){
            return back()->with("correcto","Ingreso registrado correctamnente");
        }else{
            return back()->with("incorrecto","Registro incorrecto");
        }
       
    }
}


