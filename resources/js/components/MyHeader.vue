<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
            <img :src="'./assets/image/phonebook.png'" alt="PhoneBook">
            </a>
            

            <router-link to="/" class="navbar-item" exact> Home </router-link>
            <router-link to="/about" class="navbar-item" exact> About </router-link>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>
    </nav>
</template>


<style scoped>
    .router-link-active{
        color: #3273dc
    }
</style>