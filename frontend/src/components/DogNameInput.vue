<template>
  <TextInput label="What is your dog's name?" v-model="dogName" id="dogName" placeholder="Monte"/>
</template>

<script>
import TextInput from './common/TextInput.vue';

export default {
  name: 'DogNameInput',
  components: {
    TextInput
  },
  data() {
    return {
      dogName: ''
    };
  }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>