<!--suppress JSUnresolvedReference -->
<script setup>
import { Popover } from "primevue";
import Avatar from "./Avatar.vue";
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps ( { user: Object } )
const op = ref (); // Reference to the OverlayPanel

const toggle = ( event ) => {
  op.value.toggle ( event ); // Toggle visibility using the ref
};
</script>

<template>
  <button
      class="flex items-center gap-2 hover:opacity-80 transition-opacity"
      @click="toggle"
  >
    <Avatar :image="user.attributes.avatar" />
    <span>{{ user.attributes.full_name }}</span>
  </button>
  <Popover ref="op">
    <div class="px-2 py-1">
      <h1 class="font-bold">{{ user.attributes.full_name }}</h1>
      <Avatar :image="user.attributes.avatar" size="md" />
      <Link :href="route('users.show', user.id)">
        Go to profile
      </Link>
    </div>
  </Popover>
</template>

<style scoped>

</style>