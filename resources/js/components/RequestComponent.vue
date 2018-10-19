<template>
	<div id = "request-container" class = "col- col-sm-6 col-md-4" v-show="logged">
		<div>
			Solicitudes
		</div>
		<alert :type="alert.type"></alert>
		<div v-if="requests.length > 0">
			<div v-for="request in requests" class = "item-container">
				<span>{{request.description}} - </span>
				<vue-numeric v-model="request.amount"
					currency="$"
					:presicion="2"
					:read-only="true"
				></vue-numeric>
				<span class = "button-delete" @click="deleteRequest(request.id)">x</span>
			</div>
		</div>
		<div v-else>
			Sin Solicitudes
		</div>
		<div>
			<button @click="showModal">+ Añadir solicitud</button>
		</div>
		<modal_component
      		v-show="isModalVisible"
			@close="closeModal"
		></modal_component>
	</div>
</template>
<script>
	import { mapState } from 'vuex';
	import modal_component from './ModalRequestComponent.vue';

	export default {
		name: 'request-component',
		components: {
	      modal_component,
	    },
		data() {
			return {
				requests: [],
				isModalVisible: false,
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
		methods: {
			showModal() {
		        this.isModalVisible = true;
		    },
		    closeModal() {
		        this.isModalVisible = false;
		    },
		    getData() {
		    	var vm = this;
		    	if(vm.logged) {
		    		vm.alertType(4);
			    	axios.get(`/request/0`)
		            .then(function (response) {
		            	vm.requests = response.data;
		            	vm.alertType(5);
		            })
		            .catch(function (error) {
		                vm.alertType(3);
		            });
		        }else{
		        	vm.requests = [];
		        }
		    },
		    deleteRequest(id) {
		    	var vm = this;
		    	vm.alertType(1);
		    	axios.patch(`/request/${id}`)
	            .then(function (response) {
	            	vm.getData();
	            })
	            .catch(function (error) {
	                vm.alertType(3);
	            });
		    },
		    alertType(type) {
                this.alert.type = type;
            },
		},
		mounted() {
			var vm = this;
			
			vm.getData();

			Event.$on('reload-data', function() {
                vm.getData();
            });
		},
		watch: {
			logged: function() {
				this.getData();
			},
		}
	}
</script>