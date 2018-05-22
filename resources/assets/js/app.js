
new Vue({
	el: '#crud',

	created: function(){
		this.getKeeps(); //la mandamos a llamar antes de todo para que se liste
	},

	data: {
		keeps: [],
		newKeep: '',
		errors: []
	},

	methods: {
		getKeeps: function(){
			var urlKeeps = 'task';  //recopilamos la ruta
			axios.get(urlKeeps).then(response => { //activamos axios con la ruta para traer los datos
				this.keeps = response.data //actualizamos la data de keeps[]
			});
		},

		deleteKeeps: function(keep) {
			var url = 'task/' + keep.id;  //recopilamos la ruta de borar
			axios.delete(url).then(response => {  //activamos axios para la ruta de delete ->eliminamos
				this.getKeeps(); //listamos  con la funcion getKeeps()  ->listamos
			});
		},

		createKeeps: function() {
			var url = 'task';
			axios.post(url , {
				keep: this.newKeep
			}).then(response => {
				this.getKeeps();
				this.newKeep = '';
				this.errors = [];
				$('#create').modal('hide');
			}).catch(error => {
				this.errors = error.response.data
			});

		}
	}
});