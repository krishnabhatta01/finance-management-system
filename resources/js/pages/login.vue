<template>
    <q-page>
        <div class="column q-pa-lg">
            <div class="row">
                <q-card
                    square
                    class="shadow-24"
                    style="width: 300px; height: 495px"
                >
                    <q-card-section class="bg-deep-purple-7">
                        <h4 class="text-h5 text-white q-my-md q-px-md">
                            Finance Management
                        </h4>
                        <div
                            class="absolute-bottom-right q-pr-md"
                            style="transform: translateY(50%)"
                        >
                            <q-btn
                                fab
                                icon="add"
                                color="purple-4"
                                to="/main/register"
                            />
                        </div>
                    </q-card-section>

                    <q-card-section>
                        <q-form class="q-px-sm q-pt-xl" @submit="onSubmit" ref="formRef">
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
                                v-model="formData.password"
                                type="password"
                                label="Password"
                                hint="Eg: sdfQ@123"
                                lazy-rules
                                :rules="[
                                    (val) => 
                                       
                                            (val && val.length > 0) ||
                                            'Please type something'
                                      
                                ]"
                            >
                                <template v-slot:prepend>
                                    <q-icon name="lock" />
                                </template>
                            </q-input>
                        </q-form>
                    </q-card-section>

                    <!--   <q-card-section>
                        <div class="text-center q-pa-md q-gutter-md">
                            <q-btn round color="indigo-7">
                                <q-icon
                                    name="fab fa-facebook-f"
                                    size="1.2rem"
                                />
                            </q-btn>
                            <q-btn round color="red-8">
                                <q-icon
                                    name="fab fa-google-plus-g"
                                    size="1.2rem"
                                />
                            </q-btn>
                            <q-btn round color="light-blue-5">
                                <q-icon name="fab fa-twitter" size="1.2rem" />
                            </q-btn>
                        </div>
                    </q-card-section> -->
                    <q-card-actions class="q-px-lg">
                        <q-btn
                            unelevated
                            size="lg"
                            color="purple-4"
                            class="full-width text-white"
                            label="Sign In"
                            type="submit"
                        />
                       
                       
                    </q-card-actions>
                    <q-card-section class="text-center q-pa-sm">
                        <p class="text-grey-6">Forgot your password?</p>
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </q-page>
</template>

<script setup>
import { useQuasar } from "quasar";
import { ref } from "vue";

const $q = useQuasar();
const formRef = ref(null);
const formData = ref({});


const onSubmit = async () => {
    if (formRef.value.validate()) {
        try {
            const { data } = await window.axios.post(
                `${window.baseUrl}/api/login`,
                formData.value
            );
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
            const { data } = err.response;
            $q.notify({
                color: "red-5",
                textColor: "white",
                message: data.message,
            });
        }
    }
};

const onReset =()=>{
    formData.value={}
}

  
</script>
