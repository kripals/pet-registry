<template>
    <div>
        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
        <select v-model="selectedGender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <option value="" disabled>Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
</template>

<script>
export default {
    name: 'GenderSelector',
    props: {
        modelValue: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            selectedGender: this.modelValue
        };
    },
    watch: {
        selectedGender(newValue) {
            this.$emit('update:modelValue', newValue);
        }
    }
};
</script>

<style scoped>
/* Add component-specific styles here */
</style>