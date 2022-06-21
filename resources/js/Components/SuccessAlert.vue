<script setup>
  defineProps(['message']);
</script>

<template>
    <div v-if="message" class="px-4 py-2 my-4 text-white bg-blue-500 rounded-md tex-sm">
         {{message}}
    </div>
</template>
