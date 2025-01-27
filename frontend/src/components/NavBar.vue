<template>
    <nav class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Docupet</span>
                <img class="h-8 w-auto" :src="logo" alt="Docupet Logo" />
            </a>
        </div>
        <div class="flex space-x-4">
            <router-link to="/" class="text-sm font-medium text-gray-700 hover:text-gray-900">Home</router-link>
            <router-link to="/register" class="text-sm font-medium text-gray-700 hover:text-gray-900">Register</router-link>
        </div>
        <div class="flex flex-1 justify-end">
            <CommonButton @click="logout">Logout</CommonButton>
        </div>
      </div>
    </nav>
</template>

<script>
import logo from '../assets/logo.png';
import CommonButton from './common/CommonButton.vue';

export default {
    name: 'NavBar',
    components: {
        CommonButton
    },
    methods: {
        logout() {
            this.$emit('logout');
        }
    },
    data() {
        return {
            logo
        }
    }
}
</script>

<style scoped>
    nav {
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    nav a {
    text-decoration: none;
    color: #4a5568;
    }

    nav a:hover {
    color: #2d3748;
    }

    nav .flex {
    display: flex;
    align-items: center;
    }

    nav .space-x-6 > * + * {
    margin-left: 1.5rem;
    }

    nav .space-x-2 > * + * {
    margin-left: 0.5rem;
    }

    nav .text-xl {
    font-size: 1.25rem;
    font-weight: 700;
    }

    nav .text-sm {
    font-size: 0.875rem;
    font-weight: 500;
    }

    nav .font-bold {
    font-weight: 700;
    }

    nav .font-medium {
    font-weight: 500;
    }

    nav .text-gray-700 {
    color: #4a5568;
    }

    nav .text-gray-800 {
    color: #2d3748;
    }

    nav .hover\:text-gray-900:hover {
    color: #1a202c;
    }
</style>