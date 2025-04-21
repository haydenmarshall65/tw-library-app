<script setup lang="ts">
import { computed } from 'vue';
import { type Book } from '../utils';
import axios from 'axios';
import { route } from '../../../vendor/tightenco/ziggy/src/js';

const props = defineProps<{
    book: Book
}>();

const emits = defineEmits(['checkedOut']);

const checkoutBook = () => {
    // axios request to checkoutbookcontroller::store, add book.id in query
    axios.post(route('books.checkout', props.book.id))
        .then((res) => {
            emits('checkedOut', {book: res.data.book, errorMsg: null});
        })
        .catch((err) => {
            if(err.status === 400 && err.response.data.message !== undefined) {
                emits('checkedOut', {book: null, errorMsg: err.response.data.message})
            } else {
                emits('checkedOut', {book: null, errorMsg: "Could not check out \"" + props.book.title + "\" at this time."})
            }
        })
}

const isCheckedOut = computed(() => props.book.is_checked_out);
</script>

<template>
    <button 
        @click="checkoutBook"
        class="px-4 py-2 rounded-xl text-white text-lg font-bold"
        :class="{
            'bg-coffee cursor-pointer': !isCheckedOut,
            'bg-coffee/75 cursor-not-allowed': isCheckedOut
        }"
        :disabled="isCheckedOut"
    >
        {{ isCheckedOut ? 'Checked Out' : 'Check Out' }}
    </button>
</template>

<style></style>