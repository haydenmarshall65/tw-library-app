<script setup>
import { ref } from 'vue';

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
        <button 
            class="bg-coffee px-2 rounded-xl text-white"
            @click="editBook(bookId)"
        ><i class="pi pi-pencil"></i>&nbsp;Edit</button>
    </div>
</template>

<style></style>