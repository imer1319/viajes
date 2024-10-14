<template>
    <input
        ref="input"
        type="text"
        class="form-control"
        :title="title"
        v-model="formatted"
    />
</template>

<script>
import Cleave from "cleave.js";

export default {
    props: ["title", "value"],
    data() {
        return {
            cleave: null,
        };
    },
    computed: {
        formatted: {
            get() {
                return this.value ? this.value.toString() : '';
            },
            set(newValue) {
                const cleanValue = newValue.replace(/,/g, "");
                this.$emit("input", cleanValue);
            },
        },
    },
    mounted() {
        this.initializeCleave();
    },
    watch: {
        value(newValue) {
            this.cleave.setRawValue(newValue);
        },
    },
    methods: {
        initializeCleave() {
            this.cleave = new Cleave(this.$refs.input, {
                numeral: true,
                numeralThousandsGroupStyle: "thousand",
                numeralDecimalMark: ".",
                numeralDecimalScale: 2,
            });
            this.cleave.setRawValue(this.value);
        },
    },
};
</script>
