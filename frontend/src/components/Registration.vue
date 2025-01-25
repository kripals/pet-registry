<template>
    <div class="bg-gray-100 h-screen">
      <MainHeader @logout="logout" />
      <div class="mt-10 lg:w-1/2 w-full mx-auto px-4">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
          <div class="px-4 py-5 sm:px-8">
            Paws image
          </div>
          
          <div class="px-4 py-5 sm:p-8">
            <div>
              <h2 class="text-lg/6 font-semibold text-gray-900">Tell us about your dog.</h2>
            </div>

            <DogNameInput />
            <BreedSelector />
            <GenderSelector />
          </div>

          <SubmitButton label="Continue" />
        </div>
      </div>
    </div>
</template>

<script>
import MainHeader from "./MainHeader.vue";
import DogNameInput from "./DogNameInput.vue";
import BreedSelector from "./BreedSelector.vue";
import GenderSelector from "./GenderSelector.vue";
import SubmitButton from "./common/SubmitButton.vue";

export default {
    name: 'Registration',
    components: {
        MainHeader,
        DogNameInput,
        BreedSelector,
        GenderSelector,
        SubmitButton
    },
    methods: {
        logout() {
        this.$root.logout();
        }
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>