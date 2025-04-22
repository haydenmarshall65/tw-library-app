<script setup>
import { ref } from 'vue';
import PrimaryButton from '../PrimaryButton.vue';

const props = defineProps({
    params: {
        default: () => {}
    }
})

const bookId = ref(props.params.data.id)
const editBook = ref(props.params.context.editBook);
</script>

<template>
    <div>
        <PrimaryButton 
            @click="editBook(bookId)"
        ><i class="pi pi-pencil"></i>&nbsp;Edit</PrimaryButton>
    </div>
</template>

<style></style>