<template>
  <ToolsLayout title="Calculadora de Fechas" subtitle="Calcula días, semanas, meses y años entre dos fechas específicas.">

    <!-- Main Content -->
    <main id="tool-main" class="container mx-auto px-4 py-6">

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Calculator Form -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Calcular Diferencia de Fechas</CardTitle>
            <CardDescription>
              Selecciona dos fechas para calcular la diferencia entre ellas
            </CardDescription>
          </CardHeader>
          <CardContent class="space-y-4">
            <div class="space-y-4">
              <div>
                <Label for="startDate">Fecha inicial</Label>
                <input
                  id="startDate"
                  v-model="form.startDate"
                  type="date"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  autofocus
                  required
                />
              </div>

              <div>
                <Label for="endDate">Fecha final</Label>
                <input
                  id="endDate"
                  v-model="form.endDate"
                  type="date"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  required
                />
              </div>

              <div class="flex space-x-2">
                <Button @click="calculateDifference" class="flex-1 bg-gradient-to-r from-orange-500 to-pink-600 hover:from-orange-600 hover:to-pink-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                  Calcular Diferencia
                </Button>
                <Button @click="swapDates" variant="outline" class="px-3">
                  ↕
                </Button>
              </div>

              <div class="grid grid-cols-2 gap-2">
                <Button @click="setToday('start')" variant="outline" size="sm">Hoy (Inicio)</Button>
                <Button @click="setToday('end')" variant="outline" size="sm">Hoy (Final)</Button>
              </div>

              <div class="grid grid-cols-2 gap-2">
                <label class="flex items-center gap-2 text-sm">
                  <input type="checkbox" v-model="options.businessDaysOnly" /> Solo días hábiles
                </label>
                <label class="flex items-center gap-2 text-sm">
                  <input type="checkbox" v-model="options.excludeWeekends" /> Excluir fines de semana
                </label>
              </div>

              <div class="grid grid-cols-3 gap-2">
                <div>
                  <Label for="addDays">Sumar días</Label>
                  <input id="addDays" type="number" v-model.number="options.addDays" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm"/>
                </div>
                <div>
                  <Label for="addMonths">Sumar meses</Label>
                  <input id="addMonths" type="number" v-model.number="options.addMonths" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm"/>
                </div>
                <div>
                  <Label for="addYears">Sumar años</Label>
                  <input id="addYears" type="number" v-model.number="options.addYears" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm"/>
                </div>
              </div>
              <Button @click="applyAdditions" variant="outline" size="sm">Aplicar al final</Button>
            </div>
          </CardContent>
        </Card>

        <!-- Results -->
        <div class="space-y-6">
          <!-- Calculation Result -->
          <Card v-if="result" class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Resultado del Cálculo</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                  <div class="text-center p-4 border rounded-lg">
                    <div class="text-2xl font-bold text-primary">{{ result.totalDays }}</div>
                    <div class="text-sm text-muted-foreground">Días totales</div>
                  </div>
                  <div class="text-center p-4 border rounded-lg">
                    <div class="text-2xl font-bold text-primary">{{ result.totalWeeks }}</div>
                    <div class="text-sm text-muted-foreground">Semanas totales</div>
                  </div>
                  <div class="text-center p-4 border rounded-lg">
                    <div class="text-2xl font-bold text-primary">{{ result.totalMonths }}</div>
                    <div class="text-sm text-muted-foreground">Meses totales</div>
                  </div>
                  <div class="text-center p-4 border rounded-lg">
                    <div class="text-2xl font-bold text-primary">{{ result.totalYears }}</div>
                    <div class="text-sm text-muted-foreground">Años totales</div>
                  </div>
                  <div v-if="result.businessDays !== undefined" class="text-center p-4 border rounded-lg col-span-2">
                    <div class="text-2xl font-bold text-primary">{{ result.businessDays }}</div>
                    <div class="text-sm text-muted-foreground">Días hábiles (sin fines de semana)</div>
                  </div>
                </div>

                <div class="border rounded-lg p-4">
                  <h4 class="font-semibold mb-2">Desglose detallado:</h4>
                  <p class="text-sm">
                    {{ result.detailedBreakdown }}
                  </p>
                </div>

                <div class="border rounded-lg p-4">
                  <h4 class="font-semibold mb-2">Información adicional:</h4>
                  <ul class="text-sm space-y-1">
                    <li>• Horas totales: {{ result.totalHours.toLocaleString() }}</li>
                    <li>• Minutos totales: {{ result.totalMinutes.toLocaleString() }}</li>
                    <li>• Segundos totales: {{ result.totalSeconds.toLocaleString() }}</li>
                  </ul>
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Quick Actions -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Acciones Rápidas</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="grid grid-cols-2 gap-2">
                <Button @click="calculateAge" variant="outline" size="sm">
                  Calcular Edad
                </Button>
                <Button @click="daysUntilNewYear" variant="outline" size="sm">
                  Días hasta Año Nuevo
                </Button>
                <Button @click="daysUntilChristmas" variant="outline" size="sm">
                  Días hasta Navidad
                </Button>
                <Button @click="nextBirthday" variant="outline" size="sm">
                  Próximo Cumpleaños
                </Button>
              </div>
            </CardContent>
          </Card>

          <!-- Instructions -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>¿Cómo usar la calculadora?</CardTitle>
            </CardHeader>
            <CardContent class="space-y-3">
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">1</div>
                <p class="text-sm">Selecciona la fecha de inicio en el primer campo</p>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">2</div>
                <p class="text-sm">Selecciona la fecha final en el segundo campo</p>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">3</div>
                <p class="text-sm">Haz clic en "Calcular Diferencia" para ver el resultado</p>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- SEO Content (collapsible) -->
      <details class="mt-8 group">
        <summary class="cursor-pointer select-none text-sm text-muted-foreground hover:text-foreground">Leer más sobre cálculo de fechas</summary>
        <div class="mt-4 prose prose-gray max-w-none">
          <h2 class="text-2xl font-bold mb-4">¿Para qué sirve una calculadora de fechas?</h2>
          <p class="mb-4">Calcula diferencias exactas entre fechas para múltiples usos personales y profesionales.</p>
          <h3 class="text-xl font-semibold mb-3">Casos de uso comunes</h3>
          <ul class="list-disc pl-6 mb-4">
            <li>Edad exacta</li>
            <li>Planificación de eventos</li>
            <li>Gestión de proyectos</li>
          </ul>
        </div>
      </details>
    </main>
  </ToolsLayout>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue'
