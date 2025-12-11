<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
      <h1 class="text-3xl font-bold text-slate-900 mb-6 text-center">
        Vue 3 Počítadlo
      </h1>
      
      <div class="bg-slate-50 rounded-xl p-8 mb-6">
        <p class="text-sm text-slate-600 mb-2 text-center">Aktuálna hodnota</p>
        <p class="text-6xl font-bold text-slate-900 text-center">
          {{ count }}
        </p>
      </div>

      <div class="flex gap-3 mb-6">
        <button
          @click="decrement"
          class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
        >
          - Znížiť
        </button>
        <button
          @click="increment"
          class="flex-1 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
        >
          + Zvýšiť
        </button>
      </div>

      <button
        @click="reset"
        class="w-full bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-3 px-6 rounded-lg transition-colors"
      >
        Resetovať
      </button>

      <div class="mt-6 p-4 bg-blue-50 rounded-lg">
        <p class="text-sm text-blue-800">
          <span class="font-semibold">Celkové kliknutia:</span> {{ totalClicks }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const count = ref(0)
const totalClicks = ref(0)

const increment = () => {
  count.value++
  totalClicks.value++
}

const decrement = () => {
  count.value--
  totalClicks.value++
}

const reset = () => {
  count.value = 0
}
</script>
