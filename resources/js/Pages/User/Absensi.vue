<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, onMounted } from "vue";

const videoRef = ref<HTMLVideoElement | null>(null);
const startCamera = async () => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: true,
            });
            if (videoRef.value) {
                videoRef.value.srcObject = stream;
            }
        } catch (error) {
            console.error("Error accessing camera:", error);
        }
    }
};

onMounted(() => {
    startCamera();
});
</script>

<template>
    <div class="flex justify-center items-center h-screen">
        <div class="text-center">
            <h6 class="">Silahkan melakukan absensi</h6>
            <video
                autoplay="true"
                ref="videoRef"
                class="border-2 border border-black p-2"
            ></video>
            <PrimaryButton class="mt-10"> Submit </PrimaryButton>
        </div>
    </div>
</template>
