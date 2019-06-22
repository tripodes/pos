@extends('layouts.facturas')
@section('content')
	<div class="col-md-6">
		<div class="form-group">
			@foreach ($factura as $factu)
			<div class="d-flex justify-content-between">
				<div class="col-md-12">
					<label for="cliente">Cliente</label>
					<input type="text" name="" value="{{$factu->nombre}}" class="form-control" disabled>
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<div class="col-md-4">
					<label for="nit">Nit</label>
					<input type="text" name="nit" class="form-control" value="{{$factu->nit}}" disabled>
				</div>
				<div class="col-md-8">
					<label for="dir">Direccion</label>
					<input type="text" name="dir" class="form-control" value="{{$factu->direccion}}" disabled>
				</div>
			</div>
			@endforeach
		</div>
		<table class="table">
			<thead>
				<td>Cantidad</td>
				<td>Descripcion</td>
				<td>Precio</td>
			</thead>
			<tbody>
				@foreach ($detalles as $detalle)
				<tr>
					<td>{{$detalle->cantidad}}</td>
					<td>{{$detalle->categoria}} {{$detalle->producto}} Marca {{$detalle->marca}}</td>
					<td>Q{{$detalle->precio_venta}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row justify-content-between container">
			<div>Total</div>
			<div></div>
			<div><td>Q{{$detalle->total}}</td></div>
		</div>
		<a href=" {{ action('FacturaController@index') }} " class="btn btn-secondary">Regresar</a>
	</div>
@endsection
