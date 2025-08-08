<template>
  <div class="min-h-screen bg-background">
            <!-- Header -->
        <header class="sticky top-0 z-50 w-full border-b bg-background/80 backdrop-blur-md supports-[backdrop-filter]:bg-background/60">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <Link href="/" class="flex items-center space-x-3">
                        <!-- Logo mejorado -->
                        <div class="flex items-center space-x-2">
                            <div class="relative">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500 rounded-lg flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                                    ToolVibe
                                </h1>
                                <p class="text-xs text-muted-foreground -mt-1">Calculadora IMC</p>
                            </div>
                        </div>
                    </Link>
                    <nav class="hidden md:flex items-center space-x-6">
                        <Link href="/" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Inicio
                        </Link>
                        <Link href="/tools/qr" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Generador QR
                        </Link>
                        <Link href="/tools/date-calculator" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Calculadora de Fechas
                        </Link>
                        <Link href="/tools/password-generator" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Generador de Contraseñas
                        </Link>
                    </nav>
                </div>
            </div>
        </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
      <!-- SEO Content -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4">Calculadora de IMC - Índice de Masa Corporal</h1>
        <p class="text-lg text-muted-foreground mb-6">
          Calcula tu Índice de Masa Corporal (IMC) de forma rápida y gratuita. Descubre si tu peso 
          es saludable según los estándares médicos internacionales.
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Calculator Form -->
        <Card>
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

              <Button type="submit" class="w-full">
                Calcular IMC
              </Button>
            </form>
          </CardContent>
        </Card>

        <!-- Results -->
        <div class="space-y-6">
          <!-- BMI Result -->
          <Card v-if="result">
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
              </div>
            </CardContent>
          </Card>

          <!-- BMI Categories -->
          <Card>
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
          <Card>
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

      <!-- SEO Content -->
      <div class="mt-12 prose prose-gray max-w-none">
        <h2 class="text-2xl font-bold mb-4">¿Qué es el Índice de Masa Corporal (IMC)?</h2>
        <p class="mb-4">
          El Índice de Masa Corporal (IMC) es una medida que relaciona el peso y la altura de una persona 
          para determinar si tiene un peso saludable. Es una herramienta útil para evaluar el riesgo de 
          problemas de salud relacionados con el peso.
        </p>
        
        <h3 class="text-xl font-semibold mb-3">¿Cómo se calcula el IMC?</h3>
        <p class="mb-4">
          La fórmula del IMC es: <strong>IMC = peso (kg) / altura (m)²</strong>
        </p>
        <p class="mb-4">
          Por ejemplo, si pesas 70 kg y mides 1.75 m, tu IMC sería: 70 / (1.75)² = 22.86
        </p>

        <h3 class="text-xl font-semibold mb-3">Limitaciones del IMC</h3>
        <ul class="list-disc pl-6 mb-4">
          <li>No distingue entre masa muscular y grasa corporal</li>
          <li>Puede no ser preciso para atletas con mucha masa muscular</li>
          <li>No considera la distribución de la grasa corporal</li>
          <li>Los rangos pueden variar según la edad y etnia</li>
        </ul>

        <h3 class="text-xl font-semibold mb-3">Recomendaciones importantes</h3>
        <p class="mb-4">
          El IMC es solo una herramienta de referencia. Para una evaluación completa de tu salud, 
          siempre consulta con un profesional médico que pueda considerar otros factores como tu 
          historia clínica, composición corporal y estilo de vida.
        </p>
      </div>
    </main>

    <!-- Footer -->
    <footer class="border-t mt-16">
      <div class="container mx-auto px-4 py-8">
        <div class="text-center text-muted-foreground">
          <p>&copy; 2024 ToolVibe. Herramientas online gratuitas para todos.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
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
  heightUnit: 'cm'
})

const result = ref<{
  bmi: string
  category: string
  description: string
  colorClass: string
} | null>(null)

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
