<template>
    <div class="flex items-center justify-center h-screen bg-gray-100">
      <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form @submit.prevent="login">
          <TextInput label="Email" type="email" v-model="email" id="email" />
          <TextInput label="Password" type="password" v-model="password" id="password" />
          <SubmitButton label="Login" />
        </form>
      </div>
    </div>
</template>

<script>
import axios from 'axios';
import TextInput from './common/TextInput.vue';
import SubmitButton from './common/SubmitButton.vue';

export default {
    name: 'Login',
    components: {
        TextInput,
        SubmitButton
    },
    data() {
        return {
            email: '',
            password: ''
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post('http://localhost:8080/api/login', {
                    email: this.email,
                    password: this.password
                });
                const token = response.data.token;
                localStorage.setItem('token', token);
                this.$router.push('/');
            } catch (error) {
                console.error('Login failed:', error);
                alert('Login failed. Please check your credentials.');
            }
        }
    }
};
</script>

<style scoped>
/* Add component-specific styles here */
</style>