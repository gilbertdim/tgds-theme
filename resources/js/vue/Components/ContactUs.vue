<script setup>

import FormLabel from "./FormLabel.vue";
import FormInput from "./FormInput.vue";
import FormText from "./FormText.vue";
import FormButton from "./FormButton.vue";
</script>

<template>
  <div class="bg-gray-700 w-full py-14 text-white">
    <div class="xl:container xl:mx-auto">
      <div class="grid grid-cols-3 gap-3">
        <div>
          <p class="text-2xl text-center w-full mb-2">Connect with Us</p>
        </div>
        <div>
          <p class="text-2xl text-center w-full mb-2">Find Us</p>
          <div class="w-full">
            <iframe class="w-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123846.62073528515!2d121.1016582643971!3d14.064956481836854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd68b27e517125%3A0xbf3d5b3b7274628c!2sSanto%20Tomas%2C%20Batangas!5e0!3m2!1sen!2sph!4v1710205066515!5m2!1sen!2sph"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <div>
          <p class="text-2xl text-center w-full mb-2">Send us a message</p>
          <form action="">
            <div class="flex-col mb-4">
              <FormLabel>Name</FormLabel>
              <FormInput/>
            </div>
            <div class="flex-col mb-4">
              <FormLabel>Email Address</FormLabel>
              <FormInput/>
            </div>
            <div class="flex-col mb-4">
              <FormLabel>Contact Number</FormLabel>
              <FormInput/>
            </div>
            <div class="flex-col mb-4">
              <FormLabel>Message</FormLabel>
              <FormText rows="10"/>
            </div>
            <div class="flex-col">
              <FormButton>Send Message</FormButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>