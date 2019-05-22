@extends('layouts.clientes')
@section('title',' - Crear')
@section('content')
<div class="row">
	<div class="col-md">
		<form action="/clientes" method="post">
			@csrf
			<div class="form-group">
				<label for="nit">Numero de Nit</label>
				<input type="text" name="nit" class="form-control">
				<label for="nombre">Nombre del Cliente</label>
				<input type="text" name="nombre" class="form-control">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" class="form-control">
				<label for="telefono">Numero telefonico</label>
				<input type="numerico" name="telefono" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection