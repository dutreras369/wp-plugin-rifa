# Rifa Virtual Espacios

**Versión:** 1.0  
**Autor:** Tu Nombre  
**Descripción:** Plugin para gestionar rifas virtuales en WordPress, permitiendo a los usuarios seleccionar números de rifas, realizar pagos y ver los resultados del sorteo.

## Funcionalidades Principales

1. **Custom Post Type (CPT) de Rifas**: 
   - Se crea un nuevo tipo de contenido personalizado para gestionar rifas.
   - Cada rifa tiene campos personalizados como: cantidad de números, precio por número, fecha de inicio y fin, y estado (activa/inactiva).

2. **Metaboxes Personalizados**: 
   - Los administradores pueden definir la cantidad de números disponibles, el precio de cada número, la fecha de inicio y fin de la rifa, y una descripción del premio.

3. **Formulario de Compra Interactivo**: 
   - Los usuarios pueden seleccionar un número de rifa en un formulario interactivo con **AJAX**.
   - Los números se bloquean automáticamente tras la compra.

4. **Integración con WebPay o WooCommerce**: 
   - Los pagos se procesan a través de WebPay o WooCommerce.
   - Después de un pago exitoso, el número elegido por el usuario es bloqueado y registrado.

5. **Historial de Compras**:
   - Los administradores pueden ver un historial de los números comprados, los usuarios que compraron y el estado de los pagos.

6. **Emails Automáticos**: 
   - El plugin envía correos electrónicos automáticos de confirmación de compra a los usuarios.
   - Se pueden programar recordatorios antes de la fecha del sorteo.

7. **Página de Resultados**:
   - Una vez finalizada la rifa, los resultados se pueden mostrar en una página dedicada con el número ganador y el nombre del ganador.

## Instalación

1. Descarga y sube la carpeta del plugin a tu directorio `wp-content/plugins/` o instálalo directamente desde el panel de administración de WordPress.
2. Activa el plugin a través del menú `Plugins` en WordPress.
3. Configura el plugin desde el menú `Rifas Virtuales` que aparece en el panel de administración.

## Uso del Plugin

### Crear una Nueva Rifa

1. Navega a `Rifas Virtuales -> Añadir Nueva`.
2. Completa los detalles de la rifa:
   - **Cantidad de números**: Define cuántos números estarán disponibles para la rifa.
   - **Precio por número**: Establece el precio de cada número.
   - **Fecha de inicio y fin**: Configura las fechas de duración de la rifa.
   - **Descripción del premio**: Añade detalles sobre el premio de la rifa.
3. Publica la rifa.

### Mostrar Rifas en el Frontend

Para mostrar las rifas en el frontend de tu sitio, utiliza el siguiente shortcode:


Reemplaza `ID_DE_RIFA` con el ID de la rifa que quieras mostrar.

[rifa_display id="ID_DE_RIFA"]


### Página de Resultados

Después de que una rifa haya finalizado, utiliza este shortcode para mostrar los resultados:

[rifa_resultados id="ID_DE_RIFA"]


Reemplaza `ID_DE_RIFA` con el ID de la rifa cuyos resultados quieras mostrar.

## Integración con WebPay

Para habilitar la pasarela de pago de WebPay:

1. Configura tus credenciales de WebPay en `Rifas Virtuales -> Configuración`.
2. Los pagos se procesarán automáticamente cuando un usuario compre un número.

## Personalización

### Estilos y Scripts

Puedes personalizar los estilos del frontend y backend editando los archivos **SCSS** o **CSS** dentro del directorio `assets/`. 

Los estilos y scripts principales se encuentran en:
- **Frontend CSS:** `assets/css/style.css`
- **Backend CSS:** `assets/css/admin-style.css`
- **Frontend JS:** `assets/js/rifa.js`
- **Backend JS:** `assets/js/admin-scripts.js`

## Desarrollo

### Estructura del Plugin

/rifa-virtual-espacios/
├── assets/
│   ├── css/
│   │   ├── style.css            # Estilos del frontend
│   │   └── admin-style.css       # Estilos del backend (admin)
│   └── js/
│       ├── rifa.js              # Lógica del frontend (formulario de compra de rifas, etc.)
│       └── admin-scripts.js     # Lógica del backend (administración de rifas)
├── includes/
│   ├── class-rve-cpt.php                # Clase para Custom Post Types
│   ├── class-rve-metaboxes.php          # Clase para los Metaboxes
│   ├── class-rve-shortcodes.php         # Clase para Shortcodes
│   ├── class-rve-ajax.php               # Clase para manejo de AJAX
│   ├── class-rve-email.php              # Clase para envío de emails automáticos
│   ├── class-rve-webpay.php             # Clase para integración con WebPay
│   └── class-rve-admin.php              # Clase para el panel de administración
├── templates/
│   ├── single-rifas.php                 # Plantilla para página de rifa individual
│   ├── archive-rifas.php                # Plantilla para archivo de rifas
│   └── results-rifas.php                # Plantilla para resultados de rifas
├── rifa-virtual-espacios.php            # Archivo principal del plugin
├── uninstall.php                        # Archivo para desinstalación del plugin
└── README.md                            # Archivo de documentación


### Próximos Pasos
 - **Integrar WooCommerce para usuarios que no usan WebPay**.
 - **Añadir soporte para múltiples monedas**.
 - **Implementar notificaciones push para resultados de rifas**.


### Contribuciones
Si deseas contribuir a este plugin, siéntete libre de hacer un fork del proyecto, crear una nueva rama y enviar un pull request. ¡Toda colaboración es bienvenida!

### Licencia
Este plugin está licenciado bajo la GPLv2 o posterior. Para más información, visita GNU GPL.

### Mejoras Realizadas:

1. **Corrección de Títulos**: Ahora los títulos tienen la jerarquía adecuada, comenzando desde `#` para el título principal, `##` para secciones principales, y `###` para subsecciones.

2. **Uso Correcto de Código**:
   - Para los shortcodes y fragmentos de código PHP o cualquier otro código, utilicé **bloques de código** encerrados entre tres acentos graves (```) para mantener el formato de código en Markdown. Esto asegura que se muestre correctamente como un bloque de código.
   
3. **Separación Clara**: Las secciones de instalación, uso, personalización y estructura del plugin ahora están separadas de forma clara, lo que facilita su lectura.

4. **Correcciones Menores**: Eliminé las partes donde aparecían etiquetas PHP no compatibles con `.md`.

Este archivo `README.md` ahora está bien estructurado y listo para ser utilizado como documentación de tu plugin **Rifa Virtual Espacios**.