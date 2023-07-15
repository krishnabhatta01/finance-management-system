<template>
    <div class="q-pa-md">
        <q-table title="Roles" :rows="rows" :columns="columns" row-key="name" selection="multiple"
            v-model:selected="selected">
            <template v-slot:top-right>


                <q-btn color="primary" label="Add" icon="add"  @click="() => {
                    router.push({
                        path: 'roles/save'
                    })
                }" />
            </template>
            <template v-slot:header-selection="scope">
                <q-toggle v-model="scope.selected" />
            </template>
            <template v-slot:body-selection="scope">
                <q-toggle v-model="scope.selected" />
            </template>
            <template v-slot:body-cell-actions=props>
                <q-td :props="props">
                    <q-btn color="primary" size="sm" round flat icon="edit" @click="() => {
                        router.push({
                            path: `roles/save/${props.row.id}`
                        })
                    }" />
                    <q-btn color="negative" size="sm" round flat icon="delete"
                        @click="() => { confirmDelete(props.row.id) }" />
                </q-td>
            </template>
        </q-table>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";

const rows = ref([]);
const selected = ref([]);
const router = useRouter();
const $q = useQuasar();

const columns = [
    // { name: 'id', align: 'center', label: '#', field: 'id', },
    { name: 'name', align: 'center', label: 'Name', field: 'name', },
    { name: 'actions', align: 'center', label: 'Actions', field: 'actions', },

]



const fetchPage = async () => {
    const res = await fetch(`${window.baseUrl}/api/roles`)
    const { success, data } = await res.json();
    if (success) {
        rows.value = data
    }
}

const confirmDelete = (id) => {
    $q.dialog({
        title: 'Confirm',

        message: 'Are you sure to delete this user?',
        cancel: true,
        persistent: true
    }).onOk(async () => {
        try {
            const { data } = await window.axios.delete(`${window.baseUrl}/api/roles/${id}`)
            $q.notify({
                color: 'positive',
                textColor: 'white',
                message: data.message
            })
            await fetchPage();
        } catch (e) {
            $q.notify({
                color: 'negative',
                textColor: 'white',
                message: "Something went wrong."
            })
        }
    })
}
fetchPage();
</script>
