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

new Vue({
  el: '#ModalCliente',
  created: function(){
    this.getClientes();
  },
  data: {
    clientes: [
      {nit: '', nombre: '', direccion: ''}
    ],
    obtener: [
      {nit: '', nombre: '', direccion: ''}
    ],
  },
  methods:
  {
    getClientes(){
      var urlClientes = 'http://localhost:8000/clientes';
      axios.get(urlClientes).then(response => {
        this.clientes = response.data
      });
    },
  }
})