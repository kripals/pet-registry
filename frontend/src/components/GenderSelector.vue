<template>
    <div class="mt-3">
      <label for="age" class="block text-sm/6 font-medium text-gray-900">What gender are they?</label>
      <div class="mt-2 grid grid-cols-3 gap-3 sm:grid-cols-6">
        <label class="flex cursor-pointer items-center justify-center rounded-md px-3 py-3 text-sm font-semibold uppercase focus:outline-none sm:flex-1">
            <RadioButton label="Male" name="memory-option" id="male" value="m" />
        </label>
        <label class="flex cursor-pointer items-center justify-center rounded-md px-3 py-3 text-sm font-semibold uppercase focus:outline-none sm:flex-1">
            <RadioButton label="Female" name="memory-option" id="female" value="f" />
        </label>
      </div>
    </div>
</template>

<script>
import RadioButton from './common/RadioButton.vue';

export default {
    name: 'GenderSelector',
    components: {
        RadioButton
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>