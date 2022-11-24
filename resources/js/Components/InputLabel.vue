<script setup>
defineProps(['value']);
</script>

<template>
    <label class="col-4">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
