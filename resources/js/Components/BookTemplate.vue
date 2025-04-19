<script setup lang="ts">
import { Card } from 'primevue';
import { type Book } from '../utils';

const props = defineProps<{
    book: Book
}>()

</script>

<template>
    <Card 
        class="p-4 border border-black w-full bg-white"
    >
        <template #title>
            <h2 class="text-lg font-semibold">{{book.title}}</h2>
        </template>
        <template #content>
            <div class="grid grid-cols-2">
                <div>
                    <p class="text-gray-600 text-sm">by {{book.author}}</p>
                    <p class="mt-4 w-1/2">{{book.description}}</p>
                    <p class="mt-4">5.0</p>
                </div>
                <div>
                    <img :src="book.cover_image ?? 'hi'" :alt="book.title + ' cover image'">
                </div>
            </div>
        </template>
    </Card>
</template>

<style></style>