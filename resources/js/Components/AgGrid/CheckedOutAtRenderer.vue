<script setup>
import { computed } from 'vue';
import dayjs from 'dayjs'

const props = defineProps({
    params: {
        default: () => {}
    }
})

const checkedOutAt = computed(() => {
    if(!props.params.data.checked_out_by || !props.params.data.checked_out_by.checked_out_at) {
        return '';
    }

    const dateCheckedOut = dayjs(props.params.data.checked_out_by.checked_out_at).format('MM/DD/YYYY')
    return dateCheckedOut;
})
</script>

<template>
    <div>
        <span class="p-1" :class="{
            'bg-red-200 font-bold': dayjs().diff(dayjs(checkedOutAt), 'days') >= 5,
            'bg-yellow-200 font-bold': dayjs().diff(dayjs(checkedOutAt), 'days') > 3 && dayjs().diff(dayjs(checkedOutAt), 'days') < 5,
        }">
            {{ checkedOutAt }}
        </span>
    </div>
</template>

<style></style>