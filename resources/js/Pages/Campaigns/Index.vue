<!-- resources/js/Pages/Campaigns/Index.vue -->
<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();

const campaigns = ref(props.campaigns);
console.log('campaigns', campaigns);
function formatDate(date) {
    return new Date(date).toLocaleDateString();
}
</script>
<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Campaign List</h2>
        </template>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created at
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        v-for="campaign in campaigns.data" :key="campaign.id">
                        <td class="py-2 px-4 border-b">{{ campaign.id }}</td>
                        <td class="py-2 px-4 border-b">{{ campaign.name }}</td>
                        <td class="py-2 px-4 border-b">{{ formatDate(campaign.created_at) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="campaigns.links" />
    </AuthenticatedLayout>
</template>