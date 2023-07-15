<template>
    <div class="q-pa-md q-gutter-sm">


        <q-dialog v-model="layout" no-esc-dismiss no-backdrop-dismiss>
            <q-layout view="Lhh lpR fff" container class="bg-white text-dark">
                <h4 class="flex">Create Roles </h4>
                <div class="q-pa-md" style="max-width: 400px">
                    <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
                        <q-input filled v-model="name" label="Your name *" hint="Name and surname" lazy-rules
                            :rules="[val => val && val.length > 0 || 'Please type something']" />

                        <div>
                            <q-btn label="Submit" type="submit" color="primary" />
                            <q-btn label="Cancel" to="/dashboard/roles" color="primary" />
                        
                        </div>
                    </q-form>
                </div>
            </q-layout>
        </q-dialog>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useQuasar } from 'quasar'

const layout = ref(true);
const name = ref(null);
const $q = useQuasar()

const onSubmit = () => {
    if (accept.value !== true) {
        $q.notify({
            color: 'red-5',
            textColor: 'white',
            icon: 'warning',
            message: 'You need to accept the license and terms first'
        })
    }
    else {
        $q.notify({
            color: 'green-4',
            textColor: 'white',
            icon: 'cloud_done',
            message: 'Submitted'
        })
    }
};

</script>


