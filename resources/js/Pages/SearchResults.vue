<script setup lang="ts">
import BookTemplate from '../Components/BookTemplate.vue';
import DefaultLayout from '../Layouts/DefaultLayout.vue';
import { type Book } from '../utils';

const props = defineProps<{
    books?: {data: Book[]}
    message?: string
}>()

</script>

<template>
    <DefaultLayout>
        <div v-if="books && books.data.length > 0" class="flex flex-col items-start gap-4 h-[calc(100vh-140px)] overflow-y-auto">
            <h2 class="text-2xl font-bold">Search Results:</h2>
            <BookTemplate 
                v-for="(book, index) in books.data"
                :book="book" 
            />
        </div>
        <div v-else class="flex justify-center">
            <p class="text-blue-800 bg-blue-100 p-8 text-lg font-bold text-center">
                {{ message }}
            </p>
        </div>
    </DefaultLayout>
</template>

<style></style>