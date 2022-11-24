<script setup>
defineProps(["message"]);
</script>

<template>
  <span class="error invalid-feedback" v-if="message">{{ message }}</span>
</template>
