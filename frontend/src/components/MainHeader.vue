<template>
  <header class="bg-white shadow">
    <nav class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Docupet</span>
          <img class="h-8 w-auto" :src="logo" alt="Docupet Logo" />
        </a>
      </div>
      <div class="flex flex-1 justify-end">
        <CommonButton @click="logout">Logout</CommonButton>
        <a href="#" class="text-sm/6 font-semibold text-blue-400 mx-2">Save and Finish Later</a>
      </div>
    </nav>
  </header>
</template>

<script>
import logo from '../assets/logo.png';
import CommonButton from './common/CommonButton.vue';

export default {
  name: 'MainHeader',
  components: {
    CommonButton
  },
  methods: {
    logout() {
      this.$emit('logout');
    }
  },
  data() {
    return {
      logo
    }
  }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>