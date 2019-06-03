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


var url = 'http://localhost:8000/';
var urlClientes = url + 'clientes';
var urlProductos = url + 'productos';
new Vue({
  el: '#create_factura',
  created: function(){
    this.getClientes();
    this.getProductos();
  },
  data: {
    clientes: [],
    cnit: '',
    cnom: '',
    cdir: '',
    productos: [],
    pre: '',
    pro: '',
    existencia: '',
    busca: '',
    cont: 0,
    ListaProductos:[],
    idpro: 0,
    canti: ''
  },
  methods:
  {
    getClientes(){
      axios.get(urlClientes).then(response => {
        this.clientes = response.data
      });
    },
    verCliente(index){
      this.cnit = this.clientes[index].nit;
      this.cnom = this.clientes[index].nombre;
      this.cdir = this.clientes[index].direccion;
    },
    getProductos(){
      axios.get(urlProductos).then(response => {
        this.productos = response.data
      })
    },
    verProducto(producto){
      this.idpro = producto.id_producto;
      this.pro = producto.producto;
      this.pre = producto.precio_venta;
      this.existencia = producto.existencia;
    },
    agregarFila(){
      //alert(this.idpro+' '+this.pre+' '+this.canti);
      this.cont=this.cont+1;
      document.getElementById("tablaproductos").insertRow(-1).innerHTML = '<tr id="'+this.cont+'"><td>'+this.pre+'</td><td>'+this.pro+'</td><td>'+this.canti+'</td><td><a href="#" class="btn btn-danger" onclick="eliminarFila();">-</a></td></tr>';
    },
    eliFila(){
      var table = document.getElementById("tablaproductos");
      var rowCount = table.rows.length;
      //console.log(rowCount);
    //   //
    //   // if(rowCount <= 1)
    //   //   alert('No se puede eliminar el encabezado');
    //   // else
    //   //   table.deleteRow(rowCount -1);
    }
  },
  computed: {
    FiltroProducto: function(){
      return this.productos.filter((producto) => {
        return producto.producto.match(this.busca);
      });
    }
  }
});
