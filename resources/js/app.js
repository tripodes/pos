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
new Vue({
  el: '#ModalCliente',
  created: function(){
    this.getClientes();
  },
  data: {
    clientes: [
    {nit: '',  nombre: '', direccion: ''}
    ],
    clinit: '',
    clinombre: '',
    clidireccion: ''
  },
  methods:
  {
    getClientes(){
      axios.get(urlClientes).then(response => {
        this.clientes = response.data
      });
    },
    verCliente(cid,cnit,cnom,cdir){
      var verid = urlClientes + '/' + cid;
      //alert(cid + ' ' + cnit + ' ' + cnom + ' ' + cdir);
      this.clinit = cnit;
    }
  }
})
