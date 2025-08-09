<template>
  <ToolsLayout title="Calculadora de IMC" subtitle="Calcula tu Índice de Masa Corporal y conoce tu categoría de salud.">

    <!-- Main Content -->
    <main id="tool-main" class="container mx-auto px-4 py-6">

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Calculator Form -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Calcular IMC</CardTitle>
            <CardDescription>
              Ingresa tu peso y altura para obtener tu Índice de Masa Corporal
            </CardDescription>
          </CardHeader>
          <CardContent class="space-y-4">
            <form @submit.prevent="calculateBMI" class="space-y-4">
              <div>
                <Label for="weight">Peso</Label>
                <div class="flex space-x-2">
                  <input
                    id="weight"
                    v-model.number="form.weight"
                    type="number"
                    step="0.1"
                    min="1"
                    max="1000"
                    placeholder="70"
                    class="flex-1 rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                    autofocus
                    required
                  />
                  <select
                    v-model="form.weightUnit"
                    class="rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  >
                    <option value="kg">kg</option>
                    <option value="lb">lb</option>
                  </select>
                </div>
              </div>

              <div>
                <Label for="height">Altura</Label>
                <div class="flex space-x-2">
                  <input
                    id="height"
                    v-model.number="form.height"
                    type="number"
                    step="0.1"
                    min="1"
                    max="300"
                    placeholder="175"
                    class="flex-1 rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                    required
                  />
                  <select
                    v-model="form.heightUnit"
                    class="rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  >
                    <option value="cm">cm</option>
                    <option value="ft">ft</option>
                  </select>
                </div>
                <div v-if="form.heightUnit === 'ft'" class="mt-2">
                  <Label for="inches">Pulgadas adicionales</Label>
                  <input
                    id="inches"
                    v-model.number="form.inches"
                    type="number"
                    min="0"
                    max="11"
                    placeholder="0"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  />
                </div>
              </div>

              <div class="grid grid-cols-3 gap-2">
                <div>
                  <Label for="age">Edad</Label>
                  <input id="age" v-model.number="form.age" type="number" min="10" max="100" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm" />
                </div>
                <div>
                  <Label for="sex">Sexo</Label>
                  <select id="sex" v-model="form.sex" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                    <option value="male">Hombre</option>
                    <option value="female">Mujer</option>
                  </select>
                </div>
                <div>
                  <Label for="activity">Actividad</Label>
                  <select id="activity" v-model.number="form.activity" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                    <option :value="1.2">Sedentario</option>
                    <option :value="1.375">Ligero</option>
                    <option :value="1.55">Moderado</option>
                    <option :value="1.725">Intenso</option>
                    <option :value="1.9">Muy intenso</option>
                  </select>
                </div>
              </div>

              <div>
                <Label>Rellenar ejemplo</Label>
                <div class="grid grid-cols-2 gap-2 mt-2">
                  <Button type="button" variant="outline" size="sm" @click="applyPreset('male')">Hombre (80kg, 175cm, 30a, moderado)</Button>
                  <Button type="button" variant="outline" size="sm" @click="applyPreset('female')">Mujer (60kg, 165cm, 28a, ligero)</Button>
                  <Button type="button" variant="outline" size="sm" @click="applyPreset('athlete')">Atleta (85kg, 180cm, 25a, intenso)</Button>
                  <Button type="button" variant="outline" size="sm" @click="applyPreset('senior')">Senior (70kg, 170cm, 65a, sedent.)</Button>
                </div>
              </div>

              <Button type="submit" class="w-full bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                Calcular IMC
              </Button>
            </form>
          </CardContent>
        </Card>

        <!-- Results -->
        <div class="space-y-6">
          <!-- BMI Result -->
          <Card v-if="result" class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Tu Resultado</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="text-center space-y-4">
                <div class="text-4xl font-bold" :class="result.colorClass">
                  {{ result.bmi }}
                </div>
                <div class="text-lg font-medium" :class="result.colorClass">
                  {{ result.category }}
                </div>
                <p class="text-sm text-muted-foreground">
                  {{ result.description }}
                </p>
                <div class="grid grid-cols-2 gap-3 mt-4 text-left">
                  <div class="p-3 rounded border">
                    <div class="text-xs text-muted-foreground">Peso saludable (IMC 18.5 - 24.9)</div>
                    <div class="text-sm font-medium">{{ healthyWeightRange }}</div>
                  </div>
                  <div class="p-3 rounded border" v-if="bmrTdee">
                    <div class="text-xs text-muted-foreground">BMR / TDEE</div>
                    <div class="text-sm font-medium">{{ bmrTdee.bmr }} kcal / {{ bmrTdee.tdee }} kcal</div>
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- BMI Categories -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Categorías del IMC</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-3">
                <div class="flex justify-between items-center p-2 rounded" :class="{ 'bg-blue-50 dark:bg-blue-900/20': result?.category === 'Bajo peso' }">
                  <span class="text-sm font-medium">Bajo peso</span>
                  <span class="text-sm text-muted-foreground">&lt; 18.5</span>
                </div>
                <div class="flex justify-between items-center p-2 rounded" :class="{ 'bg-green-50 dark:bg-green-900/20': result?.category === 'Peso normal' }">
                  <span class="text-sm font-medium">Peso normal</span>
                  <span class="text-sm text-muted-foreground">18.5 - 24.9</span>
                </div>
                <div class="flex justify-between items-center p-2 rounded" :class="{ 'bg-yellow-50 dark:bg-yellow-900/20': result?.category === 'Sobrepeso' }">
                  <span class="text-sm font-medium">Sobrepeso</span>
                  <span class="text-sm text-muted-foreground">25.0 - 29.9</span>
                </div>
                <div class="flex justify-between items-center p-2 rounded" :class="{ 'bg-red-50 dark:bg-red-900/20': result?.category === 'Obesidad' }">
                  <span class="text-sm font-medium">Obesidad</span>
                  <span class="text-sm text-muted-foreground">&ge; 30.0</span>
                </div>
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
                <p class="text-sm">Ingresa tu peso actual y selecciona la unidad (kg o lb)</p>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">2</div>
                <p class="text-sm">Ingresa tu altura y selecciona la unidad (cm o ft)</p>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">3</div>
                <p class="text-sm">Haz clic en "Calcular IMC" para ver tu resultado</p>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- SEO Content (collapsible) -->
      <details class="mt-8 group">
        <summary class="cursor-pointer select-none text-sm text-muted-foreground hover:text-foreground">Leer más sobre el IMC</summary>
        <div class="mt-4 prose prose-gray max-w-none">
          <h2 class="text-2xl font-bold mb-4">¿Qué es el Índice de Masa Corporal (IMC)?</h2>
          <p class="mb-4">
            El IMC relaciona el peso y la altura para estimar si un peso es saludable. Úsalo solo como referencia.
          </p>
          <h3 class="text-xl font-semibold mb-3">¿Cómo se calcula el IMC?</h3>
          <p class="mb-4">IMC = peso (kg) / altura (m)². Ej.: 70kg / 1.75² = 22.86</p>
          <h3 class="text-xl font-semibold mb-3">Limitaciones</h3>
          <ul class="list-disc pl-6 mb-4">
            <li>No distingue músculo vs. grasa</li>
            <li>Puede no ser preciso en atletas</li>
            <li>No considera distribución de grasa</li>
          </ul>
          <p class="mb-4 text-sm">Consulta siempre con un profesional para evaluación completa.</p>
        </div>
      </details>
    </main>
  </ToolsLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
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
  weight: null as number | null,
  height: null as number | null,
  inches: 0,
  weightUnit: 'kg',
  heightUnit: 'cm',
  age: 30,
  sex: 'male',
  activity: 1.55
})

const result = ref<{
  bmi: string
  category: string
  description: string
  colorClass: string
} | null>(null)

const healthyWeightRange = computed(() => {
  if (!form.value.height) return ''
  let heightMeters = form.value.heightUnit === 'cm' ? (form.value.height / 100) : (form.value.heightUnit === 'ft' ? (((form.value.height * 12) + (form.value.inches || 0)) * 0.0254) : form.value.height)
  const min = 18.5 * heightMeters * heightMeters
  const max = 24.9 * heightMeters * heightMeters
  // Return in current weight unit
  if (form.value.weightUnit === 'lb') {
    return `${(min * 2.20462).toFixed(1)} - ${(max * 2.20462).toFixed(1)} lb`
  }
  return `${min.toFixed(1)} - ${max.toFixed(1)} kg`
})

const bmrTdee = computed(() => {
  if (!form.value.weight || !form.value.height || !form.value.age) return null
  // Convert to metric for calculation
  const weightKg = form.value.weightUnit === 'lb' ? form.value.weight * 0.453592 : form.value.weight
  const heightCm = form.value.heightUnit === 'cm' ? form.value.height : (form.value.heightUnit === 'ft' ? (((form.value.height * 12) + (form.value.inches || 0)) * 2.54) : form.value.height * 100)
  // Mifflin-St Jeor
  const s = form.value.sex === 'male' ? 5 : -161
  const bmr = Math.round((10 * weightKg) + (6.25 * heightCm) - (5 * form.value.age) + s)
  const tdee = Math.round(bmr * (form.value.activity || 1.2))
  return { bmr, tdee }
})

