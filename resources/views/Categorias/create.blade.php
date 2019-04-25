@extends('layouts.categorias')
@section('title',' - Crear')
@section('content')
<div class="row">
	<div class="col-md">
		<form action="/categorias" method="post">
			@csrf
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection