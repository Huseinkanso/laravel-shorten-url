<template>
  <section class="p-2 w-3/12 m-1 border rounded">
    <pagination :items="allItems"/>
    <transition-group name="list" tag="div">
      <div v-for="item in items" :key="item.id" class="border-b py-3">
        <h3
          class="semi-bold text-orange-800 cursor-pointer hover:text-orange-500"
          @click="showDetails(item)"
        >
          {{ item.title }}
        </h3>
        <div class="flex justify-between text-sm text-gray-700">
          <div class="flex items-center">
            <p
              class="text-sm cursor-pointer"
              @click="copyToClipBoard(item.path)"
            >
              {{ item.shorten_url }}
            </p>
            <a target="blank" :href="item.path">
              <i class="fas fa-external-link-alt m-2"></i>
            </a>
          </div>
          <div class="text-xm">
            {{ item.created_at }}
          </div>
        </div>
      </div>
    </transition-group>
  </section>
</template>

<script>
import Pagination from './Pagination.vue';
export default {
  components: { Pagination },
  props: ["items","allItems"],
  methods: {
    showDetails(item) {
      this.$emit("urlSelected", item);
    },
  },
};
</script>

<style>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>