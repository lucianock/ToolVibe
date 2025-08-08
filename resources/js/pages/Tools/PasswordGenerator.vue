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
                                <p class="text-xs text-muted-foreground -mt-1">Generador Contraseñas</p>
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
                        <Link href="/tools/date-calculator" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                            Calculadora de Fechas
                        </Link>
                    </nav>
                </div>
            </div>
        </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
      <!-- SEO Content -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4">Generador de Contraseñas Seguras Online</h1>
        <p class="text-lg text-muted-foreground mb-6">
          Crea contraseñas seguras y aleatorias con nuestro generador gratuito. Personaliza longitud, 
          caracteres especiales y opciones avanzadas para máxima seguridad.
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Generator Form -->
        <Card>
          <CardHeader>
            <CardTitle>Configurar Contraseña</CardTitle>
            <CardDescription>
              Personaliza las opciones para generar una contraseña segura
            </CardDescription>
          </CardHeader>
          <CardContent class="space-y-4">
            <div class="space-y-4">
              <div>
                <Label for="length">Longitud: {{ options.length }} caracteres</Label>
                <input
                  id="length"
                  v-model="options.length"
                  type="range"
                  min="4"
                  max="128"
                  class="w-full"
                />
                <div class="flex justify-between text-xs text-muted-foreground">
                  <span>4</span>
                  <span>128</span>
                </div>
              </div>

              <div class="space-y-3">
                <Label>Tipos de caracteres</Label>
                <div class="space-y-2">
                  <label class="flex items-center space-x-2">
                    <input
                      v-model="options.includeUppercase"
                      type="checkbox"
                      class="rounded border-gray-300"
                    />
                    <span class="text-sm">Mayúsculas (A-Z)</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input
                      v-model="options.includeLowercase"
                      type="checkbox"
                      class="rounded border-gray-300"
                    />
                    <span class="text-sm">Minúsculas (a-z)</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input
                      v-model="options.includeNumbers"
                      type="checkbox"
                      class="rounded border-gray-300"
                    />
                    <span class="text-sm">Números (0-9)</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input
                      v-model="options.includeSymbols"
                      type="checkbox"
                      class="rounded border-gray-300"
                    />
                    <span class="text-sm">Símbolos (!@#$%^&*)</span>
                  </label>
                </div>
              </div>

              <div class="space-y-3">
                <Label>Opciones avanzadas</Label>
                <div class="space-y-2">
                  <label class="flex items-center space-x-2">
                    <input
                      v-model="options.excludeSimilar"
                      type="checkbox"
                      class="rounded border-gray-300"
                    />
                    <span class="text-sm">Excluir caracteres similares (0, O, l, I)</span>
                  </label>
                  <label class="flex items-center space-x-2">
                    <input
                      v-model="options.excludeAmbiguous"
                      type="checkbox"
                      class="rounded border-gray-300"
                    />
                    <span class="text-sm">Excluir caracteres ambiguos ( { } [ ] ( ) / \ ' " ` ~ , ; . < > )</span>
                  </label>
                </div>
              </div>

              <Button @click="generatePassword" class="w-full">
                Generar Nueva Contraseña
              </Button>
            </div>
          </CardContent>
        </Card>

        <!-- Generated Password -->
        <div class="space-y-6">
          <!-- Password Display -->
          <Card>
            <CardHeader>
              <CardTitle>Tu Contraseña Generada</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-4">
                <div class="relative">
                  <input
                    v-model="generatedPassword"
                    :type="showPassword ? 'text' : 'password'"
                    readonly
                    class="w-full pr-20 font-mono text-sm rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                    placeholder="Haz clic en 'Generar' para crear una contraseña"
                  />
                  <div class="absolute right-2 top-1/2 -translate-y-1/2 flex space-x-1">
                    <Button
                      @click="showPassword = !showPassword"
                      size="sm"
                      variant="ghost"
                      class="h-6 w-6 p-0"
                    >
                      {{ showPassword ? '🙈' : '👁️' }}
                    </Button>
                    <Button
                      @click="copyPassword"
                      size="sm"
                      variant="ghost"
                      class="h-6 w-6 p-0"
                      :disabled="!generatedPassword"
                    >
                      📋
                    </Button>
                  </div>
                </div>
                
                <div v-if="copied" class="text-sm text-green-600 dark:text-green-400">
                  ¡Contraseña copiada al portapapeles!
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Strength Indicator -->
          <Card v-if="generatedPassword">
            <CardHeader>
              <CardTitle>Fortaleza de la Contraseña</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-4">
                <div class="flex items-center space-x-2">
                  <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div
                      class="h-2 rounded-full transition-all duration-300"
                      :class="strength.colorClass"
                      :style="`width: ${strength.percentage}%`"
                    ></div>
                  </div>
                  <span class="text-sm font-medium" :class="strength.textClass">
                    {{ strength.level }}
                  </span>
                </div>
                <div class="text-sm text-muted-foreground">
                  {{ strength.description }}
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Quick Actions -->
          <Card>
            <CardHeader>
              <CardTitle>Configuraciones Rápidas</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="grid grid-cols-2 gap-2">
                <Button @click="setPreset('basic')" variant="outline" size="sm">
                  Básica (8 chars)
                </Button>
                <Button @click="setPreset('strong')" variant="outline" size="sm">
                  Fuerte (16 chars)
                </Button>
                <Button @click="setPreset('ultra')" variant="outline" size="sm">
                  Ultra (32 chars)
                </Button>
                <Button @click="setPreset('pin')" variant="outline" size="sm">
                  PIN (4 números)
                </Button>
              </div>
            </CardContent>
          </Card>

          <!-- Instructions -->
          <Card>
            <CardHeader>
              <CardTitle>Consejos de Seguridad</CardTitle>
            </CardHeader>
            <CardContent class="space-y-3">
              <div class="text-sm space-y-2">
                <p>✅ <strong>Usar:</strong> contraseñas largas y únicas para cada cuenta</p>
                <p>✅ <strong>Usar:</strong> un gestor de contraseñas confiable</p>
                <p>✅ <strong>Usar:</strong> autenticación de dos factores cuando sea posible</p>
                <p>❌ <strong>Evitar:</strong> información personal en contraseñas</p>
                <p>❌ <strong>Evitar:</strong> reutilizar contraseñas en múltiples sitios</p>
                <p>❌ <strong>Evitar:</strong> compartir contraseñas por email o chat</p>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- SEO Content -->
      <div class="mt-12 prose prose-gray max-w-none">
        <h2 class="text-2xl font-bold mb-4">¿Por qué usar un generador de contraseñas?</h2>
        <p class="mb-4">
          En el mundo digital actual, tener contraseñas seguras es fundamental para proteger 
          tus cuentas y datos personales. Un generador de contraseñas te ayuda a crear 
          contraseñas robustas que son prácticamente imposibles de adivinar.
        </p>
        
        <h3 class="text-xl font-semibold mb-3">Características de una contraseña segura</h3>
        <ul class="list-disc pl-6 mb-4">
          <li><strong>Longitud:</strong> Al menos 12 caracteres, idealmente 16 o más</li>
          <li><strong>Variedad:</strong> Combinación de mayúsculas, minúsculas, números y símbolos</li>
          <li><strong>Aleatoriedad:</strong> Sin patrones predecibles o información personal</li>
          <li><strong>Unicidad:</strong> Diferente para cada cuenta o servicio</li>
        </ul>

        <h3 class="text-xl font-semibold mb-3">Errores comunes en contraseñas</h3>
        <ul class="list-disc pl-6 mb-4">
          <li>Usar fechas de nacimiento, nombres o información personal</li>
          <li>Reutilizar la misma contraseña en múltiples sitios</li>
          <li>Usar contraseñas demasiado cortas (menos de 8 caracteres)</li>
          <li>Usar solo letras o solo números</li>
          <li>Usar patrones de teclado como "123456" o "qwerty"</li>
        </ul>

        <h3 class="text-xl font-semibold mb-3">Gestión de contraseñas</h3>
        <p class="mb-4">
          Te recomendamos usar un gestor de contraseñas como LastPass, 1Password, Bitwarden 
          o similares. Estas herramientas pueden generar, almacenar y rellenar automáticamente 
          contraseñas seguras, haciendo que tu vida digital sea más segura y conveniente.
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
import { ref, computed, watch } from 'vue'
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
const options = ref({
  length: 16,
  includeUppercase: true,
  includeLowercase: true,
  includeNumbers: true,
  includeSymbols: true,
  excludeSimilar: false,
  excludeAmbiguous: false
})

const generatedPassword = ref('')
const showPassword = ref(false)
const copied = ref(false)

// Character sets
const charSets = {
  uppercase: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
  lowercase: 'abcdefghijklmnopqrstuvwxyz',
  numbers: '0123456789',
  symbols: '!@#$%^&*()_+-=[]{}|;:,.<>?'
}

const similarChars = '0O1lI'
const ambiguousChars = '{}[]()/\\\'"`~,;.<>'

// Computed properties
const strength = computed(() => {
  if (!generatedPassword.value) {
    return { level: '', percentage: 0, colorClass: '', textClass: '', description: '' }
  }

  let score = 0
  const password = generatedPassword.value

  // Length scoring
  if (password.length >= 8) score += 1
  if (password.length >= 12) score += 1
  if (password.length >= 16) score += 1
  if (password.length >= 20) score += 1

  // Character variety scoring
  if (/[a-z]/.test(password)) score += 1
  if (/[A-Z]/.test(password)) score += 1
  if (/[0-9]/.test(password)) score += 1
  if (/[^a-zA-Z0-9]/.test(password)) score += 1

  // Additional complexity
  if (password.length >= 24) score += 1

  let level = ''
  let percentage = 0
  let colorClass = ''
  let textClass = ''
  let description = ''

  if (score <= 3) {
    level = 'Débil'
    percentage = 25
    colorClass = 'bg-red-500'
    textClass = 'text-red-600 dark:text-red-400'
    description = 'Esta contraseña es vulnerable. Considera hacerla más larga y compleja.'
  } else if (score <= 5) {
    level = 'Media'
    percentage = 50
    colorClass = 'bg-yellow-500'
    textClass = 'text-yellow-600 dark:text-yellow-400'
    description = 'Contraseña aceptable, pero puede mejorarse.'
  } else if (score <= 7) {
    level = 'Fuerte'
    percentage = 75
    colorClass = 'bg-green-500'
    textClass = 'text-green-600 dark:text-green-400'
    description = 'Buena contraseña con buen nivel de seguridad.'
  } else {
    level = 'Muy Fuerte'
    percentage = 100
    colorClass = 'bg-green-600'
    textClass = 'text-green-700 dark:text-green-300'
    description = 'Excelente contraseña con máximo nivel de seguridad.'
  }

  return { level, percentage, colorClass, textClass, description }
})

// Methods
const generatePassword = () => {
  let chars = ''
  
  if (options.value.includeUppercase) chars += charSets.uppercase
  if (options.value.includeLowercase) chars += charSets.lowercase
  if (options.value.includeNumbers) chars += charSets.numbers
  if (options.value.includeSymbols) chars += charSets.symbols

  if (options.value.excludeSimilar) {
    chars = chars.split('').filter(char => !similarChars.includes(char)).join('')
  }
  
  if (options.value.excludeAmbiguous) {
    chars = chars.split('').filter(char => !ambiguousChars.includes(char)).join('')
  }

  if (!chars) {
    alert('Debes seleccionar al menos un tipo de carácter')
    return
  }

  let password = ''
  for (let i = 0; i < options.value.length; i++) {
    password += chars.charAt(Math.floor(Math.random() * chars.length))
  }

  generatedPassword.value = password
}

const copyPassword = async () => {
  if (!generatedPassword.value) return

  try {
    await navigator.clipboard.writeText(generatedPassword.value)
    copied.value = true
    setTimeout(() => {
      copied.value = false
    }, 2000)
  } catch (err) {
    // Fallback for older browsers
    const textArea = document.createElement('textarea')
    textArea.value = generatedPassword.value
    document.body.appendChild(textArea)
    textArea.select()
    document.execCommand('copy')
    document.body.removeChild(textArea)
    copied.value = true
    setTimeout(() => {
      copied.value = false
    }, 2000)
  }
}

const setPreset = (preset: string) => {
  switch (preset) {
    case 'basic':
      options.value = {
        length: 8,
        includeUppercase: true,
        includeLowercase: true,
        includeNumbers: true,
        includeSymbols: false,
        excludeSimilar: false,
        excludeAmbiguous: false
      }
      break
    case 'strong':
      options.value = {
        length: 16,
        includeUppercase: true,
        includeLowercase: true,
        includeNumbers: true,
        includeSymbols: true,
        excludeSimilar: true,
        excludeAmbiguous: false
      }
      break
    case 'ultra':
      options.value = {
        length: 32,
        includeUppercase: true,
        includeLowercase: true,
        includeNumbers: true,
        includeSymbols: true,
        excludeSimilar: true,
        excludeAmbiguous: true
      }
      break
    case 'pin':
      options.value = {
        length: 4,
        includeUppercase: false,
        includeLowercase: false,
        includeNumbers: true,
        includeSymbols: false,
        excludeSimilar: false,
        excludeAmbiguous: false
      }
      break
  }
  generatePassword()
}

// Auto-generate on load
generatePassword()

// Watch for option changes to auto-regenerate
watch(options, generatePassword, { deep: true })
</script>
