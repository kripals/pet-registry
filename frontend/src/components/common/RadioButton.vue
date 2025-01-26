<template>
    <div>
        <input
            type="radio"
            :id="id"
            :name="name"
            :value="value"
            :checked="modelValue === value"
            @change="$emit('update:modelValue', value)"
        />
        <label :for="id">{{ label }}</label>
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