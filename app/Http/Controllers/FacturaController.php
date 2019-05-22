<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\fac_enc;
use App\Cliente;
use App\Producto;


class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = fac_enc::all();
        return view('facturas.index',compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facturas = fac_enc::all();
        $clientes = Cliente::all();
        $result = DB::table('fac_enc')
            ->select(DB::raw('id_fac_enc, 1 as nofac'))
            ->rightJoin('cliente', 'cliente.id_cliente', '=', 'fac_enc.id_cliente')
            ->groupBy('id_fac_enc')
            ->get();
        $productos = DB::table('producto')
        ->select(DB::raw('producto.id_producto as id, producto.descripcion as prod, marca.descripcion as marca, categoria.descripcion as categoria'))
            ->join('marca','marca.id_marca','=','producto.id_marca')
            ->join('categoria','categoria.id_categoria','=','producto.id_categoria')
            //->select('producto.id_producto as id', 'producto.descripcion as prod', 'marca.descripcion as marca', 'categoria.descripcion as categoria')
            ->where('producto.descripcion', 'like', '%%')
            ->orWhere('marca.descripcion', 'like', '%%')
            ->orWhere('categoria.descripcion', 'like', '%%')
            ->get();
        return view('facturas.create',compact('facturas','clientes','result','productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
