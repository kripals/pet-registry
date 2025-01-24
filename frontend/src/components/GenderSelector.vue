<template>
  <div>
    <label for="gender" class="block text-sm/6 font-medium text-gray-900">
      What gender are they?
    </label>
    <div class="mt-2 grid grid-cols-3 gap-3 sm:grid-cols-6">
      <RadioButton
        id="male"
        name="gender"
        value="male"
        label="Male"
        v-model="gender"
      />
      <RadioButton
        id="female"
        name="gender"
        value="female"
        label="Female"
        v-model="gender"
      />
    </div>
  </div>
</template>

<script>
import RadioButton from "./common/RadioButton.vue";

export default {
  name: "GenderSelector",
  components: { RadioButton },
  props: {
    gender: {
      type: String,
      required: true,
    },
  },
  emits: ["update:gender"],
};
</script>