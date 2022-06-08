<script setup lang="ts">
import { Head, Link } from '@inertiajs/inertia-vue3';
import route from 'ziggy-js';

const dashboardUrl = route('memo.index');
const loginUrl = route('login');
const registerUrl = route('register');
</script>

<template>
  <Head title="Welcome" />

  <div class="space-x-20 mt-52 text-center">
    <Link
      v-if="$page.props.user"
      :href="dashboardUrl"
      class="bg-blue text-white font-bold p-2 shadow-lg hover:shadow-none"
    >
      Mypage
    </Link>

    <template v-else>
      <Link
        :href="loginUrl"
        class="bg-blue text-white font-bold py-3 px-6 shadow-lg hover:shadow-none"
      >
        Log in
      </Link>

      <Link
        :href="registerUrl"
        class="bg-blue text-white font-bold py-3 px-6 shadow-lg hover:shadow-none"
      >
        Register
      </Link>
    </template>
  </div>
</template>