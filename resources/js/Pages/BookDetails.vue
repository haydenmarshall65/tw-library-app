<script setup lang="ts">
import axios from "axios";
import DefaultLayout from "../Layouts/DefaultLayout.vue"
import { Book } from "../utils";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
import { ref, type Ref } from "vue";
import BookCheckoutButton from "../Components/BookCheckoutButton.vue";
import BookRating from "../Components/BookRating.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps<{
    book: {data: Book}
}>()

const bookDetails: Ref<Book> = ref(props.book.data);
const successMessage: Ref<string> = ref("");
const errorMessage: Ref<string> = ref("");

const checkoutBook = (result: {book: Book|null, errorMsg: string|null}) => {
    if(result.book !== null) {
        successMessage.value = "\"" + bookDetails.value.title + "\" checked out!\nPlease return in 5 days.";
        bookDetails.value = result.book;
        setTimeout(() => successMessage.value = '', 5000);
    } else if (typeof result.errorMsg === 'string' && result.errorMsg.length > 0) {
        errorMessage.value = result.errorMsg;
        setTimeout(() => errorMessage.value = '', 5000);
    }
}

</script>

<template>
    <DefaultLayout>
        <div>
            <div v-if="successMessage.length > 0" class="flex justify-center">
                <p class="bg-green-100 text-green-800 shadow-lg p-6 my-2 w-fit text-center">{{ successMessage }}</p>
            </div>
            <div v-else-if="errorMessage.length > 0" class="flex justify-center">
                <p class="bg-red-100 text-red-800 shadow-lg p-6 my-2 w-fit text-center">{{ errorMessage }}</p>
            </div>
            <div class="flex justify-between">
                <h2 class="font-bold text-3xl">{{ bookDetails.title }}</h2>
                <BookCheckoutButton :book="bookDetails" @checkedOut="checkoutBook"/>
            </div>
            <p class="text-lg">by <span class="font-semibold">{{ bookDetails.author }}</span></p>
            <p class="w-1/3 text-justify my-4 text-lg">{{ bookDetails.description }}</p>
            <img :src="bookDetails.cover_image ?? '/no_image_available.jpg'" :alt="bookDetails.title + ' cover image'" width="300">
            <hr class="border border-coffee my-2">
            <p><b>Publisher: </b>{{ bookDetails.publisher }}</p>
            <p><b>Publication Date: </b>{{ bookDetails.publication_date }}</p>
            <p><b>ISBN: </b>{{ bookDetails.isbn }}</p>
            <p><b>Page count: </b>{{ bookDetails.page_count }}</p>
            <div class="flex items-start justify-start gap-2 mt-4">
                <BookRating :rating="bookDetails.average_rating" />
                <Link :href="route('books.reviews', bookDetails.id)"><span>Leave a rating</span></Link>
            </div>
        </div>
    </DefaultLayout>
</template>