<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nexelyn Conexión - Chat en Tiempo Real Premium</title>
    <!-- Incluir Font Awesome para los íconos -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-pVnG3BY2mVv3VMXvY1Qm9aYvM3u9URF3E2nXkX+1t8yzgY3GZ3kzZ3Qyd3V1FzLZr5I/OcRmX1H4TzqN4G8eMg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <style>
        /* Variables de color */
        :root {
            --primary-color: #4A90E2;
            --secondary-color: #50E3C2;
            --background-color: #F5F7FA;
            --message-bg-user: #DCF8C6;
            --message-bg-server: #FFFFFF;
            --text-color: #333333;
            --input-bg: #FFFFFF;
            --border-color: #E0E0E0;
            --header-bg: #4A90E2;
            --header-text: #FFFFFF;
            --emoji-bg: #FFFFFF;
            --emoji-hover: #F0F0F0;
            --background-image-url: url('<?= base_url('assets/imagenes/fondo.png'); ?>');
            --reaction-bg: rgba(255, 255, 255, 0.8);
            --reaction-border: #E0E0E0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: var(--background-image-url);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: var(--background-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: var(--primary-color);
            margin: 20px 0 10px 0;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 8px;
        }

        #chat-container {
            width: 90%;
            max-width: 600px;
            height: 80vh;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        /* Encabezado del chat */
        #chat-header {
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #chat-header .status {
            font-size: 14px;
            color: var(--secondary-color);
        }

        /* Avatar en el encabezado */
        #chat-header .header-info {
            display: flex;
            align-items: center;
        }

        #chat-header .header-info .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
        }

        #chat-header .header-info .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #chat {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: var(--background-color);
            background-image: url('<?= base_url('assets/imagenes/fondochat.jpeg'); ?>'); /* Tu nueva imagen de fondo dentro del chat */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
        }

        /* Overlay para mejorar la legibilidad de los mensajes */
        #chat::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(245, 247, 250, 0.5); /* Ajusta la opacidad según sea necesario */
            z-index: -1;
        }

        .message {
            width: 100%; /* Ocupa todo el ancho del contenedor */
            display: flex;
            margin-bottom: 15px;
            position: relative;
        }

        /* Mensajes del servidor: alineados a la izquierda */
        .message.server {
            justify-content: flex-start;
        }

        /* Mensajes del usuario: alineados a la derecha */
        .message.user {
            justify-content: flex-end;
        }

        .message-content {
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            max-width: 70%;
            position: relative;
        }

        /* Invertir el orden para los mensajes del usuario */
        .message.user .message-content {
            flex-direction: row-reverse;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .message-wrapper {
            display: flex;
            flex-direction: column;
            margin: 0 10px;
        }

        .message .text {
            padding: 10px 15px;
            border-radius: 20px;
            background-color: var(--message-bg-server);
            transition: background-color 0.3s;
            word-wrap: break-word;
            font-size: 16px;
            color: var(--text-color);
            position: relative;
        }

        .message.user .text {
            background-color: var(--message-bg-user);
        }

        /* Contenedor de reacciones ajustado */
        .reactions {
            display: flex;
            margin-top: 5px;
            flex-wrap: nowrap;
            overflow-x: auto;
            justify-content: flex-start; /* Para alinear las reacciones a la izquierda */
        }

        /* Reaction Picker */
        .reaction-picker {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, 10px);
            background-color: var(--emoji-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 5px;
            display: none;
            flex-wrap: wrap;
            width: 150px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1001;
        }

        .reaction {
            background-color: var(--reaction-bg);
            border: 1px solid var(--reaction-border);
            border-radius: 12px;
            padding: 2px 6px;
            margin-right: 5px;
            font-size: 14px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .reaction:hover {
            background-color: var(--emoji-hover);
        }

        /* Scrollbar personalizado */
        #chat::-webkit-scrollbar {
            width: 8px;
        }

        #chat::-webkit-scrollbar-track {
            background: var(--background-color);
        }

        #chat::-webkit-scrollbar-thumb {
            background-color: var(--primary-color);
            border-radius: 4px;
        }

        /* Emoji Picker */
        #emoji-picker {
            position: absolute;
            bottom: 60px;
            left: 15px;
            background-color: var(--emoji-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px;
            display: none;
            flex-wrap: wrap;
            width: 220px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Input Container */
        .input-container {
            display: flex;
            padding: 15px;
            border-top: 1px solid var(--border-color);
            background-color: var(--input-bg);
            align-items: center;
            position: relative;
        }

        #message {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        #message:focus {
            border-color: var(--primary-color);
        }

        #send {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        #send:hover {
            background-color: #357ABD;
        }

        /* Botón de emojis actualizado */
        #emoji-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            margin-right: 10px;
            color: var(--primary-color);
            transition: color 0.3s;
        }

        #emoji-button:hover {
            color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <h1>Chat Nexely Prueba</h1>

    <div id="chat-container">
        <!-- Encabezado del chat con avatar -->
        <div id="chat-header">
            <div class="header-info">
                <div class="avatar">
                    <img src="<?= base_url('assets/imagenes/avatarserver.png'); ?>" alt="Avatar del Servidor">
                </div>
                <div>Nexelyn</div>
            </div>
            <div class="status">Conectado</div>
        </div>

        <div id="chat"></div>
        <div class="input-container">
            <button id="emoji-button">
                ☺
            </button>
            <div id="emoji-picker">
                <!-- Lista de emojis comunes -->
                <span class="emoji">😀</span>
                <span class="emoji">😂</span>
                <span class="emoji">😍</span>
                <span class="emoji">👍</span>
                <span class="emoji">🙏</span>
                <span class="emoji">🎉</span>
                <span class="emoji">❤️</span>
                <span class="emoji">😢</span>
                <span class="emoji">🔥</span>
                <span class="emoji">🤔</span>
            </div>
            <input type="text" id="message" placeholder="Escribe tu mensaje">
            <button id="send">Enviar</button>
        </div>
    </div>

    <script>
        // Obtener las URLs de avatar desde PHP
        const userAvatarURL = '<?= base_url('assets/imagenes/iconoperfil.png'); ?>'; // Ruta a la imagen de usuario
        const serverAvatarURL = '<?= base_url('assets/imagenes/avatarserver.png'); ?>'; // Ruta a la imagen del servidor

        const conn = new WebSocket('ws://localhost:8089'); // Conectar al servidor WebSocket
        const chat = document.getElementById('chat');
        const sendButton = document.getElementById('send');
        const messageInput = document.getElementById('message');
        const emojiButton = document.getElementById('emoji-button');
        const emojiPicker = document.getElementById('emoji-picker');
        const emojis = document.querySelectorAll('#emoji-picker .emoji');

        // Simulación de usuario actual
        const currentUser = 'user'; // Puedes cambiar esto según la lógica de tu aplicación

        // Función para generar un ID único para cada mensaje
        function generateMessageId() {
            return 'msg-' + Date.now() + '-' + Math.floor(Math.random() * 1000);
        }

        // Función para crear un mensaje
        function createMessage(content, sender = 'server', messageId = null) {
            if (!messageId) {
                messageId = generateMessageId();
            }

            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', sender);
            messageDiv.setAttribute('data-message-id', messageId); // Asignar ID al mensaje
            messageDiv.setAttribute('data-user-reaction', ''); // Inicializar sin reacción

            const messageContentDiv = document.createElement('div');
            messageContentDiv.classList.add('message-content');

            const textDiv = document.createElement('div');
            textDiv.classList.add('text');
            textDiv.innerHTML = parseEmojis(content);

            const reactionsDiv = document.createElement('div');
            reactionsDiv.classList.add('reactions');

            const avatarDiv = document.createElement('div');
            avatarDiv.classList.add('avatar');
            const avatarImg = document.createElement('img');
            avatarImg.src = sender === 'user' ? userAvatarURL : serverAvatarURL;
            avatarImg.alt = sender === 'user' ? 'Avatar del Usuario' : 'Avatar del Servidor';
            avatarDiv.appendChild(avatarImg);

            // Crear el contenedor del mensaje y las reacciones
            const messageWrapper = document.createElement('div');
            messageWrapper.classList.add('message-wrapper');
            messageWrapper.appendChild(textDiv);
            messageWrapper.appendChild(reactionsDiv);

            // Agregar avatar y mensaje al contenedor de contenido
            if (sender === 'server') {
                messageContentDiv.appendChild(avatarDiv); // Avatar a la izquierda
                messageContentDiv.appendChild(messageWrapper); // Mensaje a la derecha
            } else {
                messageContentDiv.appendChild(messageWrapper); // Mensaje a la izquierda
                messageContentDiv.appendChild(avatarDiv); // Avatar a la derecha
            }

            messageDiv.appendChild(messageContentDiv);

            // Añadir evento para reaccionar al mensaje
            messageDiv.addEventListener('click', function(event) {
                event.stopPropagation(); // Evitar que el evento se propague
                closeAllReactionPickers(); // Cerrar otros pickers abiertos
                if (!messageDiv.querySelector('.reaction-picker')) {
                    const reactionPicker = createReactionPicker(messageId);
                    messageContentDiv.appendChild(reactionPicker);
                }
                const currentPicker = messageDiv.querySelector('.reaction-picker');
                currentPicker.style.display = currentPicker.style.display === 'flex' ? 'none' : 'flex';
            });

            chat.appendChild(messageDiv);
            chat.scrollTop = chat.scrollHeight;
        }

        // Función para crear el Reaction Picker
        function createReactionPicker(messageId) {
            const picker = document.createElement('div');
            picker.classList.add('reaction-picker');

            const reactionEmojis = ['👍', '❤️', '😂', '🔥'];

            reactionEmojis.forEach(emoji => {
                const emojiSpan = document.createElement('span');
                emojiSpan.classList.add('emoji');
                emojiSpan.textContent = emoji;
                emojiSpan.addEventListener('click', function(event) {
                    event.stopPropagation();
                    addReaction(emoji, messageId);
                    picker.style.display = 'none';
                });
                picker.appendChild(emojiSpan);
            });

            return picker;
        }

        // Función para añadir una reacción a un mensaje
        function addReaction(emoji, messageId) {
            // Crear un objeto de reacción
            const reaction = {
                type: 'reaction',
                messageId: messageId,
                emoji: emoji,
                user: currentUser
            };

            // Enviar la reacción al servidor
            conn.send(JSON.stringify(reaction));

            // Opcional: Crear la reacción localmente sin esperar a la confirmación del servidor
            handleReaction(reaction);
        }

        // Función para manejar una reacción (actualizar el DOM)
        function handleReaction(reaction) {
            const { messageId, emoji, user } = reaction;
            const messageDiv = document.querySelector(`.message[data-message-id="${messageId}"]`);
            if (!messageDiv) return;

            const reactionsDiv = messageDiv.querySelector('.reactions');
            if (!reactionsDiv) return;

            // Verificar si el usuario ya ha reaccionado
            const existingUserReaction = messageDiv.getAttribute('data-user-reaction');

            if (user === currentUser) {
                // Manejar la reacción del usuario actual
                let reactionSpan = Array.from(reactionsDiv.children).find(r => r.getAttribute('data-user') === user);
                if (reactionSpan) {
                    // Reemplazar la reacción existente
                    let count = parseInt(reactionSpan.getAttribute('data-count'));
                    count += 1;
                    reactionSpan.textContent = `${emoji} ${count}`;
                    reactionSpan.setAttribute('data-count', count);
                } else {
                    // Crear una nueva reacción
                    reactionSpan = document.createElement('span');
                    reactionSpan.classList.add('reaction');
                    reactionSpan.setAttribute('data-count', '1');
                    reactionSpan.setAttribute('data-user', user);
                    reactionSpan.textContent = `${emoji} 1`;
                    reactionsDiv.appendChild(reactionSpan);
                }

                // Guardar la reacción del usuario
                messageDiv.setAttribute('data-user-reaction', user);
            } else {
                // Manejar las reacciones de otros usuarios
                let reactionSpan = Array.from(reactionsDiv.children).find(r => r.getAttribute('data-user') === user);
                if (reactionSpan) {
                    let count = parseInt(reactionSpan.getAttribute('data-count'));
                    count += 1;
                    reactionSpan.textContent = `${emoji} ${count}`;
                    reactionSpan.setAttribute('data-count', count);
                } else {
                    reactionSpan = document.createElement('span');
                    reactionSpan.classList.add('reaction');
                    reactionSpan.setAttribute('data-count', '1');
                    reactionSpan.setAttribute('data-user', user);
                    reactionSpan.textContent = `${emoji} 1`;
                    reactionsDiv.appendChild(reactionSpan);
                }
            }
        }

        // Función para cerrar todos los Reaction Pickers abiertos
        function closeAllReactionPickers() {
            const allPickers = document.querySelectorAll('.reaction-picker');
            allPickers.forEach(picker => {
                picker.style.display = 'none';
            });
        }

        // Función para reemplazar texto de emojis por caracteres emoji
        function parseEmojis(text) {
            // Puedes expandir esta función para manejar más emojis o usar una librería
            return text
                .replace(/:\)/g, '😊')
                .replace(/:D/g, '😃')
                .replace(/:P/g, '😜')
                .replace(/<3/g, '❤️')
                .replace(/:O/g, '😮');
        }

        // Manejo de la conexión WebSocket
        conn.onopen = function(e) {
            // Actualizar el estado de conexión
            document.querySelector('.status').textContent = 'Conectado';
        };

        conn.onmessage = function(e) {
            try {
                const data = JSON.parse(e.data);
                if (data.type === 'message') {
                    createMessage(data.content, 'server', data.id);
                } else if (data.type === 'reaction') {
                    handleReaction(data);
                }
            } catch (err) {
                console.error('Error al parsear el mensaje:', err);
            }
        };

        conn.onerror = function(error) {
            createMessage('Error en la conexión', 'server');
            document.querySelector('.status').textContent = 'Error de conexión';
        };

        conn.onclose = function() {
            createMessage('Conexión cerrada', 'server');
            document.querySelector('.status').textContent = 'Desconectado';
        };

        // Función para enviar mensaje
        function sendMessage() {
            const msg = messageInput.value.trim();
            if (msg === '') return;

            const message = {
                type: 'message',
                content: msg,
                id: generateMessageId()
            };

            conn.send(JSON.stringify(message)); // Enviar mensaje al servidor WebSocket
            createMessage(msg, 'user', message.id);
            messageInput.value = ''; // Limpiar el campo de texto
            messageInput.focus();
        }

        // Al hacer clic en el botón enviar
        sendButton.addEventListener('click', sendMessage);

        // Enviar mensaje con la tecla "Enter"
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Toggle del picker de emojis
        emojiButton.addEventListener('click', function(event) {
            event.stopPropagation(); // Evitar que el evento se propague
            emojiPicker.style.display = emojiPicker.style.display === 'flex' ? 'none' : 'flex';
        });

        // Insertar emoji en el campo de texto
        emojis.forEach(emoji => {
            emoji.addEventListener('click', function() {
                messageInput.value += this.textContent;
                messageInput.focus();
                emojiPicker.style.display = 'none';
            });
        });

        // Cerrar el picker de emojis al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (!emojiPicker.contains(event.target) && event.target !== emojiButton) {
                emojiPicker.style.display = 'none';
            }
            // Cerrar los reaction pickers si se hace clic fuera
            closeAllReactionPickers();
        });
    </script>
</body>
</html>
