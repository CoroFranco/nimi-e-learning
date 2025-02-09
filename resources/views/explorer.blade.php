<x-app-layout>
    
    <main class="w-full p-6 md:p-8 lg:p-12 bg-gradient-to-br from-[var(--background-main)] to-[var(--card-bg)]">
        <div class="max-w-[1400px] m-auto">
            <h1 class="text-6xl font-bold mb-8 text-[var(--text-color)] tracking-tight">Explorar Cursos</h1>

            <div class="mb-8">
                <div class="relative">
                    <input 
                        type="text" 
                        id="search" 
                        placeholder="Buscar cursos..." 
                        class="text-[1.8rem] w-full px-6 py-2 rounded-xl bg-[var(--input-bg)] text-[var(--text-color)] border-2 border-[var(--border-color)] focus:outline-none focus:ring-2 focus:ring-[var(--hover-color)] focus:border-[var(--highlight-color)] transition duration-300 ease-in-out shadow-sm hover:shadow-md"
                    >
                    <svg 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 h-6 w-6 text-[var(--text-color-secondary)] cursor-pointer transition duration-300 ease-in-out hover:text-[var(--highlight-color)]"
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24" 
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        ></path>
                    </svg>
                </div>
            </div>
    
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-1/4">
                    <div class="bg-[var(--menu-bg)] rounded-3xl p-8 shadow-xl sticky top-4">
                        <button id="filter-toggle" class="lg:hidden w-full flex justify-between items-center text-[var(--text-color)] mb-4" aria-expanded="false" aria-controls="filter-content">
                            <span class="text-[2rem] font-semibold">Filtros</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="filter-content" class="hidden lg:block">
                            <form id="filter-form" class="space-y-6">
                                <div class="space-y-3 pr-2">
                                    <h3 class="text-[2rem] font-medium mb-2 text-[var(--text-color)]">Categorías</h3>
                                    <div class="">
                                        @foreach($categories as $category)
                                            <label class="flex items-center p-3 rounded-xl hover:bg-[var(--card-bg)] transition duration-200">
                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="cursor-pointer form-checkbox text-[var(--highlight-color)] rounded-lg h-5 w-5">
                                                <span class="ml-3 text-[var(--text-color)] text-2xl cursor-pointer">{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-[2rem] font-medium mb-2 text-[var(--text-color)]">Nivel</h3>
                                    @foreach(['Beginner', 'Intermediate', 'Advanced'] as $level)
                                        <label class="flex items-center p-3 rounded-xl hover:bg-[var(--card-bg)] transition duration-200">
                                            <input type="checkbox" name="levels[]" value="{{ strtolower($level) }}" class=" cursor-pointer form-checkbox text-[var(--highlight-color)] rounded-lg h-5 w-5">
                                            <span class="ml-3 text-[var(--text-color)] text-2xl cursor-pointer">{{ $level }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="">
                                    <h3 class="text-[2rem] font-medium mb-2 text-[var(--text-color)]">Precio</h3>
                                    <div class="flex flex-wrap space-x-4 place-items-center">
                                        <input type="number" name="min_price" placeholder="Min" class="text-2xl w-32 px-2 py-4 rounded-md bg-[var(--input-bg)] text-[var(--text-color)] border border-[var(--border-color)]">
                                        <span class="text-[var(--text-color)]">-</span>
                                        <input type="number" name="max_price" placeholder="Max" class="text-2xl w-32 px-2 py-4 rounded-md bg-[var(--input-bg)] text-[var(--text-color)] border border-[var(--border-color)]">
                                    </div>
                                </div>
                                <button type="submit" class="text-2xl w-full px-4 py-2 bg-[var(--highlight-color)] hover:bg-[var(--hover-color)] text-white rounded-md hover:bg-opacity-90 transition duration-300">
                                    Aplicar Filtros
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="lg:w-3/4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-[3rem] font-extrabold text-[var(--text-color)]">Resultados</h2>
                        <select 
                            id="sort" 
                            class="text-[1.3rem] px-5 py-3 rounded-md bg-[var(--input-bg)] text-[var(--text-color)] border-2 border-[var(--border-color)] focus:outline-none focus:ring-2 focus:ring-[var(--highlight-color)] transition duration-300 ease-in-out shadow-sm hover:shadow-md">
                            <option value="newest">Más recientes</option>
                            <option value="popular">Más populares</option>
                            <option value="price_low">Precio: Bajo a Alto</option>
                            <option value="price_high">Precio: Alto a Bajo</option>
                        </select>
                    </div>
                    <div id="courses-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    </div>
                    <div id="pagination" class="text-2xl mt-8 flex justify-center">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const filterForm = document.getElementById('filter-form');
        const sortSelect = document.getElementById('sort');
        const coursesGrid = document.getElementById('courses-grid');
        const pagination = document.getElementById('pagination');
        const filterToggle = document.getElementById('filter-toggle');
        const filterContent = document.getElementById('filter-content');
    
        let currentPage = 1;
        let debounceTimer;
    

    
        function debounce(func, delay) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(func, delay);
        }
    
        function fetchCourses() {
            console.log('Obteniendo cursos...');
            const formData = new FormData(filterForm);
            
            // Convertir los checkboxes de categorías y niveles en strings separados por comas
            const categories = Array.from(formData.getAll('categories[]')).join(',');
            const levels = Array.from(formData.getAll('levels[]')).join(',');
            
            const params = {
                search: searchInput.value,
                categories: categories,
                levels: levels,
                min_price: formData.get('min_price'),
                max_price: formData.get('max_price'),
                sort: sortSelect.value,
                page: currentPage
            };

            console.log('Parámetros de búsqueda:', params);

            axios.get('{{ route("api.courses.search") }}', { params })
                .then(response => {
                    console.log('Cursos obtenidos:', response.data);
                    if (response.data.courses.length === 0) {
                        console.log('No se encontraron cursos. Verifica tus criterios de búsqueda.');
                    }
                    updateCoursesGrid(response.data.courses);
                    updatePagination(response.data.pagination);
                })
                .catch(error => {
                    console.error('Error al obtener cursos:', error.response ? error.response.data : error.message);
                });
        }
    
        function updateCoursesGrid(courses) {
    coursesGrid.innerHTML = courses.map(course => `
        <div class="bg-[var(--courses-bg)] rounded-xl shadow-xl transform transition-all duration-300 ease-in-out hover:scale-100px hover:shadow-2xl hover:translate-y-2">
            <div class="relative rounded-t-3xl overflow-hidden">
                <img src="storage/${course.thumbnail_path}" alt="${course.title}" class="w-full h-60 object-cover transition-transform duration-500 ease-in-out hover:scale-110">
                <div class="absolute top-4 right-4 bg-[var(--highlight-color)] text-[var(--text-color-index)] text-xl font-semibold py-2 px-4 rounded-full shadow-lg">
                    ${course.category.name}
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-3xl font-extrabold text-[var(--text-color)] mb-4 line-clamp-2" title="${course.title}">
                    ${course.title}
                </h3>
                <div class="flex items-center text-sm mb-4">
                    <svg class="w-6 h-6 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="text-[var(--text-color)] font-medium">4.5 (120 reseñas)</span>
                </div>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-2xl font-bold text-[var(--highlight-color)]">$${parseFloat(course.price).toFixed(2)}</span>
                    <span class="text-lg font-medium px-4 py-1 bg-[var(--card-bg)] text-[var(--text-color)] rounded-full capitalize shadow-md">
                        ${course.level}
                    </span>
                </div>
                <a href="/show/${course.id}" class="block w-full text-center py-3 bg-[var(--highlight-color)] text-[var(--text-color-index)] rounded-lg text-xl font-semibold hover:bg-[var(--hover-color)] transition duration-300 ease-in-out shadow-md hover:shadow-xl">
                    Ver Curso
                </a>
            </div>
        </div>
    `).join('');
}


    
        function updatePagination(paginationData) {
            const totalPages = paginationData.last_page;
            let paginationHTML = '';
    
            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
                    <button class="px-3 py-1 mx-1 rounded ${i === currentPage ? 'bg-[var(--hover-color)] text-white' : 'bg-[var(--courses-bg)] text-[var(--text-color)]'}"
                            onclick="changePage(${i})">
                        ${i}
                    </button>
                `;
            }
    
            pagination.innerHTML = paginationHTML;
        }
    
        window.changePage = function(page) {
            currentPage = page;
            fetchCourses();
        }
    
        searchInput.addEventListener('input', () => debounce(fetchCourses, 300));
        filterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            currentPage = 1;
            fetchCourses();
        });
        sortSelect.addEventListener('change', fetchCourses);
    
        // Agregar funcionalidad para el toggle de filtros en dispositivos móviles
        filterToggle.addEventListener('click', function() {
            filterContent.classList.toggle('hidden');
            const isExpanded = !filterContent.classList.contains('hidden');
            this.setAttribute('aria-expanded', isExpanded);
            // Cambiar el ícono cuando se expande/colapsa
            const svg = this.querySelector('svg');
            svg.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';
        });

        // Función para manejar el cambio de tamaño de la ventana
        function handleResize() {
            if (window.innerWidth >= 1024) { // 1024px es el breakpoint para 'lg' en Tailwind por defecto
                filterContent.classList.remove('hidden');
            } else {
                filterContent.classList.add('hidden');
            }
        }

        // Ejecutar handleResize en la carga inicial y en cada cambio de tamaño de la ventana
        window.addEventListener('resize', handleResize);
        handleResize();
    
        fetchCourses(); // Initial fetch
    });
    </script>
</x-app-layout>
