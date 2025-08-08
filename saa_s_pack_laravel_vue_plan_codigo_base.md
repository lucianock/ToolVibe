# Proyecto SaaS Pack — Laravel + Vue (Requerimientos de desarrollo)

## Objetivo

Construir un SaaS de herramientas online (sin login) optimizado para SEO y con interactividad en Vue.

## Requerimientos funcionales

1. Implementar herramienta **Generador de QR** (server-side con PNG).
2. Implementar herramienta **Calculadora IMC** (client-side).
3. Implementar herramienta **Calculadora de días entre fechas** (client-side).
4. Implementar herramienta **Generador de contraseñas seguras** (client-side).

## Requerimientos técnicos

* **Backend:** Laravel 10, PHP 8.1+, Composer.
* **Frontend:** Vue 3.
* **Base de datos:** No requerida en esta fase.

## Estructura del proyecto

* `routes/web.php` → rutas públicas.
* `app/Http/Controllers` → controladores por herramienta.
* `resources/views` → vistas Blade con contenido indexable.
* `resources/js/components` → componentes Vue.

## Requerimientos SEO

* URLs limpias: `/tools/qr`, `/tools/imc`, etc.
* Meta tags dinámicos en cada herramienta.
* Sitemap dinámico (`/sitemap.xml`).
* `robots.txt` configurado.
* OpenGraph y Twitter Cards en cada página.
* Texto descriptivo y keywords relevantes.

## Otros requerimientos

* Integrar Google Analytics (script en layout).
* Integrar Search Console (meta tag en `<head>`).
* Optimizar imágenes y minificar assets.
* Limpiar código antes de entrega.

---

**Instrucción:** Desarrollar la aplicación cumpliendo todos los requerimientos anteriores, asegurando que cada funcionalidad esté completa, probada y documentada.
