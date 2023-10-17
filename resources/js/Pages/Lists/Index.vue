<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { defineProps } from 'vue';

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

                <table class="table-auto w-full text-center bg-white overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: hideEmpty }">
                    <thead>
                        <tr>
                            <th>List name</th>
                            <th>List description</th>
                            <th>List status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="list in lists">
                            <td><Link :href="'/lists/' + list.id">{{ list.name }}</Link></td>
                            <td>{{ list.description }}</td>
                            <td>{{ list.status }}</td>
                            <td><Link :href="'/lists/' + list.id + '/edit'" as="button" type="button" v-if="list.isOwner">Edit</Link></td>
                            <td><Link :href="'/lists/' + list.id" method="delete" as="button" type="button" class="border-rose-500 text-rose-500" v-if="list.isOwner">Delete</Link></td>
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
