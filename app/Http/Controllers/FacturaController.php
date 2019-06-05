<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\fac_enc;
use App\fac_det;
use App\Cliente;
use App\VistaProducto;


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
        $productos = VistaProducto::all();
        return view('facturas.create',compact('facturas','clientes','productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //return $request->all();
      $factura_enc = new fac_enc;
      $factura_det = new fac_det;
      $factura_enc->numero = $request->input('nofac');
      $factura_enc->id_cliente = $request->input('idcliente');
      $factura_enc->save();
      foreach ($factura_det as $detalle) {
        $detalle->id_fac_enc = $request->input('nofac');
        $detalle->id_producto = $request->input('idproducto[]');
        $detalle->cantidad = $request->input('cantproducto[]');
        $detalle->save();
      }
      return redirect()->action('FacturaController@index');
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
