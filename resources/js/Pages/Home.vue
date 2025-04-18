<script setup lang="ts">
import axios from "axios";
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import { Card } from "primevue";
import Checkbox from "primevue/checkbox";
import { ref, onMounted, type Ref, computed, ComputedRef } from "vue";
import { Filter, getRandomNum, type Book } from "../utils";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
import BookFilters from "../Components/BookFilters.vue";

const books: Ref<Book[]> = ref([]);
const featuredBooks: Ref<Book[]> = ref([]);
const errorGettingBooks = ref("");

const filteredFeaturedBooks = computed(() => {
    return featuredBooks.value.filter((book) => book.filter_on)
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
    let filteredBooks = featuredBooks.value.filter((book) => {
        if(type === 'author') {
            return book.author === filter.name
        } else if (type === 'title') {
            return book.title === filter.name
        } else if (type === 'description') {
            return book.description
        }
    })

    //todo finish implementing
}

onMounted(() => {
    fillFeaturedBooks()
})
</script>

<template>
    <DefaultLayout>
        <div v-if="books.length > 0">
            <h2 class="text-2xl font-bold">Featured Books</h2>
            <div class="grid grid-cols-[20%_80%] gap-2">
                <BookFilters :featuredBooks="featuredBooks" />
                <!-- <div class="flex flex-col justify-start items-start">
                    <p class="bg-white w-full p-2 border-t border-x border-black"><i class="pi pi-filter"></i>Filters</p>
                    <button 
                        @click="bookTitleFiltersOpen = !bookTitleFiltersOpen" 
                        aria-controls="title-filters" 
                        class="bg-white border border-black w-full align-start font-bold"
                    >
                        Title <span v-if="bookTitleFiltersActive > 0">({{bookTitleFiltersActive}})</span>
                    </button>
                    <div 
                        class="bg-white border-b border-x border-black flex flex-col w-full divide-y divide-black"
                        v-show="bookTitleFiltersOpen" 
                        id="title-filters" 
                        :aria-expanded="bookTitleFiltersOpen"
                    >
                        <div v-for="(titleFilter, index) in bookTitleFilters" class="flex items-center gap-2 p-2" :key="index">
                            <input type="checkbox" :id="'title-filter-'+index" v-model="titleFilter.on">
                            <label :for="'title-filter-'+index">
                                {{titleFilter.name}}
                            </label>
                        </div>
                    </div>
                    <button 
                        @click="bookCategoryFiltersOpen = !bookCategoryFiltersOpen" 
                        aria-controls="category-filters" 
                        class="bg-white border border-black w-full align-start font-bold"
                    >
                        Category <span v-if="bookCategoryFiltersActive > 0">({{bookCategoryFiltersActive}})</span>
                    </button>
                    <div 
                        class="bg-white border-b border-x border-black flex flex-col w-full divide-y divide-black"
                        v-show="bookCategoryFiltersOpen" 
                        id="category-filters" 
                        :aria-expanded="bookCategoryFiltersOpen"
                    >
                        <div v-for="(categoryFilter, index) in bookCategoryFilters" class="flex items-center gap-2 p-2" :key="index">
                            <input type="checkbox" :id="'cat-filter-'+index" v-model="categoryFilter.on">
                            <label :for="'cat-filter-'+index">
                                {{categoryFilter.name}}
                            </label>
                        </div>
                    </div>
                    <button 
                        @click="bookAuthorFiltersOpen = !bookAuthorFiltersOpen" 
                        aria-controls="author-filters" 
                        class="bg-white border border-black w-full align-start font-bold"
                    >
                        Author
                    </button>
                    <div 
                        class="bg-white border-b border-x border-black flex flex-col w-full divide-y divide-black"
                        v-show="bookAuthorFiltersOpen" 
                        id="author-filters" 
                        :aria-expanded="bookAuthorFiltersOpen"
                    >
                        <div v-for="(authorFilter, index) in bookAuthorFilters" class="flex items-center gap-2 p-2" :key="index">
                            <input type="checkbox" :id="'author-filter-'+index" v-model="authorFilter.on">
                            <label :for="'author-filter-'+index">
                                {{authorFilter.name}}
                            </label>
                        </div>
                    </div>
                </div> -->
                <div class="flex flex-col items-start gap-4 h-[calc(100vh-140px)] overflow-y-auto">
                    <Card 
                        v-for="(book, index) in featuredBooks" 
                        :key="index" 
                        class="p-4 border border-black w-full bg-white"
                    >
                        <template #title>
                            <h2 class="text-lg font-semibold">{{book.title}}</h2>
                        </template>
                        <template #content>
                            <div class="grid grid-cols-2">
                                <div>
                                    <p class="text-gray-600 text-sm">by {{book.author}}</p>
                                    <p class="mt-4 w-1/2">{{book.description}}</p>
                                    <p class="mt-4">5.0</p>
                                </div>
                                <div>
                                    <img :src="book.cover_image ?? 'hi'" :alt="book.title + ' cover image'">
                                </div>
                            </div>
                        </template>
                    </Card>
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