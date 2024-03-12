<script setup>

import {usePage} from "@inertiajs/inertia-vue3";

const { props } = usePage();

</script>

<template>
    <tr class="form-field form-required term-name-wrap">
        <th scope="row" class="w-52 text-left text-md">
          <label for="icon">Font Awesome Icon</label>
        </th>
        <td>
          <input name="icon"
                 id="icon"
                 type="text"
                 :value="props.icon"
                 aria-required="true"
                 aria-describedby="icon-description"
                 class="w-full">
          <p class="description" id="icon-description">The font awesome class.</p>
        </td>
    </tr>
</template>

<style scoped>

</style>