<template>
  <ToolsLayout title="Convertidor de Unidades" subtitle="Convierte entre diferentes unidades de medida de forma rápida y precisa.">

    <!-- Main Content -->
    <main id="tool-main" class="container mx-auto px-4 py-6">

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Converter Form -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Convertir Unidades</CardTitle>
            <CardDescription>
              Selecciona el tipo de conversión y las unidades
            </CardDescription>
          </CardHeader>
          <CardContent class="space-y-4">
            <div class="space-y-4">
              <!-- Category Selection -->
              <div>
                <Label for="category">Categoría</Label>
                <select
                  id="category"
                  v-model="selectedCategory"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
                  <option v-for="category in categories" :key="category.key" :value="category.key">
                    {{ category.name }}
                  </option>
                </select>
              </div>

              <!-- From Unit -->
              <div>
                <Label for="fromUnit">Desde</Label>
                <select
                  id="fromUnit"
                  v-model="fromUnit"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
                  <option v-for="unit in availableUnits" :key="unit.key" :value="unit.key">
                    {{ unit.name }} ({{ unit.symbol }})
                  </option>
                </select>
              </div>

              <!-- To Unit -->
              <div>
                <Label for="toUnit">Hasta</Label>
                <select
                  id="toUnit"
                  v-model="toUnit"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
                  <option v-for="unit in availableUnits" :key="unit.key" :value="unit.key">
                    {{ unit.name }} ({{ unit.symbol }})
                  </option>
                </select>
              </div>

              <!-- Value Input -->
              <div>
                <Label for="value">Valor</Label>
                <input
                  id="value"
                  v-model.number="inputValue"
                  type="number"
                  step="any"
                  class="w-full rounded-md border border-input bg-background px-3 py-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                  placeholder="Ingresa el valor a convertir"
                />
              </div>

              <!-- Quick Actions -->
              <div class="grid grid-cols-2 gap-2">
                <Button @click="swapUnits" variant="outline" size="sm">
                  🔄 Intercambiar
                </Button>
                <Button @click="clearAll" variant="outline" size="sm">
                  🗑️ Limpiar
                </Button>
              </div>
            </div>
          </CardContent>
        </Card>

        <!-- Results -->
        <div class="space-y-6">
          <!-- Conversion Result -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Resultado de la Conversión</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-4">
                <div v-if="result !== null" class="text-center">
                  <div class="text-3xl font-bold text-primary mb-2">
                    {{ formatNumber(result) }}
                  </div>
                  <div class="text-sm text-muted-foreground">
                    {{ inputValue }} {{ getUnitSymbol(fromUnit) }} = {{ formatNumber(result) }} {{ getUnitSymbol(toUnit) }}
                  </div>
                </div>
                <div v-else class="text-center text-muted-foreground py-8">
                  Ingresa un valor para ver la conversión
                </div>

                <!-- Copy Result -->
                <Button 
                  v-if="result !== null"
                  @click="copyResult" 
                  class="w-full bg-gradient-to-r from-teal-500 to-blue-600 hover:from-teal-600 hover:to-blue-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all"
                >
                  📋 Copiar Resultado
                </Button>
              </div>
            </CardContent>
          </Card>

          <!-- Common Conversions -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Conversiones Comunes</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="grid grid-cols-2 gap-2">
                <Button @click="setQuickConversion('length', 'km', 'mi', 1)" variant="outline" size="sm">
                  1 km → mi
                </Button>
                <Button @click="setQuickConversion('weight', 'kg', 'lb', 1)" variant="outline" size="sm">
                  1 kg → lb
                </Button>
                <Button @click="setQuickConversion('temperature', 'celsius', 'fahrenheit', 25)" variant="outline" size="sm">
                  25°C → °F
                </Button>
                <Button @click="setQuickConversion('volume', 'l', 'gal', 1)" variant="outline" size="sm">
                  1 L → gal
                </Button>
              </div>
            </CardContent>
          </Card>

          <!-- Conversion History -->
          <Card v-if="conversionHistory.length" class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Historial de Conversiones</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="space-y-2 max-h-40 overflow-y-auto">
                <div 
                  v-for="(conversion, index) in conversionHistory.slice(0, 5)" 
                  :key="index"
                  class="flex justify-between items-center p-2 bg-muted rounded text-sm"
                >
                  <span>{{ conversion.fromValue }} {{ conversion.fromUnit }} → {{ conversion.toValue }} {{ conversion.toUnit }}</span>
                  <Button @click="repeatConversion(conversion)" variant="ghost" size="sm" class="h-6 w-6 p-0">
                    🔄
                  </Button>
                </div>
              </div>
            </CardContent>
          </Card>

          <!-- Unit Information -->
          <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
            <CardHeader>
              <CardTitle>Información de Unidades</CardTitle>
            </CardHeader>
            <CardContent>
              <div class="text-sm space-y-2">
                <p v-if="selectedCategory === 'length'">
                  <strong>Longitud:</strong> Medidas de distancia, altura y profundidad
                </p>
                <p v-if="selectedCategory === 'weight'">
                  <strong>Peso:</strong> Medidas de masa y peso
                </p>
                <p v-if="selectedCategory === 'temperature'">
                  <strong>Temperatura:</strong> Escalas de temperatura
                </p>
                <p v-if="selectedCategory === 'volume'">
                  <strong>Volumen:</strong> Medidas de capacidad y espacio
                </p>
                <p v-if="selectedCategory === 'area'">
                  <strong>Área:</strong> Medidas de superficie
                </p>
                <p v-if="selectedCategory === 'speed'">
                  <strong>Velocidad:</strong> Medidas de rapidez y movimiento
                </p>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- SEO Content (collapsible) -->
      <details class="mt-8 group">
        <summary class="cursor-pointer select-none text-sm text-muted-foreground hover:text-foreground">Información sobre conversión de unidades</summary>
        <div class="mt-4 prose prose-gray max-w-none">
          <h2 class="text-2xl font-bold mb-4">¿Por qué usar un convertidor de unidades?</h2>
          <p class="mb-4">Convierte entre diferentes sistemas de medida de forma rápida y precisa.</p>
          <h3 class="text-xl font-semibold mb-3">Tipos de conversiones disponibles</h3>
          <ul class="list-disc pl-6 mb-4">
            <li><strong>Longitud:</strong> Kilómetros, millas, metros, pies, pulgadas</li>
            <li><strong>Peso:</strong> Kilogramos, libras, gramos, onzas</li>
            <li><strong>Temperatura:</strong> Celsius, Fahrenheit, Kelvin</li>
            <li><strong>Volumen:</strong> Litros, galones, metros cúbicos</li>
            <li><strong>Área:</strong> Metros cuadrados, pies cuadrados, hectáreas</li>
            <li><strong>Velocidad:</strong> km/h, mph, m/s, nudos</li>
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

