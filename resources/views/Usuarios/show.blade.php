@extends('layouts.usuarios')
@section('content')
	<table class="table table-striped">
				<tr><td>Nombres</td><td>{{ $usuario->nombres }}</td></tr>
				<tr><td>Apellidos</td><td>{{ $usuario->apellidos }}</td></tr>
				<tr><td>Dirección</td><td>{{ $usuario->direccion }}</td></tr>
				<tr><td>Teléfono</td><td>{{ $usuario->telefono }}</td></tr>
				<tr><td>Usuario</td><td>{{ $usuario->usuario }}</td></tr>
				<tr><td>Correo</td><td>{{ $usuario->email }}</td></tr>
				<tr><td>Perfil</td><td>{{ $usuario->roles->implode('name',',') }}</td></tr>
	</table>
	<a href=" {{url(action('UserController@index'))}}" class="btn btn-secondary">Regresar</a>
@endsection
