<script setup lang="ts">

const props = withDefaults(defineProps<{
    variant?: 'primary' | 'delete'
}>(), {
    variant: 'primary'
})

</script>

<template>
    <button
        class="p-2 rounded-xl text-white"
        :class="{
            'bg-coffee': variant === 'primary',
            'bg-red-600': variant === 'delete',
        }"
    >
        <slot />
    </button>
</template>
