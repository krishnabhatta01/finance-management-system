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

        <div class="q-pa-sm">
          <q-btn-dropdown color="white" text-color="black" dropdown-icon="person">
            <q-list class="q-pa-lg">
              <img
                :src="profile.avatar"
                alt="profile"
                class="w-24 h-24 rounded-full mx-auto"
              />

              <!-- <img
                    src="https://api.dicebear.com/6.x/initials/svg?seed={{profile.name}}"
                    alt="avatar" /> -->
              <q-item-label style="color: rgba(0, 0, 255, 0.589); font-size: 24px">{{
                profile.name
              }}</q-item-label>
              <hr />
              <q-item clickable v-close-popup @click="logout">
                <q-item-section>
                  <q-item-label>Logout</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
        </div>
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
            <q-item-section> Users</q-item-section>
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

        <q-list padding>
          <q-item clickable v-ripple to="/dashboard/roles">
            <q-item-section avatar>
              <q-icon name="manage_accounts" />
            </q-item-section>
            <q-item-section> Roles </q-item-section>
          </q-item>
        </q-list>

        <q-list padding>
          <q-item clickable v-ripple to="/dashboard/permissions">
            <q-item-section avatar>
              <q-icon name="admin_panel_settings" />
            </q-item-section>
            <q-item-section> Permissions </q-item-section>
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
import { ref, onMounted } from "vue";
import { useQuasar } from "quasar";
import { useRoute, useRouter } from "vue-router";

const miniState = ref(false);
const profile = ref([]);

const $q = useQuasar();
const router = useRouter();
const route = useRoute();

import { createAvatar } from "@dicebear/core";
import { initials } from "@dicebear/collection";

async function fetchPage() {
  const res = await fetch(`${window.baseUrl}/api/profile`);
  const data = await res.json();
  profile.value = data;
}

const logout = async () => {
  try {
    const { data } = await window.axios.post(`${window.baseUrl}/api/logout`);
    $q.notify({
      color: "positive",
      textColor: "white",
      message: data.message,
    });
    if (route.params?.id) return;
    await router.push({
      path: "/",
    });
  } catch (error) {
    const { data } = error.response;
    $q.notify({
      color: "red-5",
      textColor: "white",
      message: data.message,
    });
  }
};
fetchPage();
</script>