// Unit conversion data
const categories = [
  { key: 'length', name: 'Longitud' },
  { key: 'weight', name: 'Peso' },
  { key: 'temperature', name: 'Temperatura' },
  { key: 'volume', name: 'Volumen' },
  { key: 'area', name: 'Área' },
  { key: 'speed', name: 'Velocidad' }
]

const units = {
  length: [
    { key: 'mm', name: 'Milímetros', symbol: 'mm' },
    { key: 'cm', name: 'Centímetros', symbol: 'cm' },
    { key: 'm', name: 'Metros', symbol: 'm' },
    { key: 'km', name: 'Kilómetros', symbol: 'km' },
    { key: 'in', name: 'Pulgadas', symbol: 'in' },
    { key: 'ft', name: 'Pies', symbol: 'ft' },
    { key: 'yd', name: 'Yardas', symbol: 'yd' },
    { key: 'mi', name: 'Millas', symbol: 'mi' }
  ],
  weight: [
    { key: 'mg', name: 'Miligramos', symbol: 'mg' },
    { key: 'g', name: 'Gramos', symbol: 'g' },
    { key: 'kg', name: 'Kilogramos', symbol: 'kg' },
    { key: 't', name: 'Toneladas', symbol: 't' },
    { key: 'oz', name: 'Onzas', symbol: 'oz' },
    { key: 'lb', name: 'Libras', symbol: 'lb' }
  ],
  temperature: [
    { key: 'celsius', name: 'Celsius', symbol: '°C' },
    { key: 'fahrenheit', name: 'Fahrenheit', symbol: '°F' },
    { key: 'kelvin', name: 'Kelvin', symbol: 'K' }
  ],
  volume: [
    { key: 'ml', name: 'Mililitros', symbol: 'ml' },
    { key: 'l', name: 'Litros', symbol: 'L' },
    { key: 'm3', name: 'Metros cúbicos', symbol: 'm³' },
    { key: 'gal', name: 'Galones', symbol: 'gal' },
    { key: 'qt', name: 'Cuartos', symbol: 'qt' },
    { key: 'pt', name: 'Pintas', symbol: 'pt' }
  ],
  area: [
    { key: 'mm2', name: 'Milímetros cuadrados', symbol: 'mm²' },
    { key: 'cm2', name: 'Centímetros cuadrados', symbol: 'cm²' },
    { key: 'm2', name: 'Metros cuadrados', symbol: 'm²' },
    { key: 'ha', name: 'Hectáreas', symbol: 'ha' },
    { key: 'km2', name: 'Kilómetros cuadrados', symbol: 'km²' },
    { key: 'in2', name: 'Pulgadas cuadradas', symbol: 'in²' },
    { key: 'ft2', name: 'Pies cuadrados', symbol: 'ft²' },
    { key: 'ac', name: 'Acres', symbol: 'ac' }
  ],
  speed: [
    { key: 'mps', name: 'Metros por segundo', symbol: 'm/s' },
    { key: 'kmh', name: 'Kilómetros por hora', symbol: 'km/h' },
    { key: 'mph', name: 'Millas por hora', symbol: 'mph' },
    { key: 'knots', name: 'Nudos', symbol: 'kn' }
  ]
}

// Reactive data
const selectedCategory = ref('length')
const fromUnit = ref('km')
const toUnit = ref('mi')
const inputValue = ref(1)
const result = ref<number | null>(null)
const conversionHistory = ref<Array<{
  fromValue: number
  fromUnit: string
  toValue: number
  toUnit: string
}>>([])

// Computed properties
const availableUnits = computed(() => units[selectedCategory.value as keyof typeof units] || [])

// Methods
const convert = () => {
  if (inputValue.value === null || isNaN(inputValue.value)) {
    result.value = null
    return
  }

  const value = inputValue.value
  let convertedValue = 0

  switch (selectedCategory.value) {
    case 'length':
      convertedValue = convertLength(value, fromUnit.value, toUnit.value)
      break
    case 'weight':
      convertedValue = convertWeight(value, fromUnit.value, toUnit.value)
      break
    case 'temperature':
      convertedValue = convertTemperature(value, fromUnit.value, toUnit.value)
      break
    case 'volume':
      convertedValue = convertVolume(value, fromUnit.value, toUnit.value)
      break
    case 'area':
      convertedValue = convertArea(value, fromUnit.value, toUnit.value)
      break
    case 'speed':
      convertedValue = convertSpeed(value, fromUnit.value, toUnit.value)
      break
  }

  result.value = convertedValue

  // Add to history
  if (result.value !== null) {
    conversionHistory.value.unshift({
      fromValue: value,
      fromUnit: getUnitSymbol(fromUnit.value),
      toValue: result.value,
      toUnit: getUnitSymbol(toUnit.value)
    })

    // Keep only last 10 conversions
    if (conversionHistory.value.length > 10) {
      conversionHistory.value = conversionHistory.value.slice(0, 10)
    }
  }
}

const convertLength = (value: number, from: string, to: string): number => {
  // Convert to meters first
  let meters = 0
  switch (from) {
    case 'mm': meters = value / 1000; break
    case 'cm': meters = value / 100; break
    case 'm': meters = value; break
    case 'km': meters = value * 1000; break
    case 'in': meters = value * 0.0254; break
    case 'ft': meters = value * 0.3048; break
    case 'yd': meters = value * 0.9144; break
    case 'mi': meters = value * 1609.344; break
  }

  // Convert from meters to target unit
  switch (to) {
    case 'mm': return meters * 1000
    case 'cm': return meters * 100
    case 'm': return meters
    case 'km': return meters / 1000
    case 'in': return meters / 0.0254
    case 'ft': return meters / 0.3048
    case 'yd': return meters / 0.9144
    case 'mi': return meters / 1609.344
    default: return meters
  }
}

const convertWeight = (value: number, from: string, to: string): number => {
  // Convert to grams first
  let grams = 0
  switch (from) {
    case 'mg': grams = value / 1000; break
    case 'g': grams = value; break
    case 'kg': grams = value * 1000; break
    case 't': grams = value * 1000000; break
    case 'oz': grams = value * 28.3495; break
    case 'lb': grams = value * 453.592; break
  }

  // Convert from grams to target unit
  switch (to) {
    case 'mg': return grams * 1000
    case 'g': return grams
    case 'kg': return grams / 1000
    case 't': return grams / 1000000
    case 'oz': return grams / 28.3495
    case 'lb': return grams / 453.592
    default: return grams
  }
}

const convertTemperature = (value: number, from: string, to: string): number => {
  // Convert to Celsius first
  let celsius = 0
  switch (from) {
    case 'celsius': celsius = value; break
    case 'fahrenheit': celsius = (value - 32) * 5/9; break
    case 'kelvin': celsius = value - 273.15; break
  }

  // Convert from Celsius to target unit
  switch (to) {
    case 'celsius': return celsius
    case 'fahrenheit': return celsius * 9/5 + 32
    case 'kelvin': return celsius + 273.15
    default: return celsius
  }
}

const convertVolume = (value: number, from: string, to: string): number => {
  // Convert to liters first
  let liters = 0
  switch (from) {
    case 'ml': liters = value / 1000; break
    case 'l': liters = value; break
    case 'm3': liters = value * 1000; break
    case 'gal': liters = value * 3.78541; break
    case 'qt': liters = value * 0.946353; break
    case 'pt': liters = value * 0.473176; break
  }

  // Convert from liters to target unit
  switch (to) {
    case 'ml': return liters * 1000
    case 'l': return liters
    case 'm3': return liters / 1000
    case 'gal': return liters / 3.78541
    case 'qt': return liters / 0.946353
    case 'pt': return liters / 0.473176
    default: return liters
  }
}

const convertArea = (value: number, from: string, to: string): number => {
  // Convert to square meters first
  let sqMeters = 0
  switch (from) {
    case 'mm2': sqMeters = value / 1000000; break
    case 'cm2': sqMeters = value / 10000; break
    case 'm2': sqMeters = value; break
    case 'ha': sqMeters = value * 10000; break
    case 'km2': sqMeters = value * 1000000; break
    case 'in2': sqMeters = value * 0.00064516; break
    case 'ft2': sqMeters = value * 0.092903; break
    case 'ac': sqMeters = value * 4046.86; break
  }

  // Convert from square meters to target unit
  switch (to) {
    case 'mm2': return sqMeters * 1000000
    case 'cm2': return sqMeters * 10000
    case 'm2': return sqMeters
    case 'ha': return sqMeters / 10000
    case 'km2': return sqMeters / 1000000
    case 'in2': return sqMeters / 0.00064516
    case 'ft2': return sqMeters / 0.092903
    case 'ac': return sqMeters / 4046.86
    default: return sqMeters
  }
}

const convertSpeed = (value: number, from: string, to: string): number => {
  // Convert to meters per second first
  let mps = 0
  switch (from) {
    case 'mps': mps = value; break
    case 'kmh': mps = value / 3.6; break
    case 'mph': mps = value * 0.44704; break
    case 'knots': mps = value * 0.514444; break
  }

  // Convert from meters per second to target unit
  switch (to) {
    case 'mps': return mps
    case 'kmh': return mps * 3.6
    case 'mph': return mps / 0.44704
    case 'knots': return mps / 0.514444
    default: return mps
  }
}

const getUnitSymbol = (unitKey: string): string => {
  const unit = availableUnits.value.find(u => u.key === unitKey)
  return unit ? unit.symbol : unitKey
}

const formatNumber = (num: number): string => {
  if (Math.abs(num) < 0.000001 || Math.abs(num) > 999999999) {
    return num.toExponential(4)
  }
  return num.toLocaleString('es-ES', { 
    maximumFractionDigits: 6,
    minimumFractionDigits: 0
  })
}

const swapUnits = () => {
  [fromUnit.value, toUnit.value] = [toUnit.value, fromUnit.value]
  convert()
}

const clearAll = () => {
  inputValue.value = 1
  result.value = null
}

const setQuickConversion = (category: string, from: string, to: string, value: number) => {
  selectedCategory.value = category
  fromUnit.value = from
  toUnit.value = to
  inputValue.value = value
  convert()
}

const repeatConversion = (conversion: any) => {
  // Find the unit keys from the symbols
  const fromUnitKey = availableUnits.value.find(u => u.symbol === conversion.fromUnit)?.key
  const toUnitKey = availableUnits.value.find(u => u.symbol === conversion.toUnit)?.key
  
  if (fromUnitKey && toUnitKey) {
    fromUnit.value = fromUnitKey
    toUnit.value = toUnitKey
    inputValue.value = conversion.fromValue
    convert()
  }
}

const copyResult = async () => {
  if (result.value === null) return

  const text = `${inputValue.value} ${getUnitSymbol(fromUnit.value)} = ${formatNumber(result.value)} ${getUnitSymbol(toUnit.value)}`
  
  try {
    await navigator.clipboard.writeText(text)
  } catch (err) {
    // Fallback for older browsers
    const textArea = document.createElement('textarea')
    textArea.value = text
    document.body.appendChild(textArea)
    textArea.select()
    document.execCommand('copy')
    document.body.removeChild(textArea)
  }
}

// Watch for changes and convert automatically
watch([selectedCategory, fromUnit, toUnit, inputValue], convert, { immediate: true })

// Set initial units when category changes
watch(selectedCategory, () => {
  if (availableUnits.value.length >= 2) {
    fromUnit.value = availableUnits.value[0].key
    toUnit.value = availableUnits.value[1].key
  }
})
</script>
