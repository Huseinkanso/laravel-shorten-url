<template>
  <section class="m-1 p-2 w-9/12 border rounded">
    <div v-if="selectedItem">
      <div class="flex items-center justify-between">
        <h1>{{ selectedItem.title }}</h1>
        <i
        class="fas fa-times text-red-400 hover:text-red-600 cursor-pointer"
        @click="destroy"
        ></i>
      </div>
      <p>{{ selectedItem.original_url }}</p>
      <div class="flex items-center">
        <p class="text-orange-500 text-xs">{{ selectedItem.shorten_url }}</p>
        <i
          class="fas fa-copy text-orange-500 text-xs mx-2 py-1 cursor-pointer"
          @click="copyToClipBoard(selectedItem.path)"
        ></i>
      </div>
      <div>
        <p class="text-sm text-gray-600">visits: {{ selectedItem.visits }}</p>
      </div>
    </div>
    <div class="text-center text-xl text-gray-500" v-else>
      <h1>select url to show details</h1>
    </div>
  </section>
</template>

<script>
export default {
  props: ["selectedItem"],
  methods: {
    copyToClipBoard(url) {
      // double click
      //not good
      // document.execCommand("copy");

      navigator.clipboard.writeText(url);
    },
    destroy()
    {
        this.$emit("deleteItem",this.selectedItem);
    }
  },
};
</script>

<style>
</style>