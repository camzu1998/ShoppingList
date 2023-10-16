<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { reactive } from 'vue'
import {Head, router} from '@inertiajs/vue3'
import { defineProps } from 'vue'; // Dodaj to, aby można było korzystać z defineProps

const { list } = defineProps(['list']);

const form = reactive({
    name: list.name ?? null,
    description: list.description ?? null,
})

function submit() {
    if (form.name === null) {
        router.post('/lists', form)
    } else {
        router.put('/lists/' + list.id, form)
    }
}
</script>

<template>
    <Head title="Lists" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lists</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="flex flex-col">
                        <label for="name">List name:</label>
                        <input id="name" v-model="form.name" type="text" class=""/>
                        <label for="description">List description:</label>
                        <textarea id="description" v-model="form.description" />
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
