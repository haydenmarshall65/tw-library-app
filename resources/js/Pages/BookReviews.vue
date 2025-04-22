<script setup lang="ts">
import { Book, type CustomerReview } from "../utils"
import DefaultLayout from "../Layouts/DefaultLayout.vue"
import { onMounted, ref, Ref } from "vue";
import BookRating from "../Components/BookRating.vue";
import ReviewModal from "../Components/ReviewModal.vue";
import axios from "axios";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
import PrimaryButton from "../Components/PrimaryButton.vue";

const props = defineProps<{
    book: {data: Book}
}>()

const bookDetails: Ref<Book> = ref(props.book.data);
const loadingReviews: Ref<boolean> = ref(false);
const allReviews: Ref<CustomerReview[]> = ref([]);
const reviewModalIsOpen: Ref<boolean> = ref(false);
const errorLoadingReviews: Ref<string> = ref('');

const getAllBookReviews = () => {
    loadingReviews.value = true
    axios.post(route('books.all-reviews', bookDetails.value.id))
        .then((res) => {
            allReviews.value = res.data.reviews
            loadingReviews.value = false
        })
        .catch(() => {
            errorLoadingReviews.value = 'Could not load reviews at this time.'
        })
}

const onClosedReviewModal = (submitted: boolean) => {
    if(submitted) {
        getAllBookReviews()
    }
    reviewModalIsOpen.value = false;
}

onMounted(() => {
    getAllBookReviews()
})
</script>

<template>
    <DefaultLayout>
        <div :class="{'blur-[6px]': reviewModalIsOpen}">
            <h2 class="font-bold text-3xl">{{ bookDetails.title }} Reviews</h2>
            <div class="flex justify-start items-center gap-2 mt-2">
                <BookRating :rating="bookDetails.average_rating" />
                <p class="text-lg">{{ allReviews.length }} Reviews</p>
            </div>
            <PrimaryButton 
                class="text-lg font-bold mt-2"
                @click="reviewModalIsOpen = !reviewModalIsOpen"
            >
                Leave a Review
            </PrimaryButton>
            <div 
                v-if="allReviews.length > 0" 
                class="flex flex-col justify-start gap-2"
                v-for="review in allReviews"
            >
                <!-- reviews -->
            </div>
            <div v-else-if="loadingReviews" class="flex justify-start mt-4">
                <p class="bg-black/15 text-lg font-bold text-center w-fit p-6">Loading reviews...</p>
            </div>
            <div v-else-if="errorLoadingReviews.length > 0" class="flex justify-start mt-4">
                <p class="bg-red-100 text-red-800 text-center font-bold w-fit p-6">{{ errorLoadingReviews }}</p>
            </div>
            <div v-else class="flex justify-start mt-4">
                <p class="bg-black/15 text-lg font-bold text-center w-fit p-6">No Reviews Yet.</p>
            </div>
            <ReviewModal :book="bookDetails" :open="reviewModalIsOpen" @closed="onClosedReviewModal" />
        </div>
    </DefaultLayout>
</template>