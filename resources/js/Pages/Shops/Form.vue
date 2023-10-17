<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {reactive, defineProps} from 'vue'
import {Head, router} from '@inertiajs/vue3'
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { shop } = defineProps(['shop']);

const id = shop.id ?? null;

const form = reactive({
    name: shop.name ?? null,
    description: shop.description ?? null,
    address: shop.address ?? null,
})

function submit() {
    if (id === null) {
        router.post('/shops', form)
    } else {
        router.put('/shops/' + shop.id, form)
    }
}
</script>

<template>
    <Head title="Lists" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lists</h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="flex flex-col px-4 py-12">
                        <label for="name">Shop name:</label>
                        <input id="name" v-model="form.name" type="text" class=""/>
                        <label for="address">Shop address:</label>
                        <input id="address" v-model="form.address" type="text" class=""/>
                        <label for="description">Shop description:</label>
                        <textarea id="description" v-model="form.description" />
                        <PrimaryButton type="submit" class="mt-4 justify-center">Save</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
