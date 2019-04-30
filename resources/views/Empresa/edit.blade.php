@extends('layouts.empresa')
@section('content')
<form action="/empresa/{{$empresa->id_empresa}}" method="post">
	@csrf
	@method('PUT')
	<table class="table table-striped">
		<tr><td><label for="nombre">Nombre</label></td><td><input type="text" name="nombre" value="{{$empresa->nombre}}" class="form-control"></td></tr>
		<tr><td><label for="nit">Nit</label></td><td><input type="text" name="nit" value="{{$empresa->nit}}" class="form-control"></td></tr>
		<tr><td><label for="direccion">Dirección</label></td><td><input type="text" name="direccion" value="{{$empresa->direccion}}" class="form-control"></td></tr>
		<tr><td><label for="telefono">Teléfono</label></td><td><input type="text" name="telefono" value="{{$empresa->telefono}}" class="form-control"></td></tr>
		<tr><td><label for="correo">Correo</label></td><td><input type="text" name="correo" value="{{$empresa->correo}}" class="form-control"></td></tr>
		<tr><td><label for="contacto_nombre">Nombre del Contacto</label></td><td><input type="text" name="contacto_nombre" value="{{$empresa->contacto_nombre}}" class="form-control"></td></tr>
		<tr><td><label for="contacto_telefono">Teléfono del Contacto</label></td><td><input type="text" name="contacto_telefono" value="{{$empresa->contacto_telefono}}" class="form-control"></td></tr>
		<tr><td><label for="contacto_correo">Correo del Contacto</label></td><td><input type="text" name="contacto_correo" value="{{$empresa->contacto_correo}}" class="form-control"></td></tr>
		<tr><td><label for="iva_producto">IVA del Producto</label></td><td><input type="text" name="iva_producto" value="{{$empresa->iva_producto}}" class="form-control"></td></tr>
		<tr><td><label for="iva_servicio">IVA del Servicio</label></td><td><input type="text" name="iva_servicio" value="{{$empresa->iva_servicio}}" class="form-control"></td></tr>
	</table>
	<button class="btn btn-success" type="submit">Actualizar</button>
</form>
@endsection