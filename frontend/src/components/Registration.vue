<template>
  <div class="bg-gray-100 h-screen">
    <div class="mt-10 lg:w-1/2 w-full mx-auto px-4">
      <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
        <div class="px-4 py-5 sm:px-8">
          Registration for new dog
        </div>
        
        <div class="px-4 py-5 sm:p-8">
          <div>
            <h2 class="text-lg/6 font-semibold text-gray-900">Tell us about your dog.</h2>
          </div>
          <form @submit.prevent="registerPet">
            <DogNameInput v-model="name" />
            <BreedSelector v-model="breed" />
            <GenderSelector v-model="gender" />

            <div class="mt-4">
              <label class="block text-sm font-medium text-gray-700">
                <input type="checkbox" v-model="knowsDob" @change="toggleDobField" />
                I know my dog's date of birth
              </label>
            </div>
            <DateInput id="dob" label="Date of Birth" v-model="dob" :disabled="!knowsDob" />
            <NumberInput id="age" label="Approximate Age" v-model="age" :min="0" />
            
            <OwnerSelector v-model="owner" />
            <SubmitButton label="Continue" />
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MainHeader from "./MainHeader.vue";
import DogNameInput from "./DogNameInput.vue";
import BreedSelector from "./BreedSelector.vue";
import GenderSelector from "./GenderSelector.vue";
import OwnerSelector from "./OwnerSelector.vue";
import SubmitButton from "./common/SubmitButton.vue";
import DateInput from "./common/DateInput.vue";
import NumberInput from "./common/NumberInput.vue";
import { apiFetch } from '../utils/api'; // Import the utility function
import { calculateAge } from '../utils/utils'; // Import the calculateAge function

export default {
  name: 'Registration',
  components: {
      MainHeader,
      DogNameInput,
      BreedSelector,
      GenderSelector,
      OwnerSelector,
      SubmitButton,
      DateInput,
      NumberInput
  },
  data() {
      return {
          name: '',
          breed: '',
          gender: '',
          dob: '',
          age: '',
          knowsDob: false,
          owner: ''
      };
  },
  watch: {
      dob(newDob) {
          if (this.knowsDob) {
              this.age = calculateAge(newDob);
          }
      }
  },
  methods: {
      toggleDobField() {
          if (!this.knowsDob) {
              this.dob = '';
          }
      },
      async registerPet() {
          try {
              const petDetailData = {
                  name: this.name,
                  age: this.age,
                  gender: this.gender,
                  dob: this.knowsDob ? this.dob : null
              };

              const registrationData = {
                  breed_id: Array.isArray(this.breed) ? this.breed : [this.breed],
                  pet_detail: petDetailData,
                  owner_id: this.owner
              };

              const response = await apiFetch('/registrations', 'POST', {
                  body: JSON.stringify(registrationData),
                  headers: {
                      'Content-Type': 'application/json'
                  }
              });

              if (response) {
                  alert('Registration successful!');
                  this.$router.push(`/registrations/${response.id}/details`);
              }
          } catch (error) {
              console.error('Error registering dog:', error);
              alert('Registration failed. Please try again.');
          }
      },
      logout() {
          this.$root.logout();
      }
  }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>