<script setup lang="ts">
import { computed, ref } from 'vue';
import { route } from '../../../vendor/tightenco/ziggy/src/js';
import { router, usePage } from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';
import { User } from '../utils';
import PrimaryButton from '../Components/PrimaryButton.vue';

type PageProps = {
    props: {
        auth: {
            user: User
            roles: string[]
        }
    }
}

const page: PageProps = usePage();
const roles = computed(() => page.props.auth.roles);

const searchTitle = ref("");

const searchBooks = () => {
    if(searchTitle.value.length === 0) {
        return;
    }

    router.visit(route('books.search', {searchTitle: searchTitle.value}))
}

const logout = () => {
    router.post(route('logout'))
}
</script>

<template>
    <header id="topnavbar" class="border-b border-coffee p-4 flex justify-between items-center bg-tan">
        <Link :href="route('home')">
            <span class="text-2xl font-bold ml-4 flex items-center gap-2">
                <i class="pi pi-book"></i>
                <h1>Cohoes Public Library</h1>
            </span>
        </Link>
        <div class="flex items-center gap-6">
            <PrimaryButton 
                @click="router.visit(route('books.manage'))"
                v-if="roles.includes('librarian')"
            >
                Manage Books
            </PrimaryButton>
            <form @submit.prevent="searchBooks">
                <div class="flex gap-2 items-center border border-coffee p-2 rounded-xl">
                    <div class="flex flex-col">
                        <input 
                            id="search-books" 
                            class="border border-coffee bg-black/10 placeholder-black focus:bg-black/50 focus:placeholder-white focus:text-white text-black transition rounded-lg text-sm p-2" 
                            placeholder="Search for books..." 
                            v-model="searchTitle"
                        >
                    </div>
                    <button type="submit" aria-label="Search for books" class="text-coffee"><i class="pi pi-search"></i></button>
                </div>
            </form>
            <button @click="logout" aria-label="Sign Out"><i class="pi pi-sign-out"></i></button>
        </div>
    </header>
    <main class="bg-almond/75 min-h-[calc(100vh-90px)]">
        <div class="mx-20 border border-coffee/30 px-4 py-2">
            <slot></slot>
        </div>
    </main>
</template>

<style>
</style>