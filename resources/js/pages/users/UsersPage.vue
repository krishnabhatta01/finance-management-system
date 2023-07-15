<template>
    <div class="q-pa-md">
        <q-table
            title="Users"
            :rows="rows"
            :columns="columns"
            row-key="name"
        >
            <template v-slot:top-right>
                <q-btn
                    color="primary"
                    label="Add"
                    icon="add"
                    @click="()=>{
                        router.push({
                            path:'users/save'
                        })
                    }"
                />
            </template>
            <template v-slot:body-cell-actions=props>
                <q-td :props="props">
                    <q-btn
                        color="primary"
                        size="sm"
                        round
                        flat
                        icon="edit"
                        @click="()=>{
                            router.push({
                                path:`users/save/${props.row.id}`
                            })
                        }"
                    />
                    <q-btn
                        color="negative"
                        size="sm"
                        round
                        flat
                        icon="delete"
                        @click="()=>{confirmDelete(props.row.id)}"
                    />
                </q-td>
            </template>
            <template v-slot:body-cell-avatar=props>
                <q-td :props="props">
                  <img v-if="props.row.avatar" :src="props.row.avatar" alt="avatar" style="width: 50px;height: 50px;object-fit: cover;"/>
                    <span v-else>N/A</span>
                </q-td>
            </template>
        </q-table>
    </div>
</template>
<script setup>
import {ref} from "vue";
import {useRouter} from "vue-router";
import {useQuasar} from "quasar";
const router = useRouter();
const $q = useQuasar();
const columns=[
    {
        name:"id",
        label:"#",
        field:"id",
        align:"left",
    },
    {
        name:"avatar",
        label:"Avatar",
        field:"avatar",
        align:"left",
    },
    {
        name:"name",
        label:"Name",
        field:"name",
        align:"left",
    },
    {
        name:"email",
        label:"Email",
        field:"email",
        align:"left",
    },
    {
        name:"role",
        label:"Role",
        field:"role",
        align:"left",
    },
    {
        name:"actions",
        label:"Actions",
        field:"actions",
        align:"left",
    },

];

const rows = ref([])

const fetchPage=async ()=>{
    const res = await fetch(`${window.baseUrl}/api/users`)
    const { success,data } = await  res.json();
    if(success){
        rows.value=data
    }
}
const confirmDelete=(id)=>{
    $q.dialog({
        title: 'Confirm',
        message: 'Are you sure to delete this user?',
        cancel: true,
        persistent: true
    }).onOk(async () => {
        try {
            const {data} = await window.axios.delete(`${window.baseUrl}/api/users/${id}`)
            $q.notify({
                color: 'positive',
                textColor: 'white',
                message:data.message
            })
            await fetchPage();
        }catch (e) {
            $q.notify({
                color: 'negative',
                textColor: 'white',
                message:"Something went wrong."
            })
        }
    })
}
fetchPage();
</script>
