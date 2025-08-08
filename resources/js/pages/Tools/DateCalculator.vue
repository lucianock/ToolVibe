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
                                <p class="text-xs text-muted-foreground -mt-1">Calculadora Fechas</p>
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
                        <Link href="/tools/bmi" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Calculadora IMC
                        </Link>
                        <Link href="/tools/password-generator" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Generador de Contraseñas
                        </Link>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Tools Subnav -->
        <nav class="border-b bg-background/80 backdrop-blur supports-[backdrop-filter]:bg-background/60">
          <div class="container mx-auto px-4">
            <div class="flex items-center gap-2 overflow-x-auto py-3">
              <Link href="/tools/qr" class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap" :class="isActive('/tools/qr') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow' : 'bg-muted text-foreground hover:bg-muted/80'">Generador QR</Link>
              <Link href="/tools/bmi" class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap" :class="isActive('/tools/bmi') ? 'bg-gradient-to-r from-green-500 to-blue-600 text-white shadow' : 'bg-muted text-foreground hover:bg-muted/80'">Calculadora IMC</Link>
              <Link href="/tools/date-calculator" class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap" :class="isActive('/tools/date-calculator') ? 'bg-gradient-to-r from-orange-500 to-pink-600 text-white shadow' : 'bg-muted text-foreground hover:bg-muted/80'">Calculadora de Fechas</Link>
              <Link href="/tools/password-generator" class="px-4 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap" :class="isActive('/tools/password-generator') ? 'bg-gradient-to-r from-purple-500 to-red-600 text-white shadow' : 'bg-muted text-foreground hover:bg-muted/80'">Generador de Contraseñas</Link>
            </div>
          </div>
        </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-pink-50 to-purple-50 dark:from-gray-900 dark:via-purple-900/20 dark:to-pink-900/20">
      <div class="absolute inset-0 bg-grid-black/[0.02] -z-10"></div>
      <div class="relative py-14">
        <div class="container mx-auto px-4">
          <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center rounded-full px-3 py-1 text-sm bg-gradient-to-r from-orange-100 to-pink-100 text-orange-800 dark:from-orange-900/50 dark:to-pink-900/50 dark:text-orange-300 mb-6 border border-orange-200/50">
              Calculadora de Fechas
            </div>
            <h1 class="text-4xl lg:text-5xl font-bold mb-4 leading-tight">
              <span class="bg-gradient-to-r from-orange-600 via-pink-600 to-purple-600 bg-clip-text text-transparent">Diferencia entre Fechas</span>
              <br />con desglose completo
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
              Calcula días, semanas, meses y años entre dos fechas específicas.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
      <!-- SEO Content -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4">Calculadora de Días Entre Fechas</h1>
        <p class="text-lg text-muted-foreground mb-6">
          Calcula la diferencia exacta entre dos fechas. Obtén resultados en días, semanas, meses y años. 
          Perfecto para calcular edad, tiempo transcurrido o planificar eventos.
        </p>
      </div>

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

              <div class="flex space-x-2">
                <Button @click="setToday('start')" variant="outline" size="sm" class="flex-1">
                  Hoy (Inicio)
                </Button>
                <Button @click="setToday('end')" variant="outline" size="sm" class="flex-1">
                  Hoy (Final)
                </Button>
              </div>
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

      <!-- SEO Content -->
      <div class="mt-12 prose prose-gray max-w-none">
        <h2 class="text-2xl font-bold mb-4">¿Para qué sirve una calculadora de fechas?</h2>
        <p class="mb-4">
          Una calculadora de fechas es una herramienta muy útil que te permite calcular la diferencia 
          exacta entre dos fechas específicas. Es perfecta para una gran variedad de situaciones 
          tanto personales como profesionales.
        </p>
        
        <h3 class="text-xl font-semibold mb-3">Casos de uso comunes</h3>
        <ul class="list-disc pl-6 mb-4">
          <li><strong>Calcular edad exacta:</strong> Conoce tu edad en años, meses y días</li>
          <li><strong>Planificación de eventos:</strong> Tiempo restante hasta una fecha importante</li>
          <li><strong>Gestión de proyectos:</strong> Duración de proyectos o tareas</li>
          <li><strong>Recursos humanos:</strong> Tiempo de servicio, vacaciones, licencias</li>
          <li><strong>Finanzas:</strong> Períodos de inversión, plazos de pago</li>
          <li><strong>Salud:</strong> Seguimiento de tratamientos o embarazo</li>
        </ul>

        <h3 class="text-xl font-semibold mb-3">Ventajas de nuestra calculadora</h3>
        <ul class="list-disc pl-6 mb-4">
          <li>Resultados instantáneos y precisos</li>
          <li>Múltiples unidades de tiempo: días, semanas, meses, años</li>
          <li>Desglose detallado de la diferencia</li>
          <li>Funciones rápidas para cálculos comunes</li>
          <li>Interfaz intuitiva y fácil de usar</li>
        </ul>

        <h3 class="text-xl font-semibold mb-3">Consejos para usar la calculadora</h3>
        <ul class="list-disc pl-6 mb-4">
          <li>Asegúrate de seleccionar las fechas en el orden correcto</li>
          <li>Usa el botón de intercambio si necesitas invertir las fechas</li>
          <li>Aprovecha las acciones rápidas para cálculos frecuentes</li>
          <li>El resultado incluye información adicional como horas y minutos</li>
        </ul>
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
import { ref } from 'vue'
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
} | null>(null)

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
  const totalDays = Math.floor(totalHours / 24)
  const totalWeeks = Math.floor(totalDays / 7)
  
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
    detailedBreakdown
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
</script>
