import Login from './components/Login.vue'
import Register from './components/Register.vue'
import List from './components/users/list.vue'
import Edit from './components/users/Edit.vue'


export const routes = [
    {
        path:'/login',
        component:Login
    },
    {
        path:'/register',
        component:Register
    },
    {
        path:'/users',
        component:List,
        meta: {
            requiresAuth: true
        }

    
       
        /*  children: [
            {
                path:'update/user/:id',
                component:Edit

            }
          ]*/
        },

        {
            path:'/users/update/user/:id',
            component:Edit,
            meta: {
                requiresAuth: true
            }

        }
   
]