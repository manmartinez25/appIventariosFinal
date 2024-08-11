<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Throwable;

class ProductController extends Controller
{
    public function gestProducts(){
        $datosProduc=DB::select("SELECT * FROM producto");
        return view("gestProducts", ["datosProduc" => $datosProduc]);
    }

    public function createProd(Request $request){
        Log::info('updateVenta request parameters', $request->all());

        try{
            $sql= DB::insert("INSERT INTO producto(nombre_prod,tipo_prod,descripcion,precio,stock,marca) VALUES(?,?,?,?,?,?)",[
                $request->txtnombreProducto,
                $request->txttipoProducto,
                $request->txtdescripciónProd,
                $request->txtprecioProd,
                $request->txtstockProd,
                $request->txtmarcaProd
            ]);
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

    public function updateProd(Request $request){
        try{
            $sql= DB::update("UPDATE producto SET nombre_prod=?,tipo_prod=?,descripcion=?,precio=?,stock=?,marca=? WHERE id=?",[
                $request->txtnombreProducto,
                $request->txttipoProducto,
                $request->txtdescripciónProd,
                $request->txtprecioProd,
                $request->txtstockProd,
                $request->txtmarcaProd,
                $request->txtidProducto
            ]);
            if($sql==0){
                $sql=1;
            }
        }catch (\Throwable $th){
            $sql= 0;
        }
        if($sql== true){
            return back()->with("correcto","Producto modificado correctamente");
        }else{
            return back()->with("incorrecto","Error al modificar");
        }
    }

    public function deleteProd($id) {
        try{
            $sql= DB::delete("DELETE FROM producto WHERE id=$id");               ;
        }catch (\Throwable $th){
            $sql= 0;
        }
        if($sql== true){
            return back()->with("correcto","Producto eliminado correctamente");
        }else{
            return back()->with("incorrecto","Error al eliminar");
        }
    }
}

