<script setup>

</script>

<template>
  <div class="w-full text-center rounded-xl flex gap-20 p-10 transition hover:bg-blue-500 hover:text-white duration-1000">
    <slot name="icon"/>
    <div class="flex flex-col text-left">
      <span class="font-bold"><slot name="title"/></span>
      <slot name="description"/>
    </div>
  </div>
</template>

<style scoped>

</style>