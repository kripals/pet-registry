<template>
  <div class="bg-gray-100 h-screen">
    <MainHeader />
    <div class="mt-4 w-1/2 mx-auto">
    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
      <div class="px-4 py-5 sm:px-6">
        Paws image
      </div>
      <div class="px-4 py-5 sm:p-6">
        <div>
          <label for="name" class="block text-sm/6 font-medium text-gray-900">What is your dog's name?</label>
          <div class="mt-2">
            <input type="text" name="name" id="name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="" />
          </div>
        </div>
        <div class="mt-3">
          <label for="breed" class="block text-sm/6 font-medium text-gray-900">What breed are they?</label>
          <div class="mt-2">
            <div>
              <input type="radio" name="breed" id="purebreed" class="m-2" value="purebreed" />
              <label for="breed">It's Purebreed</label>
              <VueSelect id="mixed" v-model="selected" :options="breeds" placeholder="Select an option" />
            </div>
            <div>
              <input type="radio" name="breed" id="mixed" class="m-2" value="mixed" />
              <label for="mixed">It's Mixed</label>
              <VueSelect id="mixed" v-model="selected" :options="breeds" placeholder="Select an option" :is-multi="true" />
            </div>
            <div>
              <input type="radio" name="breed" id="unknown" class="m-2" value="unknown" />
              <label for="unknown">I don't know</label>
            </div>
          </div>
        </div>
        <div class="mt-3">
          <label for="age" class="block text-sm/6 font-medium text-gray-900">What gender are they?</label>
          <div class="mt-2 grid grid-cols-3 gap-3 sm:grid-cols-6">
            <label class="flex cursor-pointer items-center justify-center rounded-md px-3 py-3 text-sm font-semibold uppercase focus:outline-none sm:flex-1">
              <input type="radio" name="memory-option" value="m" class="sr-only">
              <span>Male</span>
            </label>
            <label class="flex cursor-pointer items-center justify-center rounded-md px-3 py-3 text-sm font-semibold uppercase focus:outline-none sm:flex-1">
              <input type="radio" name="memory-option" value="f" class="sr-only">
              <span>Female</span>
            </label>
          </div>
        </div>
      </div>
      <div class="px-4 py-4 sm:px-6 flex justify-center">
        <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-12 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Continue</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import VueSelect from "vue3-select-component";
import MainHeader from "./components/MainHeader.vue";

export default {
  name: 'App',
  components: {
    MainHeader,
    VueSelect
  },
  data() {
    return {
      selected: null,
      breeds: [
        { value: 'labrador', label: 'Labrador' },
        { value: 'bulldog', label: 'Bulldog' },
        { value: 'poodle', label: 'Poodle' },
        { value: 'beagle', label: 'Beagle' },
        { value: 'rottweiler', label: 'Rottweiler' },
        { value: 'german-shepherd', label: 'German Shepherd' },
        { value: 'golden-retriever', label: 'Golden Retriever' },
        { value: 'dachshund', label: 'Dachshund' },
        { value: 'siberian-husky', label: 'Siberian Husky' },
        { value: 'chihuahua', label: 'Chihuahua' },
        { value: 'pomeranian', label: 'Pomeranian' },
        { value: 'shih-tzu', label: 'Shih Tzu' },
        { value: 'boxer', label: 'Boxer' },
        { value: 'yorkshire-terrier', label: 'Yorkshire Terrier' },
        { value: 'doberman', label: 'Doberman' },
        { value: 'great-dane', label: 'Great Dane' },
        { value: 'pug', label: 'Pug' },
        { value: 'border-collie', label: 'Border Collie' },
        { value: 'australian-shepherd', label: 'Australian Shepherd' },
        { value: 'shetland-sheepdog', label: 'Shetland Sheepdog' },
        { value: 'cavalier-king-charles-spaniel', label: 'Cavalier King Charles Spaniel' },
        { value: 'boston-terrier', label: 'Boston Terrier' },
        { value: 'maltese', label: 'Maltese' },
        { value: 'papillon', label: 'Papillon' },
        { value: 'cocker-spaniel', label: 'Cocker Spaniel' },
        { value: 'pembroke-welsh-corgi', label: 'Pembroke Welsh Corgi' },
        { value: 'miniature-schnauzer', label: 'Miniature Schnauzer' }
      ]
    }
  }
}
</script>

<style>
/* Add additional styles here */
</style>