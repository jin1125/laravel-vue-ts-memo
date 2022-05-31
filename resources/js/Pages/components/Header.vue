<script setup lang="ts">
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import route from 'ziggy-js';

defineProps({
  title: String,
});

const profileUrl = route('profile.show')
const dashboardUrl = route('dashboard')

const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <div class="flex justify-between items-center bg-blue py-3 px-6">
      <Link
        :href="dashboardUrl"
        class="text-white font-bold text-3xl"
      >
        laravel Vue Memo
      </Link>
    <div class="text-white font-bold space-x-5">
      <Link
        :href="profileUrl"
        class="hover:opacity-80"
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
