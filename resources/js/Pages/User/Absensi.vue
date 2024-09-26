<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const videoRef = ref<HTMLVideoElement | null>(null);
const locationRef = ref<{ latitude: number; longitude: number } | null>(null);
const cityRef = ref<string | null>(null);
const canvasRef = ref<HTMLCanvasElement | null>(null);
const photoTaken = ref(false);
const userNameRef = ref<string | null>(null);
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
const getLocation = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                locationRef.value = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                };
                console.log("Location retrieved:", locationRef.value);
                getCityName(
                    position.coords.latitude,
                    position.coords.longitude
                );
            },
            (error) => {
                console.error("Error getting location:", error);
            }
        );
    } else {
        console.error("Geolocation is not supported by this browser.");
    }
};
// const takePhoto = () => {
//     if (videoRef.value && canvasRef.value) {
//         const context = canvasRef.value.getContext("2d");
//         if (context) {
//             // Set canvas size to video dimensions
//             canvasRef.value.width = videoRef.value.videoWidth;
//             canvasRef.value.height = videoRef.value.videoHeight;
//             // Draw video frame to canvas
//             context.drawImage(
//                 videoRef.value,
//                 0,
//                 0,
//                 canvasRef.value.width,
//                 canvasRef.value.height
//             );
//             photoTaken.value = true;
//         }
//     }
// };
const getCityName = async (latitude: number, longitude: number) => {
    // const url = `https://geocode.maps.co/reverse?lat=${latitude}&lon=${longitude}&api_key=66f39ac0c87e6795967372gys502270`;
    // try {
    //     const response = await axios.get(url);
    //     console.log(response);
    //     // const city =
    //     //     response.data.results[0].components.city ||
    //     //     response.data.results[0].components.town ||
    //     //     response.data.results[0].components.village;
    //     // cityRef.value = city;
    //     // console.log("City retrieved:", cityRef.value);
    // } catch (error) {
    //     console.log("Error retrieving city name:", error);
    // }
};
const submitPhoto = async () => {
    if (videoRef.value && canvasRef.value) {
        const context = canvasRef.value.getContext("2d");
        if (context) {
            // Set canvas size to video dimensions
            canvasRef.value.width = videoRef.value.videoWidth;
            canvasRef.value.height = videoRef.value.videoHeight;
            // Draw video frame to canvas
            context.drawImage(
                videoRef.value,
                0,
                0,
                canvasRef.value.width,
                canvasRef.value.height
            );
            photoTaken.value = true;
        }
    }
    if (canvasRef.value) {
        canvasRef.value.toBlob(async (blob) => {
            if (blob) {
                const formData = new FormData();
                formData.append("photo", blob, "photo.jpg");
                formData.append("id_user", userNameRef.value.value);

                try {
                    Inertia.post("/store", formData, {
                        onSuccess: () => {
                            console.log("Photo uploaded successfully");
                        },
                        onError: (errors) => {
                            console.error("Error uploading photo:", errors);
                        },
                    });
                } catch (error) {
                    console.error("Error uploading photo:", error);
                }
            }
        }, "image/jpeg");
    }
};
onMounted(() => {
    startCamera();
    getLocation();
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex justify-center items-center h-screen">
            <div class="text-center">
                <h6 class="">Silahkan melakukan absensi</h6>
                <video
                    autoplay="true"
                    ref="videoRef"
                    class="border-2 border border-black p-2"
                ></video>
                <PrimaryButton class="mt-10" @click="submitPhoto">
                    Submit
                </PrimaryButton>
                <canvas ref="canvasRef" class="hidden"></canvas>
                <form>
                    <input
                        type="hidden"
                        ref="userNameRef"
                        :value="$page.props.auth.user.id"
                    />
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
