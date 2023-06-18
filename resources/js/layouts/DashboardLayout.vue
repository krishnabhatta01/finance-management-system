<template>
    <q-layout view="hHh Lpr lff" container style="height: 100vh" class="shadow-2 rounded-borders">
        <q-header elevated class="bg-blue-10">
            <q-toolbar>
                <q-toolbar-title>Simple Crud App</q-toolbar-title>
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
                    <q-item clickable v-ripple to="/users">
                        <q-item-section avatar>
                            <q-icon name="people" />
                        </q-item-section>
                        <q-item-section>
                            Users
                        </q-item-section>
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
import {ref} from 'vue'
const miniState =ref(false)
</script>
