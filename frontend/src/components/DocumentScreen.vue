<template>
    <div class="document-screen">
      <h1>{{ document.title }}</h1>
      <p>{{ document.content }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
data() {
    return {
    document: {}
    };
},
created() {
    const documentId = this.$route.params.id;
    axios.get(`http://localhost:8000/api/documents/${documentId}`)
    .then(response => {
        this.document = response.data;
    })
    .catch(error => {
        console.error(error);
    });
}
};
</script>

<style scoped>
.document-screen {
padding: 20px;
}
</style>