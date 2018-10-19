export default {
 	login(user) {
        return new Promise((resolve, reject) => {
            axios.post(`/login`, user)
            .then(function (response) {
                resolve(response.data);
            })
            .catch(function (error) {
                reject(error);
            });
        });
    },

    logged() {
        return new Promise((resolve, reject) => {
            axios.get(`/login`)
            .then(function (response) {
                resolve(response.data);
            })
            .catch(function (error) {
                reject(error);
            });
        });
    },

    logout() {
        return new Promise((resolve, reject) => {
            axios.get(`/logout`)
            .then(function (response) {
                resolve(response.data);
            })
            .catch(function (error) {
                reject(error);
            });
        });
    },
}
