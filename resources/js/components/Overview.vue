<script setup>
import axios from 'axios';
import { ref, watch } from 'vue';

const search = ref('');
const books = ref([]);
const sortBy = ref('');
const sortOrder = ref('asc'); // or 'desc' for descending

function fetchBooks() {
    axios.get('/api/books', {
        params: {
            search: search.value,
            sort_by: sortBy.value,
            sort_order: sortOrder.value,
        }
    })
    .then(response => {
        books.value = response.data;
    })
    .catch(error => {
        console.log(error);
    });
}

// Watch for changes in search and sort criteria and fetch books accordingly
watch([search, sortBy, sortOrder], fetchBooks);

// Initial fetch
fetchBooks();

function sortBooks(by) {
    if (sortBy.value === by) {
        sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
    } else {
        sortBy.value = by;
        sortOrder.value = 'asc';
    }
    fetchBooks();
}
</script>

<template>
    <div class="search-bar">
        <input type="text" v-model="search" placeholder="Search books">
    </div>

    <div class="overview-heading">
        <h1>All books</h1>
        <select @change="sortBooks($event.target.value)">
            <option value="title">Title</option>
            <option value="author">Author</option>
            <option value="isbn">ISBN</option>
            <option value="is_read">Status</option>
        </select>
    </div>

    <div class="book-cards">
        <div v-for="book in books" :key="book.id" class="book-card">
            <h3>{{ book.title }}</h3>
            <span>Author: {{ book.author }}</span>
            <span>ISBN: {{ book.isbn }}</span>
            <span>Status: {{ book.is_read ? 'Read' : 'Not read' }}</span>
        </div>
    </div>
</template>