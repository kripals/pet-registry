<template>
  <div>
    <label :for="id" class="block text-md">{{ label }}</label>
    <div class="mt-2">
      <input
        :type="type"
        :name="name"
        :id="id"
        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6 h-10"
        :value="modelValue"
        :placeholder="placeholder"
        @input="$emit('update:modelValue', $event.target.value)"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'TextInput',
  props: {
    label: String,
    type: {
      type: String,
      default: 'text'
    },
    name: String,
    id: String,
    modelValue: String,
    placeholder: String
  }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>