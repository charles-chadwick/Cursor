<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps ( { user: Object } )
console.log(props.user)
</script>

<template>
  <Link
      :href="route('users.show', user.attributes.id)"
      class="flex items-center gap-2 hover:opacity-80 transition-opacity"
  >
    <img
        v-if="user.attributes.avatar !== null"
        :src="user.attributes.avatar"
        :alt="user.attributes.full_name"
        class="w-8 h-8 rounded-full object-cover"
    />
    <span>{{ user.attributes.full_name }}</span>
  </Link>
</template>

<style scoped>

</style>