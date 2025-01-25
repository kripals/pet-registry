<template>
    <div class="mt-3">
      <label for="breed" class="block text-sm/6 font-medium text-gray-900">What breed are they?</label>
      <div class="mt-2">
        <RadioButton label="It's Purebreed" name="breed" id="purebreed" value="purebreed" />
        <VueSelect inputId="purebreed" v-model="selected" :options="breeds" placeholder="Select an option" />
        <RadioButton label="It's Mixed" name="breed" id="mixed" value="mixed" />
        <VueSelect inputId="mixed" v-model="selected" :options="breeds" placeholder="Select an option" :is-multi="true" />
        <RadioButton label="I don't know" name="breed" id="unknown" value="unknown" />
      </div>
    </div>
</template>

<script>
import VueSelect from "vue3-select-component";
import RadioButton from './common/RadioButton.vue';

export default {
    name: 'BreedSelector',
    components: {
        VueSelect,
        RadioButton
    },
    data() {
        return {
            selected: null,
            breeds: [] // Add your breed options here
        }
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>