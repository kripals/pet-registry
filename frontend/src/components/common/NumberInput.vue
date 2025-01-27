<template>
    <div>
        <label :for="id" class="block text-md">{{ label }}</label>
        <input type="number" :id="id" :value="modelValue" :min="min" class="mt-2 border-r block w-full rounded-md bg-white px-3 py-1.5 pr-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6 h-10" />
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