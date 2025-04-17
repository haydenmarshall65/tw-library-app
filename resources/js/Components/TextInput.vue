<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input
        class="rounded-md shadow-sm bg-black/10 placeholder-black focus:bg-black/50 focus:placeholder-white focus:text-white text-black"
        v-model="model"
        ref="input"
    />
</template>
