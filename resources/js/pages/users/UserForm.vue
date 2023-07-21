<template>
    <div class="q-pa-md" style="max-width: 400px">
        <div>
            Create User
        </div>

        <q-form ref="formRef" @submit="onSubmit" @reset="onReset" class="q-gutter-md">
            <file-uploader v-model="formData.avatar" />
            <q-input filled v-model="formData.name" label="Name *" hint="Eg: john" lazy-rules
                :rules="[val => val && val.length > 0 || 'Please type something']" />

            <q-input filled v-model="formData.email" label="Email *" hint="Eg: john@gmail.com" lazy-rules
                :rules="[val => val && val.length > 0 || 'Please type something']" />
            <q-input filled v-model="formData.password" label="Password *" hint="Eg: sdfQ@123" lazy-rules :rules="[val => {
                if (route.params?.id) return true
                return val && val.length > 0 || 'Please type something'
            }]" />
            <q-select v-model="formData.role" :options="['Admin', 'Customer']" label="Role" lazy-rules
                :rules="[val => val && val.length > 0 || 'Please type something']" />

            <div>
                <q-btn label="Submit" type="submit" color="primary" />
                <q-btn label="Back" color="black" flat class="q-ml-sm" @click="() => {
                    router.push({
                        path: '/dashboard/users'
                    })
                }" />
            </div>
        </q-form>

    </div>
</template>

<script setup>
import { useQuasar } from 'quasar'
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from "vue-router";
import FileUploader from "../../components/FileUploader.vue";

const formRef = ref(null)

const $q = useQuasar()
const formData = ref({})
const router = useRouter()
const route = useRoute()

const onSubmit = async () => {
    if (formRef.value.validate()) {
        try {
            const { data } = await window.axios.post(`${window.baseUrl}/api/users/`, formData.value)
            $q.notify({
                color: 'positive',
                textColor: 'white',
                message: data.message
            })
            if (route.params?.id) return;
            await router.push({
                path: "/dashboard/users"
            })
        } catch (err) {
            const { data } = err.response;
            $q.notify({
                color: 'red-5',
                textColor: 'white',
                message: data.message
            })
        }
    }
}
const onReset = () => {
    formData.value = {}
}
const fetchUser = async () => {
    const { data } = await window.axios.get(`${window.baseUrl}/api/users/${route.params.id}`)

    formData.value = data.data
}
onMounted(() => {
    if (route.params?.id) {
        fetchUser(route.params?.id)
    }
})

</script>
