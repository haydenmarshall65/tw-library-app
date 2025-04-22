<script setup lang="ts">
import BookEditForm from '../../Components/BookEditForm.vue';
import DefaultLayout from '../../Layouts/DefaultLayout.vue';
import { Card } from 'primevue';
import { type BookForm, type Book } from '../../utils';
import { useForm } from '@inertiajs/vue3';
import { ref, type Ref } from 'vue';
import axios from 'axios';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import PrimaryButton from '../../Components/PrimaryButton.vue';

const newBook = useForm<BookForm>({
    'id': 0,
    'author': '',
    'title': '',
    'description': '',
    'isbn': '',
    'page_count': 0,
    'new_cover_image': [] as File[],
    'average_rating': 0,
    'checked_out_by': null,
    'category': '',
    'cover_image': '',
    'is_checked_out': false,
    'has_reviews': false,
    'publisher': '',
    'publication_date': '',
    'filter_on': false,
})

const submitting: Ref<boolean> = ref(false);
const successMessage: Ref<string> = ref('');
const errorMessage: Ref<string> = ref('');

const submit = () => {
    submitting.value = true;

    const formData = new FormData();

    for(const [key, value] of Object.entries(newBook.data())){
        if(value === null) continue;

        if(Array.isArray(value)) {
            value.length > 0 && formData.append(key, value[0], value[0].name)
        } else {
            formData.append(key, String(value))
        }
    }

    axios.post(route('books.store'), formData, {headers: {'Content-Type': 'multipart/form-data'}})
    .then((res) => {
        successMessage.value = newBook.title + ' updated!'
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
}
</script>

<template>
    <DefaultLayout>
        <form @submit.prevent="submit">
            <Card
                class="p-4 border border-black w-full bg-white"
            >
                <template #header>
                    <h2 class="text-2xl font-bold">Create New Book</h2>
                </template>
                <template #content>
                    <BookEditForm v-model:editingBook="newBook" />
                    <div class="flex flex-row justify-start items-center gap-2 mt-4">
                        <PrimaryButton type="submit" :disabled="submitting">{{submitting ? 'Submitting...' : 'Submit' }}</PrimaryButton>
                    </div>
                </template>
            </Card>
        </form>
    </DefaultLayout>
</template>

<style></style>