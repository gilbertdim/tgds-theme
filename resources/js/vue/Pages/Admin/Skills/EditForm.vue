<script setup>

import {usePage} from "@inertiajs/inertia-vue3";

const { props } = usePage();

</script>

<template>
  <table class="form-table" role="presentation">
    <tbody>
      <tr class="form-field form-required term-name-wrap">
        <th scope="row">
          <label for="rating">Rating</label>
        </th>
        <td>
          <input type="number"
                 name="rating"
                 id="rating"
                 :value="props.rating"
                 aria-required="true"
                 aria-describedby="rating-description"
                 class="w-full" />
          <p class="description" id="rating-description">Rate your skill from 1 to 100</p>
        </td>
      </tr>
      <tr class="form-field term-slug-wrap">
        <th scope="row">
          <label for="icon">icon</label>
        </th>
        <td>
          <input type="text"
                 name="icon"
                 id="icon"
                 :value="props.icon"
                 aria-required="true"
                 aria-describedby="icon-description"
                 class="w-full" />
          <p class="description" id="icon-description">Font awesome icon</p>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>