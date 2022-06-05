<script setup lang="ts">
import { PropType } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import route from 'ziggy-js';
import { Memos } from '../types/Memos'

const props = defineProps({
  memo: {
    type: Object as PropType<Memos>,
    default: () => {},
  },
})

const updateMemo = useForm({
  id: props.memo.id,
  title: props.memo.title,
  status: props.memo.status,
  detail: props.memo.detail,
  limit: props.memo.limit,
})

const onUpdateClick = () => {
  updateMemo.post(route('memo.update', [updateMemo.id]))
}

const onClickBack = () => {
  Inertia.get(route('memo.index'))
}

const onClickDestroy = () => {
  Inertia.post(route('memo.destroy', [updateMemo.id]))
}
</script>

<template>
  <div
    class="border border-blue p-10 my-20
      w-2/5 min-w-80 mx-auto shadow-lg"
  >
    <div class="space-y-5">
      <div class="text-center">
        <input
          type="text"
          v-model.trim="updateMemo.title"
          class="border border-blue text-blue text-center
            font-bold text-2xl py-1 px-2"
          placeholder="write me ..."
          maxlength="20"
          name="title"
          id="title"
        >
        <p class="font-bold text-red-500 text-sm">
          {{ updateMemo.errors.title }}
        </p>
      </div>
      <div class="grid grid-cols-3">
        <label for="status" class="text-blue text-xl font-bold col-span-1">
          status
        </label>
        <select
          class="border border-blue text-blue
            font-bold col-span-2 py-1 px-2"
          v-model.trim="updateMemo.status"
          name="status"
          id="status"
        >
          <option value="incomplete">Incomplete</option>
          <option value="working">Working</option>
          <option value="complete">Complete</option>
        </select>
      </div>
      <div class="grid grid-cols-3">
        <label
          for="detail"
          class="text-blue text-xl font-bold col-span-1"
        >
          detail
        </label>
        <textarea
          class="border border-blue text-blue
            font-bold col-span-2 py-1 px-2"
          v-model.trim="updateMemo.detail"
          placeholder="write me ..."
          maxlength="100"
          name="detail" id="detail"
        ></textarea>
        <p class="col-start-2 col-span-2 font-bold text-red-500 text-sm">
          {{ updateMemo.errors.detail }}
        </p>
      </div>
      <div class="grid grid-cols-3">
        <label for="limit" class="text-blue text-xl font-bold col-span-1">
          limit
        </label>
        <input
          type="date"
          v-model.trim="updateMemo.limit"
          class="border border-blue col-span-2 text-blue
            text-sm font-bold py-1 px-2"
          :min="new Date().toISOString().split('T')[0]"
        >
        <p class="col-start-2 col-span-2 font-bold text-red-500 text-sm">
          {{ updateMemo.errors.limit }}
        </p>
      </div>
      <div class="text-center">
        <button
          @click.prevent="onUpdateClick"
          class="select-none bg-blue shadow-lg text-white font-bold
            py-1 px-5 mt-5 hover:shadow-none hover:opacity-90"
          :class="[updateMemo.recentlySuccessful ? 'mb-2' : 'mb-12']"
        >
          Edit
        </button>
        <p
          v-if="updateMemo.recentlySuccessful"
          class="font-bold mb-5 text-green-600 text-lg"
        >
          Edit successful!
        </p>
      </div>
    </div>

    <div class="grid grid-cols-2 justify-items-center">
      <button
        @click.prevent="onClickBack"
        class="select-none border border-blue shadow-lg text-blue text-xs
          font-bold py-1 px-3 hover:shadow-none hover:opacity-90"
      >
        ← Back
      </button>
      <button
        @click.prevent="onClickDestroy"
        class="select-none border border-blue shadow-lg text-blue text-xs
          font-bold py-1 px-3 hover:shadow-none hover:opacity-90"
      >
        Delete
      </button>
    </div>
  </div>
</template>