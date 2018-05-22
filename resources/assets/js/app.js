
new Vue({
	el: '#crud',

	created: function(){
		this.getKeeps(); //la mandamos a llamar antes de todo para que se liste
	},

	data: {
		keeps: [],
		pagination: {
			'total'         : 0, //lista todo
            'current_page'  : 0, //pagina actual
            'per_page'      : 0, //por pagina
            'last_page'     : 0, //ultima pagina
            'from'          : 0, //desde
            'to'            : 0  //hasta ultimo elemento
		},
		newKeep: '',
		fillkeep: {'id': '', 'keep': ''},
		errors: []
	},

	computed: {
		isActived: function() {
			return this.pagination.current_page;
		},
		pagesNumber: function(){
			if(!this.pagination.to){
				return [];
			}

			//calcula el desde
			var from = this.pagination.current_page - 2; //Falta el offset
			if(from < 1) {
				from = 1;
			}

			//calcula hasta el final
			var to = from + (2 * 2);
			if(to >= this.pagination.last_page){
				to = this.pagination.last_page;
			}

			//calcula los numeros
			var pagesArray = [];
			while(from <= to){
				pagesArray.push(from);
				from++;
			}

			return pagesArray;
		}
	},

	methods: {
		getKeeps: function(page){
			// var urlKeeps = 'task';  //recopilamos la ruta
			var urlKeeps = 'task?page='+ page;
			axios.get(urlKeeps).then(response => { //activamos axios con la ruta para traer los datos
				this.keeps = response.data.tasks.data //actualizamos la data de keeps[]
				this.pagination = response.data.pagination
			});
		},

		editKeeps: function(keep) {
			this.fillkeep.id = keep.id;
			this.fillkeep.keep = keep.keep;

			$('#edit').modal('show');
		},

		updateKeeps: function (id) {
			var url = 'task/' + id;
			axios.put(url, this.fillkeep).then(response => {
				this.getKeeps();
				this.fillkeep = {'id': '', 'keep': ''};
				this.errors = [];
				$('#edit').modal('hide');
			}).catch(error => {
				this.errors = error.response.data
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

		},

		changePage: function(page){
			this.pagination.current_page = page;
			this.getKeeps(page);
		}
	}
});