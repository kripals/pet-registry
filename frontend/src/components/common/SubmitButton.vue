<template>
    <div class="px-4 py-4 sm:px-6 flex justify-center">
        <button 
        type="submit"
        class="inline-flex items-center rounded-md bg-indigo-600 px-12 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            {{ label }}
        </button>
    </div>
</template>

<script>
export default {
    name: 'SubmitButton',
    props: {
        label: {
            type: String,
            default: 'Submit'
        }
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>