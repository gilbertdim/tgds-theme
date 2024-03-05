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
      ? 'flex hover:bg-blue-50 transition duration-500 py-2 px-3 rounded text-blue-700'
      : 'flex hover:bg-blue-50 transition duration-500 py-2 px-3 rounded text-black ';
});

</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>

<style scoped>

</style>
