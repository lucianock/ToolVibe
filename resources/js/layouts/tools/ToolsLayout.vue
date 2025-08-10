<template>
  <div class="min-h-screen bg-background" :data-compact="compact ? 'true' : 'false'">
    <header class="w-full border-b bg-background">
      <div class="container mx-auto flex items-center justify-between" :class="compact ? 'px-3 py-2' : 'px-4 py-3 md:py-4'">
        <Link href="/" class="flex items-center gap-2">
          <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500 rounded-lg flex items-center justify-center shadow">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <div>
            <div class="text-base md:text-lg font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
              ToolVibe
            </div>
            <p v-if="title" class="text-[10px] md:text-xs text-muted-foreground -mt-1">{{ title }}</p>
          </div>
        </Link>
      
        <div class="md:hidden flex items-center gap-2">
          <button @click="toggleCompact" class="text-xs px-2 py-1 rounded border">
            {{ compact ? 'Compacto' : 'Normal' }}
          </button>
        </div>
      </div>
      <div class="border-t">
        <div class="container mx-auto px-4">
          <div class="flex items-center gap-2 overflow-x-auto" :class="compact ? 'py-1' : 'py-2'">
            <Link href="/tools/qr" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/qr') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'bg-gradient-to-r from-blue-400 to-purple-500 text-white hover:from-blue-500 hover:to-purple-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #60a5fa, #a855f7); color: white;">
              Generador QR
            </Link>
            <Link href="/tools/bmi" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/bmi') ? 'bg-gradient-to-r from-green-500 to-blue-600 text-white shadow-lg' : 'bg-gradient-to-r from-green-400 to-blue-500 text-white hover:from-green-500 hover:to-blue-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #4ade80, #3b82f6); color: white;">
              Calculadora IMC
            </Link>
            <Link href="/tools/date-calculator" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/date-calculator') ? 'bg-gradient-to-r from-orange-500 to-pink-600 text-white shadow-lg' : 'bg-gradient-to-r from-orange-400 to-pink-500 text-white hover:from-orange-500 hover:to-pink-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #fb923c, #ec4899); color: white;">
              Calculadora de Fechas
            </Link>
            <Link href="/tools/password-generator" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/password-generator') ? 'bg-gradient-to-r from-purple-500 to-red-600 text-white shadow-lg' : 'bg-gradient-to-r from-purple-400 to-red-500 text-white hover:from-purple-500 hover:to-red-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #a855f7, #ef4444); color: white;">
              Generador de Contraseñas
            </Link>
            <Link href="/tools/unit-converter" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/unit-converter') ? 'bg-gradient-to-r from-teal-500 to-blue-600 text-white shadow-lg' : 'bg-gradient-to-r from-teal-400 to-blue-500 text-white hover:from-teal-500 hover:to-blue-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #14b8a6, #3b82f6); color: white;">
              Convertidor de Unidades
            </Link>
            <Link href="/tools/percentage-calculator" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/percentage-calculator') ? 'bg-gradient-to-r from-emerald-500 to-cyan-600 text-white shadow-lg' : 'bg-gradient-to-r from-emerald-400 to-cyan-500 text-white hover:from-emerald-500 hover:to-cyan-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #10b981, #0891b2); color: white;">
              Calculadora de Porcentajes
            </Link>
            <Link href="/tools/color-generator" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/color-generator') ? 'bg-gradient-to-r from-pink-500 to-indigo-600 text-white shadow-lg' : 'bg-gradient-to-r from-pink-400 to-indigo-500 text-white hover:from-pink-500 hover:to-indigo-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #ec4899, #4f46e5); color: white;">
              Generador de Colores
            </Link>
            <Link href="/tools/time-calculator" :class="[compact ? 'px-2 py-1 text-[11px]' : 'px-3 py-1.5 text-xs md:text-sm', isActive('/tools/time-calculator') ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-lg' : 'bg-gradient-to-r from-amber-400 to-orange-500 text-white hover:from-amber-500 hover:to-orange-600 shadow-md hover:shadow-lg transition-all duration-300']" class="rounded-full font-medium whitespace-nowrap" style="background: linear-gradient(to right, #f59e0b, #ea580c); color: white;">
              Calculadora de Tiempo
            </Link>
          </div>
        </div>
      </div>
      <div v-if="subtitle || title" class="container mx-auto px-4" :class="compact ? 'py-3' : 'py-4 md:py-6'">
        <h1 v-if="title" class="text-xl md:text-2xl font-bold leading-tight">
          <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">{{ title }}</span>
        </h1>
        <p v-if="subtitle" class="text-xs md:text-sm text-muted-foreground mt-1">{{ subtitle }}</p>
      </div>
    </header>

    <a href="#tool-main" class="sr-only focus:not-sr-only fixed top-2 left-2 z-50 bg-primary text-primary-foreground px-3 py-1 rounded">
      Saltar a la herramienta
    </a>

    <main id="tool-main" class="container mx-auto px-4" :class="compact ? 'py-4' : 'py-6 md:py-8'">
      <slot />
    </main>

    <footer class="border-t mt-8">
      <div class="container mx-auto px-4 py-6">
        <div class="text-center text-muted-foreground text-xs">© 2025 ToolVibe</div>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

defineProps<{ title?: string; subtitle?: string }>()

const isActive = (path: string) => typeof window !== 'undefined' && window.location.pathname.startsWith(path)

const compact = ref(false)
const toggleCompact = () => {
  compact.value = !compact.value
  try { localStorage.setItem('tools-compact', compact.value ? '1' : '0') } catch {}
}
onMounted(() => {
  try {
    const saved = localStorage.getItem('tools-compact')
    if (saved !== null) {
      compact.value = saved === '1'
    } else {
      compact.value = window.matchMedia('(max-width: 640px)').matches
    }
  } catch {}
})
</script>


