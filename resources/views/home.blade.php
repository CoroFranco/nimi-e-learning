<x-applayout>
    <style>
        .floating-image {
    box-shadow: 0 1px 20px rgba(0, 0, 0, 0.5); /* Agrega la sombra */
    position: relative; /* Asegúrate de que se posicionen correctamente */
    z-index: 1; /* Garantiza que la imagen esté encima de la sombra */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
    </style>
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    @endpush
    <main class="flex-1 overflow-hidden bg-gradient-to-br from-[var(--background-main)] to-[var(--card-bg)]">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row items-center mb-16">
                <div class="lg:w-1/2 lg:pr-12 mb-8 lg:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Descubre. Aprende.<br>
                        <span class="text-[var(--highlight-color)]">Crea.</span>
                    </h1>
                    <p class="text-2xl text-gray-600 mb-8">Nimi: El marketplace de conocimientos donde cada pasión encuentra su lugar.</p>
                    <div class="space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{route('explorer')}}" class="text-2xl inline-block bg-[var(--highlight-color)] text-white font-semibold py-3 px-8 rounded-md hover:bg-[var(--hover-color)] transition duration-300">
                            Explorar Cursos
                        </a>
                        @php
                            $instructorRoute = Auth::check() ? route('become.instructor.form') : route('welcome');
                        @endphp
                        <a href="{{$instructorRoute}}" class="text-2xl inline-block bg-gray-200 text-gray-800 font-semibold py-3 px-8 rounded-md hover:bg-gray-300 transition duration-300">
                            Enseñar en Nimi
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="image-container" data-image-index="0">
                            <img src="/img/dev.jpeg" alt="Curso 1" class="floating-image max-h-[200px] rounded-lg shadow-md">
                        </div>
                        <div class="image-container" data-image-index="1">
                            <img src="/img/food.png" alt="Curso 2" class="floating-image max-h-[200px] rounded-lg shadow-md mt-8">
                        </div>
                        <div class="image-container" data-image-index="2">
                            <img src="/img/photograpy.jpeg" alt="Curso 3" class="floating-image max-h-[200px] rounded-lg shadow-md">
                        </div>
                        <div class="image-container" data-image-index="3">
                            <img src="/img/music.jpeg" alt="Curso 4" class="floating-image rounded-lg shadow-md mt-8">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Explora Mundos de Conocimiento</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($categories as $category)
                        <a href="#" class="bg-gray-400 rounded-lg p-6 text-center hover:bg-[var(--highlight-color)] transition duration-300">
                            <span class="block text-2xl font-semibold text-gray-800">{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-8 mb-16">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Comparte tu Pasión</h2>
                    <p class="text-gray-600 mb-6 text-2xl">En Nimi, creemos que todos tienen algo valioso que enseñar. ¿Listo para compartir tu conocimiento?</p>
                    <a href="{{$instructorRoute}}" class="text-xl inline-block bg-[var(--highlight-color)] text-white font-semibold py-3 px-8 rounded-md hover:bg-[var(--hover-color)] transition duration-300">
                        Crea tu Primer Curso
                    </a>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Cursos Destacados</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if ($randomCourses)  
                    @foreach($randomCourses as $course)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                            <img src="storage/{{$course->thumbnail_path}}" alt="Curso" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{$course->title}}</h3>
                                <p class="text-gray-600 mb-4">{{$course->description}}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-[var(--highlight-color)] font-semibold">{{$course->price}}</span>
                                    <a href="#" class="text-gray-600 hover:text-[var(--highlight-color)]">Más información →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Por qué Crear en Nimi</h2>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-xl text-gray-700">Alcanza a estudiantes de todo el mundo</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-xl text-gray-700">Herramientas fáciles de usar para crear contenido</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-xl text-gray-700">Gana dinero compartiendo tu conocimiento</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-xl text-gray-700">Únete a una comunidad de creadores apasionados</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-gray-300 rounded-lg p-6 shadow-2xl">
                    <h3 class="text-4xl font-bold text-black mb-4">Comienza tu Viaje como Creador</h3>
                    <p class="text-gray-600 mb-6 text-2xl">Únete a miles de creadores que ya están compartiendo su pasión y ganando con Nimi.</p>
                    <a href="{{route('become.instructor.form')}}" class="inline-block bg-[var(--highlight-color)] text-white font-semibold py-3 px-8 rounded-md hover:bg-[var(--hover-color)] transition duration-300">
                        Empieza Ahora
                    </a>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const imageContainers = document.querySelectorAll('.image-container');
            const maxRotation = 15; // Increased rotation angle

            imageContainers.forEach(container => {
                const image = container.querySelector('.floating-image');
                
                container.addEventListener('mousemove', (e) => {
                    const rect = container.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;
                    
                    const mouseX = e.clientX;
                    const mouseY = e.clientY;
                    
                    // Increased rotation and more dramatic effect
                    const angleX = ((mouseY - centerY) / (rect.height / 2)) * maxRotation;
                    const angleY = -((mouseX - centerX) / (rect.width / 2)) * maxRotation;
                    
                    gsap.to(image, {
                        rotationX: angleX,
                        rotationY: angleY,
                        scale: 1, // Slightly increased scale
                        translateX: (mouseX - centerX) / 20, // Added horizontal movement
                        translateY: (mouseY - centerY) / 20, // Added vertical movement
                        duration: 0.7,
                        ease: 'power1.out'
                    });
                });
                
                container.addEventListener('mouseleave', () => {
                    gsap.to(image, {
                        rotationX: 0,
                        rotationY: 0,
                        scale: 1,
                        translateX: 0,
                        translateY: 0,
                        duration: 0.7,
                        ease: 'power1.out'
                    });
                });
            });
        });
    </script>
</x-appLayout>
