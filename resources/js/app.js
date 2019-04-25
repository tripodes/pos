new Vue({
	el: '#crud',
	created: function(){
		this.getKeeps();
	},
	data: {
		keeps: []
	},
	methods: {
		getKeeps: function() {
			var urlKeeps = 'tasks';
			axios.get(urlKeeps).then(response => {
				this.keeps = response.data
			});
		},
		deleteKeep: function(keep){
			var urlKeeps = 'tasks/' + keep.id;
			axios.delete(urlKeeps).then( res => {
				this.getKeeps(); //
				toastr.success('Eliminado Correctamente');
			});
		}	
	}
});