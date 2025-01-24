<template>
    <div>
      <VueSelect
        v-model="modelValue"
        :options="options"
        :is-multi="isMulti"
        :placeholder="placeholder"
        @input="$emit('update:modelValue', modelValue)"
      />
    </div>
</template>

<script>
import VueSelect from "vue3-select-component";

export default {
name: "SelectDropdown",
components: { VueSelect },
props: {
    options: { type: Array, required: true },
    placeholder: { type: String, default: "Select an option" },
    modelValue: { type: [String, Array], required: true },
    isMulti: { type: Boolean, default: false },
},
emits: ["update:modelValue"],
};
</script>