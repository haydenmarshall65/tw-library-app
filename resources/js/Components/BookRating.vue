<script setup lang="ts">

const props = defineProps<{
    rating: number,
    noReviewsYet?: boolean
}>()
</script>

<template>
    <div>
        <span class="border border-coffee p-1">
            <i
                class="pi text-yellow-500"
                :class="{
                    'pi-star': rating === 0,
                    'pi-star-half-fill': rating > 0 && rating < 1,
                    'pi-star-fill': rating >= 1
                }"
            ></i>
            <i
                class="pi text-yellow-500"
                :class="{
                    'pi-star': rating <= 1,
                    'pi-star-half-fill': rating > 1 && rating < 2,
                    'pi-star-fill': rating >= 2
                }"
            ></i>
            <i
                class="pi text-yellow-500"
                :class="{
                    'pi-star': rating <= 2,
                    'pi-star-half-fill': rating > 2 && rating < 3,
                    'pi-star-fill': rating >= 3
                }"
            ></i>
            <i
                class="pi text-yellow-500"
                :class="{
                    'pi-star': rating <= 3,
                    'pi-star-half-fill': rating > 3 && rating < 4,
                    'pi-star-fill': rating >= 4
                }"
            ></i>
            <i
                class="pi text-yellow-500"
                :class="{
                    'pi-star': rating <= 4,
                    'pi-star-half-fill': rating > 4 && rating < 5,
                    'pi-star-fill': rating >= 5
                }"
            ></i>
            {{ noReviewsYet ? 'No Reviews Yet' : rating }}
        </span>
    </div>
</template>

<style></style>