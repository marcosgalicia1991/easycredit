<template>
	<div class = "row">
		<div class = "col-sm-12" v-show="logged_users">
			<span>EasyCredit</span>
			<button @click="logout" class = "btn-logout">Cerrar sesión</button>
		</div>
		<login-component></login-component>
		<profile-component></profile-component>
		<record-component></record-component>
		<request-component></request-component>
	</div>
</template>
<script>
	import { mapActions, mapState } from 'vuex';

	export default {
		created() {
			this.logged();
		},
		computed: {
			...mapState({
				logged_users: state => state.user.logged,
			}),
		},
		methods: {
			...mapActions('user', [
				'logged',
				'logout',
			]),
		}
	}
</script>