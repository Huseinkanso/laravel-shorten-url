<template>
  <div class="index flex flex-wrap">
    <div class="w-full py-2">
      <button
        @click="openModel"
        class="float-right px-1 py-2 bg-yellow-700 rounded shadow w-32 text-white"
      >
        new url
      </button>
    </div>
    <div class="w-full flex">
      <left-bar
        @urlSelected="showDetails"
        :allItems="items"
        :items="items.data"
      />

      <right-bar
        @deleteItem="destroy"
        v-if="selectedItem"
        :selectedItem="selectedItem"
      />
    </div>
    <transition name="fade">
      <modal
        :items="items.data"
        :show="isModalOpen"
        @closeModal="isModalOpen = false"
      />
    </transition>
  </div>
</template>

<script>
import axios from "axios";
import leftBar from "../components/index/leftBar.vue";
import rightBar from "../components/index/rightBar.vue";
import Modal from "../components/index/modal.vue";


export default {
  components: { leftBar, Modal, rightBar },
  middleware: "auth",
  setup() {},
  data() {
    return {
      form: {
        original_url: "",
        title: "",
      },
      errors: {},
      items: {},
      isModalOpen: false,
      selectedItem: null,
    };
  },
  created(){
    this.$eventBus.on('nextPage',this.next);
    this.$eventBus.on('prevPage',this.prev);

  },
  mounted() {
    this.fetchData(this.$route.query.page);
  },
  methods: {
    fetchData(page = 1) {
      this.$router.replace({ query: { page: page } });
      axios
        .get(`/url?page=${page}`)
        .then((res) => {
          this.items = res.data;
          console.log(this.items);
        })
        .catch((err) => {});
    },
    destroy(item) {
      axios
        .delete(`/url/${item.shorten_url}`)
        .then(() => {
          this.items = this.items.data.filter((i) => i.id != item.id);
          this.$notify({
            title: "hello dear",
            text: "deleted succesfully",
            type: "warning",
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },

    showDetails(item) {
      this.selectedItem = item;
    },
    openModel() {
      this.isModalOpen = true;
    },
    next() {
      if (this.items.last_page === this.items.current_page) return;

      let nextPage = this.items.current_page + 1;

      this.fetchData(nextPage);
    },
    prev() {
      let prevPage = this.items.current_page - 1;
      if (prevPage != 0) this.fetchData(prevPage);
    },
  },
};
</script>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>