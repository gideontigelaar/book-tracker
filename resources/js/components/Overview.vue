<template>
    <div class="search-bar">
        <input type="text" v-model="search" placeholder="Search books">
        <button @click="searchBooks">Search</button>
    </div>

    <h1>All books</h1>
</template>