<template>
    <div class="mt-4">
        <label :for="id" class="block text-sm font-medium text-gray-700">{{ label }}</label>
        <input type="number" :id="id" v-model="modelValue" :min="min" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </div>
</template>

<script>
export default {
    name: 'NumberInput',
    props: {
        id: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        modelValue: {
            type: [String, Number],
            required: true
        },
        min: {
            type: Number,
            default: 0
        }
    },
    emits: ['update:modelValue']
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>