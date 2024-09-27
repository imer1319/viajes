<template>
    <input
        type="text"
        class="form-control"
        :title="title"
        v-model="formatted"
    />
</template>

<script>
import NumberFormat from "number-format.js";

export default {
    props: ["title", "value"],
    computed: {
        formatted: {
            get() {
                return NumberFormat("#,##0.####", this.value);
            },
            set(newValue) {
                const cleanValue = newValue.replace(/,/g, "");
                const intValue = parseInt(cleanValue, 10);
                this.$emit("input", intValue || 0);
            },
        },
    },
};
</script>
