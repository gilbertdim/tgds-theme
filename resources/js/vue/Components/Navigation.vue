<template>
  <div class="float-start w-full">
    <nav class="bg-white opacity-95 w-full">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img :src="props.site.logo" class="h-24" alt="{{ props.site.name }} Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white sr-only">{{ props.site.name }}</span>
        </a>
        <div class="w-full md:block md:w-auto" id="navbar-multi-level">
          <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <NavLink :href="home" :active="true">Home</NavLink>
            <NavLink>Services</NavLink>
            <NavLink>Contact</NavLink>
            <NavLink>About</NavLink>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import NavLink from "../Components/NavLink.vue";

const { props } = usePage()
</script>

<style></style>
