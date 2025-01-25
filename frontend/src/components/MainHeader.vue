<template>
  <header class="bg-white">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex flex-1">
        <div class="hidden lg:flex lg:gap-x-12">

        </div>
        <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon class="size-6" aria-hidden="true" />
          </button>
        </div>
      </div>
      <a href="#" class="-m-1.5 p-1.5">
        <span class="sr-only">Your Company</span>
        <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="" />
      </a>
      <div class="flex flex-1 justify-end">
        <a href="#" class="text-sm/6 font-semibold text-gray-900 mx-2">Help</a>
        <a href="#" class="text-sm/6 font-semibold text-blue-900 mx-2">Save and Finish Later</a>
      </div>
    </nav>
  </header>
</template>

<script>
  import logo from '../assets/logo.png'
  export default {
    name: 'MainHeader',
    data() {
      return {
        logo
      }
    }
  }
</script>