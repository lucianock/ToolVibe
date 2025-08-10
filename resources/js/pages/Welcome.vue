<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'

// Define props
defineProps<{
  meta?: {
    title: string
    description: string
    keywords: string
    url: string
  }
}>()
</script>

<template>
    <Head title="ToolVibe - Herramientas Online Gratuitas" />
    
    <div class="min-h-screen bg-background">
        <!-- Header -->
        <header class="sticky top-0 z-50 w-full border-b bg-background/80 backdrop-blur-md supports-[backdrop-filter]:bg-background/60">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <!-- Logo mejorado -->
                        <div class="flex items-center space-x-2">
                            <div class="relative">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></div>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                                    ToolVibe
                                </h1>
                                <p class="text-xs text-muted-foreground -mt-1">Herramientas Pro</p>
                            </div>
                        </div>
                    </div>
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="#herramientas" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors hover:scale-105 transform">
                            Herramientas
                        </a>
                        <a href="#features" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors hover:scale-105 transform">
                            Características
                        </a>
                        <a href="#about" class="text-sm font-medium text-muted-foreground hover:text-primary transition-colors hover:scale-105 transform">
                            Acerca de
                        </a>
                        <Button asChild size="sm" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white border-0 shadow-lg hover:shadow-xl transition-all">
                            <Link href="/tools/qr">Comenzar Gratis</Link>
                        </Button>
            </nav>
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <Button variant="ghost" size="sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </Button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-blue-900/20 dark:to-purple-900/20">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-grid-black/[0.02] -z-10"></div>
            <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
            
            <div class="relative pt-8 pb-24 lg:pt-12 lg:pb-32">
                <div class="container mx-auto px-4">
                    <div class="text-center max-w-4xl mx-auto">
                        <!-- Badge -->
                        <div class="inline-flex items-center rounded-full px-3 py-1 text-sm bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 dark:from-blue-900/50 dark:to-purple-900/50 dark:text-blue-300 mb-8 border border-blue-200/50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Herramientas 100% Gratuitas
                        </div>
                        
                        <!-- Main Heading -->
                        <h1 class="text-5xl lg:text-7xl font-bold mb-8 leading-tight">
                            <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                                Herramientas Online
                                </span>
                            <br />
                            <span class="text-gray-900 dark:text-white">
                                Para Todo Lo Que Necesitas
                            </span>
                        </h1>
                        
                        <!-- Subtitle -->
                        <p class="text-xl lg:text-2xl text-gray-600 dark:text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                            Potencia tu productividad con nuestra suite de herramientas profesionales. 
                            <span class="font-semibold text-purple-600">Genera códigos QR</span>, 
                            <span class="font-semibold text-blue-600">calcula tu IMC</span>, 
                            <span class="font-semibold text-pink-600">gestiona fechas</span> y 
                            <span class="font-semibold text-green-600">crea contraseñas seguras</span>.
                        </p>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                            <Button asChild size="lg" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white border-0 shadow-2xl hover:shadow-purple-500/25 px-8 py-4 text-lg font-semibold rounded-2xl transform hover:scale-105 transition-all duration-300">
                                <Link href="/tools/qr">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    Comenzar Gratis
                                </Link>
                            </Button>
                            <Button variant="outline" size="lg" asChild class="border-2 border-purple-200 hover:border-purple-300 px-8 py-4 text-lg font-semibold rounded-2xl hover:bg-purple-50 dark:border-purple-700 dark:hover:bg-purple-900/20 transform hover:scale-105 transition-all duration-300">
                                <a href="#herramientas">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                    Explorar Herramientas
                                </a>
                            </Button>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-2xl mx-auto">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600 mb-2">4</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Herramientas</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600 mb-2">100%</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Gratuito</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-pink-600 mb-2">0</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Registro</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600 mb-2">∞</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Sin Límites</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tools Section -->
        <section id="herramientas" class="py-20 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-blue-900/20 dark:to-purple-900/20 relative overflow-hidden">
            <div class="absolute inset-0 bg-grid-black/[0.02] -z-10"></div>
            <div class="absolute top-0 -left-4 w-40 h-40 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-40 h-40 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-6 left-20 w-40 h-40 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
            
            <div class="container mx-auto px-4 relative">
                <div class="text-center max-w-4xl mx-auto">
                    
                    
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">Nuestras Herramientas</span>
                        <span class="text-gray-900 dark:text-white"> Profesionales</span>
                    </h2>
                    
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-12 leading-relaxed">
                        Descubre nuestra colección de herramientas online diseñadas para simplificar tus tareas diarias y potenciar tu productividad.
                    </p>
                    
                    <div class="flex flex-wrap justify-center gap-4 mb-8">
                        <Button asChild size="lg" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white border-0 shadow-2xl hover:shadow-purple-500/25 px-8 py-4 text-lg font-semibold rounded-2xl transform hover:scale-105 transition-all duration-300">
                            <Link href="/tools/qr">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                Explorar Herramientas
                            </Link>
                        </Button>
                    </div>
                    
                    <!-- Tool Navigation Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                        <!-- Generador QR -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border-2 border-blue-200 dark:border-blue-700 text-blue-700 dark:text-blue-300 hover:bg-gradient-to-br hover:from-blue-100 hover:to-blue-200 dark:hover:from-blue-800/30 dark:hover:to-blue-700/30 hover:border-blue-300 dark:hover:border-blue-600 hover:text-blue-800 dark:hover:text-blue-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/qr" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-3.99M12 12V8.01"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Generador QR</span>
                                    <span class="text-sm text-blue-600 dark:text-blue-400 mt-1">Códigos QR instantáneos</span>
                                </Link>
                            </Button>
                        </div>
                        
                        <!-- Calculadora IMC -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border-2 border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 hover:bg-gradient-to-br hover:from-green-100 hover:to-green-200 dark:hover:from-green-800/30 dark:hover:to-green-700/30 hover:border-green-300 dark:hover:border-green-600 hover:text-green-800 dark:hover:text-green-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/bmi" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Calculadora IMC</span>
                                    <span class="text-sm text-green-600 dark:text-green-400 mt-1">Salud y bienestar</span>
                                </Link>
                            </Button>
                        </div>
                        
                        <!-- Calculadora de Fechas -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 border-2 border-purple-200 dark:border-purple-700 text-purple-700 dark:text-purple-300 hover:bg-gradient-to-br hover:from-purple-100 hover:to-purple-200 dark:hover:from-purple-800/30 dark:hover:to-purple-700/30 hover:border-purple-300 dark:hover:border-purple-600 hover:text-purple-800 dark:hover:text-purple-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/date-calculator" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Calculadora de Fechas</span>
                                    <span class="text-sm text-purple-600 dark:text-purple-400 mt-1">Gestión de tiempo</span>
                                </Link>
                            </Button>
                        </div>
                        
                        <!-- Generador de Contraseñas -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-pink-50 to-pink-100 dark:from-pink-900/20 dark:to-pink-800/20 border-2 border-pink-200 dark:border-pink-700 text-pink-700 dark:text-pink-300 hover:bg-gradient-to-br hover:from-pink-100 hover:to-pink-200 dark:hover:from-pink-800/30 dark:hover:to-pink-700/30 hover:border-pink-300 dark:hover:border-pink-600 hover:text-pink-800 dark:hover:text-pink-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/password-generator" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v6a2 2 0 00-2-2H6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Generador de Contraseñas</span>
                                    <span class="text-sm text-pink-600 dark:text-pink-400 mt-1">Seguridad máxima</span>
                                </Link>
                            </Button>
                        </div>

                        <!-- Calculadora de Tiempo -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 border-2 border-orange-200 dark:border-orange-700 text-orange-700 dark:text-orange-300 hover:bg-gradient-to-br hover:from-orange-100 hover:to-orange-200 dark:hover:from-orange-800/30 dark:hover:to-orange-700/30 hover:border-orange-300 dark:hover:border-orange-600 hover:text-orange-800 dark:hover:text-orange-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/time-calculator" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Calculadora de Tiempo</span>
                                    <span class="text-sm text-orange-600 dark:text-orange-400 mt-1">Gestión temporal</span>
                                </Link>
                            </Button>
                        </div>

                        <!-- Generador de Colores -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 border-2 border-indigo-200 dark:border-indigo-700 text-indigo-700 dark:text-indigo-300 hover:bg-gradient-to-br hover:from-indigo-100 hover:to-indigo-200 dark:hover:from-indigo-800/30 dark:hover:to-indigo-700/30 hover:border-indigo-300 dark:hover:border-indigo-600 hover:text-indigo-800 dark:hover:text-indigo-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/color-generator" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Generador de Colores</span>
                                    <span class="text-sm text-indigo-600 dark:text-indigo-400 mt-1">Paletas creativas</span>
                                </Link>
                            </Button>
                        </div>

                        <!-- Calculadora de Porcentajes -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-teal-50 to-teal-100 dark:from-teal-900/20 dark:to-teal-800/20 border-2 border-teal-200 dark:border-teal-700 text-teal-700 dark:text-teal-300 hover:bg-gradient-to-br hover:from-teal-100 hover:to-teal-200 dark:hover:from-teal-800/30 dark:hover:to-teal-700/30 hover:border-teal-300 dark:hover:border-teal-600 hover:text-teal-800 dark:hover:text-teal-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/percentage-calculator" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Calculadora de Porcentajes</span>
                                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-1">Cálculos precisos</span>
                                </Link>
                            </Button>
                        </div>

                        <!-- Convertidor de Unidades -->
                        <div class="group">
                            <Button asChild variant="outline" size="lg" class="w-full h-32 bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/20 border-2 border-amber-200 dark:border-amber-700 text-amber-700 dark:text-amber-300 hover:bg-gradient-to-br hover:from-amber-100 hover:to-amber-200 dark:hover:from-amber-800/30 dark:hover:to-amber-700/30 hover:border-amber-300 dark:hover:border-amber-600 hover:text-amber-800 dark:hover:text-amber-200 transition-all duration-300 px-6 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transform">
                                <Link href="/tools/unit-converter" class="flex flex-col items-center justify-center h-full">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mb-2 group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-base">Convertidor de Unidades</span>
                                    <span class="text-sm text-amber-600 dark:text-amber-400 mt-1">Conversiones universales</span>
                                </Link>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-gradient-to-br from-gray-50 via-white to-blue-50 dark:from-gray-800 dark:via-gray-900 dark:to-blue-900/20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                            ¿Por qué elegir ToolVibe?
                            </span>
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Características premium que nos hacen la mejor opción para tus proyectos
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-12 max-w-6xl mx-auto">
                    <div class="text-center group">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Ultra Rápido</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Herramientas optimizadas con tecnología de vanguardia que procesan tus datos al instante sin esperas
                        </p>
                    </div>

                    <div class="text-center group">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">100% Seguro</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Procesamiento local garantizado. Tu información nunca sale de tu dispositivo y no almacenamos datos personales
                        </p>
                    </div>

                    <div class="text-center group">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Completamente Gratis</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Todas las herramientas premium sin restricciones, sin registros y sin límites de uso. Para siempre
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-20 bg-white dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-8">
                        <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                            Acerca de ToolVibe
                        </span>
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-8">
                        ToolVibe nació de la necesidad de tener herramientas web rápidas, seguras y completamente gratuitas. 
                        Nuestro compromiso es ofrecerte las mejores utilidades online sin complicaciones, sin registros y sin límites.
                    </p>
                    <div class="grid md:grid-cols-2 gap-8 mt-12">
                        <div class="text-left">
                            <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Nuestra Misión</h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Democratizar el acceso a herramientas digitales profesionales, eliminando barreras y 
                                proporcionando soluciones instantáneas para las necesidades cotidianas.
                            </p>
                        </div>
                        <div class="text-left">
                            <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Nuestra Visión</h3>
                            <p class="text-gray-600 dark:text-gray-300">
                                Ser la plataforma de referencia mundial para herramientas web gratuitas, 
                                combinando simplicidad, velocidad y la más alta calidad en cada funcionalidad.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

                <!-- Footer -->
        <footer class="bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 text-white">
            <div class="container mx-auto px-4 py-12">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Logo y descripción -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                                ToolVibe
                            </h3>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            La suite de herramientas online más completa y gratuita. Potencia tu productividad 
                            con nuestras utilidades profesionales diseñadas para simplificar tu vida digital.
                        </p>
                        <div class="flex space-x-4">
                            <!-- <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a> -->
                        </div>
                    </div>
                    
                    <!-- Herramientas -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Herramientas</h4>
                        <ul class="space-y-2">
                            <li><Link href="/tools/qr" class="text-gray-300 hover:text-white transition-colors">Generador QR</Link></li>
                            <li><Link href="/tools/bmi" class="text-gray-300 hover:text-white transition-colors">Calculadora IMC</Link></li>
                            <li><Link href="/tools/date-calculator" class="text-gray-300 hover:text-white transition-colors">Calculadora Fechas</Link></li>
                            <li><Link href="/tools/password-generator" class="text-gray-300 hover:text-white transition-colors">Generador Contraseñas</Link></li>
                        </ul>
                    </div>
                    
                    <!-- Enlaces -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Enlaces</h4>
                        <ul class="space-y-2">
                            <li><a href="#herramientas" class="text-gray-300 hover:text-white transition-colors">Todas las Herramientas</a></li>
                            <li><a href="#features" class="text-gray-300 hover:text-white transition-colors">Características</a></li>
                            <li><a href="#about" class="text-gray-300 hover:text-white transition-colors">Acerca de</a></li>
                            <li><a href="/sitemap.xml" class="text-gray-300 hover:text-white transition-colors">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-white/10 mt-8 pt-8 text-center">
                    <p class="text-gray-300">
                        &copy; 2025 <span class="font-semibold">ToolVibe</span>. Hecho con ❤️ para la comunidad. 
                        Todos los derechos reservados.
                    </p>
                </div>
        </div>
        </footer>
    </div>
</template>