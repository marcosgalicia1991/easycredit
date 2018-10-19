<template>
	<div id = "record-container" class = "col- col-sm-6 col-md-4" v-show="logged">
		<div>
			Historial
		</div>
		<alert :type="alert.type"></alert>
		<div v-if="records.length > 0">
			<div v-for="record in records" class = "item-container" v-bind:class="{ 
						'item-accepted': (record.status) == 1, 
						'item-rejected': (record.status) == 2 }">
				<span > {{record.description}} - </span>
				<vue-numeric v-model="record.amount"
					currency="$"
					:presicion="2"
					:read-only="true"
				></vue-numeric>
				<span v-if="record.status == 1"> - Aprobado</span>
				<span v-if="record.status == 2"> - Rechazado</span>
			</div>
		</div>
		<div v-else>
			Sin Historial Crediticio
		</div>
	</div>
</template>
<script>
	import { mapState } from 'vuex';

	export default {
		data() {
			return {
				records: [],
				alert: {
	                type: null,
	                state: null,
	            },
			}
		},
		mounted() {
			var vm = this;

			this.getData();

			Event.$on('reload-data', function() {
                vm.getData();
            });
		},
		computed: {
			...mapState({
				logged: state => state.user.logged,
			}),
		},
		methods: {
			getData() {
		    	var vm = this;
		    	if(vm.logged) {
		    		vm.alertType(4);
		    		axios.get(`/request/1`)
		            .then(function (response) {
		            	vm.records = response.data;
		            	vm.alertType(5);
		            })
		            .catch(function (error) {
		                vm.alertType(3);
		            });	
		    	}else{
		    		vm.records = [];
		    	}
		    },
			alertType(type) {
                this.alert.type = type;
            },
		},
		watch: {
			logged: function() {
				this.getData();
			},
		}
	}
</script>