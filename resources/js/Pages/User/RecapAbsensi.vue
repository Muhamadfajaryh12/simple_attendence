<script setup>
import { ref } from "vue";

const items = ref([
    {
        id: 1,
        nama: "test",
        date: "12-01-01",
        status: "Hadir",
    },
    {
        id: 2,
        nama: "test",
        date: "12-01-01",
        status: "Absen",
    },
    {
        id: 1,
        nama: "test",
        date: "12-01-01",
        status: "Hadir",
    },
    {
        id: 2,
        nama: "test",
        date: "12-01-01",
        status: "Absen",
    },
    {
        id: 1,
        nama: "test",
        date: "12-01-01",
        status: "Hadir",
    },
    {
        id: 2,
        nama: "test",
        date: "12-01-01",
        status: "Absen",
    },
    {
        id: 1,
        nama: "test",
        date: "12-01-01",
        status: "Hadir",
    },
    {
        id: 2,
        nama: "test",
        date: "12-01-01",
        status: "Absen",
    },
]);
</script>
<template>
    <div class="flex justify-center h-screen">
        <table class="table-auto w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Nama</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <td>{{ item.nama }}</td>
                    <td class="text-center">{{ item.date }}</td>
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
                </tr>
            </tbody>
        </table>
    </div>
</template>
