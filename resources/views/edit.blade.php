<x-appLayout>
    @push('scripts')
    <script src="https://cdn.tiny.cloud/1/lmgieupkixx4xa232zm63l0qvg7ece6egpx8eynnfck5v8fg/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        
        tinymce.init({
            skin: 'oxide-dark',
            content_css: 'dark',
            menubar: true,
        
              selector: 'textarea',
              plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Dec 18, 2024:
                'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
                // Early access to document converters
                'importword', 'exportword', 'exportpdf'
              ],
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | code',
              tinycomments_mode: 'embedded',
              tinycomments_author: 'Author name',
              valid_elements: '*[*]',
              extended_valid_elements: 'pre,code',
              mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
              ],
              ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
            });
          </script>
    @endpush
    <div class="flex-grow p-6 md:overflow-y-auto md:p-12 bg-gradient-to-br from-[var(--background-main)] to-[var(--card-bg)]">
        <div class="max-w-[1200px] mx-auto">
            <h1 class="text-6xl font-bold mb-8 text-gray-800">Editar Curso: {{ $course->title }}</h1>
            
            <form id="course-form" action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
    
                <div id="alert-container" class="mb-4"></div>
    
                <!-- Información General del Curso -->
<div class="bg-gray-100 shadow-sm rounded-lg p-5 hover:bg-gray-50 transition-all group">
    <h2 class="text-2xl font-semibold mb-4 text-gray-700 flex items-center justify-between">
        Información General del Curso
        <span class="text-lg text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity">
            Detalles básicos del curso
        </span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2">
            <label for="title" class="block text-lg font-medium text-gray-600">Título del Curso</label>
            <input type="text" name="title" id="title" value="{{ $course->title }}" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
        </div>
        <div class="space-y-2">
            <label for="category_id" class="block text-lg font-medium text-gray-600">Categoría</label>
            <select name="category_id" id="category_id" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-4 space-y-2">
        <label for="description" class="block text-lg font-medium text-gray-600">Descripción del Curso</label>
        <textarea name="description" id="description" rows="4" class="text-lg rich-text-editor w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">{{ $course->description }}</textarea>
    </div>
</div>

<!-- Detalles del Curso -->
<div class="bg-gray-100 shadow-sm rounded-lg p-5 hover:bg-gray-50 transition-all group">
    <h2 class="text-2xl font-semibold mb-4 text-gray-700 flex items-center justify-between">
        Detalles del Curso
        <span class="text-lg text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity">
            Configuración del curso
        </span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="space-y-2">
            <label for="price" class="block text-lg font-medium text-gray-600">Precio (USD)</label>
            <input type="number" name="price" id="price" value="{{ $course->price }}" step="0.01" min="0" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
        </div>
        <div class="space-y-2">
            <label for="level" class="block text-lg font-medium text-gray-600">Nivel</label>
            <select name="level" id="level" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
                <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Principiante</option>
                <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>Intermedio</option>
                <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }}>Avanzado</option>
            </select>
        </div>
        <div class="space-y-2">
            <label for="status" class="block text-lg font-medium text-gray-600">Estado</label>
            <select name="status" id="status" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
                <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>Borrador</option>
                <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>Publicado</option>
                <option value="archived" {{ $course->status == 'archived' ? 'selected' : '' }}>Archivado</option>
            </select>
        </div>
    </div>
</div>

<!-- Imagen de Portada -->
<div class="bg-gray-100 shadow-sm rounded-lg p-5 hover:bg-gray-50 transition-all group">
    <h2 class="text-2xl font-semibold mb-4 text-gray-700 flex items-center justify-between">
        Imagen de Portada
        <span class="text-lg text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity">
            Vista previa de la miniatura
        </span>
    </h2>
    <div id="drop-zone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition-all group">
        <div class="space-y-3">
            <p class="text-lg text-gray-500 group-hover:text-blue-600 transition-colors">
                Arrastra y suelta una imagen o haz clic para seleccionar
            </p>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden">
            <button type="button" id="select-file" class="text-2xl px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                Seleccionar Archivo
            </button>
        </div>
    </div>
    <div id="thumbnail-preview" class="mt-4 {{ $course->thumbnail ? '' : 'hidden' }}">
        <img id="thumbnail-image" src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : '#' }}" alt="Vista previa de la imagen" class="max-w-full h-auto rounded-lg shadow-md">
    </div>
</div>
                
                <!-- Módulos y Lecciones del Curso -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-3xl font-semibold mb-4 text-gray-700">Módulos y Lecciones del Curso</h2>
                    <div id="modules-container" class="space-y-6">
                        @foreach($course->modules as $moduleIndex => $module)
                            <div id="module-{{ $moduleIndex + 1 }}" class="module bg-gray-100 rounded-lg p-6 mb-4 relative">
                                <button type="button" class="text-lg absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="removeModule({{ $moduleIndex + 1 }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <h3 class="text-2xl font-semibold mb-4 text-gray-700">Módulo {{ $moduleIndex + 1 }}</h3>
                                <input type="hidden" name="modules[{{ $moduleIndex }}][id]" value="{{ $module->id }}">
                                <div class="module-content">
                                <div>
                                    <label class="block text-lg font-medium text-gray-700 mb-1">Título del Módulo</label>
                                    <input type="text" name="modules[{{ $moduleIndex }}][title]" value="{{ $module->title }}" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                                </div>
                                <div class="mt-4">
                                    <label class="block text-lg font-medium text-gray-700 mb-1">Descripción del Módulo</label>
                                    <textarea name="modules[{{ $moduleIndex }}][description]" rows="3" class="rich-text-editor text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">{{ $module->description }}</textarea>
                                </div>
                                <div class="mt-4">
                                    <h4 class="text-4xl font-medium mb-2 text-gray-700">Lecciones</h4>
                                    <div id="lessons-container-{{ $moduleIndex + 1 }}" class="space-y-4">
                                        @foreach($module->lessons as $lessonIndex => $lesson)
                                            <div class="lesson bg-white rounded-lg p-4 relative">
                                                <button type="button" class="text-xl absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="removeLesson(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                                <h5 class="text-lg font-medium mb-2 text-gray-700">Lección {{ $lessonIndex + 1 }}</h5>
                                                <input type="hidden" name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][id]" value="{{ $lesson->id }}">
                                                    <div>
                                                        <label class="block text-lg font-medium text-gray-700 mb-1">Título de la Lección</label>
                                                        <input type="text" name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][title]" value="{{ $lesson->title }}" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-lg font-medium text-gray-700 mb-1">Tipo de Contenido</label>
                                                        <select name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][type]" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]" onchange="showContentField(this, {{ $moduleIndex }}, {{ $lessonIndex }})">
                                                            <option value="video" {{ $lesson->type == 'video' ? 'selected' : '' }}>Video</option>
                                                            <option value="text" {{ $lesson->type == 'text' ? 'selected' : '' }}>Texto</option>
                                                            <option value="quiz" {{ $lesson->type == 'quiz' ? 'selected' : '' }}>Cuestionario</option>
                                                        </select>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block text-lg font-medium text-gray-700 mb-1">Descripción</label>
                                                        <textarea name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][description]" rows="2" class="rich-text-editor text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">{{ $lesson->description }}</textarea>
                                                    </div>
                                                    <div class="mt-2 content-field" id="content-field-{{ $moduleIndex }}-{{ $lessonIndex }}">
                                                        @if($lesson->type == 'video')
                                                            <label class="block text-lg font-medium text-gray-700 mb-1">URL del Video</label>
                                                            <input type="url" name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][content]" value="{{ $lesson->content }}" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                                                            <label class="block text-lg font-medium text-gray-700 mt-2 mb-1">Duración (en minutos)</label>
                                                            <input type="number" name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][duration]" value="{{ $lesson->duration }}" min="1" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                                                        @elseif($lesson->type == 'text')
                                                            <label class="block text-lg font-medium text-gray-700 mb-1">Contenido de Texto</label>
                                                            <textarea name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][content]" rows="6" class="rich-text-editor text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">{{ $lesson->content }}</textarea>
                                                        @elseif($lesson->type == 'quiz')
                                                            <div id="quiz-questions-{{ $moduleIndex }}-{{ $lessonIndex }}">
                                                                @foreach($lesson->quizQuestions as $questionIndex => $question)
                                                                    <div class="quiz-question bg-gray-50 p-4 rounded-md mt-4">
                                                                        <h6 class="font-semibold mb-2">Pregunta {{ $questionIndex + 1 }}</h6>
                                                                        <input type="text" name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][quiz][{{ $questionIndex }}][question]" value="{{ $question->question }}" placeholder="Pregunta" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md mb-2">
                                                                        <textarea name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][quiz][{{ $questionIndex }}][answers]" rows="4" placeholder="Opciones (una por línea)" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md mb-2">{{ $question->answers }}</textarea>
                                                                        <input type="text" name="modules[{{ $moduleIndex }}][lessons][{{ $lessonIndex }}][quiz][{{ $questionIndex }}][correct]" value="{{ $question->correct_answer }}" placeholder="Respuesta correcta" class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <button type="button" class="text-xl mt-2 px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="addQuizQuestion({{ $moduleIndex }}, {{ $lessonIndex }})">
                                                                Agregar Pregunta
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="text-xl mt-4 px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="addLesson({{ $moduleIndex + 1 }})">
                                            Agregar Lección
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                                                
                    <button type="button" id="add-module" class="text-xl mt-6 px-4 py-2 bg-[var(--highlight-color)] text-white rounded-md hover:bg-[var(--hover-color)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--highlight-color)]">
                        Agregar Módulo
                    </button>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="text-xl px-6 py-3 bg-[var(--highlight-color)] text-white font-semibold rounded-md hover:bg-[var(--hover-color)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--highlight-color)]">
                        Actualizar Curso
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        let moduleCount = {{ $course->modules->count() }};
    
        document.getElementById('add-module').addEventListener('click', addModule);
        document.getElementById('course-form').addEventListener('submit', function(event) {
            event.preventDefault();
            submitForm();
        });
    
        // Thumbnail preview functionality
const thumbnailInput = document.getElementById('thumbnail');
const dropZone = document.getElementById('drop-zone');
const thumbnailPreview = document.getElementById('thumbnail-preview');
const thumbnailImage = document.getElementById('thumbnail-image');

// Make entire drop zone clickable
dropZone.addEventListener('click', () => {
    thumbnailInput.click();
});

// Drag and drop functionality
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
});

function highlight() {
    dropZone.classList.add('border-blue-500');
}

function unhighlight() {
    dropZone.classList.remove('border-blue-500');
}

// Handle file selection
thumbnailInput.addEventListener('change', handleFiles);
dropZone.addEventListener('drop', handleDrop);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    handleFiles(files);
}

function handleFiles(files) {
    const file = files instanceof FileList ? files[0] : files.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            thumbnailImage.src = e.target.result;
            thumbnailPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}
    
document.addEventListener('DOMContentLoaded', () => {
    // Add global expand/collapse button
    const modulesContainer = document.getElementById('modules-container');
    const globalToggleButton = document.createElement('button');
    globalToggleButton.type = 'button';
    globalToggleButton.className = 'text-xl mb-4 px-4 py-2 bg-[var(--highlight-color)] text-white rounded-md hover:bg-[var(--hover-color)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--highlight-color)]';
    globalToggleButton.textContent = 'Expandir/Contraer Todos los Módulos';
    globalToggleButton.addEventListener('click', toggleAllModules);
    
    // Insert the button before the modules container
    modulesContainer.parentNode.insertBefore(globalToggleButton, modulesContainer);

    // Modify addModule function to include collapse/expand functionality
    const originalAddModule = window.addModule;
    window.addModule = function() {
        // Call the original addModule function
        originalAddModule();
        
        // Get the last added module
        const modules = document.querySelectorAll('.module');
        const latestModule = modules[modules.length - 1];
        
        // Add collapse/expand functionality to the latest module
        addModuleCollapseHeaders(latestModule);
    };

    // Initial setup of existing modules
    document.querySelectorAll('.module').forEach(addModuleCollapseHeaders);
});

function addModuleCollapseHeaders(moduleElement) {
    const moduleHeader = moduleElement.querySelector('h3');
    
    // Modify the header to be interactive
    moduleHeader.classList.add('cursor-pointer', 'flex', 'items-center', 'justify-between', 'hover:bg-gray-200', 'transition-colors', 'duration-200', 'rounded-md', 'p-2', '-ml-2');
    
    const toggleButton = document.createElement('button');
    toggleButton.type = 'button';
    toggleButton.className = 'transition-transform duration-300 ease-in-out transform hover:scale-110';
    toggleButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 hover:text-gray-900 chevron-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path class="origin-center transition-transform duration-300 ease-in-out" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    `;
    toggleButton.setAttribute('aria-expanded', 'true');
    
    // Function to toggle module
    const toggleModule = () => {
        const moduleContent = moduleElement.querySelector('.module-content');
        const svgPath = toggleButton.querySelector('path');
        const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
        
        if (isExpanded) {
            // Collapse
            gsap.to(moduleContent, {
                height: 0,
                opacity: 0,
                duration: 0.8,
                ease: "power2.inOut",
                onComplete: () => {
                    moduleContent.classList.add('hidden');
                    svgPath.classList.add('rotate-180');
                }
            });
            toggleButton.setAttribute('aria-expanded', 'false');
        } else {
            // Expand
            moduleContent.classList.remove('hidden');
            gsap.fromTo(moduleContent, 
                { height: 0, opacity: 0 },
                {
                    height: 'auto',
                    opacity: 1,
                    duration: 0.8,
                    ease: "power2.inOut",
                    onComplete: () => {
                        svgPath.classList.remove('rotate-180');
                    }
                }
            );
            toggleButton.setAttribute('aria-expanded', 'true');
        }
    };
    
    // Add click event to the entire header
    moduleHeader.addEventListener('click', toggleModule);
    
    // Append the toggle button to the header
    moduleHeader.appendChild(toggleButton);
}

function toggleAllModules() {
    const modules = document.querySelectorAll('.module');
    const firstModuleToggleButton = modules[0]?.querySelector('h3 button');
    
    if (!firstModuleToggleButton) return;
    
    const isCurrentlyExpanded = firstModuleToggleButton.getAttribute('aria-expanded') === 'true';
    
    modules.forEach(moduleElement => {
        const moduleContent = moduleElement.querySelector('.module-content');
        const toggleButton = moduleElement.querySelector('h3 button');
        const svgPath = toggleButton.querySelector('path');
        
        if (isCurrentlyExpanded) {
            // Collapse with animation
            gsap.to(moduleContent, {
                height: 0,
                opacity: 0,
                duration: 1,
                ease: "power2.inOut",
                onComplete: () => {
                    moduleContent.classList.add('hidden');
                    svgPath.style.transform = 'rotate(180deg)';
                }
            });
            toggleButton.setAttribute('aria-expanded', 'false');
        } else {
            // Expand with animation
            moduleContent.classList.remove('hidden');
            gsap.fromTo(moduleContent, 
                { height: 0, opacity: 0 },
                {
                    height: 'auto',
                    opacity: 1,
                    duration: 1,
                    ease: "power2.inOut",
                    onComplete: () => {
                        svgPath.style.transform = 'rotate(0deg)';
                    }
                }
            );
            toggleButton.setAttribute('aria-expanded', 'true');
        }
    });
}

// Modify the addModule function to wrap existing content in .module-content
function addModule() {
    moduleCount++;
    const moduleHtml = `
        <div id="module-${moduleCount}" class="module bg-gray-100 rounded-lg p-6 mb-4 relative opacity-0 scale-95">
            <button type="button" class="text-xl absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="removeModule(${moduleCount})">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="text-2xl font-semibold mb-4 text-gray-700">Módulo ${moduleCount}</h3>
            <div class="module-content">
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-1">Título del Módulo</label>
                    <input type="text" name="modules[${moduleCount}][title]" required class="text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]">
                </div>
                <div class="mt-4">
                    <label class="block text-lg font-medium text-gray-700 mb-1">Descripción del Módulo</label>
                    <textarea name="modules[${moduleCount}][description]" rows="3" class="rich-text-editor text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]"></textarea>
                </div>
                <div class="mt-4">
                    <h4 class="text-4xl font-medium mb-2 text-gray-700">Lecciones</h4>
                    <div id="lessons-container-${moduleCount}" class="space-y-4">
                        <!-- Las lecciones se agregarán dinámicamente aquí -->
                    </div>
                    <button type="button" class="text-xl mt-4 px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="addLesson(${moduleCount})">
                        Agregar Lección
                    </button>
                </div>
            </div>
        </div>
    `;
    document.getElementById('modules-container').insertAdjacentHTML('beforeend', moduleHtml);
    
    // Add GSAP animation for module
    const newModule = document.getElementById(`module-${moduleCount}`);
    gsap.to(newModule, {
        opacity: 1,
        scale: 1,
        duration: 1,
        ease: "power2.out"
    });
    
    // Add collapse/expand functionality to the new module
    addModuleCollapseHeaders(newModule);
}

        function removeModule(moduleId) {
            document.getElementById(`module-${moduleId}`).remove();
        }

        function addLesson(moduleId) {
    const lessonsContainer = document.getElementById(`lessons-container-${moduleId}`);
    const lessonCount = lessonsContainer.children.length + 1;
    const lessonHtml = `
        <div class="lesson bg-white rounded-lg p-4 relative opacity-0 scale-95">
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
                        <textarea name="modules[${moduleId}][lessons][${lessonCount}][description]" rows="2" class="rich-text-editor text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]"></textarea>
                    </div>
                    <div class="mt-2 content-field" id="content-field-${moduleId}-${lessonCount}">
                        <!-- El campo de contenido se mostrará aquí según el tipo seleccionado -->
                    </div>
                </div>
            `;
            lessonsContainer.insertAdjacentHTML('beforeend', lessonHtml);
    
    // Add GSAP animation for lesson
    const newLesson = lessonsContainer.lastElementChild;
    gsap.to(newLesson, {
        opacity: 1,
        scale: 1,
        duration: 1,
        ease: "power2.out"
    });
    
    tinymce.init({
        skin: 'oxide-dark',
        content_css: 'dark',
        menubar: true,
        selector: `#lessons-container-${moduleId} .lesson:last-child .rich-text-editor`
    });
    
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
                        <textarea name="modules[${moduleId}][lessons][${lessonId}][content]" rows="6" class="rich-text-editor text-lg w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] focus:border-[var(--highlight-color)]"></textarea>
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
            if (lessonType === 'text') {
                tinymce.init({
                    selector: `#content-field-${moduleId}-${lessonId} .rich-text-editor`,
                    plugins: [
                        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'permanentpen', 'advtable', 'advcode', 'editimage', 'tinycomments', 'tableofcontents'
                    ],
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [
                        { value: 'First.Name', title: 'First Name' },
                        { value: 'Email', title: 'Email' },
                    ],
                    height: 300,
                    menubar: false
                });
            } else if (lessonType === 'quiz') {
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
            tinymce.triggerSave();
    
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
    
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
    
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
    
            const firstError = document.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    </script>
</x-appLayout>