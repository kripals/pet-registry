<template>
    <div>
      <input
        :type="'radio'"
        :id="id"
        :value="value"
        :name="name"
        v-model="modelValue"
        @change="$emit('update:modelValue', modelValue)"
        class="m-2"
      />
      <label :for="id">{{ label }}</label>
    </div>
</template>

<script>
export default {
name: "RadioButton",
props: {
    id: { type: String, required: true },
    name: { type: String, required: true },
    value: { type: String, required: true },
    label: { type: String, required: true },
    modelValue: { type: String, required: true },
},
emits: ["update:modelValue"],
};
</script>