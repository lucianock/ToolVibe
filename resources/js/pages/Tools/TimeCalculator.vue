<template>
  <ToolsLayout title="Calculadora de Tiempo" subtitle="Calcula duraciones, fechas futuras, diferencias de tiempo y convierte unidades temporales fácilmente.">

    <!-- Main Content -->
    <main id="tool-main" class="container mx-auto px-4 py-6">

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Calculator Form -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Calculadora de Tiempo</CardTitle>
            <CardDescription>
              Selecciona el tipo de cálculo que necesitas
            </CardDescription>
          </CardHeader>
          <CardContent class="space-y-4">
            <div class="space-y-4">
              <!-- Calculation Type -->
              <div>
                <Label for="calcType">Tipo de Cálculo</Label>
                <select
                  id="calcType"
                  v-model="calcType"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
                  <option value="duration">Calcular Duración</option>
                  <option value="add-time">Agregar Tiempo</option>
                  <option value="subtract-time">Restar Tiempo</option>
                  <option value="date-difference">Diferencia entre Fechas</option>
                  <option value="time-until">Tiempo Hasta</option>
                  <option value="time-since">Tiempo Desde</option>
                  <option value="convert-units">Convertir Unidades</option>
                </select>
              </div>

              <!-- Dynamic Form Fields -->
              <div v-if="calcType === 'duration'" class="space-y-3">
                <div>
                  <Label for="startDateTime">Fecha y Hora de Inicio</Label>
                  <input
                    id="startDateTime"
                    v-model="values.startDateTime"
                    type="datetime-local"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
                <div>
                  <Label for="endDateTime">Fecha y Hora de Fin</Label>
                  <input
                    id="endDateTime"
                    v-model="values.endDateTime"
                    type="datetime-local"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
              </div>

              <div v-if="calcType === 'add-time'" class="space-y-3">
                <div>
                  <Label for="baseDateTime">Fecha y Hora Base</Label>
                  <input
                    id="baseDateTime"
                    v-model="values.baseDateTime"
                    type="datetime-local"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <div>
                    <Label for="addYears">Años</Label>
                    <input
                      id="addYears"
                      v-model.number="values.addYears"
                      type="number"
                      min="0"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                  <div>
                    <Label for="addMonths">Meses</Label>
                    <input
                      id="addMonths"
                      v-model.number="values.addMonths"
                      type="number"
                      min="0"
                      max="11"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                  <div>
                    <Label for="addDays">Días</Label>
                    <input
                      id="addDays"
                      v-model.number="values.addDays"
                      type="number"
                      min="0"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                  <div>
                    <Label for="addHours">Horas</Label>
                    <input
                      id="addHours"
                      v-model.number="values.addHours"
                      type="number"
                      min="0"
                      max="23"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                </div>
              </div>

              <div v-if="calcType === 'subtract-time'" class="space-y-3">
                <div>
                  <Label for="subtractBaseDateTime">Fecha y Hora Base</Label>
                  <input
                    id="subtractBaseDateTime"
                    v-model="values.subtractBaseDateTime"
                    type="datetime-local"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <div>
                    <Label for="subtractYears">Años</Label>
                    <input
                      id="subtractYears"
                      v-model.number="values.subtractYears"
                      type="number"
                      min="0"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                  <div>
                    <Label for="subtractMonths">Meses</Label>
                    <input
                      id="subtractMonths"
                      v-model.number="values.subtractMonths"
                      type="number"
                      min="0"
                      max="11"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                  <div>
                    <Label for="subtractDays">Días</Label>
                    <input
                      id="subtractDays"
                      v-model.number="values.subtractDays"
                      type="number"
                      min="0"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                  <div>
                    <Label for="subtractHours">Horas</Label>
                    <input
                      id="subtractHours"
                      v-model.number="values.subtractHours"
                      type="number"
                      min="0"
                      max="23"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                      placeholder="0"
                    />
                  </div>
                </div>
              </div>

              <div v-if="calcType === 'date-difference'" class="space-y-3">
                <div>
                  <Label for="diffStartDate">Fecha de Inicio</Label>
                  <input
                    id="diffStartDate"
                    v-model="values.diffStartDate"
                    type="date"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
                <div>
                  <Label for="diffEndDate">Fecha de Fin</Label>
                  <input
                    id="diffEndDate"
                    v-model="values.diffEndDate"
                    type="date"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
              </div>

              <div v-if="calcType === 'time-until'" class="space-y-3">
                <div>
                  <Label for="targetDateTime">Fecha y Hora Objetivo</Label>
                  <input
                    id="targetDateTime"
                    v-model="values.targetDateTime"
                    type="datetime-local"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
              </div>

              <div v-if="calcType === 'time-since'" class="space-y-3">
                <div>
                  <Label for="pastDateTime">Fecha y Hora Pasada</Label>
                  <input
                    id="pastDateTime"
                    v-model="values.pastDateTime"
                    type="datetime-local"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
              </div>

              <div v-if="calcType === 'convert-units'" class="space-y-3">
                <div>
                  <Label for="convertValue">Valor a Convertir</Label>
                  <input
                    id="convertValue"
                    v-model.number="values.convertValue"
                    type="number"
                    step="0.01"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                    placeholder="Ingresa un valor"
                  />
                </div>
                <div class="grid grid-cols-2 gap-2">
                  <div>
                    <Label for="fromUnit">Desde</Label>
                    <select
                      id="fromUnit"
                      v-model="values.fromUnit"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                    >
                      <option value="seconds">Segundos</option>
                      <option value="minutes">Minutos</option>
                      <option value="hours">Horas</option>
                      <option value="days">Días</option>
                      <option value="weeks">Semanas</option>
                      <option value="months">Meses</option>
                      <option value="years">Años</option>
                    </select>
                  </div>
                  <div>
                    <Label for="toUnit">Hacia</Label>
                    <select
                      id="toUnit"
                      v-model="values.toUnit"
                      class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                    >
                      <option value="seconds">Segundos</option>
                      <option value="minutes">Minutos</option>
                      <option value="hours">Horas</option>
                      <option value="days">Días</option>
                      <option value="weeks">Semanas</option>
                      <option value="months">Meses</option>
                      <option value="years">Años</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Calculate Button -->
              <Button @click="calculate" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                ⏰ Calcular
              </Button>
            </div>
          </CardContent>
        </Card>

        <!-- Results -->
        <div class="space-y-6">
          <!-- Calculation Result -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Resultado</CardTitle>
            </CardHeader>
            <CardContent>
              <div v-if="result" class="space-y-4">
                <div class="text-center">
                  <div class="text-3xl font-bold text-primary mb-2">
                    {{ result.mainResult }}
                  </div>
                  <div class="text-sm text-muted-foreground">
                    {{ result.description }}
                  </div>
                </div>

                <!-- Detailed Breakdown -->
                <div v-if="result.breakdown" class="space-y-2 text-sm">
                  <div v-for="(item, key) in result.breakdown" :key="key" class="flex justify-between">
                    <span>{{ item.label }}:</span>
                    <span class="font-medium">{{ item.value }}</span>
                  </div>
                </div>

                <!-- Copy Result -->
                <Button @click="copyResult" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                  📋 Copiar Resultado
                </Button>
              </div>
              <div v-else class="text-center text-muted-foreground py-8">
                Completa los campos y haz clic en "Calcular"
              </div>
            </CardContent>
          </Card>

          <!-- Quick Calculations -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Cálculos Rápidos</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="grid grid-cols-2 gap-2">
                <Button @click="setQuickCalc('add-time', { baseDateTime: getCurrentDateTime(), addDays: 7 })" variant="outline" size="sm">
                  +7 días
                </Button>
                <Button @click="setQuickCalc('add-time', { baseDateTime: getCurrentDateTime(), addHours: 24 })" variant="outline" size="sm">
                  +24 horas
                </Button>
                <Button @click="setQuickCalc('add-time', { baseDateTime: getCurrentDateTime(), addMonths: 1 })" variant="outline" size="sm">
                  +1 mes
                </Button>
                <Button @click="setQuickCalc('add-time', { baseDateTime: getCurrentDateTime(), addYears: 1 })" variant="outline" size="sm">
                  +1 año
                </Button>
              </div>
            </CardContent>
          </Card>

          <!-- Time Zones -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Zonas Horarias</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-3">
                <div class="grid grid-cols-2 gap-2 text-sm">
                  <div>
                    <div class="font-medium">UTC</div>
                    <div class="font-mono">{{ getCurrentUTC() }}</div>
                  </div>
                  <div>
                    <div class="font-medium">Local</div>
                    <div class="font-mono">{{ getCurrentLocal() }}</div>
                  </div>
                </div>
                <div class="text-xs text-muted-foreground">
                  <p>💡 <strong>UTC:</strong> Tiempo Universal Coordinado</p>
                  <p>💡 <strong>Local:</strong> Tu zona horaria actual</p>
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Calculation History -->
          <Card v-if="calculationHistory.length" class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Historial de Cálculos</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-2 max-h-40 overflow-y-auto">
                <div 
                  v-for="(calc, index) in calculationHistory.slice(0, 5)" 
                  :key="index"
                  class="flex justify-between items-center p-2 bg-muted rounded text-sm"
                >
                  <span>{{ calc.description }}</span>
                  <Button @click="repeatCalculation(calc)" variant="ghost" size="sm" class="h-6 w-6 p-0">
                    🔄
                  </Button>
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Tips -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Consejos Útiles</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="text-sm space-y-2">
                <p v-if="calcType === 'duration'">
                  💡 <strong>Duración:</strong> Calcula el tiempo entre dos momentos
                </p>
                <p v-if="calcType === 'add-time'">
                  💡 <strong>Agregar:</strong> Suma tiempo a una fecha base
                </p>
                <p v-if="calcType === 'subtract-time'">
                  💡 <strong>Restar:</strong> Resta tiempo de una fecha base
                </p>
                <p v-if="calcType === 'date-difference'">
                  💡 <strong>Diferencia:</strong> Calcula días entre fechas
                </p>
                <p v-if="calcType === 'convert-units'">
                  💡 <strong>Conversión:</strong> Cambia entre unidades de tiempo
                </p>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- SEO Content (collapsible) -->
      <details class="mt-8 group">
        <summary class="cursor-pointer select-none text-sm text-muted-foreground hover:text-foreground">Información sobre cálculos de tiempo</summary>
        <div class="mt-4 prose prose-gray max-w-none">
          <h2 class="text-2xl font-bold mb-4">¿Por qué usar una calculadora de tiempo?</h2>
          <p class="mb-4">Calcula duraciones, fechas futuras y diferencias de tiempo de forma rápida y precisa.</p>
          <h3 class="text-xl font-semibold mb-3">Tipos de cálculos disponibles</h3>
          <ul class="list-disc pl-6 mb-4">
            <li><strong>Duración:</strong> Calcula el tiempo entre dos fechas y horas</li>
            <li><strong>Agregar Tiempo:</strong> Suma años, meses, días o horas a una fecha</li>
            <li><strong>Restar Tiempo:</strong> Resta años, meses, días o horas de una fecha</li>
            <li><strong>Diferencia entre Fechas:</strong> Calcula días entre dos fechas</li>
            <li><strong>Tiempo Hasta:</strong> Calcula cuánto falta para una fecha objetivo</li>
            <li><strong>Tiempo Desde:</strong> Calcula cuánto ha pasado desde una fecha</li>
            <li><strong>Convertir Unidades:</strong> Cambia entre diferentes unidades de tiempo</li>
          </ul>
        </div>
      </details>
    </main>
  </ToolsLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
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
const calcType = ref('duration')
const values = ref({
  startDateTime: '',
  endDateTime: '',
  baseDateTime: '',
  addYears: 0,
  addMonths: 0,
  addDays: 0,
  addHours: 0,
  subtractBaseDateTime: '',
  subtractYears: 0,
  subtractMonths: 0,
  subtractDays: 0,
  subtractHours: 0,
  diffStartDate: '',
  diffEndDate: '',
  targetDateTime: '',
  pastDateTime: '',
  convertValue: 1,
  fromUnit: 'days',
  toUnit: 'hours'
})

const result = ref<any>(null)
const calculationHistory = ref<Array<{
  type: string
  description: string
  values: any
  result: any
}>>([])

// Utility functions
const getCurrentDateTime = (): string => {
  const now = new Date()
  const year = now.getFullYear()
  const month = String(now.getMonth() + 1).padStart(2, '0')
  const day = String(now.getDate()).padStart(2, '0')
  const hours = String(now.getHours()).padStart(2, '0')
  const minutes = String(now.getMinutes()).padStart(2, '0')
  return `${year}-${month}-${day}T${hours}:${minutes}`
}

const getCurrentDate = (): string => {
  const now = new Date()
  const year = now.getFullYear()
  const month = String(now.getMonth() + 1).padStart(2, '0')
  const day = String(now.getDate()).padStart(2, '0')
  return `${year}-${month}-${day}`
}

const getCurrentUTC = (): string => {
  return new Date().toISOString()
}

const getCurrentLocal = (): string => {
  return new Date().toLocaleString()
}

const formatDuration = (milliseconds: number): string => {
  const seconds = Math.floor(milliseconds / 1000)
  const minutes = Math.floor(seconds / 60)
  const hours = Math.floor(minutes / 60)
  const days = Math.floor(hours / 24)
  const weeks = Math.floor(days / 7)
  const months = Math.floor(days / 30.44)
  const years = Math.floor(days / 365.25)

  if (years > 0) {
    return `${years} año${years !== 1 ? 's' : ''}, ${months % 12} mes${months % 12 !== 1 ? 'es' : ''}`
  } else if (months > 0) {
    return `${months} mes${months !== 1 ? 'es' : ''}, ${days % 30} día${days % 30 !== 1 ? 's' : ''}`
  } else if (weeks > 0) {
    return `${weeks} semana${weeks !== 1 ? 's' : ''}, ${days % 7} día${days % 7 !== 1 ? 's' : ''}`
  } else if (days > 0) {
    return `${days} día${days !== 1 ? 's' : ''}, ${hours % 24} hora${hours % 24 !== 1 ? 's' : ''}`
  } else if (hours > 0) {
    return `${hours} hora${hours !== 1 ? 's' : ''}, ${minutes % 60} minuto${minutes % 60 !== 1 ? 's' : ''}`
  } else if (minutes > 0) {
    return `${minutes} minuto${minutes !== 1 ? 's' : ''}, ${seconds % 60} segundo${seconds % 60 !== 1 ? 's' : ''}`
  } else {
    return `${seconds} segundo${seconds !== 1 ? 's' : ''}`
  }
}

const formatDurationDetailed = (milliseconds: number) => {
  const seconds = Math.floor(milliseconds / 1000)
  const minutes = Math.floor(seconds / 60)
  const hours = Math.floor(minutes / 60)
  const days = Math.floor(hours / 24)
  const weeks = Math.floor(days / 7)
  const months = Math.floor(days / 30.44)
  const years = Math.floor(days / 365.25)

  return {
    years: Math.floor(years),
    months: Math.floor(months % 12),
    weeks: Math.floor(weeks % 4.35),
    days: Math.floor(days % 7),
    hours: Math.floor(hours % 24),
    minutes: Math.floor(minutes % 60),
    seconds: Math.floor(seconds % 60)
  }
}

const convertTimeUnits = (value: number, fromUnit: string, toUnit: string): number => {
  // Convert to seconds first
  let seconds = 0
  
  switch (fromUnit) {
    case 'seconds': seconds = value; break
    case 'minutes': seconds = value * 60; break
    case 'hours': seconds = value * 3600; break
    case 'days': seconds = value * 86400; break
    case 'weeks': seconds = value * 604800; break
    case 'months': seconds = value * 2592000; break
    case 'years': seconds = value * 31536000; break
  }
  
  // Convert from seconds to target unit
  switch (toUnit) {
    case 'seconds': return seconds
    case 'minutes': return seconds / 60
    case 'hours': return seconds / 3600
    case 'days': return seconds / 86400
    case 'weeks': return seconds / 604800
    case 'months': return seconds / 2592000
    case 'years': return seconds / 31536000
    default: return seconds
  }
}

