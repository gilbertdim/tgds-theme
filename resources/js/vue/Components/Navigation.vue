<template>
  <div class="w-full">
    <nav :class="classes">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-center md:justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img :src="props.site.logo" class="h-24" alt="{{ props.site.name }} Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white sr-only">{{ props.site.name }}</span>
        </a>
        <div class="w-full md:block md:w-auto" id="navbar-multi-level">
          <ul class="flex justify-center font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0">
            <NavLink href="/" :active="activeRoute == ''">Home</NavLink>
            <NavLink href="/#services">Services</NavLink>
            <NavLink>Contact</NavLink>
            <NavLink href="/about" :active="activeRoute == 'about'">About</NavLink>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import NavLink from "../Components/NavLink.vue";
import {computed} from "vue";

const { props } = usePage()
const attr = defineProps({
  class: {
    type: String,
    default: '',
  }
})

const activeRoute = computed(() => {
  return location.pathname.replaceAll('/', '');
})

const classes = computed(() => {
  if (attr.class != '') {
    return attr.class + ' w-full'
  }

  return 'bg-white opacity-95 w-full'
})
</script>

<style></style>
