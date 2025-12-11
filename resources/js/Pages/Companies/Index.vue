<!--suppress NpmUsedModulesInstalled -->
<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import { Button, DataTable, Column, ConfirmDialog } from 'primevue';
import AppLayout from '@/Layouts/AppLayout.vue';


const props = defineProps ( {
  companies: Array,
} );

const page = usePage ();
const confirm = useConfirm ();

const format_date = ( date ) => {
  return new Date ( date ).toLocaleDateString ( 'en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  } );
};

const create_company = () => {
  router.visit ( route ( 'companies.create' ) );
};

const edit_company = ( company_id ) => {
  router.visit ( route ( 'companies.edit', company_id ) );
};

const delete_company = ( company ) => {
  confirm.require ( {
    message: `Are you sure you want to delete ${ company.name }?`,
    header: 'Confirm Deletion',
    icon: 'pi pi-exclamation-triangle',
    rejectLabel: 'Cancel',
    acceptLabel: 'Delete',
    rejectClass: 'p-button-secondary p-button-outlined',
    acceptClass: 'p-button-danger',
    accept: () => {
      router.delete ( route ( 'companies.destroy', company.id ), {
        preserveScroll: true,
      } );
    }
  } );
};
</script>

<template>
  <AppLayout>
    <ConfirmDialog />
    <div class="px-8 py-4">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-darker-900">Companies</h1>
        <Button
            label="Create Company"
            icon="pi pi-plus"
            @click="create_company"
            severity="primary"
        />
      </div>

      <DataTable
          :value="props.companies"
          stripedRows
          :paginator="true"
          :rows="10"
          :rowsPerPageOptions="[5, 10, 20, 50]"
          tableStyle="min-width: 50rem"
      >
        <Column
            field="type"
            header="Type"
            sortable
        ></Column>
        <Column
            field="name"
            header="Name"
            sortable
        ></Column>
        <Column
            field="notes"
            header="Notes"
        >
          <template #body="slot_props">
            <span class="truncate max-w-md">{{ slot_props.data.notes || '-' }}</span>
          </template>
        </Column>
        <Column
            field="created_at"
            header="Created"
            sortable
        >
          <template #body="slot_props">
            {{ format_date ( slot_props.data.created_at ) }}
          </template>
        </Column>
        <Column header="Actions">
          <template #body="slot_props">
            <div class="flex gap-2">
              <Button
                  icon="pi pi-pencil"
                  severity="secondary"
                  size="small"
                  @click="edit_company(slot_props.data.id)"
                  v-tooltip.top="'Edit'"
              />
              <Button
                  icon="pi pi-trash"
                  severity="danger"
                  size="small"
                  @click="delete_company(slot_props.data)"
                  v-tooltip.top="'Delete'"
              />
            </div>
          </template>
        </Column>
      </DataTable>
    </div>
  </AppLayout>
</template>

