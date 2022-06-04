<script setup lang="ts">
import { PropType } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import route from 'ziggy-js'
import { Inertia } from '@inertiajs/inertia'
import { Memos } from '../types/Memos'

defineProps({
  memos: {
    type: Array as PropType<Memos[]>,
    default: () => [],
  },
})

const addMemo = useForm({
  id: undefined,
  title: '',
  detail: '',
  limit: '',
})

const onAddClick = () => {
  addMemo.post(route('memo.create'), { preserveState: false })
}

const onEditClick = (index: number) => {
  Inertia.get(route('memo.edit', [index]))
}
</script>

<template>
  <div
    class="border border-blue py-5 px-10 my-10
      w-2/5 min-w-80 mx-auto shadow-lg"
  >
    <h1 class="text-blue text-2xl font-bold text-center mt-5 mb-10">
      New Memo
    </h1>

    <div class="space-y-5">
      <div class="grid grid-cols-3">
        <label for="title" class="text-blue text-xl font-bold col-span-1">
          title
        </label>
        <input
          type="text"
          v-model.trim="addMemo.title"
          class="border border-blue text-blue
            font-bold col-span-2 py-1 px-2"
          placeholder="write me ..."
          maxlength="20"
          name="title"
          id="title"
        >
        <p class="col-start-2 col-span-2 font-bold text-red-500 text-sm">
          {{ addMemo.errors.title }}
        </p>
      </div>

      <div class="grid grid-cols-3">
        <label for="detail" class="text-blue text-xl font-bold col-span-1">
          detail
        </label>
        <textarea
          v-model.trim="addMemo.detail"
          class="border border-blue text-blue
            font-bold col-span-2 py-1 px-2"
          placeholder="write me ..."
          maxlength="100"
          name="detail"
          id="detail"
        ></textarea>
        <p class="col-start-2 col-span-2 font-bold text-red-500 text-sm">
          {{ addMemo.errors.detail }}
        </p>
      </div>

      <div class="grid grid-cols-3">
        <label for="limit" class="text-blue text-xl font-bold col-span-1">
          limit
        </label>
        <input
          type="date"
          name="limit"
          v-model="addMemo.limit"
          class="border border-blue col-span-2 text-blue
            text-sm font-bold py-1 px-2"
          :min="new Date().toISOString().split('T')[0]"
        >
        <p class="col-start-2 col-span-2 font-bold text-red-500 text-sm">
          {{ addMemo.errors.limit }}
        </p>
      </div>

      <div class="text-center pt-5 pb-2">
        <button
          @click="onAddClick"
          class="bg-blue shadow-lg hover:shadow-none
            text-white font-bold py-1 px-5"
        >
          Add
        </button>
      </div>
    </div>
  </div>

  <div class="w-2/5 flex justify-between mx-auto">
    <div class="flex gap-5">
      <p class="text-blue text-xl font-bold">
        sort
      </p>
      <button
        @click=""
        class="text-blue text-xl font-bold border
          border-blue px-3 shadow-lg hover:shadow-none">
        ↓↑
      </button>
    </div>

    <div class="flex gap-5">
      <p class="text-blue text-xl font-bold">
        filter
      </p>
      <select
        class="border border-blue text-blue
          font-bold col-span-2 py-1 px-2"
      >
        <option value="all">All</option>
        <option value="incomplete">Incomplete</option>
        <option value="working">Working</option>
        <option value="complete">Complete</option>
      </select>
    </div>
  </div>

  <ul class="space-y-5 my-16">
    <li
      v-for="(memo, index) in memos"
      :key="memo.id"
    >
      <div
        class="flex justify-between items-center mx-auto border
          border-blue shadow-lg py-2 px-3 w-2/5"
      >
        <span class="text-blue font-bold text-lg">
          {{ memo.title }}
        </span>
        <button
          @click="onEditClick(index)"
          class="bg-blue shadow-lg hover:shadow-none
            text-white font-bold py-1 px-4"
        >
          →
        </button>
      </div>
    </li>
  </ul>
</template>
