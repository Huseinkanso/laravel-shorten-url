import Register from "./pages/Register.vue"
import index from "./pages/index.vue"
import Login from "./pages/Login.vue"
import ForgotPassword from "./pages/ForgotPassword.vue"
import ResetPassword from "./pages/ResetPassword.vue"
import { createRouter, createWebHistory } from 'vue-router'
const routes = [

    {
      path: '/',
      component: index ,
    },
    {
        path:'/login',
        component:Login
    },
    {
        path:'/register',
        component:Register
    },
    {
        path:'/forgot-password',
        component:ForgotPassword
    },
    {
        path:'/password/reset/:token',
        component:ResetPassword
    }

  ]


export  const router = createRouter({
    history: createWebHistory(process.env.url),
    routes,

})


router.beforeEach((to,from,next)=>{
    // console.log(to,from);

    let middleware=to.matched[0].components.default.middleware;
    if(middleware=="guest")
    {
        if(window.loggedIn)
        {
            next("/");
            return;
        }
    }
    if(middleware=="auth")
    {
        if(!window.loggedIn)
        {
            next('/login');
            return;
        }
    }

    // if(!window.loggedIn)
    // {
    //     if(to.path=='/')
    //     {
    //         next('/login');
    //         return;
    //     }
    // }else
    // {
    //     if(to.path=='/login' || to.path=='/register')
    //     {
    //         next('/');
    //         return;
    //     }
    // }

    // when using beforeeach we need to call the next function to render the component
    // if next dosent have url in it will go to (to)
    next()
})

