<script setup>

import {usePage} from "@inertiajs/inertia-vue3";
import Navigation from "../Components/Navigation.vue";
import ContactUs from "../Components/ContactUs.vue";

const { props } = usePage()

</script>

<template>
  <div class="bg-gray-700">
    <Navigation class="bg-gray-700 text-white"/>

    <div class="xl:container xl:mx-auto py-10 px-5">
      <div class="flex flex-nowrap gap-5 mx-0 xl:mx-32 lg:gap-20">
        <div class="my-auto flex-col">
          <div class="mt-5 text-white" v-html="props.page.post_content"/>
        </div>
      </div>
    </div>
  </div>

  <ContactUs />

</template>

<style scoped>

</style>