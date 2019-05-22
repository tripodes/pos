@extends('layouts.facturas')
@section('content')
<div id="create_factura" class="col-md-6">
  <div class="d-flex justify-content-between col-md-12 form-group">
    <div class="col-md-4">
      <label for="nofac">No Factura</label>
      <input type="text" name="nofac" readonly="readonly" class="form-control">
    </div>
    <div></div>
    <div class="col-md-4">
      <label for="fecha">Fecha</label>
      <input type="text" name="fecha" readonly="readonly" class="form-control">
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
            <input type="text" name="nit" class="form-control" v-model="cnom">  
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
  <div class="input-group col-md-12">
     <input type="text" class="form-control" id="busqueda">
     <span class="input-group-btn">
          <button class="btn btn-info disabled" type="button">Buscar</button>
     </span>
     <table class="table table-striped">
      <thead>
        <td>Producto</td>
        <td>Marca</td>
        <td>Categoria</td>
        <td>Accion</td>
      </thead>
      <tbody id="articulo">
        @foreach($productos as $producto)
        <tr>
          <td>{{$producto->prod}}</td>
          <td>{{$producto->marca}}</td>
          <td>{{$producto->categoria}}</td>
          <td><button class="btn btn-success">+</button></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
<script>
  $(document).ready(function(){

    $('#busqueda').keyup(function(){
      var query = $(this).val();
      if(query != '')
      {
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url: "{{ route('busqueda.fetch') }}",
          method: "POST",
          data:{query:query, _token:_token},
          success:function(data)
          {
            $('#articulo').fadeIn();
            $('#articulo').html(data);
          }
        })
      }
    })
  })
</script>