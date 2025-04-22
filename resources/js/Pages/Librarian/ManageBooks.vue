<script setup lang="ts">
import { AgGridVue } from 'ag-grid-vue3';
import { onMounted, ref, type Ref } from 'vue';
import DefaultLayout from '../../Layouts/DefaultLayout.vue';
import { Book, CheckedOutBy } from '../../utils';
import BookEditRenderer from '../../Components/AgGrid/BookEditRenderer.vue';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import { router } from '@inertiajs/vue3';
import CheckedOutAtRenderer from '../../Components/AgGrid/CheckedOutAtRenderer.vue';
import ReturnBookRenderer from '../../Components/AgGrid/ReturnBookRenderer.vue';
import axios from 'axios';

const props = defineProps<{
    books: {data: Book[]}
}>()

const context: Ref<null | Record<string, Function>> = ref(null);
const gridApi = ref();
const rowData = ref(props.books.data);
const colDefs = ref([
    {
        field: 'title',
        headerName: 'Title'
    },
    {
        field: 'author',
        headerName: 'Author'
    },
    {
        field: 'publisher',
        headerName: 'Publisher'
    },
    {
        field: 'publication_date',
        headerName: 'Publication Date'
    },
    {
        field: 'isbn',
        headerName: 'ISBN'
    },
    {
        field: 'category',
        headerName: 'Category'
    },
    {
        field: 'edit',
        headerName: 'Edit',
        cellRenderer: BookEditRenderer
    },
    {
        field: 'checked_out_by.checked_out_at',
        headerName: 'Checked Out At',
        cellRenderer: CheckedOutAtRenderer
    },
    {
        field: 'return_book',
        headerName: 'Return Book',
        cellRenderer: ReturnBookRenderer
    }
    // add status part to check if checked_out and how many days ago checked out
    // add quick button to return
]);

const onGridReady = (params) => {
    gridApi.value = params.api
}

const editBook = (bookId: Book['id']) => {
    router.visit(route('books.edit', bookId))
}

const returnBook = (checkedOutId: CheckedOutBy['id']) => {
    axios.put(route('checked_out.return', checkedOutId))
}

onMounted(() => {
    context.value = {
        editBook: editBook,
        returnBook: returnBook
    }
})
</script>

<template>
    <DefaultLayout>
        <div>
            <ag-grid-vue 
                :rowData="rowData"
                :columnDefs="colDefs"
                style="height: calc(100vh - 105px)"
                @gridReady="onGridReady"
                :autoSizeStrategy="{type: 'fitGridWidth'}"
                :context="context"
                v-if="context"
            />
        </div>
    </DefaultLayout>
</template>

<style></style>