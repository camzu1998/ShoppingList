<script>
import VueSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

export default {
    components: {
        VueSelect,
    },
    data() {
        return {
            selectedOption: null,
            options: ['Option 1', 'Option 2', 'Option 3'],
        };
    },
};
</script>

<template>
    <vue-select v-model="selectedOption" :options="options" :create="true" :taggable="true"></vue-select>
</template>
