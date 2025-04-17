<script setup lang="ts">
import { Button } from 'primevue';
import { ref } from 'vue';
import { route } from '../../../vendor/tightenco/ziggy/src/js';
import { router } from '@inertiajs/vue3';

const searchInput = ref("");

const searchBooks = () => {}

const logout = () => {
    router.post(route('logout'))
}
</script>

<template>
    <header id="topnavbar" class="border-b border-coffee p-4 flex justify-between items-center bg-tan">
        <h1 class="text-2xl font-bold ml-4">Cohoes Public Library</h1>
        <div class="flex gap-6">
            <form @submit.prevent="searchBooks">
                <div class="flex gap-2 items-center border border-coffee p-2 rounded-xl">
                    <div class="flex flex-col">
                        <input id="search-books" class="border border-coffee bg-black/10 placeholder-black focus:bg-black/50 focus:placeholder-white focus:text-white text-black transition rounded-lg text-sm p-2" placeholder="Search for books..." v-model="searchInput">
                    </div>
                    <Button aria-label="Search for books" icon="pi pi-search" class="text-coffee" iconPos="right"></Button>
                </div>
            </form>
            <Button @click="logout" aria-label="Sign Out" icon="pi pi-sign-out"></Button>
        </div>
    </header>
    <main class="bg-almond/75 min-h-[calc(100vh-87px)]">
        <div class="mx-20 border border-coffee/30 px-4 py-2">
            <slot></slot>
        </div>
    </main>
</template>

<style>
</style>