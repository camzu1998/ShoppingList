<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { defineProps } from 'vue'; // Dodaj to, aby można było korzystać z defineProps

    const { lists } = defineProps(['lists']);
    const hideEmpty = lists.length === 0;
</script>
<template>
    <Head title="Lists" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lists</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg flex justify-end mb-4">
                    <Link href="/lists/create" as="button" type="button">Add</Link>
                </div>

                <table class="table-auto bg-white overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: hideEmpty }">
                    <thead>
                        <tr>
                            <th>List name</th>
                            <th>List description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="list in lists">
                            <td>{{ list.name }}</td>
                            <td>{{ list.description }}</td>
                            <td><Link :href="'/lists/' + list.id" as="button" type="button">Edit</Link></td>
                            <td><Link :href="'/lists/' + list.id" method="delete" as="button" type="button">Add</Link></td>
                        </tr>
                    </tbody>
                </table>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: !hideEmpty }">
                    <div class="p-6 text-gray-900" >Your lists is empty!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