// Methods
const calculate = () => {
  let calculationResult = null

  switch (calcType.value) {
    case 'duration':
      if (values.value.startDateTime && values.value.endDateTime) {
        const start = new Date(values.value.startDateTime)
        const end = new Date(values.value.endDateTime)
        const duration = end.getTime() - start.getTime()
        
        if (duration < 0) {
          calculationResult = {
            mainResult: 'Fecha de inicio posterior a fecha de fin',
            description: 'La fecha de inicio debe ser anterior a la fecha de fin',
            breakdown: null
          }
        } else {
          const detailed = formatDurationDetailed(duration)
          calculationResult = {
            mainResult: formatDuration(duration),
            description: `Duración entre ${start.toLocaleString()} y ${end.toLocaleString()}`,
            breakdown: {
              years: { label: 'Años', value: detailed.years },
              months: { label: 'Meses', value: detailed.months },
              weeks: { label: 'Semanas', value: detailed.weeks },
              days: { label: 'Días', value: detailed.days },
              hours: { label: 'Horas', value: detailed.hours },
              minutes: { label: 'Minutos', value: detailed.minutes },
              seconds: { label: 'Segundos', value: detailed.seconds }
            }
          }
        }
      }
      break

    case 'add-time':
      if (values.value.baseDateTime) {
        const baseDate = new Date(values.value.baseDateTime)
        const resultDate = new Date(baseDate)
        
        resultDate.setFullYear(resultDate.getFullYear() + values.value.addYears)
        resultDate.setMonth(resultDate.getMonth() + values.value.addMonths)
        resultDate.setDate(resultDate.getDate() + values.value.addDays)
        resultDate.setHours(resultDate.getHours() + values.value.addHours)
        
        calculationResult = {
          mainResult: resultDate.toLocaleString(),
          description: `Fecha resultante al agregar tiempo`,
          breakdown: {
            base: { label: 'Fecha base', value: baseDate.toLocaleString() },
            years: { label: 'Años agregados', value: values.value.addYears },
            months: { label: 'Meses agregados', value: values.value.addMonths },
            days: { label: 'Días agregados', value: values.value.addDays },
            hours: { label: 'Horas agregadas', value: values.value.addHours },
            result: { label: 'Fecha resultante', value: resultDate.toLocaleString() }
          }
        }
      }
      break

    case 'subtract-time':
      if (values.value.subtractBaseDateTime) {
        const baseDate = new Date(values.value.subtractBaseDateTime)
        const resultDate = new Date(baseDate)
        
        resultDate.setFullYear(resultDate.getFullYear() - values.value.subtractYears)
        resultDate.setMonth(resultDate.getMonth() - values.value.subtractMonths)
        resultDate.setDate(resultDate.getDate() - values.value.subtractDays)
        resultDate.setHours(resultDate.getHours() - values.value.subtractHours)
        
        calculationResult = {
          mainResult: resultDate.toLocaleString(),
          description: `Fecha resultante al restar tiempo`,
          breakdown: {
            base: { label: 'Fecha base', value: baseDate.toLocaleString() },
            years: { label: 'Años restados', value: values.value.subtractYears },
            months: { label: 'Meses restados', value: values.value.subtractMonths },
            days: { label: 'Días restados', value: values.value.subtractDays },
            hours: { label: 'Horas restadas', value: values.value.subtractHours },
            result: { label: 'Fecha resultante', value: resultDate.toLocaleString() }
          }
        }
      }
      break

    case 'date-difference':
      if (values.value.diffStartDate && values.value.diffEndDate) {
        const start = new Date(values.value.diffStartDate)
        const end = new Date(values.value.diffEndDate)
        const diffTime = Math.abs(end.getTime() - start.getTime())
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))
        
        calculationResult = {
          mainResult: `${diffDays} día${diffDays !== 1 ? 's' : ''}`,
          description: `Diferencia entre ${start.toLocaleDateString()} y ${end.toLocaleDateString()}`,
          breakdown: {
            start: { label: 'Fecha inicio', value: start.toLocaleDateString() },
            end: { label: 'Fecha fin', value: end.toLocaleDateString() },
            days: { label: 'Días de diferencia', value: diffDays }
          }
        }
      }
      break

    case 'time-until':
      if (values.value.targetDateTime) {
        const target = new Date(values.value.targetDateTime)
        const now = new Date()
        const timeUntil = target.getTime() - now.getTime()
        
        if (timeUntil < 0) {
          calculationResult = {
            mainResult: 'La fecha objetivo ya pasó',
            description: 'La fecha objetivo es anterior a la fecha actual',
            breakdown: null
          }
        } else {
          const detailed = formatDurationDetailed(timeUntil)
          calculationResult = {
            mainResult: formatDuration(timeUntil),
            description: `Tiempo hasta ${target.toLocaleString()}`,
            breakdown: {
              years: { label: 'Años', value: detailed.years },
              months: { label: 'Meses', value: detailed.months },
              weeks: { label: 'Semanas', value: detailed.weeks },
              days: { label: 'Días', value: detailed.days },
              hours: { label: 'Horas', value: detailed.hours },
              minutes: { label: 'Minutos', value: detailed.minutes }
            }
          }
        }
      }
      break

    case 'time-since':
      if (values.value.pastDateTime) {
        const past = new Date(values.value.pastDateTime)
        const now = new Date()
        const timeSince = now.getTime() - past.getTime()
        
        if (timeSince < 0) {
          calculationResult = {
            mainResult: 'La fecha está en el futuro',
            description: 'La fecha pasada es posterior a la fecha actual',
            breakdown: null
          }
        } else {
          const detailed = formatDurationDetailed(timeSince)
          calculationResult = {
            mainResult: formatDuration(timeSince),
            description: `Tiempo transcurrido desde ${past.toLocaleString()}`,
            breakdown: {
              years: { label: 'Años', value: detailed.years },
              months: { label: 'Meses', value: detailed.months },
              weeks: { label: 'Semanas', value: detailed.weeks },
              days: { label: 'Días', value: detailed.days },
              hours: { label: 'Horas', value: detailed.hours },
              minutes: { label: 'Minutos', value: detailed.minutes }
            }
          }
        }
      }
      break

    case 'convert-units':
      if (values.value.convertValue !== null && values.value.fromUnit && values.value.toUnit) {
        const convertedValue = convertTimeUnits(values.value.convertValue, values.value.fromUnit, values.value.toUnit)
        calculationResult = {
          mainResult: `${convertedValue.toFixed(2)} ${values.value.toUnit}`,
          description: `Conversión de ${values.value.convertValue} ${values.value.fromUnit}`,
          breakdown: {
            original: { label: 'Valor original', value: `${values.value.convertValue} ${values.value.fromUnit}` },
            converted: { label: 'Valor convertido', value: `${convertedValue.toFixed(2)} ${values.value.toUnit}` }
          }
        }
      }
      break
  }

  if (calculationResult) {
    result.value = calculationResult
    
    // Add to history
    calculationHistory.value.unshift({
      type: calcType.value,
      description: calculationResult.description,
      values: { ...values.value },
      result: calculationResult
    })

    // Keep only last 10 calculations
    if (calculationHistory.value.length > 10) {
      calculationHistory.value = calculationHistory.value.slice(0, 10)
    }
  }
}

