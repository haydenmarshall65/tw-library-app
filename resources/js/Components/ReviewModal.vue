<script setup lang="ts">
import Dialog from "primevue/dialog";
import { ref, watch, type Ref } from "vue";
import BookRating from "./BookRating.vue";
import axios from "axios";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
import { Book } from "../utils";

const props = defineProps<{book: Book}>()

const open = defineModel('open', {default: false})

const emits = defineEmits(['closed']);

const review: Ref<{review: string, rating: number}> = ref({
    review: '',
    rating: 0,
})
const submitting: Ref<boolean> = ref(false);
const successMessage: Ref<string> = ref('');
const errorMessage: Ref<string> = ref('');
const newReviewSubmitted: Ref<boolean> = ref(false);

const restrictBetween1and5 = (event: Event) => {
    if(!event.target) return;
    let target = event.target as HTMLInputElement;
    let value = target.value;

    if(value === "") {
        review.value.rating = 0
    } else if (Number(value) > 5) {
        review.value.rating = 5;
    }
}

const submitReview = () => {
    submitting.value = true;
    axios.post(route('books.new-review', props.book.id), review.value)
        .then((res) => {
            successMessage.value = 'Review submitted!';
            submitting.value = false;
            setTimeout(() => successMessage.value = '', 3000);
            newReviewSubmitted.value = true;
        })
        .catch((err) => {
            console.log(err);
            if(err.status && err.status === 422) {
                errorMessage.value = err.response.data.message;
            } else {
                errorMessage.value = "There was an unexpected issue submitting your review.";
            }
            submitting.value = false;
            setTimeout(() => errorMessage.value === '', 3000);
        })
}

watch(open, () => {
    if(open.value === false) {
        emits("closed", newReviewSubmitted.value);
    }
})
</script>

<template>
    <Dialog 
        modal 
        v-model:visible="open"
        :draggable="false"
        :style="{'background': '#fff', 'padding': '1rem', 'border': '1px solid black', 'width': '35%', 'border-radius': '15px'}"
    >
        <template #header>
            <span class="text-lg font-bold">Leave a Review</span>
        </template>
        <form @submit.prevent="submitReview">
            <label for="review" class="flex flex-col">
                Review
                <textarea id="review" class="rounded-lg mb-4" v-model="review.review"></textarea>
            </label>
            <label for="rating">Rating</label>
            <div class="flex justify-start items-center gap-2">
                <BookRating :rating="review.rating" />
                <input id="rating" class="rounded-lg" type="number" max="5" min="0" v-model="review.rating" @input="restrictBetween1and5">
            </div>
            <div class="flex flex-row items-center gap-2 mt-2">
                <button
                    class="px-4 py-2 rounded-xl text-white text-lg font-bold"
                    :class="{'bg-coffee/75': submitting, 'bg-coffee': !submitting}"
                    type="submit"
                    :disabled="submitting"
                >
                    {{submitting ? 'Submitting...' : 'Submit'}}
                </button>
                <p 
                    v-if="errorMessage.length > 0" 
                    class="text-lg bg-red-100 text-red-800 text-center w-fit px-4 py-2"
                >
                    {{ errorMessage }}
                </p>
                <p
                    v-else-if="successMessage.length > 0"
                    class="text-lg bg-green-100 text-green-800 text-center w-fit px-4 py-2"
                >
                    {{ successMessage }}
                </p>
            </div>
        </form>
    </Dialog>
</template>