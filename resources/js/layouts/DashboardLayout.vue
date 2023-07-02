<template>
    <q-layout
        view="hHh Lpr lff"
        container
        style="height: 100vh"
        class="shadow-2 rounded-borders"
    >
        <q-header elevated class="bg-blue-10 q-pa-sm">
            <q-toolbar>
                <q-toolbar-title>Admin panel</q-toolbar-title>
                <q-btn color="white" text-color="primary" round icon="logout" @click="logout" />
            </q-toolbar>
        </q-header>

        <q-drawer
            show-if-above
            :mini="miniState"
            :width="200"
            :breakpoint="500"
            bordered
            class="bg-white"
        >
            <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
                <q-list padding>
                    <q-item clickable v-ripple to="/dashboard/users">
                        <q-item-section avatar>
                            <q-icon name="people" />
                        </q-item-section>
                        <q-item-section> Users </q-item-section>
                    </q-item>
                </q-list>

                <q-list padding>
                    <q-item clickable v-ripple to="/dashboard/account">
                        <q-item-section avatar>
                            <q-icon name="account_circle" />
                        </q-item-section>
                        <q-item-section> Account </q-item-section>
                    </q-item>
                </q-list>
            </q-scroll-area>
        </q-drawer>

        <q-page-container>
            <q-page padding class="bg-gray-4">
                <router-view></router-view>
            </q-page>
        </q-page-container>
    </q-layout>
</template>
<script setup>
import { ref } from "vue";
import { useQuasar } from "quasar";
import {useRouter} from "vue-router";

const miniState = ref(false);
const $q = useQuasar();
const router = useRouter();

const logout = async () => {
    try {
        const { data } = await window.axios.post(
            `${window.baseUrl}/api/logout`
        );
        $q.notify({
            color: "positive",
            textColor: "white",
            message: data.message,
        });
        if (route.params?.id) return;
        await router.push({
            path: "dashboard/main",
        });
    } catch (error) {
        const { data }  = error.response;
        $q.notify({
            color: "red-5",
            textColor: "white",
            message: data.message,
        });
    }
};
</script>
