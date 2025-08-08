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
                                <p class="text-xs text-muted-foreground -mt-1">Generador QR</p>
                            </div>
                        </div>
                    </Link>
                    <nav class="hidden md:flex items-center space-x-6">
                        <Link href="/" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Inicio
                        </Link>
                        <Link href="/tools/bmi" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Calculadora IMC
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

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-blue-900/20 dark:to-purple-900/20">
      <div class="absolute inset-0 bg-grid-black/[0.02] -z-10"></div>
      <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>

      <div class="relative py-14">
        <div class="container mx-auto px-4">
          <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center rounded-full px-3 py-1 text-sm bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 dark:from-blue-900/50 dark:to-purple-900/50 dark:text-blue-300 mb-6 border border-blue-200/50">
              Generador de Códigos QR
            </div>
            <h1 class="text-4xl lg:text-5xl font-bold mb-4 leading-tight">
              <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">Crea Códigos QR</span>
              <br />en segundos y en alta calidad
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
              Convierte URLs, textos, WiFi y más en códigos QR listos para descargar en PNG.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
      <!-- SEO Content -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4">Generador de Códigos QR Online Gratis</h1>
        <p class="text-lg text-muted-foreground mb-6">
          Crea códigos QR de forma rápida y gratuita. Perfecto para URLs, texto, contactos, WiFi y más. 
          Descarga en formato PNG de alta calidad para usar en tus proyectos.
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Generator Form -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Crear Código QR</CardTitle>
            <CardDescription>
              Ingresa el texto o URL que deseas convertir en código QR
            </CardDescription>
          </CardHeader>
          <CardContent class="space-y-4">
            <form @submit.prevent="generateQR" class="space-y-4">
              <div>
                <Label for="text">Texto o URL</Label>
                <textarea
                  id="text"
                  v-model="form.text"
                  placeholder="Ingresa una URL, texto, número de teléfono, email..."
                  class="min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  required
                />
                <div v-if="errors.text" class="text-sm text-destructive mt-1">
                  {{ errors.text }}
                </div>
              </div>

              <div>
                <Label for="size">Tamaño (píxeles)</Label>
                <select
                  id="size"
                  v-model="form.size"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
                  <option value="200">200x200</option>
                  <option value="300">300x300</option>
                  <option value="400">400x400</option>
                  <option value="500">500x500</option>
                  <option value="600">600x600</option>
                </select>
              </div>

              <Button type="submit" :disabled="loading" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                <span v-if="loading">Generando...</span>
                <span v-else>Generar y Descargar QR</span>
              </Button>
            </form>
          </CardContent>
        </Card>

        <!-- Preview and Information -->
        <div class="space-y-6">
          <!-- QR Preview -->
          <Card v-if="previewUrl" class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Vista Previa</CardTitle>
            </CardHeader>
            <CardContent class="flex justify-center">
              <img :src="previewUrl" alt="Código QR generado" class="border rounded-lg">
            </CardContent>
          </Card>

          <!-- Instructions -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>¿Cómo usar el generador de QR?</CardTitle>
            </CardHeader>
            <CardContent class="space-y-3">
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">1</div>
                <p class="text-sm">Ingresa el texto, URL, número de teléfono o email que deseas codificar</p>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">2</div>
                <p class="text-sm">Selecciona el tamaño deseado para tu código QR</p>
              </div>
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center flex-shrink-0 mt-0.5">3</div>
                <p class="text-sm">Haz clic en "Generar y Descargar QR" para obtener tu imagen PNG</p>
              </div>
            </CardContent>
          </Card>

          <!-- Examples -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Ejemplos de uso</CardTitle>
            </CardHeader>
            <CardContent>
              <ul class="space-y-2 text-sm">
                <li><strong>URL:</strong> https://www.ejemplo.com</li>
                <li><strong>Teléfono:</strong> tel:+1234567890</li>
                <li><strong>Email:</strong> mailto:contacto@ejemplo.com</li>
                <li><strong>WiFi:</strong> WIFI:T:WPA;S:NombreRed;P:contraseña;;</li>
                <li><strong>Texto:</strong> Cualquier texto que desees</li>
              </ul>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- SEO Content -->
      <div class="mt-12 prose prose-gray max-w-none">
        <h2 class="text-2xl font-bold mb-4">¿Qué es un código QR y para qué sirve?</h2>
        <p class="mb-4">
          Un código QR (Quick Response) es un tipo de código de barras bidimensional que puede almacenar 
          una gran cantidad de información. Fueron creados en Japón por Denso Wave en 1994 y se han vuelto 
          extremadamente populares debido a su capacidad de ser escaneados rápidamente por dispositivos móviles.
        </p>
        
        <h3 class="text-xl font-semibold mb-3">Ventajas de usar códigos QR</h3>
        <ul class="list-disc pl-6 mb-4">
          <li>Acceso rápido a información sin necesidad de escribir URLs largas</li>
          <li>Pueden almacenar diferentes tipos de datos: URLs, texto, contactos, WiFi, etc.</li>
          <li>Fáciles de escanear con cualquier smartphone</li>
          <li>Perfectos para marketing, menús digitales, pagos móviles</li>
          <li>Se pueden imprimir en cualquier material</li>
        </ul>

        <h3 class="text-xl font-semibold mb-3">Casos de uso comunes</h3>
        <ul class="list-disc pl-6 mb-4">
          <li><strong>Restaurantes:</strong> Menús digitales sin contacto</li>
          <li><strong>Eventos:</strong> Tickets y entradas digitales</li>
          <li><strong>Marketing:</strong> Campañas publicitarias y promociones</li>
          <li><strong>Educación:</strong> Acceso rápido a recursos educativos</li>
          <li><strong>Redes sociales:</strong> Compartir perfiles y contenido</li>
        </ul>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 text-white mt-16">
      <div class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-4 gap-8">
          <div class="md:col-span-2">
            <div class="flex items-center space-x-2 mb-4">
              <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">ToolVibe</h3>
            </div>
            <p class="text-gray-300 leading-relaxed mb-6">La suite de herramientas online más completa y gratuita. Potencia tu productividad con nuestras utilidades profesionales.</p>
          </div>
          <div>
            <h4 class="text-lg font-semibold mb-4">Herramientas</h4>
            <ul class="space-y-2">
              <li><Link href="/tools/qr" class="text-gray-300 hover:text-white transition-colors">Generador QR</Link></li>
              <li><Link href="/tools/bmi" class="text-gray-300 hover:text-white transition-colors">Calculadora IMC</Link></li>
              <li><Link href="/tools/date-calculator" class="text-gray-300 hover:text-white transition-colors">Calculadora Fechas</Link></li>
              <li><Link href="/tools/password-generator" class="text-gray-300 hover:text-white transition-colors">Generador Contraseñas</Link></li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-semibold mb-4">Enlaces</h4>
            <ul class="space-y-2">
              <li><a href="/" class="text-gray-300 hover:text-white transition-colors">Inicio</a></li>
              <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Características</a></li>
              <li><a href="/sitemap.xml" class="text-gray-300 hover:text-white transition-colors">Sitemap</a></li>
            </ul>
          </div>
        </div>
        <div class="border-top border-white/10 mt-8 pt-8 text-center">
          <p class="text-gray-300">&copy; 2024 <span class="font-semibold">ToolVibe</span>. Todos los derechos reservados.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
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
  text: '',
  size: 300
})

const loading = ref(false)
const errors = ref<{text?: string}>({})
const previewUrl = ref('')

// Methods
const generateQR = async () => {
  if (!form.value.text.trim()) {
    errors.value.text = 'Por favor ingresa un texto o URL'
    return
  }

  errors.value = {}
  loading.value = true

  try {
    const response = await fetch('/tools/qr/generate', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      },
      body: JSON.stringify({
        text: form.value.text,
        size: form.value.size
      })
    })

    if (response.ok) {
      const blob = await response.blob()
      const url = URL.createObjectURL(blob)
      
      // Set preview
      previewUrl.value = url

      // Download the file
      const a = document.createElement('a')
      a.href = url
      a.download = 'qr-code.png'
      document.body.appendChild(a)
      a.click()
      document.body.removeChild(a)
    } else {
      const errorData = await response.json()
      errors.value = errorData.errors || { text: 'Error al generar el código QR' }
    }
  } catch (error) {
    errors.value.text = 'Error de conexión. Inténtalo de nuevo.'
  } finally {
    loading.value = false
  }
}
</script>
