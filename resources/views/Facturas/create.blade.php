@extends('layouts.facturas')
@section('title',' - Crear')
@section('content')
{{-- <form action="" id="form_factura_enc"> --}}
<div class="row">
	<div class="col-md">
		<form action="" method="post">
			@csrf
			<div class="form-group">
				<label for="serie">Serie</label>
				<input type="text" name="serie" class="form-control col-md-4">

				<label for="numero">Número</label>
				<input type="text" name="numero" class="form-control col-md-4">
        <br>
        <div class="row form-group">
          <div class="col-md-2 row align-items-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCliente">Buscar Cliente</button>
          </div>
          <div class="col-md-2">
    				<label for="nit">Nit</label>
    				<input type="text" name="nit" class="form-control" v-model="obtener.nit">
          </div>
          <div class="col-md-4">
            <label for="cliente">Cliente</label>
            <input type="text" name="cliente" class="form-control" v-model="obtener.nombre">
          </div>
          <div class="col-md-4">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" class="form-control" v-model="obtener.direccion">
          </div>
        </div>
			</div>
			<button type="submit" class="btn btn-primary">Llenar Detalle</button>
		</form>
	</div>
</div>
<!-- Modal Usuario -->
<div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
        	<thead>
        		<td>Nit</td>
        		<td>Nombre</td>
        		<td>Direccion</td>
            <td>Accion</td>
        	</thead>
        	<tbody>
            <tr v-for="cliente of clientes">
              <td>@{{cliente.nit}}</td>
              <td>@{{cliente.nombre}}</td>
              <td>@{{cliente.direccion}}</td>
              <td><a href="" class="btn btn-primary" v-on:click="darClientes">Seleccionar</a></td>
            </tr>
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
{{-- </form> --}}
@endsection