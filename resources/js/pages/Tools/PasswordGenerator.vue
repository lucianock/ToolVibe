<template>
  <ToolsLayout title="Generador de Contraseñas" subtitle="Crea contraseñas robustas, genera múltiples y exporta a CSV.">

    <!-- Main Content -->
    <main id="tool-main" class="container mx-auto px-4 py-6">

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Generator Form -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
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
                  <label class="flex items-center space-x-2">
                    <input
                      v-model="options.avoidSequences"
                      type="checkbox"
                      class="rounded border-gray-300"
                    />
                    <span class="text-sm">Evitar secuencias (1234, abcd)</span>
                  </label>
                </div>
              </div>

              <Button @click="generatePassword" class="w-full bg-gradient-to-r from-purple-500 to-red-600 hover:from-purple-600 hover:to-red-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                Generar Nueva Contraseña
              </Button>
            </div>
          </CardContent>
        </Card>

        <!-- Generated Password -->
        <div class="space-y-6">
          <!-- Password Display -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
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

                <div v-if="multiplePasswords.length" class="mt-4">
                  <Label>Lista generada ({{ multiplePasswords.length }})</Label>
                  <textarea readonly class="w-full font-mono text-xs rounded-md border border-input bg-background px-3 py-2 mt-1" rows="4">{{ multiplePasswords.join('\n') }}</textarea>
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Strength Indicator -->
          <Card v-if="generatedPassword" class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
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
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
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
              <div class="mt-3 grid grid-cols-2 gap-2">
                <Button @click="generateMultiple(10)" variant="outline" size="sm">10 contraseñas</Button>
                <Button @click="exportCsv" variant="outline" size="sm" :disabled="!multiplePasswords.length">Exportar CSV</Button>
              </div>
            </CardContent>
          </Card>

          <!-- Instructions -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
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

      <!-- SEO Content (collapsible) -->
      <details class="mt-8 group">
        <summary class="cursor-pointer select-none text-sm text-muted-foreground hover:text-foreground">Consejos de seguridad</summary>
        <div class="mt-4 prose prose-gray max-w-none">
          <h2 class="text-2xl font-bold mb-4">¿Por qué usar un generador de contraseñas?</h2>
          <p class="mb-4">Crea contraseñas seguras y evita patrones predecibles.</p>
          <h3 class="text-xl font-semibold mb-3">Características de una contraseña segura</h3>
          <ul class="list-disc pl-6 mb-4">
            <li>Longitud ≥ 12</li>
            <li>Variedad de caracteres</li>
            <li>Aleatoriedad y unicidad</li>
          </ul>
        </div>
      </details>
    </main>
  </ToolsLayout>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
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
const options = ref({
  length: 16,
  includeUppercase: true,
  includeLowercase: true,
  includeNumbers: true,
  includeSymbols: true,
  excludeSimilar: false,
  excludeAmbiguous: false,
  avoidSequences: true
})

const generatedPassword = ref('')
const showPassword = ref(false)
const copied = ref(false)
const multiplePasswords = ref<string[]>([])

// Helpers
const isActive = (path: string) => typeof window !== 'undefined' && window.location.pathname.startsWith(path)

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

  if (options.value.avoidSequences) {
    const isSequential = (s: string) => /0123|1234|2345|3456|4567|5678|6789|abcd|bcde|cdef|defg|efgh|fghi|ghij/i.test(s)
    if (isSequential(password)) {
      return generatePassword()
    }
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

const generateMultiple = (count: number) => {
  const set = new Set<string>()
  while (set.size < count) {
    generatePassword()
    if (generatedPassword.value) {
      set.add(generatedPassword.value)
    }
  }
  multiplePasswords.value = Array.from(set)
}

const exportCsv = () => {
  if (!multiplePasswords.value.length) return
  const rows = ['password']
  for (const p of multiplePasswords.value) rows.push(`"${p.replaceAll('"','""')}"`)
  const blob = new Blob([rows.join('\n')], { type: 'text/csv;charset=utf-8;' })
  const url = URL.createObjectURL(blob)
  const a = document.createElement('a')
  a.href = url
  a.download = 'passwords.csv'
  a.click()
  URL.revokeObjectURL(url)
}
</script>
