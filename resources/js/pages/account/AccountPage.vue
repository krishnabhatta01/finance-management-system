<template>
    <div class="q-pa-md">
        <q-table title="Account" :rows="rows" :columns="columns" row-key="name">
            <template v-slot:top-right>
                <div class="q-pa-md q-gutter-sm">
                    <q-btn
                        color="primary"
                        label="Add"
                        icon="add"
                        @click="
                            () => {
                                router.push({
                                    path: '/account/save',
                                });
                            }
                        "
                    />
                    <q-btn color="primary" icon="file_download" label="Pdf" />
                </div>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    
                    <q-btn
                        color="negative"
                        size="sm"
                        round
                        flat
                        icon="app_blocking"
                        @click="
                            () => {
                                confirmDelete(props.row.id);
                            }
                        "
                    />
                </q-td>
            </template>
            
        </q-table>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useQuasar } from "quasar";
const router = useRouter();
const $q = useQuasar();
const columns = [
    {
        name: "id",
        label: "#",
        field: "id",
        align: "left",
    },
    {
        name: "account_holder",
        label: "Account holder",
        field: "account_holder",
        align: "left",
    },
    {
        name: "ac_no",
        label: "Ac. No.",
        field: "ac_no",
        align: "left",
    },
    {
        name: "balance",
        label: "Balance",
        field: "balance",
        align: "left",
    },
    {
        name: "loan",
        label: "Loan",
        field: "loan",
        align: "left",
    },
];
const rows = ref([]);
const fetchPage = async () => {
    const res = await fetch(`${window.baseUrl}/api/account`);
    const { success, data } = await res.json();
    if (success) {
        rows.value = data;
    }
};
const confirmDelete = (id) => {
    $q.dialog({
        title: "Confirm",
        message: "Are you sure to delete this user?",
        cancel: true,
        persistent: true,
    }).onOk(async () => {
        try {
            const { data } = await window.axios.delete(
                `${window.baseUrl}/api/account/${id}`
            );
            $q.notify({
                color: "positive",
                textColor: "white",
                message: data.message,
            });
            await fetchPage();
        } catch (e) {
            $q.notify({
                color: "negative",
                textColor: "white",
                message: "Something went wrong.",
            });
        }
    });
};
fetchPage();
</script>
