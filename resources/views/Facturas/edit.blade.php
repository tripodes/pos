@extends('layouts.facturas')
@section('content')
<div class="row" id="editar_factura">
	<div class="col-md-6">
			<form action="/facturas/{{$factura}}" method="post">
				@csrf
				@method('PUT')
			<div class="form-group">
				<!-- Encabezado de la factura -->
				@foreach ($factura as $factu)
					<div class="d-flex justify-content-between">
						<div class="col-md-12">
							<label for="cliente">Cliente</label>
							<input type="text" name="" value="{{$factu->nombre}}" class="form-control" readonly>
							<input type="hidden" name="idcliente" value={{$factu->id_cliente}} class="form-control" readonly>
							<input type="hidden" name="idfactura" value={{$factu->id_fac_enc}} class="form-control" readonly>
						</div>
					</div>
					<div class="d-flex justify-content-between">
						<div class="col-md-4">
							<label for="nit">Nit</label>
							<input type="text" name="nit" class="form-control" value="{{$factu->nit}}" readonly>
						</div>
						<div class="col-md-8">
							<label for="dir">Direccion</label>
							<input type="text" name="dir" class="form-control" value="{{$factu->direccion}}" readonly>
						</div>
					</div>
				@endforeach
			</div>
			<!-- Encabezado de la factura -->
			<!-- Detalle de la factura -->
			<table class="table">
				<thead>
					<td colspan="2">Cantidad</td>
					<td></td>
					<td>Descripcion</td>
					<td>Precio</td>
				</thead>
				<div class="container row justify-content-between">
					<button v-if="activo" type="button" class="btn btn-warning" @click.prevent="activar">Editar</button>
					<button v-else="activo" type="button" class="btn btn-warning" @click.prevent="activar">Bloquear</button>
					<button type="button" class="btn btn-info" @click="lista = !lista">Agregar</button>
				</div>
				<tbody>
					@php
						$i = 0;
					@endphp
					@foreach ($detalles as $detalle)
						<tr>
							<input type="hidden" name="idproducto[]" value="{{$detalle->id_producto}}">
							<input type="hidden" name="idsviejos[]" value="{{$detalle->id_producto}}" v-model.number="ids" ref="ids">
							<input type="hidden" name="cantvieja[]" value="{{$detalle->cantidad}}">
							<td><td><a href="" class="btn btn-danger" @click.prevent="eliminarFila2(index)">-</a></td></td>
							<td><input type="number" name="cantidad[]" value="{{$detalle->cantidad}}" class="form-control col-md-5" :readonly="activo"></td>
							<td>{{$detalle->categoria}} {{$detalle->producto}} Marca {{$detalle->marca}}</td>
							<td>Q{{$detalle->precio_venta}}</td>
						</tr>
					@endforeach
				</tbody>
				<!-- Detalle de la factura -->
				<!-- Tabla si se quiere agregar un nuevo producto -->
			</table>
			<table class="table ml-4">
				<thead>
				</thead>
				<tbody>
					<tr v-for="(prod, index) in ListaProductos">
						<td v-show="">@{{prod.idpro}}</td>
						<td><a href="" class="btn btn-danger" @click.prevent="eliminarFila(index)">-</a></td>
						<td><input type="text" name="" v-model="prod.cantidad" :readonly="activo" class="form-control col-md-4"></td>
						{{-- @{{prod.cantidad}} --}}
						<td>@{{prod.cat}} @{{prod.pro}} Marca @{{prod.marca}}</td>
						<td>Q@{{prod.pre}}</td>
						<input type="hidden" name="idsproducto[]" v-model="prod.idpro">
						<input type="hidden" name="cantproducto[]" v-model="prod.cantidad">
					</tr>
				</tbody>
			</table>
			<!-- Tabla si se quiere agregar un nuevo producto -->
			<div class="row justify-content-between">
				<strong><div>Total</div></strong>
				<div></div>
				<strong>
				<div v-if="sumarSubtotal>0">
					Q. @{{sumarSubtotal}}
				</div>
				<div v-else>
					Q. @{{valor0}}
				</div>
				</strong>
				<input type="hidden" value="{{$detalle->total}}" ref="valor00" v-model.number="valor0">
			</div>
			<button class="btn btn-success">Actualizar</button>
			<a href="{{ action('FacturaController@index') }}" class="btn btn-secondary">Regresar</a>
		</div>
		<!-- Ventana Modal para el Producto-->
		<div class="modal fade" id="ModalProducto" role="dialog" aria-labelledby="exampleModalProducto" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="row col-md-12 text-center">
							<div class="col-md-4">Existencia</div>
							<div class="col-md-4">Precio</div>
							<div class="col-md-4">Cantidad</div>
						</div>
					</div>
					<div class="modal-body col-md-12 row center">
						<div class="col-md-4">
							<input type="text" v-model="existencia" class="form-control" readonly="readonly">
						</div>
						<div class="col-md-4">
							<input type="text" v-model="pre" class="form-control" readonly="readonly">
						</div>
						<div class="col-md-4">
							<input type="number" class="form-control" name="" autofocus v-model.number="canti">
						</div><br><br>
					</div>
					<div class="modal-footer">
						<td><a href="#" class="btn btn-primary" data-dismiss="modal" aria-label="Close" v-on:click.prevent="agregarFila">Agregar</a></td>
						<td><a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar</a></td>
					</div>
				</div>
			</div>
		</div>
		<!-- Ventana Modal para el Producto-->
		<div class="col-md-6" v-if="lista">
			<div class="row">
				<input type="text" class="form-control col-md-10" v-model="busca">
				<span class="input-group-btn">
					<button class="btn btn-info disabled" type="button">Buscar</button>
				</span>
			</div>
			<table class="table table-striped">
				<thead>
					<td>Producto</td>
					<td>Marca</td>
					<td>Categoria</td>
					<td>Agregar</td>
				</thead>
				<tbody>
					<tr v-for="producto in FiltroProducto">
						<td>@{{producto.producto}}</td>
						<td>@{{producto.marca}}</td>
						<td>@{{producto.categoria.toUpperCase()}}</td>
						<td><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalProducto" @click.prevent="verProducto(producto)">+</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
</div>
@endsection
