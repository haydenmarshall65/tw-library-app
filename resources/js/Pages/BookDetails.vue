<script setup lang="ts">
import DefaultLayout from "../Layouts/DefaultLayout.vue"
import { Book } from "../utils";

const props = defineProps<{
    book: {data: Book}
}>()

const checkoutBook = () => {
    // axios request to checkoutbookcontroller::store, add book.id in query
}

</script>

<template>
    <DefaultLayout>
        <div>
            <div class="flex justify-between">
                <h2 class="font-bold text-3xl">{{ book.data.title }}</h2>
                <button class="bg-coffee px-4 py-2 rounded-xl text-white text-lg font-bold">Checkout</button>
            </div>
            <p class="text-lg">by {{book.data.author}}</p>
            <p class="w-1/3 text-justify my-4 text-lg">{{ book.data.description }}</p>
            <img :src="book.data.cover_image ?? 'hi'" :alt="book.data.title + ' cover image'">
            <hr class="border border-coffee my-2">
            <p><b>Publisher: </b>{{ book.data.publisher }}</p>
            <p><b>Publication Date: </b>{{ book.data.publication_date }}</p>
            <p><b>ISBN: </b>{{ book.data.isbn }}</p>
            <p><b>Page count: </b>{{ book.data.page_count }}</p>
        </div>
    </DefaultLayout>
</template>