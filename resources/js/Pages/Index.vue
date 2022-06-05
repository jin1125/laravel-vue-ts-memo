<script setup lang="ts">
import { PropType, ref, Ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import route from 'ziggy-js'
import { Inertia } from '@inertiajs/inertia'
import { Memos } from '../types/Memos'

const props = defineProps({
  memos: {
    type: Array as PropType<Memos[]>,
    default: () => [],
  },

  successDestroy: {
    type: String,
    default: '',
  },
})

let sortStatus: Ref<boolean> = ref(true);
let filterStatus: Ref<string> = ref('all');

const addMemo = useForm({
  title: '',
  status: 'incomplete',
  detail: '',
  limit: '',
})

const onAddClick = () => {
  addMemo.post(route('memo.create'), {
    onSuccess: () => addMemo.reset()
  })
}

const onEditClick = (index: number) => {
  Inertia.get(route('memo.edit', [index]))
}

const onSortClick = () => {
  sortStatus.value = !sortStatus.value

  if(sortStatus.value) {
    return props.memos.sort((a, b) => b.id -  a.id)
  }

  if(!sortStatus.value) {
    return props.memos.sort((a, b) => a.id - b.id)
  }
}
</script>

<template>
  <div
    class="border border-blue px-10 my-10
      w-2/5 min-w-80 mx-auto shadow-lg"
  >
    <h1 class="text-blue text-3xl font-bold text-center my-10">
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

      <div class="text-center">
        <button
          @click.prevent="onAddClick"
          class="select-none bg-blue shadow-lg text-white font-bold
            py-1 px-5 mt-6 hover:shadow-none hover:opacity-90"
          :class="[addMemo.recentlySuccessful || successDestroy ? 'mb-4' : 'mb-16']"
        >
          Add
        </button>
        <p
          v-if="addMemo.recentlySuccessful"
          class="font-bold mb-5 text-green-600 text-lg"
        >
          Add successful!
        </p>
        <p
          v-if="successDestroy"
          class="font-bold mb-5 text-green-600 text-lg"
        >
          {{ successDestroy }}
        </p>
      </div>
    </div>
  </div>

  <div class="w-2/5 flex justify-between mx-auto">
    <div class="flex gap-5">
      <p class="text-blue text-xl font-bold">
        sort
      </p>
      <button
        @click.prevent="onSortClick"
        class="select-none text-blue text-xl font-bold border border-blue
          px-3 shadow-lg hover:shadow-none hover:opacity-90">
        ↓↑
      </button>
    </div>

    <div class="flex gap-5">
      <p class="text-blue text-xl font-bold">
        filter
      </p>
      <select
        class="select-none border border-blue text-blue
          font-bold col-span-2 py-1 cursor-pointer hover:opacity-90"
        v-model="filterStatus"
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
      v-for="(memo) in memos"
      :key="memo.id"
    >
      <div
        v-if="filterStatus === 'all' ||
          memo.status === filterStatus"
        class="flex justify-between items-center mx-auto border
          border-blue shadow-lg py-2 px-3 w-2/5"
      >
        <span class="text-blue font-bold text-lg">
          {{ memo.title }}
        </span>

        <button
          @click.prevent="onEditClick(memo.id)"
          class="select-none bg-blue shadow-lg text-white font-bold
            py-1 px-4 hover:shadow-none hover:opacity-90"
        >
          →
        </button>
      </div>
    </li>
  </ul>
</template>
