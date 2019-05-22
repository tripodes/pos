@extends('layouts.clientes')
@section('title',' - Listado')
@section('content')
<a href=" {{ action('clientecontroller@create') }} " class="btn btn-primary">Crear</a><br><br>
<table class="table table-striped">
	<thead>
		<td class="text-left">Numero de nit</td>
		<td class="text-left">Nombre del cliente</td>
		<td class="text-left">Direccion</td>
		<td class="text-left">Numero telefonico</td>
		<td class="text-center" colspan="3">Acción</td>
	</thead>
	<tbody>
		@foreach ($clientes as $cliente)
		<tr>
			<td>{{$cliente->nit}}</td>
			<td>{{$cliente->nombre}}</td>
			<td>{{$cliente->direccion}}</td>
			<td>{{$cliente->telefono}}</td>
			<td><a href="/clientes/{{$cliente->id_cliente}}" class="btn btn-info">Ver</a></td>
			<td><a href="/clientes/{{$cliente->id_cliente}}/edit" class="btn btn-warning">Editar</a></td>
			<form action="/clientes/{{$cliente->id_cliente}}" method="post">
				@csrf
				@method('DELETE')
				<th><button class="btn btn-danger" type="submit">Eliminar</button></th>
			</form>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection