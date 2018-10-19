import * as actions from './actions';
import initialState from './state';
import * as mutations from './mutations';

export default {
    namespaced: true,
    state: initialState,
    //getters,
    mutations,
    actions
}