<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nimi - Cursos, tutoriales, clases y más</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/normalize.css'])
    @vite(['resources/js/inicioSesion.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" sizes="16x16" href="/img/fav.jpeg">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/fav.jpeg"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-[var(--background-index)] overflow-hidden h-screen font-[var(----main-font)]  ">
    <main class=" overflow-hidden relative h-[100vh] flex justify-center items-center text-[var(--text-color-index)] ">
        <div class="stars"></div>
        <div class="cosmicCircle" style="width: 300px; height: 300px; top: -100px; left: -100px;"></div>
        <div class="cosmicCircle " style="width: 300px; height: 300px; bottom: -300px; right: -200px;"></div>

        <div class="text-[1.5rem] bg-[#11112718] shadowNav  my-[10px] rounded-[10px] w-[100%] px-10 py-10 max-w-[400px] fadeInFocus [&>form>div]:mb-[24px] [&>form>div]:flex [&>form>div]:flex-col [&>form>div]:gap-5 [&>form>div>label]:uppercase [&>form>div>label]:font-medium [&>form>div>input]:h-[40px] [&>form>div>input]:px-[12px] ">

            <div class="flex justify-center">
                <img class="w-[35%] h-auto" src="/img/Logo2.png" alt="Nimi logo">
            </div>

            
            <form class="" id="loginForm" method="post" action="login">
                @csrf
                <h2 class="uppercase font-bold text-center text-[2.5rem] text-[var(--highlight-color)] tracking-wider my-[24px]">Iniciar Sesión</h2>
                <div>
                    <label for="email">Correo Electrónico</label>
                    <input class="indexInput" type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
                </div>
                <div>
                    <label for="password">Contraseña</label>
                    <input class="indexInput togglePassword" type="password" id="password" name="password" placeholder="*********" required>
                </div>
                <button class="indexButton" type="submit">Iniciar Sesión</button>
            </form>

            <form id="registerForm" style="display: none;" method="post" action="register">
                @csrf
                <h2 class="uppercase font-bold text-center text-[2.5rem] text-[var(--highlight-color)] tracking-wider my-[24px]">Registrarse</h2>
                <div>
                    <label for="registerName">Nombre</label>
                    <input class="indexInput" type="text" id="registerName" name="name" placeholder="Ingresa tu nombre" required>
                </div>
                <div>
                    <label for="registerEmail">Correo Electrónico</label>
                    <input class="indexInput" type="email" id="registerEmail" name="email" placeholder="correo@ejemplo.com" required>
                </div>
                <div>
                    <label for="registerPassword">Contraseña</label>
                    <input class="indexInput togglePassword" type="password" id="registerPassword" name="password" placeholder="*********" required>
                </div>
                <div>
                    <label for="reapetPassword">Repetir Contraseña</label>
                    <input class="indexInput togglePassword" type="password" id="reapetPassword" name="reapetPassword" placeholder="*********" required>
                    
                </div>
                <button class="indexButton" type="submit">Registrarse</button>
            </form>

            <form id="resetForm" style="display: none;">
                <h2 class="uppercase font-bold text-center text-[2.5rem] text-[var(--highlight-color)] tracking-wider my-[24px]">Restablecer Contraseña</h2>
                <div>
                    <label for="resetEmail">Correo Electrónico</label>
                    <input class="indexInput" type="email" id="resetEmail" name="email" placeholder="correo@ejemplo.com" required>
                </div>
                <button class="indexButton" type="submit">Enviar código</button>
            </form>

            <x-toggleForm>
                <x-slot name="id">
                    toggleRegister
                </x-slot>
                ¿No tienes cuenta? Regístrate
            </x-toggleForm>
            <x-toggleForm>
                <x-slot name="id">
                    toggleReset
                </x-slot>
                ¿Olvidaste tu contraseña?
            </x-toggleForm>
            @if(session('success'))
            <div class="alert text-center text-[2rem] my-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative ">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </main>
    <script>
        const eyeOpenSVG = `
            <svg class="text-[#dcdcdc] hover:text-cyan-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
  <circle cx="12" cy="12" r="3"/>
</svg>`;
        
        const eyeClosedSVG = `
            <svg class="text-[#dcdcdc]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
  <line x1="1" y1="1" x2="23" y2="23"/>
</svg>`;
        document.addEventListener('DOMContentLoaded', () => {
    const passwordInputs = document.querySelectorAll('.togglePassword');
    
    passwordInputs.forEach(input => {
        const wrapper = input.closest('div');
        input.classList.add('relative')
        // Create password toggle
        const toggleBtn = document.createElement('div');
        toggleBtn.innerHTML = eyeOpenSVG;
        toggleBtn.style.cssText = `
            position: absolute; 
            right: 30px; 
            bottom: 8px;
            background: none;
            border: none;
            cursor: pointer;
            z-index: 10;
        `;
        

        wrapper.style.position = 'relative';
        wrapper.appendChild(toggleBtn);

        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            input.type = input.type === 'password' ? 'text' : 'password';
            toggleBtn.innerHTML = input.type === 'password' ? eyeOpenSVG : eyeClosedSVG;
        });
    });

})
    </script>
</body>
</html>
