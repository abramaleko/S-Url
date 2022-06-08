<script setup>
import AuthLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import HeaderStats from '@/Components/HeaderStats.vue';
</script>

<template>
    <Head title="Dashboard" />
    <AuthLayout>
       <HeaderStats/>
    </AuthLayout>
</template>
