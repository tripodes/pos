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
        $facturas = DB::table('fac_enc as fe')
                    ->join('cliente as cli','cli.id_cliente','fe.id_cliente')
                    ->select('serie','id_fac_enc','nombre','total')
                    ->orderBy('id_fac_enc')
                    ->get();
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
        $correlativo = DB::table('fac_enc')->max('id_fac_enc');
        return view('facturas.create',compact('facturas','clientes','productos','correlativo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $factura_enc = new fac_enc;
      $factura_enc->numero = $request->input('nofac');
      if ($request->input('cliente') == '0') {
        $cliente = 7;
      }else{
        $cliente = $request->input('idcliente');
      }

      $factura_enc->id_cliente = $cliente;
      $factura_enc->total = $request->input('total');
      $factura_enc->save();

      $id_producto = $_POST['idproducto'];
			$cant_producto = $_POST['cantproducto'];

			$array_id=array();
			$array_cant=array();

			foreach($id_producto as $fila_id => $valor_id) {
				array_push($array_id, $valor_id) ;
			}
			foreach($cant_producto as $fila_cant => $valor_cant) {
				array_push($array_cant, $valor_cant) ;
			}

      for ($i=0; $i < count($request->input('idproducto')) ; $i++) {
          $factura_det = new fac_det;
          $factura_det->id_fac_enc = $request->input('nofac');
          $factura_det->id_producto = $array_id[$i];
          $factura_det->cantidad = $array_cant[$i];
          $factura_det->save();
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
        $factura = DB::table('fac_enc as fe')
                    ->join('cliente as cli','cli.id_cliente','=','fe.id_cliente')
                    ->select('fe.id_fac_enc','nit','nombre','direccion')
                    ->where('fe.id_fac_enc','=',$id)
                    ->get();
        $detalles = DB::table('fac_enc as fe')
                    ->join('fac_det as fd','fe.id_fac_enc','=','fd.id_fac_enc')
                    ->join('producto as p','p.id_producto','=','fd.id_producto')
                    ->join('marca as m','m.id_marca','=','p.id_marca')
                    ->join('categoria as c','c.id_categoria','=','p.id_categoria')
                    ->where('fd.id_fac_enc','=',$id)
                    ->select('cantidad','c.descripcion as categoria','p.descripcion as producto','m.descripcion as marca','precio_venta','fe.total')
                    ->get();
        return view('Facturas.show', compact('factura','detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $factura = DB::table('fac_enc as fe')
                  ->join('cliente as cli','cli.id_cliente','=','fe.id_cliente')
                  ->where('fe.id_fac_enc','=',$id)
                  ->select('fe.id_fac_enc as id_fac_enc','cli.id_cliente','nit','nombre','direccion')
                  ->get();
      $detalles = DB::table('fac_enc as fe')
                  ->join('fac_det as fd','fe.id_fac_enc','=','fd.id_fac_enc')
                  ->join('producto as p','p.id_producto','=','fd.id_producto')
                  ->join('marca as m','m.id_marca','=','p.id_marca')
                  ->join('categoria as c','c.id_categoria','=','p.id_categoria')
                  ->where('fd.id_fac_enc','=',$id)
                  ->select('cantidad','c.descripcion as categoria','fd.id_producto','p.descripcion as producto','m.descripcion as marca','precio_venta','fe.total')
                  ->get();
      return view('Facturas.edit', compact('factura','detalles'));
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
      return $request;
      /* Actualizacion de datos existentes*/
      $id_producto = $_POST['idproducto'];
      $cant_producto = $_POST['cantidad'];
      $cant_vieja = $_POST['cantvieja'];

      $array_id=array();
      $array_cant=array();
      $array_cvieja=array();

      foreach($id_producto as $fila_id => $valor_id) {
        array_push($array_id, $valor_id) ;
      }
      foreach($cant_producto as $fila_cant => $valor_cant) {
        array_push($array_cant, $valor_cant) ;
      }
      foreach($cant_vieja as $fila_canti => $valor_canti) {
        array_push($array_cvieja, $valor_canti) ;
      }

      for ($i=0; $i < count($request->input('idproducto')) ; $i++) {
          DB::table('producto')->where('id_producto','=',$array_id[$i])->increment('existencia', $array_cvieja[$i]);
          DB::table('producto')->where('id_producto','=',$array_id[$i])->decrement('existencia', $array_cant[$i]);
          DB::table('fac_det')->where('id_fac_enc','=',$request->input('idfactura'))->where('id_producto','=',$array_id[$i])->update(['cantidad' => $array_cant[$i]]);
      }

      /* Insercion de datos */
      if ($request->has('idsproducto')) {
        $ids_producto = $_POST['idsproducto'];
        $cantis_producto = $_POST['cantproducto'];

        $array_ids=array();
        $array_cantis=array();

        foreach($ids_producto as $fila_ids => $valor_ids) {
          array_push($array_ids, $valor_ids) ;
        }
        foreach($cantis_producto as $fila_cantis => $valor_cantis) {
          array_push($array_cantis, $valor_cantis) ;
        }

        for ($i=0; $i < count($request->input('idsproducto')) ; $i++) {
          DB::table('fac_det')->updateOrInsert(['id_producto' => $array_ids[$i], 'id_fac_enc' => $request->input('idfactura')],['cantidad' => $array_cantis[$i]]);
          DB::table('producto')->where('id_producto','=',$array_ids[$i])->decrement('existencia', $array_cantis[$i]);
          // DB::table('producto')->where('id_producto','=',$array_ids[$i])->increment('existencia', $array_cvieja[$i]);
        }
      }


      return redirect()->action('FacturaController@index');
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
