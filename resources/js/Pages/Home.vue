<script setup lang="ts">
import axios from "axios";
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import { ref, onMounted, type Ref } from "vue";
import { getRandomNum, type Book } from "../utils";
import { route } from "../../../vendor/tightenco/ziggy/src/js";

type Filter = {name: string, on: boolean}

const books: Ref<Book[]> = ref([]);
const featuredBooks: Ref<Book[]> = ref([]);
const bookCategoryFilters: Ref<Filter[]> = ref([]);
const bookTitleFilters: Ref<Filter[]> = ref([]);
const bookAuthorFilters: Ref<Filter[]> = ref([]);

const fillFeaturedBooks = () => {
    axios.get(route('books.index'))
    .then((res) => {
        books.value = res.data;

        // select random 5 books to be featured
        for(let i = 0; i < 5; i++){
            let bookToGet = getRandomNum(0, books.value.length - 1);
            featuredBooks.value[i] = books.value[bookToGet];
        }

        // set up the filters for the random 5 books
        featuredBooks.value.forEach((book) => {
            bookCategoryFilters.value.push({name: book.category, on: false})
            bookTitleFilters.value.push({name: book.title, on: false})
            bookAuthorFilters.value.push({name: book.author, on: false})
        })
    })
    .catch((err) => {
        console.log(err);
    })
}

onMounted(() => {
    fillFeaturedBooks()
})
</script>

<template>
    <DefaultLayout>
        <div v-if="books.length > 0">
            <div v-for="book in featuredBooks">
                <h1>{{book.title}}</h1>
            </div>
        </div>
        <div v-else>
            Loading books...
        </div>
    </DefaultLayout>
</template>

<style></style>