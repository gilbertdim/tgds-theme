<script setup>

import {usePage} from "@inertiajs/inertia-vue3";

const { props } = usePage();

</script>

<template>
    <tr class="form-field form-required term-name-wrap">
        <th scope="row" class="w-52 text-left text-md">
          <label for="username">Username</label>
        </th>
        <td>
          <input name="username"
                 id="username"
                 type="text"
                 :value="props.username"
                 aria-required="true"
                 aria-describedby="username-description"
                 class="w-full">
          <p class="description" id="username-description">Social media username.</p>
        </td>
    </tr>
  <tr class="form-field form-required term-name-wrap">
    <th scope="row" class="w-52 text-left text-md">
      <label for="icon">Icon</label>
    </th>
    <td>
      <input name="icon"
             id="icon"
             type="text"
             :value="props.icon"
             aria-required="true"
             aria-describedby="icon-description"
             class="w-full">
      <p class="description" id="icon-description">Social media icon.</p>
    </td>
  </tr>
  <tr class="form-field form-required term-name-wrap">
    <th scope="row" class="w-52 text-left text-md">
      <label for="link">Link</label>
    </th>
    <td>
      <input name="link"
             id="link"
             type="text"
             :value="props.link"
             aria-required="true"
             aria-describedby="link-description"
             class="w-full">
      <p class="description" id="link-description">Social media url link.</p>
    </td>
  </tr>
</template>

<style scoped>

</style>