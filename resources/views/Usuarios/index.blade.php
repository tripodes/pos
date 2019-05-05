@extends('layouts.usuarios')
@section('title',' - Listado')
@section('content')
<div class="row justify-content-end">
		<a href="/usuarios/create" class="btn btn-primary">Crear</a>
</div>
	<table class="table table-striped">
		<thead>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Dirección</th>
			<th>Teléfono</th>
			<th>Perfil</th>
			<th>Acciones</th>
		</thead>
		<tbody>
			<tr>
				@foreach($users as $usuario)
				<td>{{$usuario->nombres }}</td>
				<td>{{$usuario->apellidos }}</td>
				<td>{{$usuario->direccion }}</td>
				<td>{{$usuario->telefono }}</td>
				<td>{{$usuario->roles->implode('name',',') }}</td>
				<td>
					<div class="justify-content-end">
						<a href=" {{ url('/usuarios/'.$usuario->usuario) }} " class="btn btn-info">Ver</a>
						<a href="{{ url('/usuarios/'.$usuario->usuario.'/edit') }}" class="btn btn-warning">Editar</a>
						<form action="/usuarios/{{$usuario->usuario}}" method="post" class="" style="display: inline-block;">
							@csrf
							@method('DELETE')
								<button type="submit" name="button" class="btn btn-danger">Eliminar</button>
						</form>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection
