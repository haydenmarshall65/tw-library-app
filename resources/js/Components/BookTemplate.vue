<script setup lang="ts">
import { Card } from 'primevue';
import { type Book } from '../utils';
import { route } from '../../../vendor/tightenco/ziggy/src/js';
import {Link} from '@inertiajs/vue3';
import BookCheckoutButton from './BookCheckoutButton.vue';
import { ref, type Ref } from "vue"
import BookRating from './BookRating.vue';

const props = defineProps<{
    book: Book
}>()

const bookDetails: Ref<Book> = ref(props.book)
const successMessage: Ref<string> = ref("")
const errorMessage: Ref<string> = ref("")

const checkoutBook = (result: {book: Book|null, errorMsg: string|null}) => {
    if(result.book !== null) {
        successMessage.value = "\"" + bookDetails.value.title + "\" checked out!\nPlease return in 5 days.";
        bookDetails.value = result.book;
        setTimeout(() => successMessage.value = '', 3000);
    } else if (typeof result.errorMsg === 'string' && result.errorMsg.length > 0) {
        errorMessage.value = result.errorMsg;
        setTimeout(() => errorMessage.value = '', 5000);
    }
}
</script>

<template>
    <Card 
        class="p-4 border border-black w-full bg-white"
    >
        <template #title>
            <div class="flex justify-between">
                <Link :href="route('books.show', bookDetails.id)"><h2 class="text-lg font-semibold">{{bookDetails.title}}</h2></Link>
                <div class="flex flex-row gap-1 items-start justify-start">
                    <p v-if="successMessage.length > 0" class="bg-green-100 text-green-800 shadow-lg p-6 w-fit text-center">
                        {{ successMessage }}
                    </p>
                    <p v-else-if="errorMessage.length > 0" class="bg-red-100 text-red-800 shadow-lg p-6 w-fit text-center">{{ errorMessage }}</p>
                    <BookCheckoutButton :book="bookDetails" @checkedOut="checkoutBook" />
                </div>
            </div>
        </template>
        <template #content>
            <div class="grid grid-cols-2">
                <div>
                    <p class="text-gray-600 text-sm">by {{bookDetails.author}}</p>
                    <p class="mt-4 w-1/2">{{bookDetails.description}}</p>
                    <!-- <p class="mt-4">5.0</p> -->
                    <Link :href="route('books.reviews', bookDetails.id)"><BookRating :rating="0" :noReviewsYet="bookDetails.has_reviews" class="mt-2" /></Link>
                </div>
                <div>
                    <img :src="bookDetails.cover_image ?? 'hi'" :alt="bookDetails.title + ' cover image'">
                </div>
            </div>
        </template>
    </Card>
</template>

<style></style>