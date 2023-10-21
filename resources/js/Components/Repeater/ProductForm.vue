<template>
    <div class="flex w-full">
        <label for="name">Name:</label>
        <input v-model="product.name" type="text" id="name">
        <label for="price">Price:</label>
        <input v-model="product.price" type="number" id="price">
        X
    </div>
</template>

<script>
export default {
    props: {
        product: Object,
        index: Number
    }
};
</script>
