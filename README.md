# Chat Nexely Prueba

## Descripción

**Chat Nexely Prueba** es una aplicación de **chat en tiempo real** desarrollada en **PHP** utilizando el framework **CodeIgniter 4** y la biblioteca **Ratchet** para manejar **WebSockets**. La aplicación está diseñada para ofrecer una experiencia de comunicación instantánea y enriquecida con funcionalidades clave que mejoran la interacción entre los usuarios.

## Características Principales

- **Envío y Recepción de Mensajes de Texto:**
  - Permite a los usuarios enviar y recibir mensajes de texto de forma instantánea, facilitando una comunicación fluida.

- **Soporte de Emojis:**
  - Integra un selector de emojis que permite a los usuarios enriquecer sus mensajes con expresiones visuales.

- **Interfaz Profesional con Tema Oscuro y Opción de Fondo Personalizado:**
  - Diseño moderno y atractivo con tema oscuro, ideal para programadores y usuarios que prefieren interfaces elegantes.
  - Posibilidad de personalizar el fondo para adaptar la apariencia a las preferencias del usuario.

- **Reacciones a Mensajes mediante Emojis:**
  - Los usuarios pueden reaccionar a los mensajes recibidos utilizando emojis, mejorando la interacción y retroalimentación en el chat.

- **Estado de Actividad:**
  - Muestra en tiempo real el estado de conexión de los usuarios (Conectado/Desconectado), proporcionando información sobre la disponibilidad de los participantes en la conversación.

- **Foto de Perfil:**
  - Cada usuario puede personalizar su perfil con una foto, facilitando la identificación y personalización de la experiencia de chat.

## Instalación

### Requisitos Previos

- **XAMPP** (versión 8.1.25) o cualquier entorno de desarrollo PHP compatible.
- **Composer** instalado en tu sistema.
- **CodeIgniter 4** instalado.
- **Ratchet WebSocket** instalado vía Composer.

### Pasos de Instalación

1. **Clonar el Repositorio**

   Clona este repositorio en tu directorio de proyectos:

   ```bash
   git clone https://github.com/tuusuario/tu_repositorio.git

2. **Navegar al Directorio del Proyecto**

    ```bash
    cd tu_repositorio

3. **Instalar Dependencias**

    Ejecuta Composer para instalar las dependencias necesarias:

   ```bash
    composer install

4. **Configurar CodeIgniter**

   Configura la URL base en el archivo .env:

   ```bash
    app.baseURL = 'http://localhost:8080/'

5. **Instalar Ratchet**

    Si no lo has hecho, instala Ratchet:

     ```bash
    composer require cboden/ratchet

6. **Iniciar el Servidor WebSocket**

    En una terminal, ejecuta:

     ```bash
    php server.php

7. Iniciar el Servidor de CodeIgniter

    En otra terminal, ejecuta:

     ```bash
    php spark serve

## Uso

1. **Acceder a la Aplicación**

   Abre tu navegador web y ve a:

   ```bash
    http://localhost:8080/chat

2. **Enviar Mensajes de Texto**

    -Escribe tu mensaje en el campo de texto y presiona Enter o haz clic en el botón Enviar.

3. **Añadir Emojis**

    -Haz clic en el botón de emoji (☺) y selecciona el que desees para añadirlo a tu mensaje.

1. **Reacciones a Mensajes mediante Emojis**

   -Haz clic en cualquier mensaje para abrir el Reaction Picker y selecciona un emoji para reaccionar al mensaje.

5. **Estado de Actividad y Foto de Perfil**

    -Estado de Conexión:

    --Observa el estado de los usuarios (Conectado/Desconectado) en el encabezado del chat para saber quiénes están disponibles.

    -Foto de Perfil:

    --Cada usuario tiene una foto de perfil visible junto a sus mensajes, facilitando la identificación.

# Documentación Técnica

## Estructura del Proyecto

### Controladores

Manejan las solicitudes y responden con las vistas correspondientes.

### Vistas

Contienen el código CSS, HTML y JavaScript de la interfaz del usuario.

### Servidor WebSocket (`serrunChatServer.php`)

Maneja las conexiones WebSocket utilizando Ratchet.


### Recursos de Imágenes

Imágenes utilizadas en la interfaz, almacenadas en la carpeta `public/assets/imagenes`.

## Archivos Clave

- `app/Views/chat_view.php`: Contiene la interfaz del chat y el código JavaScript para la interacción en tiempo real.
- `runChatServer.php`: Script que inicia el servidor WebSocket.

## Licencia

Este proyecto está bajo la **Licencia MIT** - ver el archivo [LICENSE](LICENSE) para más detalles.

## Autor

**[Yoel Cristian Catacora](https://github.com/YoeCris)**
