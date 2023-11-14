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
            <h2 class="font-semibold text-xl text-purple-100 leading-tight">Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg flex justify-end mb-4">
                    <Link href="/products/create" as="button" type="button" class="text-purple-100 bg-blue-800 px-4 py-1 rounded-md">Add <i class="fa-solid fa-plus fa-bounce"></i></Link>
                </div>

                <table class="table-auto w-full text-center bg-purple-600 text-purple-100 overflow-hidden shadow-sm sm:rounded-lg" :class="{hidden: hideEmpty }">
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
                            <td>{{ product.description ?? 'Empty' }}</td>
                            <td>{{ product.price ?? 'Empty' }}</td>
                            <td>{{ product.shopName ?? 'Empty' }}</td>
                            <td><Link :href="product.editUrl" as="button" type="button">Edit <i class="fa-regular fa-pen-to-square"></i></Link></td>
                            <td><Link :href="'/products/' + product.id" method="delete" as="button" type="button" class="border-rose-500 text-rose-500">Delete <i class="fa-regular fa-trash-can"></i></Link></td>
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