import { Link } from '@inertiajs/vue3'
import ToolsLayout from '@/layouts/tools/ToolsLayout.vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Label } from '@/components/ui/label'

// Define props
defineProps<{
  meta: {
    title: string
    description: string
    keywords: string
    url: string
  }
}>()

// Reactive data
const form = ref({
  startDate: '',
  endDate: ''
})

const result = ref<{
  totalDays: number
  totalWeeks: number
  totalMonths: number
  totalYears: number
  totalHours: number
  totalMinutes: number
  totalSeconds: number
  detailedBreakdown: string
  businessDays?: number
} | null>(null)

const options = ref({
  businessDaysOnly: false,
  excludeWeekends: false,
  addDays: 0,
  addMonths: 0,
  addYears: 0
})

// Helpers
const isActive = (path: string) => typeof window !== 'undefined' && window.location.pathname.startsWith(path)

// Methods
const calculateDifference = () => {
  if (!form.value.startDate || !form.value.endDate) {
    return
  }

  const startDate = new Date(form.value.startDate)
  const endDate = new Date(form.value.endDate)
  
  // Ensure endDate is after startDate
  if (endDate < startDate) {
    const temp = form.value.startDate
    form.value.startDate = form.value.endDate
    form.value.endDate = temp
    calculateDifference()
    return
  }

  const diffInMs = endDate.getTime() - startDate.getTime()
  
  // Calculate different units
  const totalSeconds = Math.floor(diffInMs / 1000)
  const totalMinutes = Math.floor(totalSeconds / 60)
  const totalHours = Math.floor(totalMinutes / 60)
  let totalDays = Math.floor(totalHours / 24)
  let totalWeeks = Math.floor(totalDays / 7)

  // Business days (exclude weekends) calculation
  let businessDays: number | undefined
  if (options.value.excludeWeekends || options.value.businessDaysOnly) {
    const countBusinessDays = (start: Date, end: Date): number => {
      let count = 0
      const cur = new Date(start)
      // Iterate day by day, inclusive of end date
      while (cur <= end) {
        const day = cur.getDay()
        if (day !== 0 && day !== 6) count++
        cur.setDate(cur.getDate() + 1)
      }
      return count
    }
    businessDays = countBusinessDays(startDate, endDate)
    if (options.value.businessDaysOnly) {
      totalDays = businessDays
      totalWeeks = Math.floor((businessDays || 0) / 5) // approx weeks of 5 business days
    }
  }
  
  // Calculate years and months more accurately
  let years = endDate.getFullYear() - startDate.getFullYear()
  let months = endDate.getMonth() - startDate.getMonth()
  let days = endDate.getDate() - startDate.getDate()

  if (days < 0) {
    months--
    const lastMonth = new Date(endDate.getFullYear(), endDate.getMonth(), 0)
    days += lastMonth.getDate()
  }

  if (months < 0) {
    years--
    months += 12
  }

  const totalMonths = years * 12 + months
  const totalYears = parseFloat((totalDays / 365.25).toFixed(2))

  let detailedBreakdown = ''
  if (years > 0) {
    detailedBreakdown += `${years} año${years !== 1 ? 's' : ''}`
  }
  if (months > 0) {
    if (detailedBreakdown) detailedBreakdown += ', '
    detailedBreakdown += `${months} mes${months !== 1 ? 'es' : ''}`
  }
  if (days > 0) {
    if (detailedBreakdown) detailedBreakdown += ' y '
    detailedBreakdown += `${days} día${days !== 1 ? 's' : ''}`
  }

  if (!detailedBreakdown) {
    detailedBreakdown = '0 días'
  }

  result.value = {
    totalDays,
    totalWeeks,
    totalMonths,
    totalYears,
    totalHours,
    totalMinutes,
    totalSeconds,
    detailedBreakdown,
    businessDays
  }
}

