<template>
	<div id = "login-container"
		class = "col-sm-12"
		v-show="!logged">
		<div>
			EasyCredit
		</div>
		<div>
			<label>Usuario: </label>
			<input type="text" v-model="user">
		</div>
		<button @click="getLogin">Entrar</button>
	</div>
</template>
<script>
	import { mapActions, mapState } from 'vuex';

	export default {
		data() {
			return {
				user: "",
			}	
		},
		computed: {
			...mapState({
				logged: state => state.user.logged,
			}),
		},
		methods: {
			...mapActions('user', [
				'login',
			]),
			getLogin() {
				var vm = this;
				this.login({user: this.user}).then(response => {
					if (response.login) {
						vm.user = "";
					}
				});
			},
		}
	}
</script>