<template>
    <div>
        <div>
            <img :src="modelValue" v-if="modelValue" alt="" style="width: 100px; height: 100px;object-fit: cover;">
        </div>
        <input type="file" @change="uploadFile" />
    </div>
</template>
<script setup>
const props = defineProps({
    modelValue: {
        required: false
    },
})
const emit = defineEmits(['update:modelValue'])
const uploadFile = (e) => {
    const file = e.target.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        emit("update:modelValue", reader.result);
    };
};
</script>
