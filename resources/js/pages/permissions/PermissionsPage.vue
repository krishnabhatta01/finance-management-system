<template>
    <div class="q-pa-md">
        <q-table title="Permissions" :rows="rows" :columns="columns" row-key="name" selection="multiple"
            v-model:selected="selected">
            <template v-slot:top-right >
                <q-btn
                color="primary"
                icon-right="archive"
                label="Export to csv"
                no-caps
                style="margin-right: 10px;"
                @click="() => { exportTable() }"
                />

                 <q-btn
                            color="primary"
                            label="Add"
                            icon="add"
                            @click="() => {
                                router.push({
                                    path: 'permissions/save'
                                })
                            }"
                        />
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
                            path: `permissions/save/${props.row.id}`
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
import { useQuasar, exportFile } from "quasar";

const rows = ref([]);
const selected = ref([]);
const router = useRouter();
const $q = useQuasar();

const columns = [
    // { name: 'id', align: 'center', label: '#', field: 'id', },
    { name: 'name', align: 'center', label: 'Name', field: 'name', },
    { name: 'actions', align: 'center', label: 'Actions', field: 'actions', },

]


function wrapCsvValue(val, formatFn, row) {
    let formatted = formatFn !== void 0
        ? formatFn(val, row)
        : val

    formatted = formatted === void 0 || formatted === null
        ? ''
        : String(formatted)

    formatted = formatted.split('"').join('""')
    /**
     * Excel accepts \n and \r in strings, but some other CSV parsers do not
     * Uncomment the next two lines to escape new lines
     */
    // .split('\n').join('\\n')
    // .split('\r').join('\\r')

    return `"${formatted}"`
}

const fetchPage = async () => {
    const res = await fetch(`${window.baseUrl}/api/permissions`)
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
            const { data } = await window.axios.delete(`${window.baseUrl}/api/permissions/${id}`)
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

const exportTable = () => {
    // naive encoding to csv format
    const content = [columns.map(col => wrapCsvValue(col.label))].concat(
        rows.map(row => columns.map(col => wrapCsvValue(
            typeof col.field === 'function'
                ? col.field(row)
                : row[col.field === void 0 ? col.name : col.field],
            col.format,
            row
        )).join(','))
    ).join('\r\n')

    const status = exportFile(
        'table-export.csv',
        content,
        'text/csv'
    )

    if (status !== true) {
        $q.notify({
            message: 'Browser denied file download...',
            color: 'negative',
            icon: 'warning'
        })
    }
};
fetchPage();
</script>
