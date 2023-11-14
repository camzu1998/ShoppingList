<template>
    <div class="flex w-full">
        <label for="name">Name:</label>
        <input v-model="product.name" type="text" id="name">
        <label for="price">Price:</label>
        <input v-model="product.price" type="number" id="price">
        <SecondaryButton @click="remove">X</SecondaryButton>
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
