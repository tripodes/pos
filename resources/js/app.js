// new Vue({
// 	el: '#crud',
// 	created: function(){
// 		this.getKeeps();
// 	},
// 	data: {
// 		keeps: []
// 	},
// 	methods: {
// 		getKeeps: function() {
// 			var urlKeeps = 'tasks';
// 			axios.get(urlKeeps).then(response => {
// 				this.keeps = response.data
// 			});
// 		},
// 		deleteKeep: function(keep){
// 			var urlKeeps = 'tasks/' + keep.id;
// 			axios.delete(urlKeeps).then( res => {
// 				this.getKeeps(); //
// 				toastr.success('Eliminado Correctamente');
// 			});
// 		}
// 	}
// });


// new Vue({
//   el: '#listaclientes',
//   created: function(){
//     this.getClientes();
//   },
//   data: {
//     clientes: [],
//   },
//   methods: {
//     getClientes: function(){
//       var urlClientes = 'clientes';
//       axios.get(urlClientes).then(response =>{
//         this.clientes = response.data
//       });
//     }
//   }
// });


// var url = 'http://localhost:8000/';
// var urlClientes = url + 'clientes';
// new Vue({
//   el: '#create_factura',
//   created: function(){
//     this.getClientes();
//   },
//   data: {
//     clientes: [],
//     cli: [{nit: ''}],
//     cnit: ''
//   },
//   methods:
//   {
//     getClientes(){
//       axios.get(urlClientes).then(response => {
//         this.clientes = response.data
//       });
//     },
//     verCliente(index){
//       this.cnit = this.clientes[index].nombre;
//       console.log(this.cnit)
//     }
//   }
// });
  $(document).ready(function(){
      $('a.agregar').click(function(){
          var v_cliente = $(this).parent().parent().find('input#val_cliente').attr('value'); 
          var v_nombre = $(this).parent().parent().find('input#val_nombre').attr('value');
          var v_direccion = $(this).parent().parent().find('input#val_direccion').attr('value');
          var v_nit = $(this).parent().parent().find('input#val_nit').attr('value');

          $("#id_cli").val(v_cliente);
          $("#cliente").val(v_nombre);
          $("#direccion").val(v_direccion);
      $("#nit").val(v_nit);
      });
  });
  /*Declaracion de las variables de arreglo para luego ingresarlas*/
    var cont=0;
    var total=0;
    var arr_canti=[];
    var arr_id_bodega_producto=[];
    var arr_precio = [];
    var arr_subtotal = [];
    var v_id_bodega_producto = 0; 
    var v_producto =  "";
    var v_existencia = 0;
    var v_pre1 = 0;
    var v_pre2 = 0;
    var v_pre3 = 0;
    var v_pre4 = 0;
    var v_pre0 = 0;
    var v_canti = 0;
    var v_precio = 0;
    var v_id_del = 0;
    /****************************************************************/
    /* Funcion para que muestre la ventana con precios, existencia y cantidad*/
  $(document).ready(function(){
    $('.agregar_fila').click(function(){
      document.getElementById('caja3').style.display='block';

      v_id_bodega_producto = $(this).parent().parent().find('input#val_id_bodega_producto').attr('value'); 
      v_producto =  $(this).parent().parent().find('input#val_producto').attr('value');
      v_existencia = parseInt($(this).parent().parent().find('input#val_existencia').attr('value'));
      v_pre1 = $(this).parent().parent().find('input#val_pre1').attr('value');
      v_pre2 = $(this).parent().parent().find('input#val_pre2').attr('value');
      v_pre3 = $(this).parent().parent().find('input#val_pre3').attr('value');
      v_pre4 = $(this).parent().parent().find('input#val_pre4').attr('value');
      v_pre0 = $(this).parent().parent().find('input#val_pre_farm').attr('value');
      

      $('#pre_producto').val(v_producto);
      $('#pre_existencia').val(v_existencia);
      $('#desc1').html(v_pre1);
      $('#desc2').html(v_pre2);
      $('#desc3').html(v_pre3);
      $('#desc4').html(v_pre4);
      $('#desc0').html(v_pre0);

      $('#des0').val(v_pre0);
      $('#des1').val(v_pre1);
      $('#des2').val(v_pre2);
      $('#des3').val(v_pre3);
      $('#des4').val(v_pre4);
    });
  });
  /****************************************************************************/
  function agregar(){
      v_canti = $('#canti').val();
      v_precio = $("input[name='descuento']:checked").val();
      //alert("los valores son v_canti: "+v_canti+" id: "+v_id_bodega_producto+" v_precio: "+v_precio+" contador  "+cont+" v_existencia "+v_existencia+" total "+total);
      if(v_canti>0 && v_canti<=v_existencia)
      {
        /*ya ingresadas las variables se Meten las variables en el arreglo*/
        arr_canti.push(v_canti);  
        arr_precio.push(v_precio);
        arr_id_bodega_producto.push(v_id_bodega_producto);
        arr_subtotal.push(arr_canti[cont]*arr_precio[cont]);
        total+=arr_subtotal[cont];
        var fila = '<tr id="no_fila'+cont+'"><td style="display:none;">'+cont+'<input type="hidden" name="id_bod_pro[]" value="'+arr_id_bodega_producto[cont]+'"></td><td>'+arr_canti[cont]+'<input type="hidden" name="arr_cant[]" value="'+arr_canti[cont]+'"></td><td>'+v_producto+'</td><td>'+arr_subtotal[cont]+'<input type="hidden" name="arr_precio[]" value="'+arr_precio[cont]+'"></td><td><a href="#" class="quitar_fila" id="'+cont+'" onclick="quitar(this.id);"><i class="fas fa-minus-square" style="font-size:50px; color: #c23235;"></i></a></td></tr>';
        $('#articulo3').append(fila);
        cont++;
        document.getElementById('subtotal').value = total;
        $('#caja3').hide();
      }
      else{
        alert("Cantidad Invalida");
      }
      /*funcion desaparece la fila*/
      $(document).ready(function(){
        $('.quitar_fila').click(function(){
          $(this).parent().parent().remove();
        });
      });
    }
    /* con la funcion quita el elemento del array pero no la fila*/
    function quitar(este){
      v_id_del=este;
      arr_canti.splice(v_id_del,1);
      arr_precio.splice(v_id_del,1);
      arr_id_bodega_producto.splice(v_id_del,1);
      //alert("valores total "+total);//+" valor del subtotal"+arr_subtotal[cont]+++);
      total-=arr_subtotal[v_id_del];
      //var vtot = total;
      //alert("total es "+total+" y vtot "+vtot);
      arr_subtotal.splice(v_id_del,1);
      //total=vtot-arr_subtotal[v_id_del];
      
      document.getElementById('subtotal').value=total;
      cont = cont -1;
      //alert("total es "+total);
      //alert("valores total "+total+" array "+arr_subtotal.length+" contador "+cont);
      }
      /****************************************************/
      
  $(document).ready(function(){
    $('#btn_bor').click(function(){
      $('#caja3').hide();
    });
  });
        $(document).ready(function(){
            $("table#articulo").html();
        });

        function buscar_producto(){
            var textobusqueda = $("input#busqueda").val();

            if (textobusqueda!=""){
                $.post("buscar_producto_venta.php", {valorbusqueda: textobusqueda}, function(mensaje){
                    $("table#articulo").html(mensaje);
                });
            }else{
                $("table#articulo").html();
            };
        };
    
      $(document).ready(function(){
        $('#mostrar').click(function(){
          var pago = prompt("Cantidad a Cancelar: ");
          $('#contador').val(cont);
          $('#pago').val(pago);
          if(pago<=total)
          {
            var pagina = 'insertar.php';
            document.form_venta.action=pagina;
                document.form_venta.submit();
          }
          else
          {
            alert("la cantidad pagada es mayor que la cantidad a pagar");
          }
        //alert("el ancho del array es "+arr_canti.length);
        });
      });