<template>
	<div id = "profile-container" class ="col- col-sm-6 col-md-4" v-show="logged">
		<div>
			Perfil
		</div>
		<alert :type="alert.type"></alert>
		<div>Usuario: {{name}}</div>

		<div>
			Total de solicitudes por aprobar: {{total}}
		</div>
	</div>
</template>
<script>
	import { mapState } from 'vuex';

	export default {
		data() {
			return {
				name: "",
				total: 0,
				alert: {
	                type: null,
	                state: null,
	            },
			}
		},
		computed: {
			...mapState({
				logged: state => state.user.logged,
			}),
		},
		mounted() {
			var vm = this;
			this.getDataUser();

			Event.$on('reload-data', function() {
                vm.getDataUser();
            });
		},
		methods: {
			getDataUser() {
				if(this.logged) {
					var vm = this;
					vm.alertType(4);
					axios.get(`/user`)
		            .then(function (response) {
		            	vm.name = response.data.name;
		            	vm.total = response.data.total;
		            	vm.alertType(5);
		            })
		            .catch(function (error) {
		                vm.alertType(3);
		            });
				}
			},
			alertType(type) {
                this.alert.type = type;
            },
		},
		watch: {
			logged: function(value) {
				this.getDataUser();
			}
		}
	}
</script>