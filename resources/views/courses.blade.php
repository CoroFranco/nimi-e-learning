<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - {{ $lesson->title }} | Nimi Learning Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" sizes="16x16" href="/img/fav.jpeg">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/fav.jpeg">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
</head>
<body class="h-full font-[var(--main-font)]">
    <div id="app" class="min-h-screen bg-gradient-to-br from-[#1f2e33] to-[var(--text-color)] text-[var(--main-color)]">
        <header class="bg-[var(--course-card-bg)] shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <a href="/home" class="flex items-center">
                    <img src="/img/Logo1.png" alt="Nimi logo" class="h-16 w-auto">
                    <span class="ml-2 text-[1.5rem] font-bold text-[var(--highlight-color)]">Learning</span>
                    
                </a>
                <nav>
                    <ul class="flex space-x-4 text-[1.6rem]">
                        <li><a href="/explorer" class="text-[var(--text-gray)] hover:text-[var(--text-color-index)] transition duration-150 ease-in-out">Cursos</a></li>
                        <li><a href="/home/profile" class="text-[var(--text-gray)] hover:text-[var(--text-color-index)] transition duration-150 ease-in-out">Perfil</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main class="max-w-[1500px] w-[99%] mx-auto px-4 sm:px-6 py-8">
            <div class="bg-[var(--course-card-bg)] rounded-lg shadow-xl overflow-hidden">
                <div class="px-10 py-4 border-b border-gray-700">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="flex items-center mb-4 md:mb-0">
                            <div class="h-32 w-32 rounded-full overflow-hidden border-2 border-[var(--hover-color)] p-1 transition-all duration-300 hover:scale-110">
                                @if($course->instructor->profile_photo_path)
                                    <img class="h-full w-full object-cover rounded-full" 
                                         src="/storage/{{$course->instructor->profile_photo_path }}" 
                                         alt="{{ $course->instructor->name }}">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-[var(--text-color)] text-[var(--text-gray)] text-[2.5rem] font-bold">
                                        {{ strtoupper(substr($course->instructor->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h1 class="text-[2.5rem] font-bold text-[var(--course-main-color)]">{{ $course->title }}</h1>
                                <p class="text-[1.5rem] text-[var(--text-gray)]">Instructor: {{ $course->instructor->name }}</p>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <p class="text-[1.5rem] text-[var(--text-gray)]">Level: <span class="font-semibold text-[var(--highlight-color)]">{{ ucfirst($course->level) }}</span></p>
                            <p class="text-[1.5rem] text-[var(--text-gray)]">Category: <span class="font-semibold text-[var(--highlight-color)]">{{ $course->category->name }}</span></p>
                        </div>
                    </div>
                    @if($progress === 100)
                        
                    <a id="downloadCertificate" href="{{ url('/generate-certificate/'.$course->id) }}" class="m-auto relative inline-block text-center text-lg font-semibold text-white py-4 px-8 bg-gradient-to-r from-[#00b4d8] via-[#4fa3d1] to-[#4e94b7] rounded-xl shadow-lg hover:from-[#0094b3] hover:to-[#4179a4] transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 mt-4 w-full focus:ring-[#00b4d8] focus:ring-opacity-50">
                        <span class="absolute inset-0 bg-opacity-30 bg-gradient-to-r from-[#00b4d8] via-[#4fa3d1] to-[#4e94b7] rounded-xl"></span>
                        <span class="relative z-10 text-4xl">Descargar Certificado</span>
                    </a>
                    @endif
                    <div class="mt-8">
                        <h3 class="text-[1.5rem] font-semibold text-[var(--course-main-color)] mb-2">Course Progress</h3>
                        <div class="relative pt-1">
                            <div class="overflow-hidden h-4 mb-4 text-xs flex rounded-full bg-gray-700">
                                <div id="progressBar" class="shadow-none flex flex-col text-center space-nowrap text-[var(--text-gray)] justify-center bg-gradient-to-r from-[var(--hover-color)] to-[var(--highlight-color)]" style="width: 0%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <p class="text-[1.5rem] text-[var(--text-gray)]">
                            <span class="font-semibold text-[var(--highlight-color)]">{{ $completedLessons }}</span> of 
                            <span class="font-semibold text-[var(--highlight-color)]">{{ $totalLessons }}</span> lessons completed 
                            (<span id="progressText" class="font-semibold text-[var(--highlight-color)]">0%</span>)
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6">
                    <div class="md:col-span-1 space-y-6">
                        <div class="bg-black shadow-md p-4 h-full">
                            <h3 class="text-[1.5rem] font-semibold text-[var(--course-main-color)] mb-4">Course Modules</h3>
                            <div class="space-y-2">
                                @foreach ($course->modules as $module)
                                    <div class="bg-[var(--course-card-bg)] rounded-lg shadow-sm overflow-hidden module-container">
                                        <button class="text-[1.3rem] w-full text-left px-4 py-3 bg-[var(--hover-color)] text-[var(--text-gray)] font-medium hover:from-[var(--highlight-color)] hover:to-[var(--text-color)] transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-[var(--hover-color)] focus:ring-opacity-50 flex justify-between items-center module-toggle" data-module="{{ $module->id }}" aria-expanded="false" aria-controls="module-content-{{ $module->id }}">
                                            <span>{{ $module->title }}</span>
                                            <svg class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                        <div id="module-content-{{ $module->id }}" class="text-[1.1rem] bg-gray-750 px-4 py-2 module-content" style="display: none;">
                                            @foreach ($module->lessons as $moduleLesson)
                                                <a href="{{ route('courses.lesson', ['course' => $course->id, 'lesson' => $moduleLesson->id]) }}" 
                                                class="block py-2 px-3 my-1 rounded-md hover:bg-gray-700 transition-colors duration-200 {{ $lesson->id === $moduleLesson->id ? 'bg-gray-700 text-[var(--highlight-color)]' : 'text-[var(--text-gray)]' }} flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        @if (in_array($moduleLesson->id, $completedLessonIds))
                                                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        @else
                                                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        @endif
                                                        <span>{{ $moduleLesson->title }}</span>
                                                    </div>
                                                    <span class="text-[1.2rem] text-gray-500">{{ $moduleLesson->duration }} min</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="bg-[var(--input-bg)] md:col-span-3 bg-gray-750 rounded-lg shadow-md p-6">
                        <h2 class="text-[2.5rem] font-bold text-[var(--course-main-color)] mb-4">{{ $lesson->title }}</h2>
                        
                        <div class="mb-6">
                            <div class="text-[1.2rem] flex border-b border-gray-700">
                                <button id="contentTab" class="py-2 px-4 font-medium transition duration-200 focus:outline-none focus:ring-2 focus:ring-[var(--hover-color)] focus:ring-opacity-50 text-[var(--highlight-color)] border-b-2 border-[var(--hover-color)]" aria-selected="true" aria-controls="contentSection">
                                    Lesson Content
                                </button>
                                <button id="commentsTab" class="py-2 px-4 font-medium transition duration-200 focus:outline-none focus:ring-2 focus:ring-[var(--hover-color)] focus:ring-opacity-50 text-[var(--text-gray)] hover:text-[var(--text-color-index)]" aria-selected="false" aria-controls="commentsSection">
                                    Comments
                                </button>
                            </div>
                        </div>

                        <div id="contentSection" role="tabpanel" aria-labelledby="contentTab">
                            @if ($lesson->type === 'video')
                                <div class="aspect-w-16 aspect-video mb-4">
                                    <iframe src="{{ $lesson->content }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full rounded-lg" title="Lesson Video"></iframe>
                                </div>
                            @elseif ($lesson->type === 'text')
                                <div class="text-white text-[1.5rem]">
                                    {!! $lesson->content !!}
                                </div>
                            @elseif ($lesson->type === 'quiz')
                                <form id="quiz-form" method="POST">
                                    @csrf
                                    @foreach ($lesson->quizQuestions as $question)
                                        <div class="mb-6 p-4 bg-[var(--course-card-bg)] rounded-lg text-[1.5rem]">
                                            <p class="font-semibold mb-3 text-[var(--course-main-color)]">{{ $question->question }}</p>
                                            @foreach (explode("\n", $question->answers) as $index => $answer)
                                                <label class="block mb-2 flex items-center">
                                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer }}" required class="mr-2 text-[var(--text-color)] focus:ring-[var(--hover-color)] focus:ring-offset-[var(--course-card-bg)]" id="question-{{ $question->id }}-answer-{{ $index }}">
                                                    <span class="text-[var(--text-gray)]">{{ $answer }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    <button type="submit" class="text-[1.5rem] bg-[var(--hover-color)] text-[var(--text-gray)] px-6 py-2 rounded-md hover:bg-[var(--highlight-color)] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[var(--hover-color)] focus:ring-offset-2 focus:ring-offset-[var(--course-card-bg)]">Submit Quiz</button>
                                </form>
                                <div class="m-10 flex justify-center gap-10 text-[1.5rem] text-[var(--text-color-index)]" id="quiz-results" aria-live="polite"></div>
                            @endif
                        </div>

                        <div id="commentsSection" style="display: none;" role="tabpanel" aria-labelledby="commentsTab">
                            <form id="commentForm" action="{{ route('courses.addComment', ['course' => $course->id, 'lesson' => $lesson->id]) }}" method="POST" class="text-[1.5rem] pb-5 mb-5 border-gray-700 border-b-[1px]">
                                @csrf
                                <textarea id="commentContent" name="content" rows="3" class="w-full p-3 bg-gray-700 text-gray-200 border border-gray-600 rounded-md focus:ring-2 focus:ring-[var(--hover-color)] focus:border-transparent transition duration-200" placeholder="Add a comment..."></textarea>
                                <button type="submit" class="mt-2 bg-[var(--hover-color)] text-[var(--text-gray)] px-4 py-2 rounded-md hover:bg-[var(--highlight-color)] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[var(--hover-color)] focus:ring-offset-2 focus:ring-offset-[var(--course-card-bg)]">Post Comment</button>
                            </form>
                            <div id="commentsList">
                                @foreach ($comments as $comment)
                                <div id="comment-{{ $comment->id }}" class="bg-[var(--course-card-bg)] p-4 rounded-lg shadow-xl mb-4 transition-all duration-200 hover:shadow-2xl">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full overflow-hidden mr-3">
                                                @if($comment->user->profile_photo_path)
                                                    <img src="/storage/{{ $comment->user->profile_photo_path }}" alt="{{ $comment->user->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-[var(--text-color)] text-[var(--text-gray)] text-[1.5rem] font-bold">
                                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-semibold text-[var(--course-main-color)]">{{ $comment->user->name }}</p>
                                                <p class="text-[1.2rem] text-[var(--text-gray)]">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        @if(Auth::id() === $comment->user_id)
                                            <button class="text-red-400 hover:text-red-300 transition duration-200 delete-comment" data-comment-id="{{ $comment->id }}">
                                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        @endif
                                    </div>
                                    <p class="text-[1.5rem] mt-2 text-[var(--text-color-index)]">{{ $comment->content }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-8">
                            @if ($previousLesson)
                                <a href="{{ route('courses.lesson', ['course' => $course->id, 'lesson' => $previousLesson->id]) }}" class="bg-gray-700 text-gray-200 px-4 py-2 rounded-md hover:bg-gray-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                    Previous Lesson
                                </a>
                            @else
                                <div></div>
                            @endif

                            @if (!in_array($lesson->id, $completedLessonIds))
                                <form action="{{ route('courses.completeLesson', ['course' => $course->id, 'lesson' => $lesson->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-[var(--text-gray)] px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-[var(--course-card-bg)] flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Mark as Completed
                                    </button>
                                </form>
                            @else
                                <span class="text-green-400 font-semibold flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Lesson Completed
                                </span>
                            @endif

                            @if ($nextLesson)
                                <a href="{{ route('courses.lesson', ['course' => $course->id, 'lesson' => $nextLesson->id]) }}" class="bg-gray-700 text-gray-200 px-4 py-2 rounded-md hover:bg-gray-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 flex items-center">
                                    Next Lesson
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            @else
                                <div></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            gsap.registerPlugin(ScrollTrigger);

            // Progress bar animation
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progress = {{ $progress }};
            
            gsap.to(progressBar, {
                width: `${progress}%`,
                duration: 1.5,
                ease: "power2.out",
                onUpdate: function() {
                    const currentProgress = Math.round(progressBar.offsetWidth / progressBar.parentNode.offsetWidth * 100);
                    progressText.textContent = `${currentProgress}%`;
                    progressBar.setAttribute('aria-valuenow', currentProgress);
                }
            });

            // Module toggle animation
            const moduleToggles = document.querySelectorAll('.module-toggle');
            moduleToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const moduleContent = this.nextElementSibling;
                    const chevron = this.querySelector('svg');
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';

                    this.setAttribute('aria-expanded', !isExpanded);

                    if (!isExpanded) {
                        moduleContent.style.display = 'block';
                        gsap.from(moduleContent, {height: 0, opacity: 0, duration: 0.3, ease: "power2.out"});
                        gsap.to(chevron, {rotation: 180, duration: 0.3});
                    } else {
                        gsap.to(moduleContent, {
                            height: 0, 
                            opacity: 0, 
                            duration: 0.3, 
                            ease: "power2.in",
                            onComplete: () => {
                                moduleContent.style.display = 'none';
                                moduleContent.style.height = 'auto';
                                moduleContent.style.opacity = 1;
                            }
                        });
                        gsap.to(chevron, {rotation: 0, duration: 0.3});
                    }
                });
            });

            // Tab switching animation
            const contentTab = document.getElementById('contentTab');
            const commentsTab = document.getElementById('commentsTab');
            const contentSection = document.getElementById('contentSection');
            const commentsSection = document.getElementById('commentsSection');

            function switchTab(activeTab, activeSection, inactiveTab, inactiveSection) {
                activeTab.setAttribute('aria-selected', 'true');
                inactiveTab.setAttribute('aria-selected', 'false');
                activeTab.classList.add('text-[var(--highlight-color)]', 'border-b-2', 'border-[var(--hover-color)]');
                activeTab.classList.remove('text-[var(--text-gray)]', 'hover:text-[var(--text-color-index)]');
                inactiveTab.classList.remove('text-[var(--highlight-color)]', 'border-b-2', 'border-[var(--hover-color)]');
                inactiveTab.classList.add('text-[var(--text-gray)]', 'hover:text-[var(--text-color-index)]');

                gsap.to(inactiveSection, {opacity: 0, y: 20, duration: 0.3, onComplete: () => {
                    inactiveSection.style.display = 'none';
                    activeSection.style.display = 'block';
                    gsap.fromTo(activeSection, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.3 });
                }});
            }

            contentTab.addEventListener('click', () => switchTab(contentTab, contentSection, commentsTab, commentsSection));
            commentsTab.addEventListener('click', () => switchTab(commentsTab, commentsSection, contentTab, contentSection));

            // Comment animation
            const comments = document.querySelectorAll('#commentsSection > div');
            gsap.to(comments, {
                opacity: 1,
                y: 10,
                duration: 0.5,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: "#commentsSection",
                    start: "top bottom-=100px",
                    toggleActions: "play none none none"
                }
            });

            // Delete comment animation
            function deleteComment (){
                document.querySelectorAll('.delete-comment').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const commentId = this.getAttribute('data-comment-id');
                    if (confirm('Are you sure you want to delete this comment?')) {
                        fetch(`/courses/{{ $course->id }}/lessons/{{ $lesson->id }}/comments/${commentId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const commentElement = document.getElementById(`comment-${commentId}`);
                                gsap.to(commentElement, {
                                    opacity: 0,
                                    y: -20,
                                    duration: 0.3,
                                    onComplete: () => commentElement.remove()
                                });
                            } else {
                                alert('Error deleting comment');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('Error deleting comment');
                        });
                    }
                });
            });
            }
            deleteComment();

            document.getElementById('commentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const commentContent = document.getElementById('commentContent').value;
    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const newComment = data.comment;
            
            const newCommentHtml = `
                <div id="comment-${newComment.id}" class="bg-[var(--course-card-bg)] p-4 rounded-lg shadow-xl mb-4 transition-all duration-200 hover:shadow-2xl opacity-0 transform translate-y-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full overflow-hidden mr-3">
                                ${newComment.user.profile_photo_path ? 
                                    `<img src="/storage/${newComment.user.profile_photo_path}" alt="${newComment.user.name}" class="w-full h-full object-cover">` : 
                                    `<div class="w-full h-full flex items-center justify-center bg-[var(--text-color)] text-[var(--text-gray)] text-[1.5rem] font-bold">
                                        ${newComment.user.name.charAt(0).toUpperCase()}
                                    </div>`}
                            </div>
                            <div>
                                <p class="font-semibold text-[var(--course-main-color)] text-[1.5rem]">${newComment.user.name}</p>
                                <p class="text-[1.2rem] text-[var(--text-gray)]">Just now</p>
                            </div>
                        </div>
                        ${newComment.user_id === {{ Auth::id() }} ? 
                            `<button class="text-red-400 hover:text-red-300 transition duration-200 delete-comment" data-comment-id="${newComment.id}">
                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>` : ''}
                    </div>
                    <p class="text-[1.5rem] mt-2 text-[var(--text-color-index)]">${newComment.content}</p>
                </div>`;

            const commentsList = document.getElementById('commentsList');
            commentsList.insertAdjacentHTML('afterbegin', newCommentHtml);

            document.getElementById('commentContent').value = ''; // Limpiar el campo del formulario

            const newCommentElement = document.getElementById(`comment-${newComment.id}`);
            gsap.to(newCommentElement, {
                opacity: 1, 
                translateY: 0, 
                scale: 1, 
                duration: 0.5, 
                ease: "back.out(1.7)" // Esta añade un efecto de rebote
            });
            
        }
    })
    .catch(error => {
        console.error('Error posting comment:', error);
    });
});

            document.getElementById('quiz-form').addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const quizResultsDiv = document.getElementById('quiz-results');

                fetch('{{ route("courses.submit-quiz", [$course->id, $lesson->id]) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const score = data.quizResults.score;
                        const correctAnswers = data.quizResults.correctAnswers;
                        const totalQuestions = data.quizResults.totalQuestions;
                        const scoreClass = score > 50 ? 'text-green-500' : 'text-red-500';
                        
                        quizResultsDiv.innerHTML = `
                            <p class='${scoreClass}'>Score: ${score}%</p>
                            <p class='${scoreClass}'>Correct Answers: ${correctAnswers} of ${totalQuestions}</p>
                        `;
                        
                        gsap.from(quizResultsDiv, {opacity: 0, y: 20, duration: 0.5, ease: "power2.out"});
                    } else {
                        quizResultsDiv.innerHTML = `<p class='text-red-500'>There was an error processing the quiz.</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    quizResultsDiv.innerHTML = `<p class='text-red-500'>There was an error processing the quiz.</p>`;
                });
            });
        });
        //confetti
        window.addEventListener('load', function() {
        // Suponemos que el valor de progreso está disponible en la variable `progress` de JavaScript
        let progress = {{ $progress }}; // Laravel Blade pasa el valor de la variable `progress` a JavaScript

        if (progress === 100) {
            // Lanza el confeti automáticamente
            confetti({
                particleCount: 800,
                spread: 300,
                origin: { y: 0.6 },
                colors: ['#ff0a54', '#ff477e', '#ff7096', '#ff85a1', '#fbb1bd'],
            });

        }
    });
    </script>

    @if(session('success'))
        <div id="successMessage" class="fixed bottom-4 right-4 bg-green-500 text-[var(--text-gray)] px-6 py-3 rounded-lg shadow-lg opacity-0 transform translate-y-2" role="alert" aria-live="assertive">
            {{ session('success') }}
        </div>
        <script>
            gsap.to("#successMessage", {opacity: 1, y: 0, duration: 0.5, ease: "power2.out"});
            gsap.to("#successMessage", {opacity: 0, y: 2, duration: 0.5, delay: 3, ease: "power2.in"});
        </script>
    @endif

    @if ($errors->any())
        <div id="errorMessage" class="fixed bottom-4 right-4 bg-red-500 text-[var(--text-gray)] px-6 py-3 rounded-lg shadow-lg opacity-0 transform translate-y-2" role="alert" aria-live="assertive">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            gsap.to("#errorMessage", {opacity: 1, y: 0, duration: 0.5, ease: "power2.out"});
            gsap.to("#errorMessage", {opacity: 0, y: 2, duration: 0.5, delay: 5, ease: "power2.in"});
        </script>
    @endif
</body>
</html>