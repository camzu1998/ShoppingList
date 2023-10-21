<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {reactive, defineProps} from 'vue'
import {Head, router} from '@inertiajs/vue3'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Select from "@/Components/Select.vue";
import VueSelect from "vue-select";

const { product, shops } = defineProps(['product' , 'shops']);

const id = product.id ?? null;

const form = reactive({
    name: product.name ?? null,
    description: product.description ?? null,
    price: product.price ?? null,
    shop_id: product.shop_id ?? null,
})

function submit() {
    if (id === null) {
        router.post('/products', form)
    } else {
        router.put('/products/' + product.id, form)
    }
}
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product</h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="flex flex-col px-4 py-12">
                        <label for="name">Product name:</label>
                        <input id="name" v-model="form.name" type="text" class="" required/>
                        <label for="description">Product description:</label>
                        <textarea id="description" v-model="form.description" />
                        <label for="price">Product price:</label>
                        <input id="price" v-model="form.price" type="number" min="0" step="0.01" class=""/>
                        <label for="shop_id">Product shop:</label>
                        <Select :options="shops" id="shop_id" v-model="form.shop_id" :value="form.shop_id" label="name" :reduce="name => name.id" :create="false" :taggable="false"></Select>
                        <PrimaryButton type="submit" class="mt-4 justify-center">Save</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
