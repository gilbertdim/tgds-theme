<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  href: String,
  active: {
    type: Boolean,
    default: false,
  },
});

const classes = computed(() => {
  return props.active
      ? 'flex pointer-events-none transition duration-500 py-2 px-3 rounded text-blue-700'
      : 'flex hover:bg-blue-50 hover:text-black transition duration-500 py-2 px-3 rounded';
});

</script>

<template>
  <a :href="href" :class="classes">
    <slot />
  </a>
</template>

<style scoped>

</style>
