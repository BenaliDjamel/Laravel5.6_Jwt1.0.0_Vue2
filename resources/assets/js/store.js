import {
    getLocalStorage
} from './helpers/help'

const user = getLocalStorage();
export default {


    state: {
        currentUser: user,
        users: null,
        isLogged: false,
        auth_error: null,
        register_error: null
    },

    mutations: {
        loginSuccess(state, data) {
            state.currentUser = Object.assign({}, data.user, {
                token: data.access_token
            });
            state.isLogged = true;
            state.auth_error = null;
            localStorage.setItem('user', JSON.stringify(state.currentUser));
        },

        authError(state, err) {
            state.auth_error = err;
        },

        logout(state) {
            state.currentUser = null;
            state.isLogged = false;
            localStorage.removeItem('user');

        },

        RegisterError(state, err) {
            state.Register_error = err;
        },
        setUsers(state, data) {
            state.users = data
        },
        deteleUser(state, id) {
            console.log(id);

            axios.get(`/api/users/delete/user/${id}`)
                .then(response => {
                    console.log(response);
                    const userIndex = state.users.findIndex(user => user.id === id);
                    state.users.splice(userIndex, 1);
                }).catch(err => console.log(err))
        },

        addUser(state, user) {
            state.users.push(user);
        }
    
    },

    actions: {
        login(context) {
            context.commit('login');
        },
        deleteUser(context, id) {

            context.commit('deteleUser', id);

        },
       
    },

    getters: {
        currentUser(state) {
            return state.currentUser;
        },

        users(state) {
            return state.users;
        },
        userLoggedIn(state) {
            return state.isLogged;
        },
        authErrors(state) {
            return state.auth_error;
        },
        RegisterError(state) {
            return state.register_error;
        },
        getUsers(state) {
            return state.users;
        }
    }
}