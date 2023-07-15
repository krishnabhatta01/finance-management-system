<template>
    <q-page>
        <div class="column q-pa-lg">
            <div class="row">
                <q-card
                    square
                    class="shadow-24"
                    style="width: 300px; height: 500px"
                >
                    <q-card-section
                        class="bg-deep-purple-7"
                        style="width: 300px; height: 80px"
                    >
                        <h4 class="text-h5 text-white q-my-md absolute-center">
                            Registration
                        </h4>
                        <div
                            class="absolute-bottom-right q-pr-md"
                            style="transform: translateY(50%)"
                        >
                            <q-btn fab icon="close" color="purple-4" />
                        </div>
                    </q-card-section>
                    <q-card-section>
                        <q-form
                            class="q-px-sm q-pt-xl q-pb-lg"
                            @submit="onSubmit"
                            ref="formRef"
                            @submit.prevent="simulateSubmit"
                        >
                            <q-input
                                square
                                clearable
                                v-model="formData.email"
                                type="email"
                                label="Email"
                                hint="Eg: john@gmail.com"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Please type something',
                                ]"
                            >
                                <template v-slot:prepend>
                                    <q-icon name="email" />
                                </template>
                            </q-input>
                            <q-input
                                square
                                clearable
                                v-model="formData.username"
                                type="username"
                                label="Username"
                                hint="Eg:John"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Please type something',
                                ]"
                            >
                                <template v-slot:prepend>
                                    <q-icon name="person" />
                                </template>
                            </q-input>
                            <q-input
                                square
                                clearable
                                v-model="formData.password"
                                type="password"
                                label="Password"
                                hint="Eg: sdfQ@123"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Please type something',
                                ]"
                            >
                                <template v-slot:prepend>
                                    <q-icon name="lock" />
                                </template>
                            </q-input>

                            <q-card-actions class="q-px-lg">
                                <q-btn
                                    label="Submit"
                                    type="submit"
                                    unelevated
                                    size="lg"
                                    color="purple-4"
                                    class="full-width text-white"
                                    :loading="submitting"
                                >
                                    <template v-slot:loading>
                                        <q-spinner-facebook />
                                    </template>
                                </q-btn>
                            </q-card-actions>
                            <q-card-section class="text-center q-pa-sm">
                                <!--  <p class="text-grey-6">Return to login</p> -->
                                <q-btn
                                    flat
                                    rounded
                                    color="primary"
                                    label="Return to login"
                                    to="/"
                                />
                            </q-card-section>
                        </q-form>
                    </q-card-section>

                </q-card>
            </div>
        </div>
    </q-page>
</template>

<script setup>
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const formData = ref({});
const formRef = ref(null);
const router = useRouter();
const route = useRoute();
const submitting = ref(false);

const onSubmit = async () => {
    try {
        const { data } = await window.axios.post(
            `${window.baseUrl}/api/register`,
            formData.value
        );
        await router.push({
            path: "/",
        });
        $q.notify({
            color: "positive",
            textColor: "white",
            message: data.message,
        });
    } catch (err) {
        const { data } = err.response;
        $q.notify({
            color: "red-5",
            textColor: "white",
            message: data.message,
        });
    }
};

//loading submit button function
function simulateSubmit() {
    submitting.value = true

    // Simulating a delay here.
    // When we are done, we reset "submitting"
    // Boolean to false to restore the
    // initial state.
    setTimeout(() => {
        // delay simulated, we are done,
        // now restoring submit to its initial state
        submitting.value = false
    }, 3000)
}
</script>
