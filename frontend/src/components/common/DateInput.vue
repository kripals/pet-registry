<template>
    <div class="mt-4">
        <label :for="id" class="block text-sm font-medium text-gray-700">{{ label }}</label>
        <input type="date" :id="id" v-model="modelValue" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
    </div>
</template>

<script>
export default {
    name: 'DateInput',
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
            type: String,
            required: true
        }
    },
    emits: ['update:modelValue']
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>