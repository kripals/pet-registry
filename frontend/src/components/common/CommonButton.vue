<template>
    <button @click="handleClick" :class="buttonClass">
      <slot></slot>
    </button>
</template>

<script>
export default {
    name: 'CommonButton',
    props: {
        buttonClass: {
            type: String,
            default: 'text-sm font-medium text-indigo-600 hover:text-indigo-500'
        }
    },
    methods: {
        handleClick(event) {
            this.$emit('click', event);
        }
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>