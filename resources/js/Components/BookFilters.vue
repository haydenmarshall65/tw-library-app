<script setup lang="ts">
import {type Ref, ref, computed, onMounted} from "vue"
import { Book, isBook, type Filter } from "../utils";

const props = defineProps({
    featuredBooks: Array 
})

const emits = defineEmits(['toggleFilter'])

const bookCategoryFilters: Ref<Filter[]> = ref([]);
const bookCategoryFiltersOpen: Ref<boolean> = ref(false);
const bookTitleFilters: Ref<Filter[]> = ref([]);
const bookTitleFiltersOpen: Ref<boolean> = ref(false);
const bookAuthorFilters: Ref<Filter[]> = ref([]);
const bookAuthorFiltersOpen: Ref<boolean> = ref(false);

const bookCategoryFiltersActive = computed(() => {
    let filtersActive = 0;
    bookCategoryFilters.value.forEach((filter) => {
        if(filter.on) {
            filtersActive++;
        }
    })
    return filtersActive;
})

const bookTitleFiltersActive = computed(() => {
    let filtersActive = 0;
    bookTitleFilters.value.forEach((filter) => {
        if(filter.on) {
            filtersActive++;
        }
    })
    return filtersActive;
})

const bookAuthorFiltersActive = computed(() => {
    let filtersActive = 0;
    bookAuthorFilters.value.forEach((filter) => {
        if(filter.on) {
            filtersActive++;
        }
    })
    return filtersActive;
})

const toggleFilter = (filter: Filter, type: string) => {
    emits("toggleFilter", filter, type)
}

onMounted(() => {
        // set up the filters for the random 5 books
        if(!Array.isArray(props.featuredBooks)){
            return;
        }
        props.featuredBooks.forEach((book) => {
            if(!isBook(book)) return;

            bookCategoryFilters.value.push({name: book.category, on: false})
            bookTitleFilters.value.push({name: book.title, on: false})
            bookAuthorFilters.value.push({name: book.author, on: false})
        })
})
</script>

<template>
    <div class="flex flex-col justify-start items-start">
        <p class="bg-white w-full p-2 border-t border-x border-black"><i class="pi pi-filter"></i>Filters</p>
        <div class="max-h-[65vh] overflow-y-auto w-full">
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
                    <input 
                        type="checkbox" 
                        :id="'title-filter-'+index" 
                        v-model="titleFilter.on" 
                        :checked="titleFilter.on" 
                        @change="toggleFilter(titleFilter, 'title')"
                    >
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
                    <input 
                        type="checkbox" 
                        :id="'cat-filter-'+index" 
                        v-model="categoryFilter.on" 
                        :checked="categoryFilter.on"
                        @change="toggleFilter(categoryFilter, 'category')"
                    >
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
                    <input 
                        type="checkbox" 
                        :id="'author-filter-'+index" 
                        v-model="authorFilter.on"
                        :checked="authorFilter.on"
                        @change="toggleFilter(authorFilter, 'author')"
                    >
                    <label :for="'author-filter-'+index">
                        {{authorFilter.name}}
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<style></style>