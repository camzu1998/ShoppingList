<template>
    <div class="flex w-full my-2 items-center md:justify-start justify-between">
        <div class="flex items-center space-x-2 mx-2" v-if="isList">
            <div class="relative inline-block w-4 h-4 bg-gray-300 rounded-full">
                <input type="checkbox" :id="'product_' + index" class="hidden peer" v-model="product.pivot.bought_at"/>
                <label :for="'product_' + index" class="absolute inset-0 rounded-full cursor-pointer transition-transform bg-red-600 peer-checked:bg-green-600"></label>
            </div>
        </div>
        <div>
            <label for="name" class="text-purple-100">Name:</label>
            <input v-model="product.name" type="text" id="name" class="text-purple-700 bg-purple-200 focus:bg-purple-350">
        </div>
        <div>
            <label for="price" class="text-purple-100">Price:</label>
            <input v-model="product.price" type="number" id="price" class="text-purple-700 bg-purple-200 focus:bg-purple-350 mr-1">
        </div>
        <SecondaryButton @click="remove" bg="red">X</SecondaryButton>
    </div>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    components: {SecondaryButton},
    props: {
        product: Object,
        index: Number,
        isList: Boolean
    },
    methods: {
        remove() {
            this.$emit('removeProduct', this.index);
        }
    }
};
</script>
