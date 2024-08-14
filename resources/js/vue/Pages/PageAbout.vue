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

  <div class="my-20">
    <div class="container mx-auto p-10 lg:p-0">
      <span class="text-5xl">Expertise</span>
      <div class="flex flex-col flex-wrap gap-9 justify-center my-20">
        <div class="flex flex-wrap flex-row mx-0 xl:mx-40 gap-16 justify-center">
          <div v-for="skill in props.skills">
            <div class="flex-col text-center hover:animate-bounce transition duration-1000">
              <a href="#" :title="skill.name">
                <img :src="skill.meta.icon" class="h-20 lg:h-28 mx-auto"/>
<!--              <div class="overflow-hidden bg-blue-50 mt-2 h-1.5 rounded-full w-full">-->
<!--                <span class="h-full bg-blue-500 w-full block rounded-full"-->
<!--                      :style="{width: skill.meta.rating + '%' }"></span>-->
<!--              </div>-->
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <ContactUs />

</template>

<style scoped>

</style>