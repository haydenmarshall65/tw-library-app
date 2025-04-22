<script setup>
import { ref } from 'vue';
const props = defineProps({
    params: {
        default: () => {}
    }
})

const returnBook = ref(props.params.context.returnBook);
const checkedOutBy = ref(props.params.data.checked_out_by);
</script>

<template>
    <div>
        <button
            v-if="checkedOutBy?.checked_out_at !== null && checkedOutBy?.returned_at === null"
            @click="returnBook(checkedOutBy.id)"
            class="bg-coffee px-2 rounded-xl text-white"
        >
            <i class="pi pi-reply"></i>&nbsp;Return
        </button>
    </div>
</template>

<style></style>