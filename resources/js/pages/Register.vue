<template>
    <div class="register border rounded">
        <div class="p-3">
          <h1 class="text-3xl text-center">register</h1>
        <form method="post" @submit.prevent="submit" class="flex p-2 flex-wrap flex-col justify-center text-center m-auto  w-10/12">
            <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
          <div class="py-2">
            <input v-model="form.name" class="w-full rounded shadow p-2" type="text" placeholder="name">
          </div>
          <div class="py-2">
            <input v-model="form.email" class="w-full rounded shadow p-2" type="email" placeholder="email">
          </div>
          <div class="py-2">
            <input v-model="form.password" class="w-full rounded shadow p-2" type="password" placeholder="********">
          </div>
          <div class="py-2">
            <input v-model="form.password_confirmation" class="w-full rounded shadow p-2" type="password" placeholder="*****confirm">
          </div>
          <div class="py-2">
            <input type="submit" value="register" class="rounded shadow p-2 bg-red-500 text-white">
          </div>
        </form>

        </div>
      </div>
</template>

<script>
import axios from 'axios'
import {useRouter} from "vue-router"
export default {
    middleware:"guest",
    data()
    {
        return {
            form:{
                name:"",
                email:"",
                password:"",
                password_confirmation:"",
            },
            router:useRouter()
        }
    },
    methods:{
        submit()
        {
            axios.post('/register',this.form,{headers:{'Accept':'application/json','Content-Type':'application/json'}}).then((res)=>{
                this.router.push("/")
            })
            .catch((err)=>{
                console.log(err);
            })
        }
    }
}
</script>

<style>

</style>