const applyPreset = (preset: 'male' | 'female' | 'athlete' | 'senior') => {
  // Ensure metric units for presets
  form.value.weightUnit = 'kg'
  form.value.heightUnit = 'cm'
  form.value.inches = 0

  switch (preset) {
    case 'male':
      form.value.sex = 'male'
      form.value.weight = 80
      form.value.height = 175
      form.value.age = 30
      form.value.activity = 1.55
      break
    case 'female':
      form.value.sex = 'female'
      form.value.weight = 60
      form.value.height = 165
      form.value.age = 28
      form.value.activity = 1.375
      break
    case 'athlete':
      form.value.sex = 'male'
      form.value.weight = 85
      form.value.height = 180
      form.value.age = 25
      form.value.activity = 1.725
      break
    case 'senior':
      form.value.sex = 'male'
      form.value.weight = 70
      form.value.height = 170
      form.value.age = 65
      form.value.activity = 1.2
      break
  }
  calculateBMI()
}
// Helpers
const isActive = (path: string) => typeof window !== 'undefined' && window.location.pathname.startsWith(path)

// Methods
const calculateBMI = () => {
  if (!form.value.weight || !form.value.height) {
    return
  }

  // Convert weight to kg
  let weightInKg = form.value.weight
  if (form.value.weightUnit === 'lb') {
    weightInKg = form.value.weight * 0.453592
  }

  // Convert height to meters
  let heightInM = form.value.height
  if (form.value.heightUnit === 'cm') {
    heightInM = form.value.height / 100
  } else if (form.value.heightUnit === 'ft') {
    const totalInches = (form.value.height * 12) + (form.value.inches || 0)
    heightInM = totalInches * 0.0254
  }

  // Calculate BMI
  const bmi = weightInKg / (heightInM * heightInM)
  
  // Determine category
  let category = ''
  let description = ''
  let colorClass = ''

  if (bmi < 18.5) {
    category = 'Bajo peso'
    description = 'Tu IMC indica que tienes bajo peso. Considera consultar con un profesional de la salud.'
    colorClass = 'text-blue-600 dark:text-blue-400'
  } else if (bmi >= 18.5 && bmi < 25) {
    category = 'Peso normal'
    description = '¡Excelente! Tu IMC indica que tienes un peso saludable.'
    colorClass = 'text-green-600 dark:text-green-400'
  } else if (bmi >= 25 && bmi < 30) {
    category = 'Sobrepeso'
    description = 'Tu IMC indica sobrepeso. Considera adoptar hábitos más saludables.'
    colorClass = 'text-yellow-600 dark:text-yellow-400'
  } else {
    category = 'Obesidad'
    description = 'Tu IMC indica obesidad. Te recomendamos consultar con un profesional de la salud.'
    colorClass = 'text-red-600 dark:text-red-400'
  }

  result.value = {
    bmi: bmi.toFixed(1),
    category,
    description,
    colorClass
  }
}
</script>
