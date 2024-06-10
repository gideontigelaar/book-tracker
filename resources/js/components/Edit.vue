<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const title = ref('');
const author = ref('');
const isbn = ref(null);
const is_read = ref(true);

const route = useRoute();
const router = useRouter();
const bookId = route.params.id;

onMounted(() => {
    fetchBookDetails(bookId);
});

function fetchBookDetails(id) {
    axios.get(`/api/books/${id}`)
        .then(response => {
            const book = response.data;
            title.value = book.title;
            author.value = book.author;
            isbn.value = book.isbn;
            is_read.value = book.is_read;
        })
        .catch(error => {
            console.log(error);
            alert('Book not found');
            router.push('/');
        });
}

function saveChanges() {
    axios.put(`/api/books/${bookId}`, {
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
            alert('An error occurred while updating the book');
        }
    });
}

function deleteBook() {
    axios.delete(`/api/books/${bookId}`)
        .then(response => {
            console.log(response.data);
            router.push('/');
        })
        .catch(error => {
            console.log(error);
            alert('An error occurred while deleting the book');
        });
}
</script>

<template>
    <div class="edit-book">
        <h1>Edit book</h1>
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
        <div class="top">
            <div class="form-group">
                <button type="submit" @click.prevent="saveChanges" class="primaryBtn">Save changes</button>
            </div>
            <div class="form-group">
                <button @click="$router.push('/')" class="secondaryBtn">Cancel</button>
            </div>
        </div>

        <div class="top">
            <div class="form-group">
                <button @click="deleteBook" class="deleteBtn">Delete</button>
            </div>
        </div>
    </div>
</template>