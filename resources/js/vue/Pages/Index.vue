<template>
  <Navigation/>

  <section>
    <div class="w-full bg-cover bg-center h-screen" style="background-image: url(https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80);">
        <div class="flex items-center justify-end px-0 xl:px-60 h-full w-full bg-gray-900 bg-opacity-50">
          <div class="pr-10 xl:pr-60">
            <div class="text-white ml-auto md:w-1/2 flex gap-2 my-5">
              <i class="fa-solid fa-arrow-trend-up my-auto text-6xl xl:text-9xl"></i>
              <div>
                <h1 class="text-xl xl:text-5xl font-semibold text-gray-300">Let's <span class="text-white">build</span> your idea up and</h1>
                <span class="text-blue-400 great-vibes-regular font-normal text-6xl xl:text-[10rem]">Running</span>
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>

  <section class="bg-white py-10" scroll-region id="services">
    <div class="container mx-auto p-2">
      <h1 class="text-4xl text-center my-10">
        Services
      </h1>
      <div class="flex flex-col mx-1 xl:mx-52 gap-9 justify-center my-10">
        <Service v-for="service in props.services">
          <template #icon>
            <i v-for="icon in service.meta.icon" class="text-7xl" :class="icon"></i>
          </template>
          <template #title>
            {{ service.name }}
          </template>
          <template #description>
            {{ service.description }}
          </template>
        </Service>

      </div>
    </div>
  </section>

  <ContactUs/>
</template>

<script setup>

import { usePage } from '@inertiajs/inertia-vue3'
import Navigation from "../Components/Navigation.vue";
import Service from "../Components/Service.vue";
import ContactUs from "../Components/ContactUs.vue";

const { props } = usePage()

</script>

<style></style>
