<template>
  <header>
    <title v-text="props.site.name"></title>
  </header>
</template>

<script setup>

import {usePage} from "@inertiajs/inertia-vue3";

const { props } = usePage();
</script>

<style>

</style>
