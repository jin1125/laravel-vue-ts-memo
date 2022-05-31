<script setup lang="ts">
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import route from 'ziggy-js';

defineProps({
    title: String,
});

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
  <div class="flex justify-between items-center bg-blue py-3 px-6">
    <span class="cursor-pointer text-white font-bold text-3xl">
      laravel Vue Memo
    </span>
    <div class="text-white space-x-5">
      <Link
        :href="route('profile.show')"
        class="font-bold hover:opacity-80"
      >
        profile
      </Link>
      <button
        @click.prevent="logout"
        class="font-bold hover:opacity-80"
      >
        logout
      </button>
    </div>
  </div>
</template>
