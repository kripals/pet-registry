<template>
    <div class="bg-gray-100 h-screen">
        <div class="mt-10 lg:w-3/4 w-full mx-auto px-4">
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:px-8">
                    <h2 class="text-lg font-semibold text-gray-900">Registered Dog Details</h2>
                </div>
                <div class="px-4 py-5 sm:p-8">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pet Detail ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner ID</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- <tr v-if="registration">
                                <td class="px-6 py-4 whitespace-nowrap">{{ registration.registrationNo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ registration.petDetailId }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ registration.ownerId }}</td>
                            </tr> -->
                        </tbody>
                    </table>
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
        // async fetchRegistration(id) {
        //     try {
        //         const data = await apiFetch('/registrations/${id}/details', 'GET');
        //         if (data && data.data) {
        //             this.registration = data.data;
        //         } else {
        //             this.registration = [];
        //         }
        //     } catch (error) {
        //         console.error('Error fetching registration:', error);
        //     }
        // },

        // logout() {
        //     localStorage.removeItem('token');
        //     this.$router.push('/login');
        // }
    },
    created() {
        const registrationId = this.$route.params.id;
        this.fetchRegistration(registrationId);
    }
}
</script>

<style scoped>
/* Add component-specific styles here */
</style>