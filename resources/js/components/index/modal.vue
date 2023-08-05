<template>
  <div v-if="show"
    class="text-center mt-5 absolute rounded border-2 bg-white p-4 right-1/2 top-1/4 translate-x-1/2 translate-y-1/2"
  >
    <div class="flex">
      <h1 class="py-4 text-3xl">shorten your big url</h1>
      <i
        class="fas fa-times-circle text-black-800 hover:text-black-500 cursor-pointer float-right"
        @click="close"
      ></i>
    </div>
    <div>
      <form
        @submit.prevent="submit"
        class="flex justify-center items-center gap-6"
      >
        <div>
          <div>
            <input
              v-model="form.original_url"
              class="w-64 m-2 p-2 border rounded-md shadow-md"
              type="text"
              placeholder="paste your big url"
            />
          </div>
          <div class="text-red-500 text-sm" v-if="errors.original_url">
            {{ errors.original_url }}
          </div>
          <div>
            <input
              v-model="form.title"
              class="w-64 m-2 p-2 border rounded-md shadow-md"
              type="text"
              placeholder="title for your url"
            />
          </div>
          <div class="text-red-500 text-sm" v-if="errors.title">
            {{ errors.title }}
          </div>
        </div>
        <i
          class="fas fa-paper-plane text-orange-600 cursor-pointer"
          @click="submit"
        ></i>
      </form>
    </div>
  </div>
</template>

<script>
export default {
    props:['show','items'],
  data() {
    return {
      form: {
        original_url: "",
        title: "",
      },
      errors: {},

    };
  },
  methods: {
    submit() {
      if (this.original_url == "") {
        return;
      }
      axios
        .post("/url", this.form)
        .then((res) => {
          this.form.original_url = "";
          this.form.title = "";
          console.log(res.data);
          this.close();
          this.items.data.unshift(res.data);
          this.$notify({
            title: "hello dear",
            text: "created succesfully",
            type: "warning",
          });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
    close()
    {
        this.errors={};
        this.$emit('closeModal');
    }
  },

};
</script>

<style>
</style>