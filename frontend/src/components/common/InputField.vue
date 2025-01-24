<template>
    <div>
      <label :for="id" class="block text-sm/6 font-medium text-gray-900">
        {{ label }}
      </label>
      <div class="mt-2">
        <input
          :type="type"
          :id="id"
          :name="name"
          :placeholder="placeholder"
          v-model="modelValue"
          @input="$emit('update:modelValue', modelValue)"
          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
        />
      </div>
    </div>
</template>

<script>
export default {
name: "InputField",
props: {
    id: { type: String, required: true },
    name: { type: String, required: true },
    label: { type: String, required: true },
    placeholder: { type: String, default: "" },
    type: { type: String, default: "text" },
    modelValue: { type: String, required: true },
},
emits: ["update:modelValue"],
};
</script>