document.addEventListener('DOMContentLoaded', function () {
    // Elementos del DOM
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const resetForm = document.getElementById('resetForm');
    const toggleRegister = document.getElementById('toggleRegister');
    const toggleReset = document.getElementById('toggleReset');

    // Manejo de alertas existentes
    let alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(function () {
            alert.classList.add('hidden');
        }, 5000);
    }

    // Funciones auxiliares
    function createMessageContainer(type) {
        const container = document.createElement('div');
        const className = type === 'error'
            ? 'bg-red-100 border border-red-400 text-red-700'
            : 'bg-green-100 border border-green-400 text-green-700';
        container.className = `${className} px-4 py-3 rounded relative my-4 hidden`;
        return container;
    }

    function showForm(formToShow) {
        [loginForm, registerForm, resetForm].forEach(form => {
            if (form) form.style.display = 'none';
        });
        if (formToShow) formToShow.style.display = 'block';
    }

    function displayMessages(container, messages) {
        if (!container) return;
        container.innerHTML = '';
        container.classList.remove('hidden');
        if (typeof messages === 'string') {
            messages = { general: [messages] };
        }
        Object.values(messages).flat().forEach(message => {
            const messageElement = document.createElement('p');
            messageElement.textContent = message;
            container.appendChild(messageElement);
        });
    }

    function clearMessages(form) {
        const containers = form.querySelectorAll('.message-container');
        containers.forEach(container => {
            container.innerHTML = '';
            container.classList.add('hidden');
        });
    }

    // Agregar contenedores de mensajes a los formularios
    [loginForm, registerForm, resetForm].forEach(form => {
        if (form) {
            const errorContainer = createMessageContainer('error');
            const successContainer = createMessageContainer('success');
            errorContainer.classList.add('message-container', 'error-container');
            successContainer.classList.add('message-container', 'success-container');
            form.appendChild(errorContainer);
            form.appendChild(successContainer);
        }
    });

    // Event Listeners para cambiar entre formularios
    toggleRegister.addEventListener('click', () => {
        if (loginForm.style.display !== 'none') {
            showForm(registerForm);
            toggleRegister.textContent = '¿Ya tienes cuenta? Inicia sesión';
            toggleReset.style.display = 'none';
        } else {
            showForm(loginForm);
            toggleRegister.textContent = '¿No tienes cuenta? Regístrate';
            toggleReset.style.display = 'block';
        }
        clearMessages(loginForm);
        clearMessages(registerForm);
    });

    toggleReset.addEventListener('click', () => {
        if (resetForm.style.display === 'none') {
            showForm(resetForm);
            toggleReset.textContent = 'Volver al inicio de sesión';
            toggleRegister.style.display = 'none';
        } else {
            showForm(loginForm);
            toggleReset.textContent = '¿Olvidaste tu contraseña?';
            toggleRegister.style.display = 'block';
        }
        clearMessages(loginForm);
        clearMessages(resetForm);
    });

    // Manejo del formulario de registro
    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        clearMessages(registerForm);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
                const errorContainer = registerForm.querySelector('.error-container');
                displayMessages(errorContainer, data.errors);
            } else if (data.success) {
                showForm(loginForm);
                const successContainer = loginForm.querySelector('.success-container');
                displayMessages(successContainer, { message: [data.message] });
                registerForm.reset();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const errorContainer = registerForm.querySelector('.error-container');
            displayMessages(errorContainer, { general: ['Hubo un problema al procesar tu solicitud. Por favor, inténtalo de nuevo.'] });
        });
    });

    // Manejo del formulario de inicio de sesión
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        clearMessages(loginForm);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else if (data.errors) {
                const errorContainer = loginForm.querySelector('.error-container');
                displayMessages(errorContainer, data.errors);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const errorContainer = loginForm.querySelector('.error-container');
            displayMessages(errorContainer, { general: ['Hubo un problema al iniciar sesión. Por favor, inténtalo de nuevo.'] });
        });
    });

    // Manejo del formulario de restablecimiento de contraseña
    resetForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        clearMessages(resetForm);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const successContainer = resetForm.querySelector('.success-container');
                displayMessages(successContainer, { message: [data.message] });
            } else if (data.errors) {
                const errorContainer = resetForm.querySelector('.error-container');
                displayMessages(errorContainer, data.errors);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const errorContainer = resetForm.querySelector('.error-container');
            displayMessages(errorContainer, { general: ['Hubo un problema al procesar tu solicitud. Por favor, inténtalo de nuevo.'] });
        });
    });

    // Función global para cambiar entre formularios
    window.toggleForm = function (formId) {
        const form = document.getElementById(formId);
        showForm(form);
        clearMessages(form);
    };
});