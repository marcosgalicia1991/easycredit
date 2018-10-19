import initialState from './state';

export const setLogin = (state, payload) => {
    state.logged = payload;
}