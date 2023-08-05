<template>
  <div class="login border rounded">
    <div class="p-3">
      <h1 class="text-3xl text-center">login</h1>
    <form @submit.prevent="submit" class="flex p-2 flex-wrap flex-col justify-center text-center m-auto  w-10/12">
      <div class="py-2">
        <input v-model="form.email" class="w-full rounded shadow p-2" type="email" placeholder="email">
    </div>
    <span class="text-red-500 text-sm" v-if="errors.email">{{errors.email}}</span>
      <div class="py-2">
        <input v-model="form.password" class="w-full rounded shadow p-2" type="password" placeholder="********">
      </div>
      <span class="text-red-500 text-sm" v-if="errors.password">{{errors.password}}</span>
      <div class="py-2">
        <input type="submit" value="login" class="rounded shadow p-2 bg-red-500 text-white">
      </div>
      <div class="w-full text-right ">
        <router-link to="/forgot-password" class="text-blue-400 hover:text-blue-800" href="">forgot password</router-link>
      </div>

    </form>

    </div>
  </div>
</template>

<script>
export default {
    middleware:"guest",
    data()
    {
        return {
            form:{
                email:"",
                password:"",
            },
            errors:{}
        }
    },
    methods:{
        submit()
        {
            axios.post('/login',this.form).then((res)=>{
                console.log(res.data);
                window.location='/'
            })
            .catch((err)=>{
                this.errors= err.response.data.errors;
            })
        }
    }
}
</script>

<style>

</style>