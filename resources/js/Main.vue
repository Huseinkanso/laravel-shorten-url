<template>
    <div>
        <notifications position="top right" class=" bg-green" />
        <app-header/>
        <div class="min-h-screen">

            <router-view></router-view>
            <!-- <index/> -->

        </div>
        <app-footer/>
     </div>
</template>

<script>
import AppHeader from './components/layouts/AppHeader.vue';
import AppFooter from './components/layouts/AppFooter.vue';

export default {
  components: { AppHeader,AppFooter },

}
</script>

<style>

</style>AppFooter