<template>
  <Head>
    <title>{{ title }} - Laravel junior test</title>
    <meta name="description" :content="title + '- Vendite'" />
  </Head>
  <teleport to="#header-title">{{ title }}</teleport>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

// props
const props = defineProps({
  title: String,
});
</script>

<style>
</style>