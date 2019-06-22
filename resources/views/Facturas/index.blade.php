@extends('layouts.facturas')
@section('title',' - Listado')
@section('content')
<a href=" {{ action('FacturaController@create') }} " class="btn btn-primary">Crear</a><br><br>
<table class="table table-striped">
	<thead>
		<td class="text-left">Serie</td>
		<td class="text-left">No.</td>
		<td class="text-left">Cliente</td>
		<td class="text-left">Total</td>
		<td class="text-center" colspan="3">Acción</td>
	</thead>
	<tbody>
		@foreach ($facturas as $factura)
		<tr>
			<td>{{$factura->serie}}</td>
			<td>{{$factura->id_fac_enc}}</td>
			<td>{{$factura->nombre}}</td>
			<td>{{$factura->total}}</td>
			<th><a href="/facturas/{{$factura->id_fac_enc}}" class="btn btn-info">Ver</a></th>
			<td><a href="/facturas/{{$factura->id_fac_enc}}/edit" class="btn btn-warning">Editar</a></td>
			<form action="/facturas/{{$factura->id_fac_enc}}" method="post">
				@csrf
				@method('DELETE')
				<th><button class="btn btn-danger" type="submit">Eliminar</button></th>
			</form>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
