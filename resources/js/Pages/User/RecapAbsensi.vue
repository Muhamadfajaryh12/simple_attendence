<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = usePage().props;

const absensi_data = computed(() => props.data || []);
console.log(absensi_data);
</script>
<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                    <div class="text-gray-900">Recap Absensi</div>
                    <table class="table-auto w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-2">Nama</th>
                                <th class="p-2">Lokasi</th>
                                <th class="p-2">Tanggal</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Evidence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in absensi_data" :key="item.id">
                                <td>{{ item.user.name }}</td>
                                <td>{{ item.lokasi }}</td>
                                <td class="text-center">
                                    {{
                                        new Date(
                                            item.created_at
                                        ).toLocaleDateString()
                                    }}
                                </td>
                                <td>
                                    <div
                                        :class="
                                            item.status == 'Absen'
                                                ? 'bg-red-500 w-32 p-2 mx-auto rounded-md text-center text-white font-bold'
                                                : 'bg-green-500 w-32 p-2  mx-auto rounded-md text-center font-bold'
                                        "
                                    >
                                        {{ item.status }}
                                    </div>
                                </td>
                                <td>
                                    <img
                                        class="w-24 mx-auto"
                                        :src="`http://127.0.0.1:8000/storage/${item.foto}`"
                                        alt="Foto Absensi"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
