import user from '../../../services/user';

export const login = async ({ commit, state }, payload) => {
    return new Promise((resolve, reject) => {
        user.login(payload).then(
            response => { // resolve
                commit("user/setLogin", response.login, {
                    root: true
                });

                resolve(response);
            },
            reason => { // reject
                reject(reason);
            }
        ).catch(error => {
            reject(error);
        });
    });
}

export const logged = async ({commit, state}) => {
	return new Promise((resolve, reject) => {
		user.logged().then(
			response => {
				commit("user/setLogin", response.login, {
                    root: true
                });

				resolve(response);
			},
			reason => {
				reject(reason);
			}
		).catch(error => {
			reject(error);
		});
	});
}

export const logout = async ({commit, state}) => {
	return new Promise((resolve, reject) => {
		user.logout().then(
			response => {
				commit("user/setLogin", false, {
                    root: true
                });

				resolve(response);
			},
			reason => {
				reject(reason);
			}
		).catch(error => {
			reject(error);
		});
	});
}