<template>
  <InputField
    id="dogName"
    name="dogName"
    label="What is your dog's name?"
    v-model="dogName"
    placeholder="Enter your dog's name"
  />
</template>

<script>
import InputField from "./common/InputField.vue";

export default {
  name: "DogNameInput",
  props: {
    dogName: {
      type: String,
      required: true,
    },
  },
  emits: ["update:dogName"],
  components: {
    InputField,
  },
};
</script>