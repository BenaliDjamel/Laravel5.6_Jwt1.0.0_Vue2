

export function initialize(store, router) {
    router.beforeEach((to, from, next) => {
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const currentUser = store.state.currentUser;
    
        if(requiresAuth && !currentUser) {
            next('/login');
        } else if(to.path == '/login' && currentUser) {
            next('/');
        } else {
            next();
        }
    });
    
    axios.interceptors.response.use(null, (error) => {
       
        
        if (error.toString().includes('401')) {
            store.commit('logout');
            router.push('/register');
        }

        return Promise.reject(error);
    });

    if (store.getters.currentUser) {
        setAuthorization(store.getters.currentUser.token);
    }
}


export  function setAuthorization(token) {
   axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
}

export function getLocalStorage() {

    const user = localStorage.getItem('user');

    if(!user) {
        return null;
    }

    return JSON.parse(user);
}