<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {reactive, defineProps} from 'vue';
import {Head, router} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { products, list } = defineProps(['products', 'list']);

const addProduct = () => {
    products.push({ name: '', price: null, shopName: null });
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
                ></ProductForm>
                <PrimaryButton type="button" @click="addProduct">Add Product</PrimaryButton>
                <button type="submit">Submit</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<!--<script setup>-->
<!--import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';-->
<!--import {reactive, defineProps} from 'vue'-->
<!--import {Head, router} from '@inertiajs/vue3'-->
<!--import Select from "@/Components/Select.vue";-->
<!--import PrimaryButton from "@/Components/PrimaryButton.vue";-->

<!--const { list } = defineProps(['list']);-->

<!--const id = list.id ?? null;-->

<!--const form = reactive({-->
<!--    name: list.name ?? null,-->
<!--    description: list.description ?? null,-->
<!--    status: list.status ?? null,-->
<!--})-->

<!--function submit() {-->
<!--    if (id === null) {-->
<!--        router.post('/lists', form)-->
<!--    } else {-->
<!--        router.put('/lists/' + list.id, form)-->
<!--    }-->
<!--}-->

<!--const statuses = ['active', 'inactive', 'archive'];-->
<!--</script>-->

<!--<template>-->
<!--    <Head title="Lists" />-->

<!--    <AuthenticatedLayout>-->
<!--        <template #header>-->
<!--            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lists</h2>-->
<!--        </template>-->

<!--        <div class="py-4">-->
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
<!--                <div class="bg-white shadow-sm sm:rounded-lg">-->
<!--                    <form @submit.prevent="submit" class="flex flex-col px-4 py-12">-->
<!--                        <label for="name">List name:</label>-->
<!--                        <input id="name" v-model="form.name" type="text" class=""/>-->
<!--                        <label for="description">List description:</label>-->
<!--                        <textarea id="description" v-model="form.description" />-->
<!--                        <label for="status">List status:</label>-->
<!--                        <Select :options="statuses" id="status" v-model="form.status"></Select>-->
<!--                        <PrimaryButton type="submit" class="mt-4 justify-center">Save</PrimaryButton>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </AuthenticatedLayout>-->
<!--</template>-->
