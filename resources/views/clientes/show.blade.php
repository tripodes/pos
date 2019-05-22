@extends('layouts.clientes')
@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" value="{{$cliente->nombre}}" class="form-control" disabled="">
			</div>
		</div>
	</div>
@endsection