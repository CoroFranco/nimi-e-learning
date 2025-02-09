<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado del Curso de Programación Avanzada</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
            padding: 40px;
            box-sizing: border-box;
            overflow-x: hidden; /* Evita desbordamientos horizontales */
        }
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #e0e0e0;
            background-color: #1a1a2e;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden; /* Elimina el scroll */
        }
        .container {
            background-color: #16213e;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 100%; /* Elimina la restricción de max-width */
            box-sizing: border-box;
            overflow: hidden;
        }
        .certificate {
            border: 2px solid #0f3460;
            padding: 20px;
            text-align: center;
            position: relative;
            overflow: hidden; /* Elimina cualquier contenido que se desborde */
        }
        .certificate::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 65%, rgba(131, 58, 180, 0.1) 70%, transparent 75%);
            animation: shine 3s infinite;
        }
        @keyframes shine {
            0% { transform: translateX(-50%) translateY(-50%) rotate(0deg); }
            100% { transform: translateX(-50%) translateY(-50%) rotate(360deg); }
        }
        h1 {
            color: #00b4d8;
            font-family: 'Source Code Pro', monospace;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            background-color: #0f3460;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3em;
            font-weight: 500;
            color: #00b4d8;
        }
        .certificate-details {
            margin-bottom: 30px;
            font-size: 1.2em;
        }
        .certificate-details p {
            margin: 10px 0;
        }
        .name {
            font-size: 2em;
            color: #48cae4;
            margin: 20px 0;
            font-weight: bold;
        }
        .course {
            font-size: 1.5em;
            color: #ade8f4;
            margin-bottom: 20px;
        }
        .signature {
            font-family: 'Source Code Pro', monospace;
            font-style: italic;
            color: #90e0ef;
            margin-top: 30px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #caf0f8;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 2em;
            }
            .name {
                font-size: 1.5em;
            }
            .course {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="certificate">
            <div class="logo">&lt;/NIMI&gt;</div>
            
            <h1>Certificado de Finalización</h1>
            <p>Se certifica que</p>
            <p class="name">{{$user->name}}</p>
            <p>ha completado con éxito el curso de</p>
            <p class="course">{{$course->title}}</p>
            <div class="certificate-details">
                <p><strong>Duración del Curso:</strong> {{$course->lessons()->sum('duration')}} Min</p>
                <p><strong>Fecha de Finalización:</strong> {{$completionDate}}</p>
                <p><strong>ID del Certificado:</strong> {{$user->id}}{{$course->id}}{{$enrollment->id}}-NM</p>
            </div>
            <p class="signature">{{$course->instructor->name}}<br>Instructor del Curso</p>
        </div>
        <div class="footer">
            <p>Este certificado verifica la finalización del Curso</p>
            <p>Para verificar este certificado, por favor visita: www.example.com/verify</p>
        </div>
    </div>
</body>
</html>
