@extends('layouts.empresa');
@section('content')

	<body>
		<div class="row col-md-8">
		<table class="table table-striped">
			@foreach($empresa as $emp)
				<tr><td>Nombre</td><td>{{ $emp->nombre }}</td></tr>
				<tr><td>Nit</td><td>{{ $emp->nit }}</td></tr>
				<tr><td>Dirección</td><td>{{ $emp->direccion }}</td></tr>
				<tr><td>Teléfono</td><td>{{ $emp->telefono }}</td></tr>
				<tr><td>Correo</td><td>{{ $emp->correo }}</td></tr>
				<tr><td>Nombre del Contacto</td><td>{{ $emp->contacto_nombre }}</td></tr>
				<tr><td>Correo del Contacto</td><td>{{ $emp->contacto_correo }}</td></tr>
				<tr><td>IVA</td><td>{{ $emp->iva_producto }}</td></tr>
				<tr><td>Ganancia</td><td>{{ $emp->iva_servicio }}</td></tr>
			@endforeach
		</table>
			<a href="/empresa/{{$emp->id_empresa}}/edit" class="btn btn-primary">Editar</a>
		</div>
	</body>
@endsection