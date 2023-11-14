<template>
    <div class="flex w-full my-2 items-center">
        <label for="name" class="text-purple-100">Name:</label>
        <input v-model="product.name" type="text" id="name" class="text-purple-700 bg-purple-200 focus:bg-purple-350">
        <label for="price" class="text-purple-100">Price:</label>
        <input v-model="product.price" type="number" id="price" class="text-purple-700 bg-purple-200 focus:bg-purple-350 mr-1">
        <SecondaryButton @click="remove" bg="red">X</SecondaryButton>
    </div>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    components: {SecondaryButton},
    props: {
        product: Object,
        index: Number
    },
    methods: {
        remove() {
            this.$emit('removeProduct', this.index);
        }
    }
};
</script>
