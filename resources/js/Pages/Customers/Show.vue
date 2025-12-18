<script setup>
import { Head } from '@inertiajs/vue3'
  import AppLayout from "../../Layouts/AppLayout.vue";

  defineProps({customer: Object})
</script>

<template>
  <AppLayout>
    <Head title="Show" />

  </AppLayout>
</template>
