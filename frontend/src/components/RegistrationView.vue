<template>
    <div>
        <NavBar />
        <div class="container mx-auto py-8">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="min-w-full py-2 align-middle inline-block">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Registration No</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.registration.registrationNo }}</td>
                                    </tr>
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Pet Name</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.petDetail.name }}</td>
                                    </tr>
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Pet Age</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.petDetail.age }}</td>
                                    </tr>
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Pet Gender</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.petDetail.gender }}</td>
                                    </tr>
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Pet DOB</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.petDetail.dob }}</td>
                                    </tr>
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Breeds</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.petDetail.breeds.join(', ') }}</td>
                                    </tr>
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Owner Name</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.owner.name }}</td>
                                    </tr>
                                    <tr v-if="registration">
                                        <td class="px-6 py-4 whitespace-nowrap">Owner Email</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ registration.owner.email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";
import { apiFetch } from '../utils/api'; // Import the utility function

export default {
    name: 'RegistrationView',
    components: {
        NavBar
    },
    data() {
        return {
            registration: null
        }
    },
    methods: {
        async fetchRegistration(id) {
            try {
                const response = await apiFetch(`/registrations/${id}/details`, 'GET');
                if (response && response.data) {
                    this.registration = response.data;
                } else {
                    this.registration = null;
                }
            } catch (error) {
                console.error('Error fetching registration:', error);
            }
        },
        logout() {
            this.$root.logout();
        }
    },
    mounted() {
        const registrationId = this.$route.params.id; // Assuming the ID is passed as a route parameter
        this.fetchRegistration(registrationId);
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>