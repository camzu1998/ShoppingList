<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {reactive, defineProps} from 'vue'
import {Head, Link, router} from '@inertiajs/vue3'
import Select from "@/Components/Select.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { emails, list } = defineProps(['emails', 'list']);


const form = reactive({
    email: ''
})

function submit() {
    router.post('/lists/' + list.id + '/invite', form)
}

const statuses = ['active', 'inactive', 'archive'];
</script>

<template>
    <Head title="Lists" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List invitations</h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <h3>Invite</h3>
                    <form @submit.prevent="submit" class="flex flex-col px-4 py-12">
                        <Select :options="users" id="email" v-model="form.email"></Select>
                        <PrimaryButton type="submit" class="mt-4 justify-center">Invite</PrimaryButton>
                    </form>
                    <hr>
                    <h3>Manage list users</h3>
                    <div class="flex flex-col px-4 py-12">
                        <div class="py-2 flex w-full" v-for="user in list.users">
                            <span>{{ user.name + '(' +user.email + ')'}}</span>
                            <Link :href="'/lists/' + list.id + '/detach/' + user.id" method="delete" as="button" type="button" class="border-rose-500 text-rose-500" >Delete</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
