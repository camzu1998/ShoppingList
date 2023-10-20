<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { defineProps } from 'vue';

    const { products } = defineProps(['products']);
    const hideEmpty = products.length === 0;
</script>
<template>
    <Head title="Shops" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg flex justify-end mb-4">
                    <Link href="/products/create" as="button" type="button">Add</Link>
                </div>

                <table class="table-auto w-full text-center bg-white overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: hideEmpty }">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Product description</th>
                            <th>Product price</th>
                            <th>Product shop</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products">
                            <td>{{ product.name }}</td>
                            <td>{{ product.description ?? 'Brak' }}</td>
                            <td>{{ product.price ?? 'Brak' }}</td>
                            <td>{{ product.shopName ?? 'Brak' }}</td>
                            <td><Link :href="product.editUrl" as="button" type="button">Edit</Link></td>
                            <td><Link :href="'/products/' + product.id" method="delete" as="button" type="button" class="border-rose-500 text-rose-500">Delete</Link></td>
                        </tr>
                    </tbody>
                </table>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: !hideEmpty }">
                    <div class="p-6 text-gray-900" >Your products is empty!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
