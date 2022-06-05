<script setup lang="ts">
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import route from 'ziggy-js';

defineProps({
  title: String,
});

const profileUrl = route('profile.show')

const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <div class="flex justify-between items-center bg-blue py-3 px-6">
    <Link
      :href="$page.props.user ? route('memo.index') : route('welcome')"
      class="text-white font-bold text-3xl"
    >
      laravel Vue Ts Memo
    </Link>
    <div
      v-if="$page.props.user"
      class="text-white font-bold space-x-5"
    >
      <Link
        :href="profileUrl"
        class="hover:opacity-90"
      >
        profile
      </Link>
      <button
        @click.prevent="logout"
        class="font-bold hover:opacity-90"
      >
        logout
      </button>
    </div>
  </div>
</template>
