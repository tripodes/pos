@extends('layouts.categorias')
@section('title',' - Listado')
@section('content')
<a href=" {{ action('CategoriaController@create') }} " class="btn btn-primary">Crear</a><br><br>
<table class="table table-striped">
	<thead>
		<td class="text-left">No.</td>
		<td class="text-left">Descripción</td>
		<td class="text-center" colspan="3">Acción</td>
	</thead>
	<tbody>
		@foreach ($categorias as $categoria)
		<tr>
			<td>{{$categoria->id_categoria}}</td>
			<td>{{$categoria->descripcion}}</td>
			<td><a href="/categorias/{{$categoria->id_categoria}}" class="btn btn-info">Ver</a></td>
			<td><a href="/categorias/{{$categoria->id_categoria}}/edit" class="btn btn-warning">Editar</a></td>
			<form action="/categorias/{{$categoria->id_categoria}}" method="post">
				@csrf
				@method('DELETE')
				<th><button class="btn btn-danger" type="submit">Eliminar</button></th>
			</form>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection