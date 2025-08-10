<template>
  <ToolsLayout title="Generador de Colores" subtitle="Genera paletas de colores armónicas, convierte formatos y crea gradientes profesionales.">

    <!-- Main Content -->
    <main id="tool-main" class="container mx-auto px-4 py-6">

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Color Generator -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Generador de Colores</CardTitle>
            <CardDescription>
              Genera paletas armónicas y personaliza colores
            </CardDescription>
          </CardHeader>
          <CardContent class="space-y-4">
            <div class="space-y-4">
              <!-- Color Picker -->
              <div>
                <Label for="baseColor">Color Base</Label>
                <div class="flex gap-2 items-center">
                  <input
                    id="baseColor"
                    v-model="baseColor"
                    type="color"
                    class="w-16 h-12 rounded border cursor-pointer"
                  />
                  <input
                    v-model="baseColorHex"
                    type="text"
                    class="flex-1 rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                    placeholder="#000000"
                    maxlength="7"
                  />
                </div>
              </div>

              <!-- Palette Type -->
              <div>
                <Label for="paletteType">Tipo de Paleta</Label>
                <select
                  id="paletteType"
                  v-model="paletteType"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
                  <option value="monochromatic">Monocromática</option>
                  <option value="analogous">Análoga</option>
                  <option value="complementary">Complementaria</option>
                  <option value="triadic">Triádica</option>
                  <option value="tetradic">Tetrádica</option>
                  <option value="split-complementary">Complementaria Dividida</option>
                </select>
              </div>

              <!-- Color Count -->
              <div>
                <Label for="colorCount">Número de Colores</Label>
                <input
                  id="colorCount"
                  v-model.number="colorCount"
                  type="range"
                  min="3"
                  max="12"
                  class="w-full"
                />
                <div class="flex justify-between text-xs text-muted-foreground">
                  <span>3</span>
                  <span>{{ colorCount }}</span>
                  <span>12</span>
                </div>
              </div>

              <!-- Generate Button -->
              <Button @click="generatePalette" class="w-full bg-gradient-to-r from-pink-500 to-indigo-600 hover:from-pink-600 hover:to-indigo-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                🎨 Generar Paleta
              </Button>

              <!-- Random Colors -->
              <div class="grid grid-cols-2 gap-2">
                <Button @click="generateRandomPalette" variant="outline" size="sm">
                  🎲 Paleta Aleatoria
                </Button>
                <Button @click="generateTrendingColors" variant="outline" size="sm">
                  🔥 Colores de Moda
                </Button>
              </div>
            </div>
          </CardContent>
        </Card>

        <!-- Results -->
        <div class="space-y-6">
          <!-- Generated Palette -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Paleta Generada</CardTitle>
            </CardHeader>
            <CardContent>
              <div v-if="generatedPalette.length" class="space-y-4">
                <div class="grid grid-cols-2 gap-2">
                  <div 
                    v-for="(color, index) in generatedPalette" 
                    :key="index"
                    class="relative group cursor-pointer"
                    @click="selectColor(color)"
                  >
                    <div 
                      class="h-20 rounded-lg border-2 border-white shadow-lg transition-transform hover:scale-105"
                      :style="{ backgroundColor: color.hex }"
                    ></div>
                    <div class="absolute bottom-1 left-1 right-1 text-xs text-white font-mono bg-black bg-opacity-50 rounded px-1">
                      {{ color.hex }}
                    </div>
                    <div class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity">
                      <Button @click.stop="copyColor(color)" variant="ghost" size="sm" class="h-6 w-6 p-0 bg-white bg-opacity-20 hover:bg-opacity-30">
                        📋
                      </Button>
                    </div>
                  </div>
                </div>

                <!-- Copy All Colors -->
                <Button @click="copyAllColors" class="w-full bg-gradient-to-r from-pink-500 to-indigo-600 hover:from-pink-600 hover:to-indigo-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                  📋 Copiar Todos los Colores
                </Button>
              </div>
              <div v-else class="text-center text-muted-foreground py-8">
                Haz clic en "Generar Paleta" para crear colores
              </div>
            </CardContent>
          </Card>

          <!-- Color Information -->
          <Card v-if="selectedColorInfo" class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Información del Color</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-4">
                <div class="flex items-center gap-4">
                  <div 
                    class="w-16 h-16 rounded-lg border-2 border-white shadow-lg"
                    :style="{ backgroundColor: selectedColorInfo.hex }"
                  ></div>
                  <div class="flex-1">
                    <div class="text-2xl font-bold font-mono">{{ selectedColorInfo.hex }}</div>
                    <div class="text-sm text-muted-foreground">{{ selectedColorInfo.name }}</div>
                  </div>
                </div>

                <!-- Color Values -->
                <div class="grid grid-cols-3 gap-2 text-sm">
                  <div>
                    <div class="font-medium">RGB</div>
                    <div class="font-mono">{{ selectedColorInfo.rgb }}</div>
                  </div>
                  <div>
                    <div class="font-medium">HSL</div>
                    <div class="font-mono">{{ selectedColorInfo.hsl }}</div>
                  </div>
                  <div>
                    <div class="font-medium">CMYK</div>
                    <div class="font-mono">{{ selectedColorInfo.cmyk }}</div>
                  </div>
                </div>

                <!-- Color Properties -->
                <div class="space-y-2 text-sm">
                  <div class="flex justify-between">
                    <span>Luminosidad:</span>
                    <span>{{ selectedColorInfo.luminance }}%</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Saturación:</span>
                    <span>{{ selectedColorInfo.saturation }}%</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Contraste:</span>
                    <span>{{ selectedColorInfo.contrast }}</span>
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Gradient Generator -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Generador de Gradientes</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-4">
                <div class="grid grid-cols-2 gap-2">
                  <div>
                    <Label for="gradientStart">Inicio</Label>
                    <input
                      id="gradientStart"
                      v-model="gradientStart"
                      type="color"
                      class="w-full h-10 rounded border cursor-pointer"
                    />
                  </div>
                  <div>
                    <Label for="gradientEnd">Fin</Label>
                    <input
                      id="gradientEnd"
                      v-model="gradientEnd"
                      type="color"
                      class="w-full h-10 rounded border cursor-pointer"
                    />
                  </div>
                </div>

                <div>
                  <Label for="gradientDirection">Dirección</Label>
                  <select
                    id="gradientDirection"
                    v-model="gradientDirection"
                    class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  >
                    <option value="to right">Horizontal (→)</option>
                    <option value="to bottom">Vertical (↓)</option>
                    <option value="45deg">Diagonal (↗)</option>
                    <option value="135deg">Diagonal (↖)</option>
                    <option value="to right bottom">Esquina (↘)</option>
                    <option value="to left bottom">Esquina (↙)</option>
                  </select>
                </div>

                <!-- Gradient Preview -->
                <div 
                  class="h-20 rounded-lg border-2 border-white shadow-lg"
                  :style="{ background: `linear-gradient(${gradientDirection}, ${gradientStart}, ${gradientEnd})` }"
                ></div>

                <!-- Copy Gradient -->
                <Button @click="copyGradient" class="w-full bg-gradient-to-r from-pink-500 to-indigo-600 hover:from-pink-600 hover:to-indigo-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                  📋 Copiar CSS del Gradiente
                </Button>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- Color Tools Row -->
      <div class="mt-8 grid lg:grid-cols-3 gap-6">
        <!-- Color Converter -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Convertidor de Colores</CardTitle>
          </CardHeader>
          <CardContent>
            <div class="space-y-4">
              <div>
                <Label for="convertColor">Color a Convertir</Label>
                <input
                  id="convertColor"
                  v-model="convertColorInput"
                  type="text"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  placeholder="#FF0000, rgb(255,0,0), hsl(0,100%,50%)"
                />
              </div>

              <div v-if="convertedColor" class="space-y-2">
                <div class="flex items-center gap-2">
                  <div 
                    class="w-8 h-8 rounded border"
                    :style="{ backgroundColor: convertedColor.hex }"
                  ></div>
                  <span class="font-mono text-sm">{{ convertedColor.hex }}</span>
                </div>
                <div class="text-xs space-y-1">
                  <div><strong>RGB:</strong> {{ convertedColor.rgb }}</div>
                  <div><strong>HSL:</strong> {{ convertedColor.hsl }}</div>
                  <div><strong>CMYK:</strong> {{ convertedColor.cmyk }}</div>
                </div>
              </div>

              <Button @click="convertColor" class="w-full bg-gradient-to-r from-pink-500 to-indigo-600 hover:from-pink-600 hover:to-indigo-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                🔄 Convertir
              </Button>
            </div>
          </CardContent>
        </Card>

        <!-- Color Accessibility -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Accesibilidad</CardTitle>
          </CardHeader>
          <CardContent>
            <div class="space-y-4">
              <div v-if="selectedColorInfo" class="space-y-3">
                <div class="flex items-center gap-2">
                  <div 
                    class="w-8 h-8 rounded border"
                    :style="{ backgroundColor: selectedColorInfo.hex }"
                  ></div>
                  <div class="flex-1">
                    <div class="text-sm font-medium">Color seleccionado</div>
                    <div class="text-xs text-muted-foreground">{{ selectedColorInfo.hex }}</div>
                  </div>
                </div>

                <div class="space-y-2">
                  <div class="flex justify-between text-sm">
                    <span>Contraste con blanco:</span>
                    <span :class="getContrastClass(selectedColorInfo.contrastWhite)">{{ selectedColorInfo.contrastWhite }}:1</span>
                  </div>
                  <div class="flex justify-between text-sm">
                    <span>Contraste con negro:</span>
                    <span :class="getContrastClass(selectedColorInfo.contrastBlack)">{{ selectedColorInfo.contrastBlack }}:1</span>
                  </div>
                </div>

                <div class="text-xs text-muted-foreground">
                  <p>✅ <strong>Excelente:</strong> 7:1 o mayor</p>
                  <p>⚠️ <strong>Bueno:</strong> 4.5:1 o mayor</p>
                  <p>❌ <strong>Pobre:</strong> Menor a 4.5:1</p>
                </div>
              </div>
              <div v-else class="text-center text-muted-foreground py-4">
                Selecciona un color para ver su accesibilidad
              </div>
            </div>
          </CardContent>
        </Card>

        <!-- Color Inspiration -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Inspiración</CardTitle>
          </CardHeader>
          <CardContent>
            <div class="space-y-4">
              <div class="grid grid-cols-2 gap-2">
                <Button @click="generateMaterialColors" variant="outline" size="sm">
                  🎨 Material Design
                </Button>
                <Button @click="generateFlatColors" variant="outline" size="sm">
                  🟦 Flat UI
                </Button>
                <Button @click="generatePastelColors" variant="outline" size="sm">
                  🌸 Pasteles
                </Button>
                <Button @click="generateNeutralColors" variant="outline" size="sm">
                  ⚫ Neutros
                </Button>
              </div>

              <div class="text-xs text-muted-foreground">
                <p>💡 <strong>Material Design:</strong> Colores de Google</p>
                <p>💡 <strong>Flat UI:</strong> Colores planos modernos</p>
                <p>💡 <strong>Pasteles:</strong> Colores suaves y claros</p>
                <p>💡 <strong>Neutros:</strong> Grises y tonos tierra</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      <!-- SEO Content (collapsible) -->
      <details class="mt-8 group">
        <summary class="cursor-pointer select-none text-sm text-muted-foreground hover:text-foreground">Información sobre teoría del color</summary>
        <div class="mt-4 prose prose-gray max-w-none">
          <h2 class="text-2xl font-bold mb-4">¿Por qué usar un generador de colores?</h2>
          <p class="mb-4">Crea paletas armónicas y profesionales para tus diseños y proyectos.</p>
          <h3 class="text-xl font-semibold mb-3">Tipos de paletas disponibles</h3>
          <ul class="list-disc pl-6 mb-4">
            <li><strong>Monocromática:</strong> Variaciones de un solo color</li>
            <li><strong>Análoga:</strong> Colores adyacentes en el círculo cromático</li>
            <li><strong>Complementaria:</strong> Colores opuestos en el círculo cromático</li>
            <li><strong>Triádica:</strong> Tres colores equidistantes</li>
            <li><strong>Tetrádica:</strong> Dos pares de colores complementarios</li>
          </ul>
        </div>
      </details>
    </main>
  </ToolsLayout>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue'
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
const baseColor = ref('#3B82F6')
const baseColorHex = ref('#3B82F6')
const paletteType = ref('monochromatic')
const colorCount = ref(5)
const generatedPalette = ref<Array<{
  hex: string
  rgb: string
  hsl: string
  cmyk: string
  name: string
  luminance: number
  saturation: number
  contrast: number
  contrastWhite: number
  contrastBlack: number
}>>([])

const selectedColorInfo = ref<any>(null)
const gradientStart = ref('#3B82F6')
const gradientEnd = ref('#EC4899')
const gradientDirection = ref('to right')
const convertColorInput = ref('')

// Color names for common colors
const colorNames: { [key: string]: string } = {
  '#FF0000': 'Rojo',
  '#00FF00': 'Verde',
  '#0000FF': 'Azul',
  '#FFFF00': 'Amarillo',
  '#FF00FF': 'Magenta',
  '#00FFFF': 'Cian',
  '#FFA500': 'Naranja',
  '#800080': 'Púrpura',
  '#FFC0CB': 'Rosa',
  '#A52A2A': 'Marrón',
  '#000000': 'Negro',
  '#FFFFFF': 'Blanco',
  '#808080': 'Gris',
  '#3B82F6': 'Azul',
  '#EC4899': 'Rosa',
  '#10B981': 'Verde Esmeralda',
  '#F59E0B': 'Ámbar',
  '#EF4444': 'Rojo',
  '#8B5CF6': 'Violeta'
}

// Methods
const hexToRgb = (hex: string): [number, number, number] => {
  const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex)
  return result ? [
    parseInt(result[1], 16),
    parseInt(result[2], 16),
    parseInt(result[3], 16)
  ] : [0, 0, 0]
}

const rgbToHex = (r: number, g: number, b: number): string => {
  return '#' + [r, g, b].map(x => {
    const hex = x.toString(16)
    return hex.length === 1 ? '0' + hex : hex
  }).join('')
}

const rgbToHsl = (r: number, g: number, b: number): [number, number, number] => {
  r /= 255
  g /= 255
  b /= 255

  const max = Math.max(r, g, b)
  const min = Math.min(r, g, b)
  let h = 0
  let s = 0
  const l = (max + min) / 2

  if (max !== min) {
    const d = max - min
    s = l > 0.5 ? d / (2 - max - min) : d / (max + min)
    switch (max) {
      case r: h = (g - b) / d + (g < b ? 6 : 0); break
      case g: h = (b - r) / d + 2; break
      case b: h = (r - g) / d + 4; break
    }
    h /= 6
  }

  return [Math.round(h * 360), Math.round(s * 100), Math.round(l * 100)]
}

const rgbToCmyk = (r: number, g: number, b: number): [number, number, number, number] => {
  r /= 255
  g /= 255
  b /= 255

  const k = 1 - Math.max(r, g, b)
  const c = (1 - r - k) / (1 - k)
  const m = (1 - g - k) / (1 - k)
  const y = (1 - b - k) / (1 - k)

  return [
    Math.round(c * 100),
    Math.round(m * 100),
    Math.round(y * 100),
    Math.round(k * 100)
  ]
}

const calculateLuminance = (r: number, g: number, b: number): number => {
  const [rs, gs, bs] = [r, g, b].map(c => {
    c = c / 255
    return c <= 0.03928 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4)
  })
  return 0.2126 * rs + 0.7152 * gs + 0.0722 * bs
}

const calculateContrast = (l1: number, l2: number): number => {
  const lighter = Math.max(l1, l2)
  const darker = Math.min(l1, l2)
  return (lighter + 0.05) / (darker + 0.05)
}

const generateColorInfo = (hex: string) => {
  const [r, g, b] = hexToRgb(hex)
  const [h, s, l] = rgbToHsl(r, g, b)
  const [c, m, y, k] = rgbToCmyk(r, g, b)
  const luminance = Math.round(l)
  const saturation = Math.round(s)
  
  const whiteLuminance = 1
  const blackLuminance = 0
  const colorLuminance = calculateLuminance(r, g, b)
  
  const contrastWhite = Math.round(calculateContrast(colorLuminance, whiteLuminance) * 100) / 100
  const contrastBlack = Math.round(calculateContrast(colorLuminance, blackLuminance) * 100) / 100

  return {
    hex,
    rgb: `rgb(${r}, ${g}, ${b})`,
    hsl: `hsl(${h}, ${s}%, ${l}%)`,
    cmyk: `cmyk(${c}%, ${m}%, ${y}%, ${k}%)`,
    name: colorNames[hex] || 'Personalizado',
    luminance,
    saturation,
    contrast: Math.round((contrastWhite + contrastBlack) / 2 * 100) / 100,
    contrastWhite,
    contrastBlack
  }
}

const generatePalette = () => {
  const [h, s, l] = rgbToHsl(...hexToRgb(baseColor.value))
  const colors = []

  switch (paletteType.value) {
    case 'monochromatic':
      for (let i = 0; i < colorCount.value; i++) {
        const newL = Math.max(0, Math.min(100, l + (i - Math.floor(colorCount.value / 2)) * 20))
        const newS = Math.max(0, Math.min(100, s + (i % 2 === 0 ? 10 : -10)))
        const hex = hslToHex(h, newS, newL)
        colors.push(generateColorInfo(hex))
      }
      break

    case 'analogous':
      for (let i = 0; i < colorCount.value; i++) {
        const newH = (h + (i - Math.floor(colorCount.value / 2)) * 30) % 360
        const hex = hslToHex(newH, s, l)
        colors.push(generateColorInfo(hex))
      }
      break

    case 'complementary':
      for (let i = 0; i < colorCount.value; i++) {
        if (i === 0) {
          colors.push(generateColorInfo(baseColor.value))
        } else if (i === 1) {
          const complementH = (h + 180) % 360
          const hex = hslToHex(complementH, s, l)
          colors.push(generateColorInfo(hex))
        } else {
          const newH = (h + (i - 2) * 30) % 360
          const hex = hslToHex(newH, s, l)
          colors.push(generateColorInfo(hex))
        }
      }
      break

    case 'triadic':
      for (let i = 0; i < colorCount.value; i++) {
        if (i === 0) {
          colors.push(generateColorInfo(baseColor.value))
        } else if (i === 1) {
          const triadicH = (h + 120) % 360
          const hex = hslToHex(triadicH, s, l)
          colors.push(generateColorInfo(hex))
        } else if (i === 2) {
          const triadicH2 = (h + 240) % 360
          const hex = hslToHex(triadicH2, s, l)
          colors.push(generateColorInfo(hex))
        } else {
          const newH = (h + (i - 3) * 45) % 360
          const hex = hslToHex(newH, s, l)
          colors.push(generateColorInfo(hex))
        }
      }
      break

    default:
      // Generate random variations
      for (let i = 0; i < colorCount.value; i++) {
        const newH = (h + i * 360 / colorCount.value) % 360
        const newS = Math.max(30, Math.min(100, s + (Math.random() - 0.5) * 40))
        const newL = Math.max(20, Math.min(80, l + (Math.random() - 0.5) * 40))
        const hex = hslToHex(newH, newS, newL)
        colors.push(generateColorInfo(hex))
      }
  }

  generatedPalette.value = colors
  if (colors.length > 0) {
    selectedColorInfo.value = colors[0]
  }
}

const hslToHex = (h: number, s: number, l: number): string => {
  l /= 100
  const a = s * Math.min(l, 1 - l) / 100
  const f = (n: number) => {
    const k = (n + h / 30) % 12
    const color = l - a * Math.max(Math.min(k - 3, 9 - k, 1), -1)
    return Math.round(255 * Math.max(0, Math.min(1, color)))
  }
  return rgbToHex(f(0), f(8), f(4))
}

const generateRandomPalette = () => {
  const randomHue = Math.floor(Math.random() * 360)
  baseColor.value = hslToHex(randomHue, 70, 50)
  baseColorHex.value = baseColor.value
  generatePalette()
}

const generateTrendingColors = () => {
  const trendingColors = [
    '#3B82F6', '#EC4899', '#10B981', '#F59E0B', '#EF4444',
    '#8B5CF6', '#06B6D4', '#84CC16', '#F97316', '#6366F1'
  ]
  baseColor.value = trendingColors[Math.floor(Math.random() * trendingColors.length)]
  baseColorHex.value = baseColor.value
  generatePalette()
}

const generateMaterialColors = () => {
  const materialColors = [
    '#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5',
    '#2196F3', '#03A9F4', '#00BCD4', '#009688', '#4CAF50'
  ]
  generatedPalette.value = materialColors.map(color => generateColorInfo(color))
}

const generateFlatColors = () => {
  const flatColors = [
    '#E74C3C', '#E67E22', '#F1C40F', '#2ECC71', '#3498DB',
    '#9B59B6', '#34495E', '#1ABC9C', '#F39C12', '#E91E63'
  ]
  generatedPalette.value = flatColors.map(color => generateColorInfo(color))
}

const generatePastelColors = () => {
  const pastelColors = [
    '#FFB3BA', '#BAFFC9', '#BAE1FF', '#FFFFBA', '#FFB3F7',
    '#E8B3FF', '#B3FFF7', '#FFE8B3', '#F7B3FF', '#B3FFE8'
  ]
  generatedPalette.value = pastelColors.map(color => generateColorInfo(color))
}

const generateNeutralColors = () => {
  const neutralColors = [
    '#F8F9FA', '#E9ECEF', '#DEE2E6', '#CED4DA', '#ADB5BD',
    '#6C757D', '#495057', '#343A40', '#212529', '#000000'
  ]
  generatedPalette.value = neutralColors.map(color => generateColorInfo(color))
}

const selectColor = (color: any) => {
  selectedColorInfo.value = color
}

const copyColor = async (color: any) => {
  try {
    await navigator.clipboard.writeText(color.hex)
  } catch (err) {
    const textArea = document.createElement('textarea')
    textArea.value = color.hex
    document.body.appendChild(textArea)
    textArea.select()
    document.execCommand('copy')
    document.body.removeChild(textArea)
  }
}

const copyAllColors = async () => {
  const colorsText = generatedPalette.value.map(color => color.hex).join('\n')
  try {
    await navigator.clipboard.writeText(colorsText)
  } catch (err) {
    const textArea = document.createElement('textarea')
    textArea.value = colorsText
    document.body.appendChild(textArea)
    textArea.select()
    document.execCommand('copy')
    document.body.removeChild(textArea)
  }
}

const copyGradient = async () => {
  const gradientCSS = `background: linear-gradient(${gradientDirection.value}, ${gradientStart.value}, ${gradientEnd.value});`
  try {
    await navigator.clipboard.writeText(gradientCSS)
  } catch (err) {
    const textArea = document.createElement('textarea')
    textArea.value = gradientCSS
    document.body.appendChild(textArea)
    textArea.select()
    document.execCommand('copy')
    document.body.removeChild(textArea)
  }
}

const convertColor = () => {
  if (!convertColorInput.value) return
  
  let hex = convertColorInput.value
  
  // Try to parse different formats
  if (hex.startsWith('rgb(')) {
    const match = hex.match(/rgb\((\d+),\s*(\d+),\s*(\d+)\)/)
    if (match) {
      hex = rgbToHex(parseInt(match[1]), parseInt(match[2]), parseInt(match[3]))
    }
  } else if (hex.startsWith('hsl(')) {
    const match = hex.match(/hsl\((\d+),\s*(\d+)%,\s*(\d+)%\)/)
    if (match) {
      hex = hslToHex(parseInt(match[1]), parseInt(match[2]), parseInt(match[3]))
    }
  }
  
  if (hex.startsWith('#')) {
    const convertedColor = generateColorInfo(hex)
    selectedColorInfo.value = convertedColor
  }
}

const getContrastClass = (contrast: number): string => {
  if (contrast >= 7) return 'text-green-600 dark:text-green-400'
  if (contrast >= 4.5) return 'text-yellow-600 dark:text-yellow-400'
  return 'text-red-600 dark:text-red-400'
}

// Watch for changes
watch(baseColor, (newColor) => {
  baseColorHex.value = newColor
})

watch(baseColorHex, (newHex) => {
  if (/^#[0-9A-F]{6}$/i.test(newHex)) {
    baseColor.value = newHex
  }
})

// Initialize
generatePalette()
</script>
