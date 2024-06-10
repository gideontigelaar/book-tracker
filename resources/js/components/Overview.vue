<template>
    <div class="search-bar">
        <input type="text" v-model="search" placeholder="Search books">
        <button @click="searchBooks">Search</button>
    </div>

    <div class="overview-heading">
        <h1>All books</h1>
        <button @click="sortBooks">Sort</button>
    </div>

    <div class="book-cards">
        <div class="book-card">
            <h3>Title</h3>
            <span>Author: Test</span>
            <span>ISBN: 1234567890</span>
            <span>Status: Not read</span>
        </div>

        <div class="book-card">
            <h3>Title</h3>
            <span>Author: Test</span>
            <span>ISBN: 1234567890</span>
            <span>Status: Not read</span>
        </div>
    </div>
</template>