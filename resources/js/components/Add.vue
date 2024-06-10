<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const title = ref('');
const author = ref('');
const isbn = ref(null);
const is_read = ref(true);

const router = useRouter();

function addBook() {
    axios.post('/api/books', {
        title: title.value,
        author: author.value,
        isbn: isbn.value,
        is_read: is_read.value,
    })
    .then(response => {
        console.log(response.data);
        router.push('/');
    })
    .catch(error => {
        console.log(error);
        if (error.response && error.response.data.errors) {
            alert('Validation failed: ' + JSON.stringify(error.response.data.errors));
        } else {
            alert('An error occurred while adding the book');
        }
    });
}
</script>

<template>
    <div class="add-book">
        <h1>Add a new book</h1>
        <div class="top">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" v-model="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" v-model="author" required>
            </div>
        </div>
        <div class="bottom">
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="number" maxlength="13" id="isbn" v-model="isbn" required>
            </div>
            <div class="form-group">
                <label for="is_read">Status</label>
                <select id="is_read" v-model="is_read" required>
                    <option :value="true">Read</option>
                    <option :value="false">Not read</option>
                </select>
            </div>
        </div>
        <button type="submit" @click.prevent="addBook" class="primaryBtn">Add book</button>
    </div>
</template>