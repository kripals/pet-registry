<template>
    <div class="flex items-center">
        <input
            type="radio"
            :id="id"
            :name="name"
            :value="value"
            :checked="modelValue === value"
            @change="$emit('update:modelValue', value)"
            class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300"
        />
        <label :for="id" class="ml-2 text-sm">{{ label }}</label>
    </div>
</template>

<script>
export default {
    name: 'RadioButton',
    props: {
        id: String,
        name: String,
        value: String,
        label: String,
        modelValue: String
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>