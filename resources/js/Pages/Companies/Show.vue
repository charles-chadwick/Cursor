<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Contacts from '@/Pages/Contacts/Partials/Details.vue';

const { company } = defineProps ( {
  company: {
    type: Object,
    required: true
  },
} );

const pageTitle = computed ( () => `${ company.name } Information` );
</script>

<template>
  <AppLayout>
    <Head :title="pageTitle" />

    <div class="px-8 py-4 text-left">
      <div class="p-6 flex justify-between">
        <div class="flex gap-4">
          <!-- Logo Section -->
          <div
              v-if="company.logo"
              class="size-32"
          >
            <img
                :src="company.logo"
                :alt="`${company.name} Logo`"
                class="size-full rounded-xl border-2 border-darker-300 object-cover"
            >
          </div>
          <div
              v-else
              class="size-32 rounded-xl border-2 border-darker-300 bg-darker-200 text-darker-400 font-semibold flex items-center justify-center"
          >
            <p>No Logo</p>
          </div>

          <!-- Company Info -->
          <div>
            <h1 class="text-3xl font-bold text-darker-900">
              {{ company.name }}
            </h1>
            <p class="text-darker-600">
              {{ company.type }}
            </p>
          </div>
        </div>

        <!-- Contacts Component -->
        <Contacts
            :contacts="company.contacts"
            :on_id="company.id"
            on_type="Company"
        />
      </div>
    </div>
  </AppLayout>
</template>
