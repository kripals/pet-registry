<template>
    <div class="home">
      <h1>Document List</h1>
      <ul>
        <li v-for="document in documents" :key="document.id">
          <router-link :to="{ name: 'DocumentScreen', params: { id: document.id } }">
            {{ document.title }}
          </router-link>
        </li>
      </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
data() {
    return {
    documents: []
    };
},
created() {
    axios.get('http://localhost:8000/api/documents')
    .then(response => {
        this.documents = response.data;
    })
    .catch(error => {
        console.error(error);
    });
}
};
</script>

<style scoped>
.home {
padding: 20px;
}
</style>