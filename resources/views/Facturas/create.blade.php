@extends('layouts.facturas')
@section('content')
<form class="" action="/facturas" method="POST">
    @csrf
  <div class="row col-md-12" id="create_factura">
    <div class="col-md-7">
      <div class="d-flex justify-content-between col-md-12">
        <div class="col-md-4">
          <label for="nofac">No Factura</label>
          @if (empty($correlativo))
            <input type="text" name="nofac" readonly="readonly" class="form-control" value="1">
  				@else
            <input type="text" name="nofac" readonly="readonly" class="form-control" value="{{$correlativo+1}}">
         	@endif
        </div>
        <div class="col-md-4">
          <label for="fecha">Fecha</label>
          <input type="text" name="fecha" readonly="readonly" class="form-control" value="{{ date('d/m/Y') }} ">
        </div>
      </div>
      <div class="form-group">
        <div class="d-flex justify-content-between">
          <div class="col-md-12">
            <label for="cliente">Cliente</label>
            <div class="input-group">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCliente">Buscar Cliente
                </button>
              </span>
              <input type="hidden" name="idcliente" v-model="cid">
              <input type="text" name="cliente" class="form-control" v-model="cnom" placeholder="Coloque 0 para consumidor final">
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="col-md-4">
            <label for="nit">Nit</label>
            <input type="text" name="nit" class="form-control" v-model="cnit">
          </div>
          <div class="col-md-8">
            <label for="dir">Direccion</label>
            <input type="text" name="dir" class="form-control" v-model="cdir">
          </div>
        </div>
      </div>
      <!-- Ventana Modal para el Cliente-->
      <div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Clientes</h5>
              {{-- <a href=" {{ action('ClienteController@create') }} " class="btn btn-success" target="_blank">+</a> --}}
              <a href="#" class="btn btn-success" onClick="window.open('{{ action('CategoriaController@create')}}','popup', 'width=400px,height=400px')">+</a>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <table class="table table-striped">
                  <thead>
                    <td>Nit</td>
                    <td>Nombre</td>
                    <td>Direccion</td>
                    <td></td>
                  </thead>
                  <tbody>
                    <tr v-for="(cliente, index) in clientes">
                      <td>@{{cliente.nit}}</td>
                      <td>@{{cliente.nombre}}</td>
                      <td>@{{cliente.direccion}}</td>
                      <td><a href="" class="btn btn-primary" data-dismiss="modal" aria-label="Close" v-on:click.prevent="verCliente(index)">Seleccionar</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ventana Modal para el Cliente-->
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
              <div class="col-md-3">
                <input type="text" v-model="existencia" class="form-control" readonly="readonly">
              </div>
              <div class="col-md-3">
                <input type="text" v-model="pre" class="form-control" readonly="readonly">
              </div>
              <div class="col-md-3">
                <input type="number" class="form-control focus" name="" @blur="focusOut" @focus="focusIn" v-model.number="canti">
              </div>
              <div class="col-md-3">
                <input type="number" class="form-control focus" name="" autofocus v-model.number="canti">
              </div><br><br>
            </div>
            <div class="modal-footer">
              {{-- <a href="#" class="btn btn-success" onclick="agregarFila();">Agregar</a> --}}
              <td><a href="#" class="btn btn-primary" data-dismiss="modal" aria-label="Close" v-on:click.prevent="agregarFila">Agregar</a></td>
              <td><a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar</a></td>
              {{-- <button type="button" class="btn btn-secondary" >Cancelar</button> --}}
            </div>
          </div>
        </div>
      </div>
      <!-- Ventana Modal para el Producto-->
      <div class="input-group col-md-12">
        <input type="text" class="form-control" v-model="busca">
        {{-- style="text-transform:uppercase" onKeyUp="this.value=this.value.toUpperCase();"> --}}
        <span class="input-group-btn">
          <button class="btn btn-info disabled" type="button">Buscar</button>
        </span>
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
        <a href="{{ action('FacturaController@index')}}" class="btn btn-secondary">Regresar</a>
      </div>
    </div>
    <div class="col-md-5">
      <table class="table">
        <thead>
          <td>Cantidad</td>
          <td>Precio</td>
          <td>Producto</td>
          <td>Subtotal</td>
          <td>Eliminar</td>
        </thead>
        <tbody>
          <tr v-for="(prod, index) in ListaProductos">
            <td v-show="">@{{prod.idpro}}</td>
            <td>@{{prod.cantidad}}</td>
            <td>@{{prod.pre}}</td>
            <td>@{{prod.pro}}</td>
            <td>@{{prod.subtotal}}</td>
            <input type="hidden" name="idproducto[]" v-model="prod.idpro">
            <input type="hidden" name="cantproducto[]" v-model="prod.cantidad">
            <td><a href="" class="btn btn-danger" @click.prevent="eliminarFila(index)">-</a></td>
          </tr>
          <tr>
            <td colspan="3"><strong> Total:</td>
              <td v-show="total>0">@{{sumarSubtotal}}</td><strong>
                <input type="hidden" name="total" v-model="total">
              </tr>
            </tbody>
          </table>
          <button type="submit" name="button" class="btn btn-success">Vender</button>
          <a href="#" class="btn btn-warning" onClick="window.open('{{ action('CategoriaController@create')}}','popup', 'width=400px,height=400px')">Cotizar</a>
        </div>
  </div>
</form>
@endsection
