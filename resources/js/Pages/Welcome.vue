<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
  <Head title="Welcome" />

  <div class="space-x-3 p-5">
    <Link
      v-if="$page.props.user"
      :href="route('dashboard')"
      class="bg-blue text-white font-bold p-2 shadow-lg hover:shadow-none"
    >
      Mypage
    </Link>

    <template v-else>
      <Link
        :href="route('login')"
        class="bg-blue text-white font-bold p-2 shadow-lg hover:shadow-none"
      >
        Log in
      </Link>

      <Link
        :href="route('register')"
        class="bg-blue text-white font-bold  p-2 shadow-lg hover:shadow-none"
      >
        Register
      </Link>
    </template>
  </div>
</template>