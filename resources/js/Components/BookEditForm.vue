<script setup lang="ts">
import { ModelRef } from 'vue';
import { type BookForm } from '../utils';

const editingBook = defineModel<BookForm>('editingBook') as ModelRef<BookForm>;

const newCoverImage = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files;

    if(file === null) return;

    editingBook.value.new_cover_image.push(file[0])
}
</script>

<template>
    <div class="flex flex-col justify-start items-start mt-4 h-[calc(100vh-250px)] overflow-y-auto" v-if="editingBook">
        <label for="book-title" class="text-sm">
            Title
        </label>
        <input id="book-title" v-model="editingBook.title" class="rounded-lg w-[300px]">

        <label for="book-author" class="text-sm mt-2">
            Author
        </label>
        <input id="book-author" v-model="editingBook.author" class="rounded-lg w-[300px]">

        <label for="book-description" class="text-sm mt-2">
            Description
        </label>
        <textarea id="book-description" v-model="editingBook.description" class="rounded-lg w-[400px]" rows="5"></textarea>

        <label for="book-publisher" class="text-sm mt-2">
            Publisher
        </label>
        <input id="book-publisher" v-model="editingBook.publisher" class="rounded-lg w-[300px]">

        <label for="book-publication-date" class="text-sm mt-2">
            Publication Date
        </label>
        <input type="date" id="book-publication-date" v-model="editingBook.publication_date" class="rounded-lg w-[300px]">

        <label for="book-isbn" class="text-sm mt-2">
            ISBN
        </label>
        <input id="book-isbn" v-model="editingBook.isbn" class="rounded-lg w-[300px]">

        <label for="book-category" class="text-sm mt-2">
            Category
        </label>
        <input id="book-category" v-model="editingBook.category" class="rounded-lg w-[300px]">

        <label for="book-page-count" class="text-sm mt-2">
            Page Count
        </label>
        <input type="number" id="book-page-count" v-model="editingBook.page_count" class="rounded-lg w-[300px]">

        <label for="book-cover-image" class="text-sm mt-2">
            Cover Image
        </label>
        <input type="file" accept="image/*" id="book-cover-letter" @change="newCoverImage" class="rounded-lg w-[300px]">
    </div>
</template>