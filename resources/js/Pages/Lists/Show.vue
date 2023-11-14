<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {reactive, defineProps} from 'vue';
import {Head, router} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const { products, list } = defineProps(['products', 'list']);

const addProduct = () => {
    products.push({ name: '', price: null, shopName: null });
};

const removeProduct = (index) => {
    products.splice(index, 1);
};

const submitForm = () => {
    var formData = new FormData();

    products.forEach((product, index) => {
        if (product['name'] != "") {
            formData.append('products[' + index + '][name]', product['name']);
            formData.append('products[' + index + '][price]', product['price'] ?? "");
        }
    })

    router.post('/lists/' + list.id + '/products', formData)
    console.log(formData);
};
</script>

<script>
import ProductForm from "@/Components/Repeater/ProductForm.vue";

export default {
    components: {
        ProductForm
    }
};
</script>
<template>
    <Head title="List" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List</h2>
        </template>

        <div>
            <form @submit.prevent="submitForm">
                <ProductForm
                    v-for="(product, index) in products"
                    :key="index"
                    :product="product"
                    :index="index"
                    @removeProduct="removeProduct"
                ></ProductForm>
                <PrimaryButton type="button" @click="addProduct">Add Product</PrimaryButton>
                <SecondaryButton type="submit" bg="lime">Submit</SecondaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