const swapDates = () => {
  const temp = form.value.startDate
  form.value.startDate = form.value.endDate
  form.value.endDate = temp
  if (form.value.startDate && form.value.endDate) {
    calculateDifference()
  }
}

const setToday = (field: 'start' | 'end') => {
  const today = new Date().toISOString().split('T')[0]
  if (field === 'start') {
    form.value.startDate = today
  } else {
    form.value.endDate = today
  }
  if (form.value.startDate && form.value.endDate) {
    calculateDifference()
  }
}

const calculateAge = () => {
  const birthDate = prompt('Ingresa tu fecha de nacimiento (YYYY-MM-DD):')
  if (birthDate) {
    form.value.startDate = birthDate
    form.value.endDate = new Date().toISOString().split('T')[0]
    calculateDifference()
  }
}

const daysUntilNewYear = () => {
  const today = new Date()
  const nextYear = today.getFullYear() + 1
  const newYear = new Date(nextYear, 0, 1)
  
  form.value.startDate = today.toISOString().split('T')[0]
  form.value.endDate = newYear.toISOString().split('T')[0]
  calculateDifference()
}

const daysUntilChristmas = () => {
  const today = new Date()
  let christmas = new Date(today.getFullYear(), 11, 25)
  
  // If Christmas has passed this year, calculate for next year
  if (christmas < today) {
    christmas = new Date(today.getFullYear() + 1, 11, 25)
  }
  
  form.value.startDate = today.toISOString().split('T')[0]
  form.value.endDate = christmas.toISOString().split('T')[0]
  calculateDifference()
}

const nextBirthday = () => {
  const birthDate = prompt('Ingresa tu fecha de nacimiento (YYYY-MM-DD):')
  if (birthDate) {
    const today = new Date()
    const birth = new Date(birthDate)
    let nextBirthday = new Date(today.getFullYear(), birth.getMonth(), birth.getDate())
    
    // If birthday has passed this year, calculate for next year
    if (nextBirthday < today) {
      nextBirthday = new Date(today.getFullYear() + 1, birth.getMonth(), birth.getDate())
    }
    
    form.value.startDate = today.toISOString().split('T')[0]
    form.value.endDate = nextBirthday.toISOString().split('T')[0]
    calculateDifference()
  }
}

// Auto-calculate when both dates are present
watch(form, () => {
  if (form.value.startDate && form.value.endDate) {
    calculateDifference()
  }
}, { deep: true })
// React to options changes as well
watch(options, () => {
  if (form.value.startDate && form.value.endDate) {
    calculateDifference()
  }
}, { deep: true })

const applyAdditions = () => {
  if (!form.value.endDate) return
  const end = new Date(form.value.endDate)
  if (options.value.addYears) end.setFullYear(end.getFullYear() + options.value.addYears)
  if (options.value.addMonths) end.setMonth(end.getMonth() + options.value.addMonths)
  if (options.value.addDays) end.setDate(end.getDate() + options.value.addDays)
  form.value.endDate = end.toISOString().split('T')[0]
  calculateDifference()
}
</script>
