<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { defineProps } from 'vue';

    const { shops } = defineProps(['shops']);
    const hideEmpty = shops.length === 0;
</script>
<template>
    <Head title="Lists" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shops</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg flex justify-end mb-4">
                    <Link href="/shops/create" as="button" type="button">Add</Link>
                </div>

                <table class="table-auto w-full text-center bg-white overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: hideEmpty }">
                    <thead>
                        <tr>
                            <th>Shop name</th>
                            <th>Shop description</th>
                            <th>Shop address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="shop in shops">
                            <td>{{ shop.name }}</td>
                            <td>{{ shop.description }}</td>
                            <td>{{ shop.address }}</td>
                            <td><Link :href="'/shops/' + shop.id + '/edit'" as="button" type="button">Edit</Link></td>
                            <td><Link :href="'/shops/' + shop.id" method="delete" as="button" type="button" class="border-rose-500 text-rose-500">Delete</Link></td>
                        </tr>
                    </tbody>
                </table>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: !hideEmpty }">
                    <div class="p-6 text-gray-900" >Your shops is empty!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
