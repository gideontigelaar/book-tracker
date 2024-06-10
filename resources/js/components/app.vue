<template>
    <div class="container">
        <div class="top-bar">
            <b><a href="/">Book Tracker</a></b>
            <nav class="nav-links">
                <router-link to="/">Overview</router-link>
                <router-link to="/about">About</router-link>
            </nav>
        </div>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>