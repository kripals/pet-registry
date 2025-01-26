<template>
    <div>
        <label for="owner" class="block text-sm font-medium text-gray-700">Select Owner</label>
        <VueSelect v-model="selectedOwner" :options="owners" placeholder="Select an owner" />
    </div>
</template>

<script>
import VueSelect from "vue3-select-component";
import { apiFetch } from '../utils/api'; // Import the utility function

export default {
    name: 'OwnerSelector',
    components: {
        VueSelect
    },
    props: {
        modelValue: {
            type: [String, Number],
            default: null
        }
    },
    data() {
        return {
            selectedOwner: this.modelValue,
            owners: [] // This will be populated with data from the API
        };
    },
    watch: {
        selectedOwner(newValue) {
            this.$emit('update:modelValue', newValue);
        }
    },
    mounted() {
        this.fetchOwners();
    },
    methods: {
        async fetchOwners() {
            try {
                const data = await apiFetch('/owners', 'GET');
                if (data) {
                    this.owners = data.data.map(owner => ({
                        label: `${owner.firstName} ${owner.lastName} (${owner.email})`,
                        value: owner.id
                    }));
                }
            } catch (error) {
                console.error('Error fetching owners:', error);
            }
        }
    }
};
</script>

<style scoped>
/* Add component-specific styles here */
</style>