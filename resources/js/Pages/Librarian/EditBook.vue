<script setup lang="ts">
import DefaultLayout from '../../Layouts/DefaultLayout.vue';
import { Book } from '../../utils';
import { ref, type Ref } from "vue";
import { Card } from 'primevue';
import { router, useForm } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import axios from 'axios';
import BookEditForm from '../../Components/BookEditForm.vue';
import { type BookForm } from '../../utils';
import PrimaryButton from '../../Components/PrimaryButton.vue';

const props = defineProps<{
    book: {data: Book}
}>()

const editingBook = useForm<BookForm>({
    ...props.book.data,
    publication_date: dayjs(props.book.data.publication_date).format('YYYY-MM-DD'),
    new_cover_image: [] 
});
const submitting: Ref<boolean> = ref(false);
const successMessage: Ref<string> = ref('');
const errorMessage: Ref<string> = ref('');
// on this page, allow for librarians to edit the fields and save, or delete the book entirely

const submit = () => {
    submitting.value = true;

    const formData = new FormData();

    for(const [key, value] of Object.entries(editingBook.data())){
        if(value === null) continue;

        if(Array.isArray(value)) {
            value.length > 0 && formData.append(key, value[0], value[0].name)
        } else {
            formData.append(key, String(value))
        }
    }

    formData.append('_method', 'put');

    axios.post(route('books.update', props.book.data.id), formData, {headers: {'Content-Type': 'multipart/form-data'}})
    .then((res) => {
        successMessage.value = editingBook.title + ' updated!'
        submitting.value = false;
    })
    .catch((err) => {
        if(err.status && err.status === 422) {
            errorMessage.value = err.response.data.message;
        } else {
            errorMessage.value = 'Could not update this book at this time.'
        }
        submitting.value = false;
    })
    // handle image upload to new api route for updating books
}

const deleteBook = () => {
    if(window.confirm('Are you sure you want to delete this book?')) {
        console.log('hi');
    }
}
</script>

<template>
    <DefaultLayout>
        <form @submit.prevent="submit">
            <Card 
                class="p-4 border border-black w-full bg-white"
            >
                <template #header>
                    <h2 class="text-2xl font-bold">Editing "{{ book.data.title }}"</h2>
                </template>
                <template #content>
                    <BookEditForm 
                        v-model:editingBook="editingBook" 
                        class="h-[calc(100vh-250px)] overflwo-y-auto"
                    />
                    <div class="flex flex-row justify-start items-center gap-2 mt-4">
                        <PrimaryButton :disabled="submitting">{{submitting ? 'Submitting...' : 'Submit'}}</PrimaryButton>
                        <PrimaryButton @click="deleteBook" variant="delete"><i class="pi pi-trash"></i>&nbsp;Delete</PrimaryButton>
                        <p v-if="successMessage.length > 0" class="px-4 py-2 text-green-800 bg-green-100 font-bold shadow-lg">{{ successMessage }}</p>
                        <p v-else-if="errorMessage.length > 0" class="px-4 py-2 text-red-800 bg-red-100 font-bold shadow-lg">{{ errorMessage }}</p>
                    </div>
                </template>
            </Card>
        </form>
    </DefaultLayout>
</template>