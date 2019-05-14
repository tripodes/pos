@extends('layouts.categorias')
@section('title',' - Editar')
@section('content')
<div class="row">
	<div class="col-md">
		<form action="/categorias/{{$categoria->id_categoria}}" method="post">
			@csrf
			@method('PUT')
			<div class="form-group col-md">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" class="form-control" value="{{$categoria->descripcion}}">
			</div>
			<div class="form-group col-md">
				<label for="activo">Activo</label>
				@if ($categoria->activo == 1)<input type="checkbox" name="activo" checked="">
				@else <input type="checkbox" name="activo" {{ old('activo') ? 'checked' : '' }} >
       			@endif
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection