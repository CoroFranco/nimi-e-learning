<x-applayout>
    <div class="flex-grow p-6 md:overflow-y-auto md:p-12 bg-gray-100">
        <div class="max-w-[1200px] mx-auto">
            <h1 class="text-6xl font-bold mb-8 text-gray-800">Crear Nuevo Curso</h1>
            
            <form id="course-form" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div id="alert-container" class="mb-4"></div>

                <!-- Información General del Curso -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-3xl font-semibold mb-4 text-gray-700">Información General del Curso</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-lg font-medium text-gray-700 mb-1">Título del Curso</label>
                            <input type="text" name="title" id="title" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                        </div>
                        <div>
                            <label for="category_id" class="block text-lg font-medium text-gray-700 mb-1">Categoría</label>
                            <select name="category_id" id="category_id" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="description" class="block text-lg font-medium text-gray-700 mb-1">Descripción del Curso</label>
                        <textarea name="description" id="description" rows="4" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]"></textarea>
                    </div>
                </div>
                
                <!-- Detalles del Curso -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-3xl font-semibold mb-4 text-gray-700">Detalles del Curso</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price" class="block text-lg font-medium text-gray-700 mb-1">Precio (USD)</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                        </div>
                        <div>
                            <label for="level" class="block text-lg font-medium text-gray-700 mb-1">Nivel</label>
                            <select name="level" id="level" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                                <option value="beginner">Principiante</option>
                                <option value="intermediate">Intermedio</option>
                                <option value="advanced">Avanzado</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-lg font-medium text-gray-700 mb-1">Estado</label>
                            <select name="status" id="status" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                                <option value="draft">Borrador</option>
                                <option value="published">Publicado</option>
                                <option value="archived">Archivado</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Imagen de Portada -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-4xl font-semibold mb-4 text-gray-700">Imagen de Portada</h2>
                    <div id="drop-zone" class="mt-2 border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-[var(--highlight-color)] transition-colors">
                        <p class="text-lg text-gray-500 mb-2">Arrastra y suelta una imagen aquí o haz clic para seleccionar</p>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="text-lg hidden">
                        <button type="button" id="select-file" class="text-xl px-4 py-2 bg-[var(--highlight-color)] text-white rounded-md hover:bg-[var(--hover-color)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--highlight-color)]">
                            Seleccionar Archivo
                        </button>
                    </div>
                    <div id="thumbnail-preview" class="mt-4 hidden">
                        <img id="thumbnail-image" src="#" alt="Vista previa de la imagen" class="max-w-full h-auto rounded-lg shadow-md">
                    </div>
                </div>
                
                <!-- Módulos y Lecciones del Curso -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-3xl font-semibold mb-4 text-gray-700">Módulos y Lecciones del Curso</h2>
                    <div id="modules-container" class="space-y-6">
                        <!-- Los módulos se agregarán dinámicamente aquí -->
                    </div>
                    <button type="button" id="add-module" class="text-xl mt-6 px-4 py-2 bg-[var(--highlight-color)] text-white rounded-md hover:bg-[var(--hover-color)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--highlight-color)]">
                        Agregar Módulo
                    </button>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="text-xl px-6 py-3 bg-[var(--highlight-color)] text-white font-semibold rounded-md hover:bg-[var(--hover-color)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--highlight-color)]">
                        Crear Curso
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let moduleCount = 0;

        document.getElementById('add-module').addEventListener('click', addModule);
        document.getElementById('course-form').addEventListener('submit', function(event) {
            event.preventDefault();
            submitForm();
        });

        // Funcionalidad de arrastrar y soltar para la imagen de portada
        const dropZone = document.getElementById('drop-zone');
        const thumbnailInput = document.getElementById('thumbnail');
        const selectFileButton = document.getElementById('select-file');
        const thumbnailPreview = document.getElementById('thumbnail-preview');
        const thumbnailImage = document.getElementById('thumbnail-image');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-[var(--highlight-color)]', 'bg-[var(--highlight-color)]/10');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-[var(--highlight-color)]', 'bg-[var(--highlight-color)]/10');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-[var(--highlight-color)]', 'bg-[var(--highlight-color)]/10');
            const file = e.dataTransfer.files[0];
            handleFile(file);
        });

        selectFileButton.addEventListener('click', () => {
            thumbnailInput.click();
        });

        thumbnailInput.addEventListener('change', () => {
            const file = thumbnailInput.files[0];
            handleFile(file);
        });

        function handleFile(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    thumbnailImage.src = e.target.result;
                    thumbnailPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                alert('Por favor, selecciona un archivo de imagen válido.');
            }
        }

        function addModule() {
            moduleCount++;
            const moduleHtml = `
                <div id="module-${moduleCount}" class="module bg-gray-100 rounded-lg p-6 mb-4 relative">
                    <button type="button" class="text-lg absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="removeModule(${moduleCount})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-700">Módulo ${moduleCount}</h3>
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-1">Título del Módulo</label>
                        <input type="text" name="modules[${moduleCount}][title]" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                    </div>
                    <div class="mt-4">
                        <label class="block text-lg font-medium text-gray-700 mb-1">Descripción del Módulo</label>
                        <textarea name="modules[${moduleCount}][description]" rows="3" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]"></textarea>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-2xl font-medium mb-2 text-gray-700">Lecciones</h4>
                        <div id="lessons-container-${moduleCount}" class="space-y-4">
                            <!-- Las lecciones se agregarán dinámicamente aquí -->
                        </div>
                        <button type="button" class="text-xl mt-4 px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="addLesson(${moduleCount})">
                            Agregar Lección
                        </button>
                    </div>
                </div>
            `;
            document.getElementById('modules-container').insertAdjacentHTML('beforeend', moduleHtml);
        }

        function removeModule(moduleId) {
            document.getElementById(`module-${moduleId}`).remove();
        }

        function addLesson(moduleId) {
            const lessonCount = document.querySelectorAll(`#lessons-container-${moduleId} .lesson`).length + 1;
            const lessonHtml = `
                <div class="lesson bg-white rounded-lg p-4 relative">
                    <button type="button" class="text-xl absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="this.closest('.lesson').remove()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <h5 class="text-lg font-medium mb-2 text-gray-700">Lección ${lessonCount}</h5>
                    <div>
                        <label class="block text-lg font-medium text-gray-700 mb-1">Título de la Lección</label>
                        <input type="text" name="modules[${moduleId}][lessons][${lessonCount}][title]" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                    </div>
                    <div class="mt-2">
                        <label class="block text-lg font-medium text-gray-700 mb-1">Tipo de Contenido</label>
                        <select name="modules[${moduleId}][lessons][${lessonCount}][type]" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]" onchange="showContentField(this, ${moduleId}, ${lessonCount})">
                            <option value="video">Video</option>
                            <option value="text">Texto</option>
                            <option value="quiz">Cuestionario</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label class="block text-lg font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="modules[${moduleId}][lessons][${lessonCount}][description]" rows="2" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]"></textarea>
                    </div>
                    <div class="mt-2 content-field" id="content-field-${moduleId}-${lessonCount}">
                        <!-- El campo de contenido se mostrará aquí según el tipo seleccionado -->
                    </div>
                </div>
            `;
            document.getElementById(`lessons-container-${moduleId}`).insertAdjacentHTML('beforeend', lessonHtml);
            showContentField(document.querySelector(`#lessons-container-${moduleId} .lesson:last-child select`), moduleId, lessonCount);
        }

        function showContentField(select, moduleId, lessonId) {
            const contentField = document.getElementById(`content-field-${moduleId}-${lessonId}`);
            const lessonType = select.value;
            let fieldHtml = '';

            switch (lessonType) {
                case 'video':
                    fieldHtml = `
                        <label class="block text-lg font-medium text-gray-700 mb-1">URL del Video</label>
                        <input type="url" name="modules[${moduleId}][lessons][${lessonId}][content]" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                        <label class="block text-lg font-medium text-gray-700 mt-2 mb-1">Duración (en minutos)</label>
                        <input type="number" name="modules[${moduleId}][lessons][${lessonId}][duration]" min="1" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                    `;
                    break;
                case 'text':
                    fieldHtml = `
                        <label class="block text-lg font-medium text-gray-700 mb-1">Contenido de Texto</label>
                        <textarea name="modules[${moduleId}][lessons][${lessonId}][content]" rows="6" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]"></textarea>
                    `;
                    break;
                case 'quiz':
                    fieldHtml = `
                        <div id="quiz-questions-${moduleId}-${lessonId}">
                            <!-- Las preguntas del cuestionario se agregarán aquí -->
                        </div>
                        <button type="button" class="text-xl mt-2 px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="addQuizQuestion(${moduleId}, ${lessonId})">
                            Agregar Pregunta
                        </button>
                    `;
                    break;
            }

            contentField.innerHTML = fieldHtml;
            if (lessonType === 'quiz') {
                addQuizQuestion(moduleId, lessonId);
            }
        }

        function addQuizQuestion(moduleId, lessonId) {
            const questionCount = document.querySelectorAll(`#quiz-questions-${moduleId}-${lessonId} .quiz-question`).length + 1;
            const questionHtml = `
                <div class="quiz-question bg-gray-50 p-4 rounded-md mt-4">
                    <h6 class="font-semibold mb-2">Pregunta ${questionCount}</h6>
                    <input type="text" name="modules[${moduleId}][lessons][${lessonId}][quiz][${questionCount}][question]" placeholder="Pregunta" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md mb-2">
                    <textarea name="modules[${moduleId}][lessons][${lessonId}][quiz][${questionCount}][answers]" rows="4" placeholder="Opciones (una por línea)" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md mb-2"></textarea>
                    <input type="text" name="modules[${moduleId}][lessons][${lessonId}][quiz][${questionCount}][correct]" placeholder="Respuesta correcta" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
            `;
            document.getElementById(`quiz-questions-${moduleId}-${lessonId}`).insertAdjacentHTML('beforeend', questionHtml);
        }

        function submitForm() {
            const form = document.getElementById('course-form');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Server error');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 2000);
                } else {
                    showAlert('error', 'Por favor, corrige los errores en el formulario.');
                    if (data.errors) {
                        displayErrors(data.errors);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Ha ocurrido un error. Por favor, inténtalo de nuevo.');
            });
        }

        function showAlert(type, message) {
            const alertContainer = document.getElementById('alert-container');
            const alertClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
            
            alertContainer.innerHTML = `
                <div class="${alertClass} px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">${type === 'success' ? '¡Éxito!' : '¡Error!'}</strong>
                    <span class="block sm:inline">${message}</span>
                </div>
            `;

            alertContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function displayErrors(errors) {
            if (!errors || typeof errors !== 'object') {
                console.error('Invalid errors object:', errors);
                return;
            }

            // Eliminar mensajes de error anteriores
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));

            // Mostrar nuevos mensajes de error
            for (const [key, messages] of Object.entries(errors)) {
                const field = document.querySelector(`[name="${key}"]`);
                if (field) {
                    field.classList.add('border-red-500');
                    const errorMessage = document.createElement('p');
                    errorMessage.classList.add('error-message', 'text-red-500', 'text-lg', 'mt-1');
                    errorMessage.textContent = Array.isArray(messages) ? messages[0] : messages;
                    field.parentNode.insertBefore(errorMessage, field.nextSibling);
                }
            }

            // Desplazarse al primer error
            const firstError = document.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    </script>
</x-applayout>