const setQuickCalc = (type: string, quickValues: any) => {
  calcType.value = type
  Object.assign(values.value, quickValues)
  calculate()
}

const repeatCalculation = (calc: any) => {
  calcType.value = calc.type
  Object.assign(values.value, calc.values)
  calculate()
}

const copyResult = async () => {
  if (!result.value) return

  const text = `${result.value.description}\n${result.value.mainResult}${result.value.breakdown ? '\n' + Object.entries(result.value.breakdown).map(([key, item]: [string, any]) => `${item.label}: ${item.value}`).join('\n') : ''}`
  
  try {
    await navigator.clipboard.writeText(text)
  } catch (err) {
    const textArea = document.createElement('textarea')
    textArea.value = text
    document.body.appendChild(textArea)
    textArea.select()
    document.execCommand('copy')
    document.body.removeChild(textArea)
  }
}

// Initialize with current date/time
values.value.startDateTime = getCurrentDateTime()
values.value.endDateTime = getCurrentDateTime()
values.value.baseDateTime = getCurrentDateTime()
values.value.subtractBaseDateTime = getCurrentDateTime()
values.value.diffStartDate = getCurrentDate()
values.value.diffEndDate = getCurrentDate()
values.value.targetDateTime = getCurrentDateTime()
values.value.pastDateTime = getCurrentDateTime()
</script>
