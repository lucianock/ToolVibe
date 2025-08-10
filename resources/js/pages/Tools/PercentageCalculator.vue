<template>
  <ToolsLayout title="Calculadora de Porcentajes" subtitle="Calcula porcentajes, descuentos, aumentos, propinas y división de cuentas fácilmente.">

    <!-- Main Content -->
    <main id="tool-main" class="container mx-auto px-4 py-6">

      <div class="grid lg:grid-cols-2 gap-8">
        <!-- Calculator Form -->
        <Card class="relative bg-white dark:bg-gray-800 border-0 shadow-xl rounded-3xl overflow-hidden">
          <CardHeader>
            <CardTitle>Calculadora de Porcentajes</CardTitle>
            <CardDescription>
              Selecciona el tipo de cálculo que necesitas
            </CardDescription>
          </CardHeader>
          <CardContent class="card-content-forms">
            <div class="form-group">
              <!-- Calculation Type -->
              <div class="form-field">
                <Label for="calcType" class="form-label">Tipo de Cálculo</Label>
                <select
                  id="calcType"
                  v-model="calcType"
                  class="form-select"
                >
                  <option value="percentage">Calcular Porcentaje</option>
                  <option value="discount">Calcular Descuento</option>
                  <option value="increase">Calcular Aumento</option>
                  <option value="tip">Calcular Propina</option>
                  <option value="split">Dividir Cuenta</option>
                  <option value="tax">Calcular Impuesto</option>
                </select>
              </div>

              <!-- Dynamic Form Fields -->
              <div v-if="calcType === 'percentage'" class="form-group">
                <div class="form-field">
                  <Label for="part" class="form-label">Parte</Label>
                  <input
                    id="part"
                    v-model.number="values.part"
                    type="number"
                    step="0.01"
                    class="form-input"
                    placeholder="Valor de la parte"
                  />
                </div>
                <div class="form-field">
                  <Label for="total" class="form-label">Total</Label>
                  <input
                    id="total"
                    v-model.number="values.total"
                    type="number"
                    step="0.01"
                    class="form-input"
                    placeholder="Valor total"
                  />
                </div>
              </div>

              <div v-if="calcType === 'discount'" class="form-group">
                <div class="form-field">
                  <Label for="originalPrice" class="form-label">Precio Original</Label>
                  <input
                    id="originalPrice"
                    v-model.number="values.originalPrice"
                    type="number"
                    step="0.01"
                    class="form-input"
                    placeholder="Precio sin descuento"
                  />
                </div>
                <div class="form-field">
                  <Label for="discountPercent" class="form-label">Porcentaje de Descuento</Label>
                  <input
                    id="discountPercent"
                    v-model.number="values.discountPercent"
                    type="number"
                    step="0.01"
                    min="0"
                    max="100"
                    class="form-input"
                    placeholder="% de descuento"
                  />
                </div>
              </div>

              <div v-if="calcType === 'increase'" class="form-group">
                <div class="form-field">
                  <Label for="originalValue" class="form-label">Valor Original</Label>
                  <input
                    id="originalValue"
                    v-model.number="values.originalValue"
                    type="number"
                    step="0.01"
                    class="form-input"
                    placeholder="Valor sin aumento"
                  />
                </div>
                <div class="form-field">
                  <Label for="increasePercent" class="form-label">Porcentaje de Aumento</Label>
                  <input
                    id="increasePercent"
                    v-model.number="values.increasePercent"
                    type="number"
                    step="0.01"
                    min="0"
                    class="form-input"
                    placeholder="% de aumento"
                  />
                </div>
              </div>

              <div v-if="calcType === 'tip'" class="form-group">
                <div class="form-field">
                  <Label for="billAmount" class="form-label">Monto de la Cuenta</Label>
                  <input
                    id="billAmount"
                    v-model.number="values.billAmount"
                    type="number"
                    step="0.01"
                    class="form-input"
                    placeholder="Total de la cuenta"
                  />
                </div>
                <div class="form-field">
                  <Label for="tipPercent" class="form-label">Porcentaje de Propina</Label>
                  <input
                    id="tipPercent"
                    v-model.number="values.tipPercent"
                    type="number"
                    step="0.01"
                    min="0"
                    class="form-input"
                    placeholder="% de propina"
                  />
                </div>
                <div class="form-field">
                  <Label for="peopleCount" class="form-label">Número de Personas</Label>
                  <input
                    id="peopleCount"
                    v-model.number="values.peopleCount"
                    type="number"
                    min="1"
                    class="form-input"
                    placeholder="Cantidad de personas"
                  />
                </div>
              </div>

              <div v-if="calcType === 'split'" class="form-group">
                <div class="form-field">
                  <Label for="totalAmount" class="form-label">Monto Total</Label>
                  <input
                    id="totalAmount"
                    v-model.number="values.totalAmount"
                    type="number"
                    step="0.01"
                    class="form-input"
                    placeholder="Total a dividir"
                  />
                </div>
                <div class="form-field">
                  <Label for="splitCount" class="form-label">Número de Personas</Label>
                  <input
                    id="splitCount"
                    v-model.number="values.splitCount"
                    type="number"
                    min="1"
                    class="form-input"
                    placeholder="Cantidad de personas"
                  />
                </div>
              </div>

              <div v-if="calcType === 'tax'" class="form-group">
                <div class="form-field">
                  <Label for="subtotal" class="form-label">Subtotal</Label>
                  <input
                    id="subtotal"
                    v-model.number="values.subtotal"
                    type="number"
                    step="0.01"
                    class="form-input"
                    placeholder="Subtotal sin impuestos"
                  />
                </div>
                <div class="form-field">
                  <Label for="taxRate" class="form-label">Tasa de Impuesto (%)</Label>
                  <input
                    id="taxRate"
                    v-model.number="values.taxRate"
                    type="number"
                    step="0.01"
                    min="0"
                    class="form-input"
                    placeholder="% de impuesto"
                  />
                </div>
              </div>

              <!-- Calculate Button -->
              <Button @click="calculate" class="w-full bg-gradient-to-r from-emerald-500 to-cyan-600 hover:from-emerald-600 hover:to-cyan-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
                Calcular
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
                    {{ formatCurrency(result.finalAmount) }}
                  </div>
                  <div class="text-sm text-muted-foreground">
                    {{ result.description }}
                  </div>
                </div>

                <!-- Detailed Breakdown -->
                <div class="space-y-2 text-sm">
                  <div v-if="result.breakdown" class="space-y-1">
                    <div v-for="(item, key) in result.breakdown" :key="key" class="flex justify-between">
                      <span>{{ item.label }}:</span>
                      <span class="font-medium">{{ formatCurrency(item.value) }}</span>
                    </div>
                  </div>
                </div>

                <!-- Copy Result -->
                <Button @click="copyResult" class="w-full bg-gradient-to-r from-emerald-500 to-cyan-600 hover:from-emerald-600 hover:to-cyan-700 text-white border-0 rounded-xl py-3 font-semibold shadow-lg hover:shadow-xl transition-all">
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
                <Button @click="setQuickCalc('tip', { billAmount: 50, tipPercent: 15, peopleCount: 2 })" variant="outline" size="sm">
                  Propina 15% $50
                </Button>
                <Button @click="setQuickCalc('discount', { originalPrice: 100, discountPercent: 20 })" variant="outline" size="sm">
                  Descuento 20% $100
                </Button>
                <Button @click="setQuickCalc('split', { totalAmount: 75, splitCount: 3 })" variant="outline" size="sm">
                  Dividir $75 entre 3
                </Button>
                <Button @click="setQuickCalc('tax', { subtotal: 200, taxRate: 8.5 })" variant="outline" size="sm">
                  Impuesto 8.5% $200
                </Button>
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
                <p v-if="calcType === 'tip'">
                  💡 <strong>Propinas:</strong> 15-20% es estándar en restaurantes
                </p>
                <p v-if="calcType === 'discount'">
                  💡 <strong>Descuentos:</strong> Calcula el precio final después de rebajas
                </p>
                <p v-if="calcType === 'tax'">
                  💡 <strong>Impuestos:</strong> Agrega la tasa fiscal al subtotal
                </p>
                <p v-if="calcType === 'split'">
                  💡 <strong>División:</strong> Divide gastos equitativamente entre personas
                </p>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>

      <!-- SEO Content (collapsible) -->
      <details class="mt-8 group">
        <summary class="cursor-pointer select-none text-sm text-muted-foreground hover:text-foreground">Información sobre cálculos de porcentajes</summary>
        <div class="mt-4 prose prose-gray max-w-none">
          <h2 class="text-2xl font-bold mb-4">¿Por qué usar una calculadora de porcentajes?</h2>
          <p class="mb-4">Calcula porcentajes de forma rápida y precisa para diferentes situaciones cotidianas.</p>
          <h3 class="text-xl font-semibold mb-3">Tipos de cálculos disponibles</h3>
          <ul class="list-disc pl-6 mb-4">
            <li><strong>Porcentaje:</strong> Calcula qué porcentaje representa una parte del total</li>
            <li><strong>Descuento:</strong> Calcula el precio final después de aplicar un descuento</li>
            <li><strong>Aumento:</strong> Calcula el valor final después de aplicar un incremento</li>
            <li><strong>Propina:</strong> Calcula propinas y división de cuentas</li>
            <li><strong>División:</strong> Divide gastos equitativamente entre personas</li>
            <li><strong>Impuesto:</strong> Calcula impuestos sobre subtotales</li>
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
const calcType = ref('percentage')
const values = ref({
  part: null as number | null,
  total: null as number | null,
  originalPrice: null as number | null,
  discountPercent: null as number | null,
  originalValue: null as number | null,
  increasePercent: null as number | null,
  billAmount: null as number | null,
  tipPercent: null as number | null,
  peopleCount: null as number | null,
  totalAmount: null as number | null,
  splitCount: null as number | null,
  subtotal: null as number | null,
  taxRate: null as number | null
})

const result = ref<any>(null)
const calculationHistory = ref<Array<{
  type: string
  description: string
  values: any
  result: any
}>>([])

// Methods
const calculate = () => {
  let calculationResult = null

  switch (calcType.value) {
    case 'percentage':
      if (values.value.part !== null && values.value.total !== null) {
        const percentage = (values.value.part / values.value.total) * 100
        calculationResult = {
          finalAmount: percentage,
          description: `${values.value.part} es el ${percentage.toFixed(2)}% de ${values.value.total}`,
          breakdown: {
            part: { label: 'Parte', value: values.value.part },
            total: { label: 'Total', value: values.value.total },
            percentage: { label: 'Porcentaje', value: percentage }
          }
        }
      }
      break

    case 'discount':
      if (values.value.originalPrice !== null && values.value.discountPercent !== null) {
        const discountAmount = (values.value.originalPrice * values.value.discountPercent) / 100
        const finalPrice = values.value.originalPrice - discountAmount
        calculationResult = {
          finalAmount: finalPrice,
          description: `Precio final con ${values.value.discountPercent}% de descuento`,
          breakdown: {
            original: { label: 'Precio original', value: values.value.originalPrice },
            discount: { label: 'Descuento', value: discountAmount },
            final: { label: 'Precio final', value: finalPrice }
          }
        }
      }
      break

    case 'increase':
      if (values.value.originalValue !== null && values.value.increasePercent !== null) {
        const increaseAmount = (values.value.originalValue * values.value.increasePercent) / 100
        const finalValue = values.value.originalValue + increaseAmount
        calculationResult = {
          finalAmount: finalValue,
          description: `Valor final con ${values.value.increasePercent}% de aumento`,
          breakdown: {
            original: { label: 'Valor original', value: values.value.originalValue },
            increase: { label: 'Aumento', value: increaseAmount },
            final: { label: 'Valor final', value: finalValue }
          }
        }
      }
      break

    case 'tip':
      if (values.value.billAmount !== null && values.value.tipPercent !== null && values.value.peopleCount !== null) {
        const tipAmount = (values.value.billAmount * values.value.tipPercent) / 100
        const totalWithTip = values.value.billAmount + tipAmount
        const perPerson = totalWithTip / values.value.peopleCount
        calculationResult = {
          finalAmount: perPerson,
          description: `$${perPerson.toFixed(2)} por persona (incluye propina)`,
          breakdown: {
            bill: { label: 'Cuenta', value: values.value.billAmount },
            tip: { label: 'Propina', value: tipAmount },
            total: { label: 'Total con propina', value: totalWithTip },
            perPerson: { label: 'Por persona', value: perPerson }
          }
        }
      }
      break

    case 'split':
      if (values.value.totalAmount !== null && values.value.splitCount !== null) {
        const perPerson = values.value.totalAmount / values.value.splitCount
        calculationResult = {
          finalAmount: perPerson,
          description: `$${perPerson.toFixed(2)} por persona`,
          breakdown: {
            total: { label: 'Total', value: values.value.totalAmount },
            people: { label: 'Personas', value: values.value.splitCount },
            perPerson: { label: 'Por persona', value: perPerson }
          }
        }
      }
      break

    case 'tax':
      if (values.value.subtotal !== null && values.value.taxRate !== null) {
        const taxAmount = (values.value.subtotal * values.value.taxRate) / 100
        const totalWithTax = values.value.subtotal + taxAmount
        calculationResult = {
          finalAmount: totalWithTax,
          description: `Total con ${values.value.taxRate}% de impuesto`,
          breakdown: {
            subtotal: { label: 'Subtotal', value: values.value.subtotal },
            tax: { label: 'Impuesto', value: taxAmount },
            total: { label: 'Total con impuesto', value: totalWithTax }
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

const formatCurrency = (amount: number): string => {
  return new Intl.NumberFormat('es-ES', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(amount)
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

  const text = `${result.value.description}\n${Object.entries(result.value.breakdown || {}).map(([key, item]: [string, any]) => `${item.label}: ${formatCurrency(item.value)}`).join('\n')}`
  
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

// Initialize with default values
values.value.part = 25
values.value.total = 100
</script>
