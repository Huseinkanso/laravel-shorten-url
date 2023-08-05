<template>
  <nav class="bg-teal-600 p-4 text-white text-3xl flex justify-between">
    <router-link  class="px-3 cursor-pointer" to="/">home</router-link>
    <div v-if="!loggedIn" class="">
        <router-link to="/login"     class="px-3 cursor-pointer">login</router-link>
        <router-link to="/register"  class="px-3 cursor-pointer">register</router-link>
    </div>
    <div class="flex" v-else>
        <p class="mx-3">{{user.name}}</p>
        <a  @click.prevent="logout"  class="px-3 cursor-pointer">logout</a>
    </div>
  </nav>
</template>

<script>
import axios from 'axios'
export default {
    data()
    {
        return  {
            loggedIn:window.loggedIn,
            user:window.user
        }
    },
    components:{

    },
    methods:{
        logout()
        {
            axios.post('/logout').then((res)=>{
                window.location='/'
            })
            .catch((res)=>{

            })
        }
    },
    name:"AppHeader"
}
</script>

<style>

</style>