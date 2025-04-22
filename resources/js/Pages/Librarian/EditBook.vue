<script setup lang="ts">
import DefaultLayout from '../../Layouts/DefaultLayout.vue';
import { Book } from '../../utils';
import { ref, type Ref } from "vue";
import { Card } from 'primevue';
import { useForm } from '@inertiajs/vue3';
import dayjs from 'dayjs';

const props = defineProps<{
    book: {data: Book}
}>()

type BookForm = Book & {new_cover_image: File[]}

const editingBook = useForm<BookForm>({
    ...props.book.data,
    publication_date: dayjs(props.book.data.publication_date).format('YYYY-MM-DD'),
    new_cover_image: [] 
});
const submitting: Ref<boolean> = ref(false);
// on this page, allow for librarians to edit the fields and save, or delete the book entirely

const submit = () => {
    submitting.value = true;
    console.log('submitting...')
    // handle image upload to new api route for updating books
    submitting.value = false;
}

const deleteBook = () => {
    if(window.confirm('Are you sure you want to delete this book?')) {
        console.log('hi');
    }
}

const newCoverImage = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files;

    if(file === null) return;

    editingBook.new_cover_image.push(file[0])
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
                    <div class="flex flex-col justify-start items-start mt-4">
                        <label for="book-title" class="text-sm">
                            Title
                        </label>
                        <input id="book-title" v-model="editingBook.title" class="rounded-lg w-[300px]">

                        <label for="book-author" class="text-sm mt-2">
                            Author
                        </label>
                        <input id="book-author" v-model="editingBook.author" class="rounded-lg w-[300px]">

                        <label for="book-description" class="text-sm mt-2">
                            Description
                        </label>
                        <textarea id="book-description" v-model="editingBook.description" class="rounded-lg w-[400px]" rows="5"></textarea>

                        <label for="book-publisher" class="text-sm mt-2">
                            Publisher
                        </label>
                        <input id="book-publisher" v-model="editingBook.publisher" class="rounded-lg w-[300px]">

                        <label for="book-publication-date" class="text-sm mt-2">
                            Publication Date
                        </label>
                        <input type="date" id="book-publication-date" v-model="editingBook.publication_date" class="rounded-lg w-[300px]">

                        <label for="book-isbn" class="text-sm mt-2">
                            ISBN
                        </label>
                        <input id="book-isbn" v-model="editingBook.isbn" class="rounded-lg w-[300px]">

                        <label for="book-category" class="text-sm mt-2">
                            ISBN
                        </label>
                        <input id="book-category" v-model="editingBook.isbn" class="rounded-lg w-[300px]">

                        <label for="book-page-count" class="text-sm mt-2">
                            Page Count
                        </label>
                        <input type="number" id="book-page-count" v-model="editingBook.page_count" class="rounded-lg w-[300px]">

                        <label for="book-cover-image" class="text-sm mt-2">
                            Page Count
                        </label>
                        <input type="file" accept="image/*" id="book-cover-letter" @change="newCoverImage" class="rounded-lg w-[300px]">
                    </div>
                </template>
            </Card>
        </form>
    </DefaultLayout>
</template>