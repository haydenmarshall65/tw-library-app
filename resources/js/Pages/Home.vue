<script setup lang="ts">
import axios from "axios";
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import BookTemplate from "../Components/BookTemplate.vue";
import { ref, onMounted, type Ref, computed, ComputedRef } from "vue";
import { Filter, getRandomNum, type Book } from "../utils";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
import BookFilters from "../Components/BookFilters.vue";

const books: Ref<Book[]> = ref([]);
const featuredBooks: Ref<Book[]> = ref([]);
const errorGettingBooks = ref("");

const filteredFeaturedBooks = computed(() => {
    let filteredBooks = featuredBooks.value.filter((book) => book.filter_on)

    if(filteredBooks.length === 0) {
        return featuredBooks.value
    } else {
        return filteredBooks
    }
})

const fillFeaturedBooks = () => {
    axios.get(route('books.index'))
    .then((res) => {
        books.value = res.data;

        //todo set up better way to sort by average rating and pick top 5
        for(let i = 0; i < 5; i++) {
            let bookToGet = getRandomNum(0, books.value.length - 1);
            featuredBooks.value[i] = books.value[bookToGet];
        }
    })
    .catch((err) => {
        errorGettingBooks.value = "Could not retrieve the featured books at this time."
    })
}

const toggleFilter = (filter: Filter, type: string) => {
    let filteredBookID = featuredBooks.value.findIndex((book) => {
        if(type === 'author') {
            return book.author === filter.name
        } else if (type === 'title') {
            return book.title === filter.name
        } else if (type === 'category') {
            return book.category === filter.name
        }
    })

    if(filteredBookID === -1) {
        return;
    }

    // if the filter is active, apply filter. otherwise, do nothing.
    featuredBooks.value[filteredBookID].filter_on = filter.on;
}

onMounted(() => {
    fillFeaturedBooks();
})
</script>

<template>
    <DefaultLayout>
        <div v-if="books.length > 0">
            <h2 class="text-2xl font-bold">Featured Books</h2>
            <div class="grid grid-cols-[20%_80%] gap-2">
                <BookFilters :featuredBooks="featuredBooks" @toggleFilter="toggleFilter" />
                <div class="flex flex-col items-start gap-4 h-[calc(100vh-140px)] overflow-y-auto">
                    <BookTemplate
                        v-for="(book, index) in filteredFeaturedBooks" 
                        :key="index"
                        :book="book"
                    ></BookTemplate>
                </div>
            </div>
        </div>
        <div v-else-if="errorGettingBooks.length > 0" class="flex items-center justify-center">
            <p class="px-4 py-2 text-lg text-red-700 bg-red-100 text-center">
                {{errorGettingBooks}}
            </p>
        </div>
        <div v-else>
            Loading books...
        </div>
    </DefaultLayout>
</template>

<style></style>