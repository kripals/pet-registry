<template>
    <div>
        <label for="gender" class="block text-md">Gender</label>
        <select v-model="selectedGender" class="mt-2 border-r-14 border-r-transparent border-r block w-full rounded-md bg-white px-3 py-1.5 pr-5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6 h-10">
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