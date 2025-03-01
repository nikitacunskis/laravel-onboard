<script setup>

const props = defineProps({
    headers: {
        type: Array,
        required: true,
    },
    data: {
        type: Array,
        required: true,
    },
})
</script>
<template>
    <main>
        <table>
            <thead>
                <tr>
                    <th v-for="title in headers">{{ title }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, rowIndex) in data" :key="rowIndex">
                    <td v-for="(field, index) in row" :key="index">{{ field }}</td>
                </tr>
            </tbody>
        </table>
    </main>
</template>