<script setup lang="ts">
import { Head } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Jetstream/Banner.vue';
import Header from '@/Pages/components/Header.vue';
import Footer from '@/Pages/components/Footer.vue';

defineProps({
    title: String,
});
</script>

<template>
  <Head :title="title" />

  <JetBanner />

  <Header />

  <main>
    <slot />
  </main>

  <Footer />
</template>
