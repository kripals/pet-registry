<template>
    <div class="mt-3">
        <label for="breed" class="block text-sm font-medium text-gray-900">What breed are they?</label>
        <div class="mt-2">
            <RadioButton label="It's Purebreed" name="breed" id="purebreed" value="purebreed" v-model="selectedBreedType" />
            <VueSelect v-if="selectedBreedType === 'purebreed'" inputId="purebreed" v-model="selected" :options="breeds" placeholder="Select an option" :is-multi="false" />
            
            <RadioButton label="It's Mixed" name="breed" id="mixed" value="mixed" v-model="selectedBreedType" />
            <VueSelect v-if="selectedBreedType === 'mixed'" inputId="mixed" v-model="selected" :options="breeds" placeholder="Select an option" :is-multi="true" />
            
            <RadioButton label="I don't know" name="breed" id="unknown" value="unknown" v-model="selectedBreedType" />
        </div>
    </div>
</template>

<script>
import VueSelect from "vue3-select-component";
import RadioButton from './common/RadioButton.vue';
import { apiFetch } from '../utils/api'; // Import the utility function

export default {
    name: 'BreedSelector',
    components: {
        VueSelect,
        RadioButton
    },
    props: {
        modelValue: {
            type: [String, Array],
            default: null
        }
    },
    data() {
        return {
            selected: this.modelValue,
            selectedBreedType: null,
            breeds: [] // This will be populated with data from the API
        };
    },
    watch: {
        selected(newValue) {
            this.$emit('update:modelValue', newValue);
        },
        selectedBreedType(newValue) {
            if (newValue === 'unknown') {
                this.selected = null;
            } else if (newValue === 'mixed') {
                this.selected = []; // Initialize as an array for multiple selections
            } else if (newValue === 'purebreed') {
                this.selected = null; // Initialize as null for single selection
            }
        }
    },
    mounted() {
        this.fetchBreeds();
    },
    methods: {
        async fetchBreeds() {
            try {
                // hardcoding the endpoint for now i.e. dogs can be of any pet type
                const data = await apiFetch('/breeds/pet-types/1', 'GET');
                if (data && data.data) {
                    this.breeds = data.data.map(breed => ({
                        label: breed.breedName,
                        value: breed.id
                    }));
                } else {
                    this.breeds = [];
                }
            } catch (error) {
                console.error('Error fetching breeds:', error);
                this.breeds = [];
            }
        }
    }
};
</script>

<style scoped>
/* Add component-specific styles here */
</style>