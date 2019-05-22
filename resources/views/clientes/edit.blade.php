@extends('layouts.clientes')
@section('title',' - Editar')
@section('content')
<div class="row">
	<div class="col-md">
		<form action="/clientes/{{$cliente->id_cliente}}" method="post">
			@csrf
			@method('PUT')
			<div class="form-group col-md">
							
				<label for="nit">Numero de Nit</label>
				<input type="text" name="nit" class="form-control" value="{{$cliente->nit}}">

				<label for="nombre">Nombre del Cliente</label>
				<input type="text" name="nombre" class="form-control" value="{{$cliente->nombre}}">

				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}">

				<label for="telefono">Numero telefonico</label>
				<input type="numerico" name="telefono" class="form-control" value="{{$cliente->telefono}}">

			
			</div>
			<div class="form-group col-md">
				<label for="activo">Activo</label>
				@if ($cliente->activo == 1)<input type="checkbox" name="activo" checked="">
				@else <input type="checkbox" name="activo" {{ old('activo') ? 'checked' : '' }} >
       			@endif
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection