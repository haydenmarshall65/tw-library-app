<script setup>
import { ref } from 'vue';
import PrimaryButton from '../PrimaryButton.vue';
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
        <PrimaryButton
            v-if="checkedOutBy?.checked_out_at !== null && checkedOutBy?.returned_at === null"
            @click="returnBook(checkedOutBy.id)"
        >
            <i class="pi pi-reply"></i>&nbsp;Return
        </PrimaryButton>
    </div>
</template>

<style></style>