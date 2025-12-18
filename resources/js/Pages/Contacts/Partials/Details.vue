<!--suppress NpmUsedModulesInstalled, JSValidateTypes, JSUnresolvedReference -->
<script setup>
import { Select } from "primevue";
import { onMounted, computed, ref } from "vue";

const selected_contact = ref ( null );

const contact_options = computed ( () => {
  return props.contacts.map ( contact => ( {
    label: `${ contact.type }`,
    value: contact.id
  } ) );
} );

const primary_contact = computed ( () => {
  return props.contacts.find ( contact => contact.is_primary ) || props.contacts[ 0 ] || null;
} );

const current_contact = computed ( () => {
  if ( ! selected_contact.value ) return null;
  return props.contacts.find ( contact => contact.id === selected_contact.value );
} );

onMounted ( () => {
  if ( primary_contact.value ) {
    selected_contact.value = primary_contact.value.id;
  }
} );
const props = defineProps ( {
  contacts: Object,
} );
</script>

<template>
  <div class="w-80">

    <div
        class="flex flex-col gap-4"
    >
      <div class="flex flex-col gap-2">
        <label
            for="contact-select"
            class="font-semibold"
        >Select Contact</label>
        <Select
            id="contact-select"
            v-model="selected_contact"
            :options="contact_options"
            optionLabel="label"
            optionValue="value"
            placeholder="Select a contact"
            class="w-full"
        />
      </div>

      <div
          v-if="current_contact"
          class="bg-darker-50 p-4 rounded-lg"
      >
        <div class="flex justify-between">
          <h3 class="font-semibold text-lg mb-2">{{ current_contact.type }}</h3>
          <i
              class="pi pi-star-fill text-accent-500"
              v-if="current_contact.is_primary"
          />
        </div>

        <div class="space-y-1 text-sm">

          <p v-if="current_contact.address_1 && current_contact.address_2">
            {{ current_contact.address_1 }} {{ current_contact.address_2 }}
          </p>

          <p v-if="current_contact.city || current_contact.state">
            {{ current_contact.city }}, {{ current_contact.state }} {{ current_contact.postal_code }}
          </p>

          <p v-if="current_contact.phone">Phone: {{ current_contact.phone }}</p>
          <p v-if="current_contact.fax">Fax: {{ current_contact.fax }}</p>

        </div>
      </div>
    </div>
  </div>

</template>
