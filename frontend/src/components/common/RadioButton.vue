<template>
    <div>
      <input :type="type" :name="name" :id="id" class="m-2" :value="value" />
      <label :for="id">{{ label }}</label>
    </div>
</template>

<script>
export default {
    name: 'RadioButton',
    props: {
        label: String,
        type: {
            type: String,
            default: 'radio'
        },
        name: String,
        id: String,
        value: String
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>