<script setup>

import {usePage} from "@inertiajs/inertia-vue3";
import Navigation from "../Components/Navigation.vue";
import ContactUs from "../Components/ContactUs.vue";

const { props } = usePage()

function profileImage() {
  return this.props.site.theme_path + '/assets/images/tgds-me.png';
}
</script>

<template>
  <div class="bg-gray-700">
    <Navigation class="bg-gray-700 text-white"/>

    <div class="xl:container xl:mx-auto">
      <div class="flex flex-nowrap gap-5 mx-0 xl:mx-32 lg:gap-20">
        <img class="h-[40rem]" :src="profileImage()" alt="" >

        <div class="hidden my-auto sm:block flex-col">
          <div class="text-gray-50 text-5xl md:text-3xl xl:text-5xl">Hi, I'm</div>
          <div class="text-blue-400 text-7xl md:text-5xl xl:text-7xl">Gilbert Dimaano</div>
          <hr class="hidden lg:block my-2">
          <div class="text-gray-300 text-4xl">PHP Laravel and Wordpress Developer</div>
          <div class="hidden 2xl:block mt-5 text-white" v-html="props.page.post_content"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="2xl:hidden my-10 px-10">
    <div class="sm:hidden">
      <h1 class="text-2xl my-3">Hi, I'm <span class="text-blue-400">Gilbert Dimaano</span></h1>
      <hr class="my-1">
      <div>PHP Laravel and Wordpress Developer</div>
    </div>

    <div class="mt-5" v-html="props.page.post_content"></div>
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