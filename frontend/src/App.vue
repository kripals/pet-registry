<template>
  <div class="bg-gray-100 h-screen">
    <MainHeader />
    <div class="mt-4 w-1/2 mx-auto">
      <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:px-6">
          Paws image
        </div>
        <div class="px-4 py-5 sm:p-6">
          <DogNameInput v-model:dogName="dogName" />
          <BreedSelector
            v-model:breedType="breedType"
            v-model:selectedBreed="selectedBreed"
            :breeds="breeds"
          />
          <GenderSelector v-model:gender="gender" />
        </div>
        <div class="px-4 py-4 sm:px-6">
          <SubmitButton />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MainHeader from "./components/MainHeader.vue";
import DogNameInput from "./components/DogNameInput.vue";
import BreedSelector from "./components/BreedSelector.vue";
import GenderSelector from "./components/GenderSelector.vue";
import SubmitButton from "./components/SubmitButton.vue";

export default {
  name: "App",
  components: {
    MainHeader,
    DogNameInput,
    BreedSelector,
    GenderSelector,
    SubmitButton,
  },
  data() {
    return {
      dogName: "",
      breedType: "unknown",
      selectedBreed: null,
      gender: "",
      breeds: [
        { value: "labrador", label: "Labrador" },
        { value: "bulldog", label: "Bulldog" },
        // Add more breeds...
      ],
    };
  },
};
</script>