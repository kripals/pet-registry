<template>
  <div>
    <label for="breed" class="block text-sm/6 font-medium text-gray-900">
      What breed are they?
    </label>
    <div class="mt-2">
      <RadioButton
        id="purebreed"
        name="breed"
        value="purebreed"
        label="It's Purebreed"
        v-model="breedType"
      />
      <SelectDropdown
        v-if="breedType === 'purebreed'"
        :options="breeds"
        v-model="selectedBreed"
        placeholder="Select an option"
      />
      <RadioButton
        id="mixed"
        name="breed"
        value="mixed"
        label="It's Mixed"
        v-model="breedType"
      />
      <SelectDropdown
        v-if="breedType === 'mixed'"
        :options="breeds"
        v-model="selectedBreed"
        placeholder="Select options"
        :is-multi="true"
      />
      <RadioButton
        id="unknown"
        name="breed"
        value="unknown"
        label="I don't know"
        v-model="breedType"
      />
    </div>
  </div>
</template>

<script>
import RadioButton from "./common/RadioButton.vue";
import SelectDropdown from "./common/SelectDropdown.vue";

export default {
  name: "BreedSelector",
  components: { RadioButton, SelectDropdown },
  props: {
    breeds: { type: Array, required: true },
    breedType: { type: String, required: true },
    selectedBreed: { type: [String, Array], required: true },
  },
  emits: ["update:breedType", "update:selectedBreed"],
};
</script>