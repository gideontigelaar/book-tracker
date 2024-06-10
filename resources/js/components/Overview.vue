<script setup>
import axios from 'axios';
import { ref, watch } from 'vue';
import { useRouter } from 'vue-router';

const search = ref('');
const books = ref([]);
const sortBy = ref('');
const sortOrder = ref('asc');
const router = useRouter();

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

watch([search, sortBy, sortOrder], fetchBooks);

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

function navigateToAddBook() {
    router.push('/add');
}
</script>

<template>
    <div class="search-bar">
        <input type="text" v-model="search" placeholder="Search books by title, author, or ISBN">
    </div>

    <div class="overview-heading">
        <h1>All books ({{ books.length }})</h1>
        <div>
            <span>Sort by:&nbsp;&nbsp;</span>
            <select @change="sortBooks($event.target.value)">
                <option value="title">Title ↓</option>
                <option value="author">Author ↓</option>
                <option value="isbn">ISBN ↓</option>
                <option value="is_read">Status ↓</option>
            </select>

            <button @click="navigateToAddBook" class="primaryBtn">Add book</button>
        </div>
    </div>

    <div class="book-cards">
        <span v-if="books.length === 0">No books found</span>

        <div v-for="book in books" :key="book.id" class="book-card">
            <h3>{{ book.title }}</h3>
            <span>Author: {{ book.author }}</span>
            <span>ISBN: {{ book.isbn }}</span>
            <span>Status: {{ book.is_read ? 'Read' : 'Not read' }}</span>
            <button @click="$router.push(`/edit/${book.id}`)" class="secondaryBtn">Edit</button>
        </div>
    </div>
</template>