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
            <h2 class="font-semibold text-xl text-purple-100 leading-tight">Lists</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg flex justify-end mb-4">
                    <Link href="/lists/create" as="button" type="button" class="text-purple-100 bg-blue-800 px-4 py-1 rounded-md">Add <i class="fa-solid fa-plus fa-beat-fade"></i></Link>
                </div>

                <table class="table-auto w-full text-center bg-purple-600 text-purple-100 overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: hideEmpty }">
                    <thead>
                        <tr>
                            <th>List name</th>
                            <th>List description</th>
                            <th>List status</th>
                            <th>Users</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="list in lists">
                            <td><Link :href="'/lists/' + list.id">{{ list.name }}</Link></td>
                            <td>{{ list.description }}</td>
                            <td :class="{'text-green-400': list.status == 'active', 'text-rose-400': list.status == 'inactive'}">{{ list.status }}</td>
                            <td><Link :href="'/lists/' + list.id + '/manage'" as="button" type="button" v-if="list.isOwner">Manage <i class="fa-solid fa-users-gear"></i></Link></td>
                            <td><Link :href="'/lists/' + list.id + '/edit'" as="button" type="button" v-if="list.isOwner">Edit <i class="fa-regular fa-pen-to-square"></i></Link></td>
                            <td><Link :href="'/lists/' + list.id" method="delete" as="button" type="button" class="border-rose-500 text-rose-500" v-if="list.isOwner">Delete <i class="fa-regular fa-trash-can"></i></Link></td>
                        </tr>
                    </tbody>
                </table>

                <div class="bg-purple-700 overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: !hideEmpty }">
                    <div class="p-6 text-gray-900" >Your lists is empty!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
