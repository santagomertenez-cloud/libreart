<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Páginas Abiertas | Librería-Café & Donación de Libros Rurales</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome CDN para Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- QRCode.js para generación dinámica de códigos QR -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        coffee: {
                            50: '#fdfbf7',
                            100: '#f7f2e8',
                            200: '#eee2cd',
                            300: '#e1cca8',
                            500: '#b8925f',
                            700: '#6b4d27',
                            800: '#4a3319',
                            900: '#2d1e0e',
                        },
                        paper: '#f9f6f0',
                        ruralGreen: '#2e5a44',
                        amberGold: '#d97706',
                    },
                    fontFamily: {
                        serif: ['Lora', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #f7f2e8;
            color: #2d1e0e;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, .font-serif {
            font-family: 'Lora', serif;
        }
        .wood-pattern {
            background-color: #2d1e0e;
            background-image: radial-gradient(#4a3319 1px, transparent 0);
            background-size: 16px 16px;
        }
        .paper-texture {
            background-color: #fdfbf7;
            box-shadow: 0 4px 20px -2px rgba(45, 30, 14, 0.08);
            border: 1px solid #eee2cd;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f7f2e8;
        }
        ::-webkit-scrollbar-thumb {
            background: #b8925f;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6b4d27;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between antialiased selection:bg-amber-200 selection:text-coffee-900">

    <!-- Toast Notifications Container -->
    <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none"></div>

    <!-- NAVEGACIÓN PRINCIPAL -->
    <header class="sticky top-0 z-40 bg-coffee-900 text-coffee-100 shadow-md border-b border-coffee-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo / Nombre del Café -->
            <div class="flex items-center space-x-3 cursor-pointer" onclick="scrollToSection('hero')">
                <div class="w-10 h-10 rounded-full bg-coffee-500 text-coffee-900 flex items-center justify-center font-bold text-xl shadow-inner">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div>
                    <span class="font-serif text-xl sm:text-2xl font-bold tracking-tight block leading-none">Páginas Abiertas</span>
                    <span class="text-xs text-coffee-300 tracking-wider uppercase font-semibold">Librería & Cafetería Solidaria</span>
                </div>
            </div>

            <!-- Menú Navegación -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="#mision" onclick="scrollToSection('mision')" class="hover:text-coffee-300 transition-colors">La Misión</a>
                <a href="#criterios" onclick="scrollToSection('criterios')" class="hover:text-coffee-300 transition-colors">Qué Aceptamos</a>
                <a href="#donar" onclick="scrollToSection('donar')" class="hover:text-coffee-300 transition-colors">Donar Libros</a>
                <a href="#escuelas" onclick="scrollToSection('escuelas')" class="hover:text-coffee-300 transition-colors">Escuelas Destino</a>
            </nav>

            <!-- Acceso a Gestión Interna / Botón Acción -->
            <div class="flex items-center space-x-3">
                <button onclick="openAdminModal()" class="px-3 py-2 text-xs font-semibold bg-coffee-800 hover:bg-coffee-700 text-coffee-200 rounded-lg border border-coffee-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-user-shield text-amberGold"></i>
                    <span class="hidden sm:inline">Panel Local</span>
                </button>
                <a href="#donar" onclick="scrollToSection('donar')" class="px-4 py-2 text-sm font-semibold bg-amberGold hover:bg-amber-600 text-white rounded-lg shadow-sm transition flex items-center gap-2">
                    <i class="fa-solid fa-heart"></i>
                    <span>Donar Ahora</span>
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        <!-- 1. HERO BANNER -->
        <section id="hero" class="relative py-16 lg:py-24 overflow-hidden border-b border-coffee-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-12 gap-12 items-center">
                    
                    <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-ruralGreen/10 text-ruralGreen border border-ruralGreen/20 text-xs font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-seedling"></i> Proyecto Círculo de Lectura Rural
                        </div>
                        
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-bold text-coffee-900 leading-tight">
                            Dale una segunda vida a tus libros, iluminá una escuela rural.
                        </h1>
                        
                        <p class="text-lg text-coffee-800 max-w-2xl font-normal leading-relaxed">
                            Somos una librería y cafetería en Buenos Aires. Traé tus libros usados en buen estado para que recorran el país hasta las aulas de escuelas rurales argentinas.
                        </p>

                        <!-- Banner de incentivo del café -->
                        <div class="p-4 bg-coffee-100 rounded-2xl border border-coffee-300 flex items-center gap-4 max-w-xl mx-auto lg:mx-0 shadow-sm">
                            <div class="w-12 h-12 rounded-xl bg-coffee-700 text-coffee-100 flex items-center justify-center flex-shrink-0 text-2xl">
                                <i class="fa-solid fa-mug-hot"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-coffee-900 text-sm sm:text-base">¡Tu gesto tiene premio delicioso!</h4>
                                <p class="text-xs sm:text-sm text-coffee-800">Al registrar tu donación, te regala un <span class="font-bold text-ruralGreen">10% de descuento</span> en tu consumo de cafetería o pastelería en nuestro local.</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                            <a href="#donar" onclick="scrollToSection('donar')" class="px-8 py-4 bg-ruralGreen hover:bg-emerald-900 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition text-center flex items-center justify-center gap-3">
                                <i class="fa-solid fa-book-medical"></i> Registrar mi Donación
                            </a>
                            <a href="#escuelas" onclick="scrollToSection('escuelas')" class="px-6 py-4 bg-coffee-200 hover:bg-coffee-300 text-coffee-900 font-semibold rounded-xl transition text-center flex items-center justify-center gap-2">
                                <i class="fa-solid fa-map-location-dot"></i> Ver Mapa de Escuelas
                            </a>
                        </div>
                    </div>

                    <!-- Estadísticas e Impacto -->
                    <div class="lg:col-span-5">
                        <div class="paper-texture p-6 sm:p-8 rounded-3xl relative">
                            <div class="absolute -top-4 -right-4 bg-amberGold text-white text-xs font-bold px-3 py-1 rounded-full shadow-md uppercase tracking-wider transform rotate-3">
                                Impacto En Vivo
                            </div>
                            
                            <h3 class="font-serif text-2xl font-bold text-coffee-900 mb-6 border-b border-coffee-200 pb-3 flex items-center gap-2">
                                <i class="fa-solid fa-chart-line text-coffee-500"></i> Nuestro Registro Solidario
                            </h3>

                            <div class="space-y-5">
                                <div class="flex items-center justify-between p-4 bg-coffee-50 rounded-xl border border-coffee-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-coffee-200 text-coffee-800 flex items-center justify-center text-lg">
                                            <i class="fa-solid fa-books"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-coffee-700 uppercase font-semibold">Libros Recolectados</p>
                                            <p id="statBooks" class="text-2xl font-bold text-coffee-900">1,480</p>
                                        </div>
                                    </div>
                                    <span class="text-emerald-700 text-xs font-bold bg-emerald-100 px-2.5 py-1 rounded-full">+12 hoy</span>
                                </div>

                                <div class="flex items-center justify-between p-4 bg-coffee-50 rounded-xl border border-coffee-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-ruralGreen/20 text-ruralGreen flex items-center justify-center text-lg">
                                            <i class="fa-solid fa-school"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-coffee-700 uppercase font-semibold">Escuelas Beneficiadas</p>
                                            <p id="statSchools" class="text-2xl font-bold text-coffee-900">28</p>
                                        </div>
                                    </div>
                                    <span class="text-coffee-700 text-xs font-bold">En 12 Provincias</span>
                                </div>

                                <div class="flex items-center justify-between p-4 bg-coffee-50 rounded-xl border border-coffee-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center text-lg">
                                            <i class="fa-solid fa-heart-circle-check"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-coffee-700 uppercase font-semibold">Donaciones Recibidas</p>
                                            <p id="statDonations" class="text-2xl font-bold text-coffee-900">342</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-coffee-700 font-medium">Comunidad Activa</span>
                                </div>
                            </div>

                            <p class="text-xs text-center text-coffee-700 mt-6 italic">
                                "Un libro no cambia el mundo, pero cambia a la persona que va a cambiar el mundo."
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 2. CRITERIOS DE ACEPTACIÓN DE LIBROS -->
        <section id="criterios" class="py-16 bg-coffee-100/60 border-b border-coffee-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <h2 class="text-3xl font-serif font-bold text-coffee-900">¿Qué tipo de libros necesitamos?</h2>
                    <p class="mt-3 text-coffee-800">
                        Para asegurar que la donación sea de utilidad directa para los alumnos y docentes rurales, clasificamos los libros antes de empaquetarlos.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- ACEPTAMOS -->
                    <div class="paper-texture p-6 sm:p-8 rounded-2xl border-l-8 border-l-ruralGreen">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-coffee-900">¡SÍ recibimos con gusto!</h3>
                        </div>
                        <ul class="space-y-4 text-sm text-coffee-800">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                <span><strong>Literatura Infantil y Juvenil:</strong> Cuentos ilustrados, novelas juveniles, poesías y cómics.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                <span><strong>Manuales Escolares Actualizados:</strong> Libros de primaria y secundaria (preferentemente posteriores a 2015).</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                <span><strong>Clásicos y Literatura General:</strong> Novelas, biografías, diccionarios en buen estado.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-emerald-600 mt-1"></i>
                                <span><strong>Libros de Actividades:</strong> Sin completar o pintar.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- NO ACEPTAMOS -->
                    <div class="paper-texture p-6 sm:p-8 rounded-2xl border-l-8 border-l-rose-700">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-800 flex items-center justify-center text-xl">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <h3 class="text-xl font-serif font-bold text-coffee-900">Por el momento NO podemos recibir:</h3>
                        </div>
                        <ul class="space-y-4 text-sm text-coffee-800">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-xmark text-rose-600 mt-1"></i>
                                <span><strong>Enciclopedias o Anuarios Antiguos:</strong> Ocupan mucho espacio de transporte y el contenido suele estar desactualizado.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-xmark text-rose-600 mt-1"></i>
                                <span><strong>Libros Rotos o Incompletos:</strong> Sin tapas, con hojas sueltas, fúngicos o húmedos.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-xmark text-rose-600 mt-1"></i>
                                <span><strong>Revistas o Fotocopias:</strong> Materiales anillados o no originales.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-xmark text-rose-600 mt-1"></i>
                                <span><strong>Manuales Técnicos / Universitarios muy específicos:</strong> No aplicables a la enseñanza escolar rural.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. FORMULARIO DE DONACIÓN -->
        <section id="donar" class="py-16 bg-paper border-b border-coffee-200">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <span class="text-xs font-bold uppercase tracking-wider text-amberGold bg-amber-100 px-3 py-1 rounded-full">Paso 1</span>
                    <h2 class="text-3xl font-serif font-bold text-coffee-900 mt-2">Registrá tu Donación</h2>
                    <p class="text-sm text-coffee-800 mt-1">
                        Completá este formulario previo para preparar la recepción y generar tu cupón de café.
                    </p>
                </div>

                <form id="donationForm" onsubmit="handleFormSubmit(event)" class="paper-texture p-6 sm:p-10 rounded-3xl space-y-6 shadow-lg">
                    
                    <div class="grid sm:grid-cols-2 gap-6">
                        <!-- Nombre Completo -->
                        <div>
                            <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                                Nombre y Apellido <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" id="donorName" required placeholder="Ej: Sofía Martínez" 
                                class="w-full px-4 py-3 rounded-xl border border-coffee-300 focus:ring-2 focus:ring-coffee-700 focus:outline-none bg-white text-coffee-900 text-sm">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                                Correo Electrónico <span class="text-rose-600">*</span>
                            </label>
                            <input type="email" id="donorEmail" required placeholder="sofia@ejemplo.com.ar" 
                                class="w-full px-4 py-3 rounded-xl border border-coffee-300 focus:ring-2 focus:ring-coffee-700 focus:outline-none bg-white text-coffee-900 text-sm">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <!-- WhatsApp / Teléfono -->
                        <div>
                            <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                                Teléfono / WhatsApp <span class="text-rose-600">*</span>
                            </label>
                            <input type="tel" id="donorPhone" required placeholder="Ej: 11 4567 8901" 
                                class="w-full px-4 py-3 rounded-xl border border-coffee-300 focus:ring-2 focus:ring-coffee-700 focus:outline-none bg-white text-coffee-900 text-sm">
                        </div>

                        <!-- Provincia de Origen -->
                        <div>
                            <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                                Provincia / Localidad <span class="text-rose-600">*</span>
                            </label>
                            <select id="donorProvince" required class="w-full px-4 py-3 rounded-xl border border-coffee-300 focus:ring-2 focus:ring-coffee-700 focus:outline-none bg-white text-coffee-900 text-sm">
                                <option value="">Seleccioná tu provincia...</option>
                                <option value="Buenos Aires">Buenos Aires / CABA</option>
                                <option value="Catamarca">Catamarca</option>
                                <option value="Chaco">Chaco</option>
                                <option value="Chubut">Chubut</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Corrientes">Corrientes</option>
                                <option value="Entre Ríos">Entre Ríos</option>
                                <option value="Formosa">Formosa</option>
                                <option value="Jujuy">Jujuy</option>
                                <option value="La Pampa">La Pampa</option>
                                <option value="La Rioja">La Rioja</option>
                                <option value="Mendoza">Mendoza</option>
                                <option value="Misiones">Misiones</option>
                                <option value="Neuquén">Neuquén</option>
                                <option value="Río Negro">Río Negro</option>
                                <option value="Salta">Salta</option>
                                <option value="San Juan">San Juan</option>
                                <option value="San Luis">San Luis</option>
                                <option value="Santa Cruz">Santa Cruz</option>
                                <option value="Santa Fe">Santa Fe</option>
                                <option value="Santiago del Estero">Santiago del Estero</option>
                                <option value="Tierra del Fuego">Tierra del Fuego</option>
                                <option value="Tucumán">Tucumán</option>
                            </select>
                        </div>
                    </div>

                    <hr class="border-coffee-200 my-4">

                    <div class="grid sm:grid-cols-2 gap-6">
                        <!-- Cantidad Estimada -->
                        <div>
                            <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                                Cantidad estimada de libros <span class="text-rose-600">*</span>
                            </label>
                            <input type="number" id="bookCount" min="1" max="200" required placeholder="Ej: 5" 
                                class="w-full px-4 py-3 rounded-xl border border-coffee-300 focus:ring-2 focus:ring-coffee-700 focus:outline-none bg-white text-coffee-900 text-sm">
                        </div>

                        <!-- Estado de los libros -->
                        <div>
                            <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                                Estado general de los libros <span class="text-rose-600">*</span>
                            </label>
                            <select id="bookCondition" required class="w-full px-4 py-3 rounded-xl border border-coffee-300 focus:ring-2 focus:ring-coffee-700 focus:outline-none bg-white text-coffee-900 text-sm">
                                <option value="Excelente">Excelente (Nuevos / Casi sin uso)</option>
                                <option value="Bueno" selected>Bueno (Leídos pero bien conservados)</option>
                                <option value="Con detalles">Con detalles leves de uso</option>
                            </select>
                        </div>
                    </div>

                    <!-- Categorías (Checkboxes) -->
                    <div>
                        <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                            Categorías incluidas (Podés marcar varias) <span class="text-rose-600">*</span>
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <label class="flex items-center space-x-2 bg-coffee-50 p-3 rounded-xl border border-coffee-200 cursor-pointer hover:bg-coffee-100 transition">
                                <input type="checkbox" name="category" value="Infantil" class="rounded text-coffee-700 focus:ring-coffee-700">
                                <span class="text-xs font-medium text-coffee-900">Infantil</span>
                            </label>
                            <label class="flex items-center space-x-2 bg-coffee-50 p-3 rounded-xl border border-coffee-200 cursor-pointer hover:bg-coffee-100 transition">
                                <input type="checkbox" name="category" value="Primaria" class="rounded text-coffee-700 focus:ring-coffee-700">
                                <span class="text-xs font-medium text-coffee-900">Primaria</span>
                            </label>
                            <label class="flex items-center space-x-2 bg-coffee-50 p-3 rounded-xl border border-coffee-200 cursor-pointer hover:bg-coffee-100 transition">
                                <input type="checkbox" name="category" value="Secundaria" class="rounded text-coffee-700 focus:ring-coffee-700">
                                <span class="text-xs font-medium text-coffee-900">Secundaria</span>
                            </label>
                            <label class="flex items-center space-x-2 bg-coffee-50 p-3 rounded-xl border border-coffee-200 cursor-pointer hover:bg-coffee-100 transition">
                                <input type="checkbox" name="category" value="Literatura General" class="rounded text-coffee-700 focus:ring-coffee-700">
                                <span class="text-xs font-medium text-coffee-900">Literatura Gen.</span>
                            </label>
                        </div>
                    </div>

                    <!-- Modalidad de Entrega -->
                    <div>
                        <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                            Modalidad de Entrega <span class="text-rose-600">*</span>
                        </label>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <label class="flex items-start p-4 bg-coffee-50 rounded-xl border border-coffee-200 cursor-pointer hover:bg-coffee-100 transition">
                                <input type="radio" name="deliveryMethod" value="Presencial" checked class="mt-1 text-coffee-700 focus:ring-coffee-700">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-coffee-900">Entrega Presencial en Local</span>
                                    <span class="block text-xs text-coffee-700">Los llevás a Av. Corrientes 1845, CABA y usás tu descuento al instante.</span>
                                </div>
                            </label>

                            <label class="flex items-start p-4 bg-coffee-50 rounded-xl border border-coffee-200 cursor-pointer hover:bg-coffee-100 transition">
                                <input type="radio" name="deliveryMethod" value="Envío" class="mt-1 text-coffee-700 focus:ring-coffee-700">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-coffee-900">Envío por Encomienda</span>
                                    <span class="block text-xs text-coffee-700">Coordinamos el envío desde tu provincia hacia nuestra sede central.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Dedicatoria Opcional -->
                    <div>
                        <label class="block text-xs font-bold text-coffee-900 uppercase tracking-wider mb-2">
                            Mensaje o Dedicatoria para los alumnos (Opcional)
                        </label>
                        <textarea id="donorMessage" rows="3" placeholder="Escribí unas palabras inspiradoras para incluir dentro de los libros para los chicos..." 
                            class="w-full px-4 py-3 rounded-xl border border-coffee-300 focus:ring-2 focus:ring-coffee-700 focus:outline-none bg-white text-coffee-900 text-sm"></textarea>
                    </div>

                    <!-- Botón Enviar -->
                    <button type="submit" class="w-full py-4 bg-amberGold hover:bg-amber-600 text-white font-bold text-base rounded-xl shadow-md transition flex items-center justify-center gap-3">
                        <i class="fa-solid fa-ticket"></i> Confirmar Donación y Generar Cupón
                    </button>

                </form>
            </div>
        </section>

        <!-- 4. MODAL / GENERADOR DE CUPÓN DIGITAL -->
        <div id="couponModal" class="fixed inset-0 bg-coffee-900/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 overflow-y-auto">
            <div class="paper-texture max-w-lg w-full rounded-3xl p-6 sm:p-8 relative shadow-2xl animate-fade-in border-4 border-coffee-300 my-8">
                <button onclick="closeCouponModal()" class="absolute top-4 right-4 w-8 h-8 bg-coffee-200 text-coffee-800 rounded-full flex items-center justify-center hover:bg-coffee-300 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="text-center space-y-2 mb-6">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-800 rounded-full flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-coffee-900">¡Donación Registrada!</h3>
                    <p class="text-xs text-coffee-700">Presentá este ticket digital en nuestra cafetería para canjear tu beneficio.</p>
                </div>

                <!-- EL TICKET/CUPÓN -->
                <div id="printableTicket" class="bg-coffee-50 border-2 border-dashed border-coffee-300 p-6 rounded-2xl relative space-y-4">
                    <!-- Marca de Agua / Sello -->
                    <div class="absolute -top-3 right-4 bg-ruralGreen text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full shadow">
                        Descuento 10% Valido
                    </div>

                    <div class="flex items-center justify-between border-b border-coffee-200 pb-3">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-coffee-700 tracking-wider">Código de Donación</span>
                            <p id="ticketCode" class="font-mono text-lg font-bold text-coffee-900">DON-AR-2026-X000</p>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] uppercase font-bold text-coffee-700 tracking-wider">Fecha</span>
                            <p id="ticketDate" class="text-xs font-bold text-coffee-900">19/10/2026</p>
                        </div>
                    </div>

                    <div class="space-y-1.5 text-xs text-coffee-900">
                        <p><strong>Donante:</strong> <span id="ticketDonorName">Sofía Martínez</span></p>
                        <p><strong>Provincia:</strong> <span id="ticketProvince">Buenos Aires</span></p>
                        <p><strong>Cantidad Aportada:</strong> <span id="ticketCount">5 Libros</span></p>
                        <p><strong>Entrega:</strong> <span id="ticketMethod">Presencial</span></p>
                    </div>

                    <!-- Código QR Dinámico -->
                    <div class="pt-4 border-t border-coffee-200 flex flex-col items-center justify-center">
                        <div id="qrcode" class="p-2 bg-white border border-coffee-200 rounded-xl shadow-sm mb-2"></div>
                        <span class="text-[10px] text-coffee-700 font-mono">Escanear en caja para validar consumo</span>
                    </div>
                </div>

                <!-- Acciones del Cupón -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <button onclick="printCoupon()" class="flex-1 py-3 bg-coffee-800 hover:bg-coffee-900 text-white rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow">
                        <i class="fa-solid fa-print"></i> Imprimir / Guardar PDF
                    </button>
                    <button onclick="simulateEmail()" class="flex-1 py-3 bg-coffee-200 hover:bg-coffee-300 text-coffee-900 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2">
                        <i class="fa-solid fa-envelope"></i> Enviar por Email
                    </button>
                </div>
            </div>
        </div>

        <!-- 5. MAPA Y ESCUELAS DESTINO -->
        <section id="escuelas" class="py-16 bg-coffee-100/40 border-b border-coffee-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-xs font-bold uppercase tracking-wider text-ruralGreen bg-emerald-100 px-3 py-1 rounded-full">Transparencia</span>
                    <h2 class="text-3xl font-serif font-bold text-coffee-900 mt-2">Escuelas Rurales Beneficiadas</h2>
                    <p class="text-sm text-coffee-800 mt-1">
                        Conocé algunas de las instituciones rurales donde tus libros cobran un nuevo valor educativo.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6" id="schoolsContainer">
                    <!-- Las tarjetas de las escuelas se generan con JS -->
                </div>
            </div>
        </section>
    </main>

    <!-- PANEL MODAL DE GESTIÓN INTERNA (ADMIN LOCAL) -->
    <div id="adminModal" class="fixed inset-0 bg-coffee-900/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white max-w-5xl w-full rounded-3xl p-6 sm:p-8 relative shadow-2xl border border-coffee-200 max-h-[90vh] flex flex-col">
            
            <div class="flex items-center justify-between border-b border-coffee-200 pb-4 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-coffee-800 text-amberGold flex items-center justify-center text-lg">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-serif font-bold text-coffee-900">Panel Interno - Cafetería & Recepción</h3>
                        <p class="text-xs text-coffee-700">Administración de registros guardados localmente (localStorage)</p>
                    </div>
                </div>
                <button onclick="closeAdminModal()" class="w-8 h-8 bg-coffee-100 text-coffee-800 rounded-full flex items-center justify-center hover:bg-coffee-200 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Filtros del Dashboard -->
            <div class="flex flex-col sm:flex-row gap-4 mb-4 items-center justify-between bg-coffee-50 p-4 rounded-xl border border-coffee-200">
                <div class="w-full sm:w-64 relative">
                    <input type="text" id="adminSearch" onkeyup="renderAdminTable()" placeholder="Buscar por donante o código..." 
                        class="w-full pl-9 pr-4 py-2 rounded-lg border border-coffee-300 text-xs focus:outline-none focus:ring-1 focus:ring-coffee-700">
                    <i class="fa-solid fa-search absolute left-3 top-2.5 text-coffee-400 text-xs"></i>
                </div>

                <div class="flex gap-2 w-full sm:w-auto overflow-x-auto pb-1 sm:pb-0">
                    <select id="adminStatusFilter" onchange="renderAdminTable()" class="px-3 py-2 rounded-lg border border-coffee-300 text-xs font-semibold text-coffee-800 focus:outline-none">
                        <option value="TODOS">Todos los Estados</option>
                        <option value="Pendiente">Pendientes de Entrega</option>
                        <option value="Recibido">Recibidos en Cafe</option>
                        <option value="Clasificado">Clasificados</option>
                        <option value="Enviado">Enviados a Escuela</option>
                    </select>
                    
                    <button onclick="clearAllData()" class="px-3 py-2 bg-rose-100 text-rose-800 hover:bg-rose-200 rounded-lg text-xs font-bold transition flex items-center gap-1">
                        <i class="fa-solid fa-trash"></i> Resetear
                    </button>
                </div>
            </div>

            <!-- Tabla de Datos -->
            <div class="flex-grow overflow-auto border border-coffee-200 rounded-xl">
                <table class="w-full text-left text-xs text-coffee-900">
                    <thead class="bg-coffee-100 uppercase text-[10px] font-bold text-coffee-800 tracking-wider sticky top-0">
                        <tr>
                            <th class="p-3">Código</th>
                            <th class="p-3">Donante</th>
                            <th class="p-3">Libros</th>
                            <th class="p-3">Categorías</th>
                            <th class="p-3">Estado Actual</th>
                            <th class="p-3 text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody" class="divide-y divide-coffee-200 bg-white">
                        <!-- Filas dinamicas -->
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-right">
                <button onclick="closeAdminModal()" class="px-5 py-2 bg-coffee-800 text-white text-xs font-bold rounded-xl hover:bg-coffee-900">
                    Cerrar Panel
                </button>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-coffee-900 text-coffee-200 py-12 border-t border-coffee-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div class="space-y-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-amberGold text-coffee-900 flex items-center justify-center font-bold text-base">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <span class="font-serif text-lg font-bold text-white">Páginas Abiertas</span>
                    </div>
                    <p class="text-xs text-coffee-300 leading-relaxed">
                        Un espacio que combina el aroma del café recién molido, la buena literatura y el compromiso con las escuelas rurales de Argentina.
                    </p>
                </div>

                <div>
                    <h4 class="font-serif font-bold text-white text-sm mb-3">Ubicación & Horarios</h4>
                    <p class="text-xs text-coffee-300">Av. Corrientes 1845, CABA</p>
                    <p class="text-xs text-coffee-300 mt-1">Lunes a Sábados: 08:00 a 20:00 hs</p>
                    <p class="text-xs text-coffee-300">Domingos: 10:00 a 19:00 hs</p>
                </div>

                <div>
                    <h4 class="font-serif font-bold text-white text-sm mb-3">Contacto Directo</h4>
                    <p class="text-xs text-coffee-300"><i class="fa-solid fa-envelope mr-1"></i> donaciones@paginasabiertas.com.ar</p>
                    <p class="text-xs text-coffee-300 mt-1"><i class="fa-brands fa-whatsapp mr-1"></i> +54 9 11 5544-3322</p>
                </div>

                <div>
                    <h4 class="font-serif font-bold text-white text-sm mb-3">Redes Sociales</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-coffee-800 hover:bg-amberGold text-white flex items-center justify-center transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-coffee-800 hover:bg-amberGold text-white flex items-center justify-center transition"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-coffee-800 hover:bg-amberGold text-white flex items-center justify-center transition"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="border-t border-coffee-800 pt-6 text-center text-xs text-coffee-400">
                <p>&copy; 2026 Páginas Abiertas Librería-Café. Proyecto de impacto social educativo para la República Argentina.</p>
            </div>
        </div>
    </footer>

    <!-- LOGICA JAVASCRIPT INTEGRADA -->
    <script>
        // --- DATOS INICIALES Y CONFIGURACIÓN ---
        const INITIAL_DONATIONS = [
            {
                code: "DON-AR-2026-A102",
                donorName: "Martín Gómez",
                email: "mgomez@gmail.com",
                phone: "1198765432",
                province: "Buenos Aires",
                bookCount: 8,
                categories: ["Infantil", "Primaria"],
                condition: "Excelente",
                method: "Presencial",
                status: "Recibido",
                date: "15/10/2026"
            },
            {
                code: "DON-AR-2026-B884",
                donorName: "Carolina Rossi",
                email: "caro.rossi@yahoo.com.ar",
                phone: "3514432111",
                province: "Córdoba",
                bookCount: 15,
                categories: ["Secundaria", "Literatura General"],
                condition: "Bueno",
                method: "Envío",
                status: "Clasificado",
                date: "17/10/2026"
            },
            {
                code: "DON-AR-2026-C301",
                donorName: "Facundo Morales",
                email: "facu_m@hotmail.com",
                phone: "2615554321",
                province: "Mendoza",
                bookCount: 4,
                categories: ["Infantil"],
                condition: "Excelente",
                method: "Presencial",
                status: "Pendiente",
                date: "19/10/2026"
            }
        ];

        const SCHOOLS_DATA = [
            {
                name: "Escuela Rural N° 402 'Sarmiento'",
                location: "Susques, Jujuy",
                target: 150,
                received: 120,
                image: "https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=600&q=80",
                needs: "Cuentos infantiles ilustrados y diccionarios."
            },
            {
                name: "Escuela N° 12 'Padre Zink'",
                location: "Tolhuin, Tierra del Fuego",
                target: 200,
                received: 200,
                image: "https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=600&q=80",
                needs: "¡Meta alcanzada! Gracias a todos."
            },
            {
                name: "Escuela Fronteriza N° 88",
                location: "Misión La Paz, Salta",
                target: 300,
                received: 185,
                image: "https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80",
                needs: "Manuales de ciencia y novelas juveniles."
            }
        ];

        let donations = [];

        // --- INICIALIZACIÓN ---
        window.onload = function() {
            // Cargar donaciones desde localStorage o cargar las iniciales
            const stored = localStorage.getItem('paginas_abiertas_donations');
            if (stored) {
                donations = JSON.parse(stored);
            } else {
                donations = [...INITIAL_DONATIONS];
                saveToLocalStorage();
            }

            renderSchools();
            updateStats();
        };

        function saveToLocalStorage() {
            localStorage.setItem('paginas_abiertas_donations', JSON.stringify(donations));
        }

        // --- NAVEGACIÓN SUAVE ---
        function scrollToSection(id) {
            const el = document.getElementById(id);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // --- ACTUALIZACIÓN DE ESTADÍSTICAS ---
        function updateStats() {
            const totalBooks = donations.reduce((acc, curr) => acc + parseInt(curr.bookCount || 0), 1450);
            const totalDonations = donations.length + 339; // Base de demostración
            
            document.getElementById('statBooks').innerText = totalBooks.toLocaleString('es-AR');
            document.getElementById('statDonations').innerText = totalDonations;
        }

        // --- RENDERIZADO DE ESCUELAS ---
        function renderSchools() {
            const container = document.getElementById('schoolsContainer');
            container.innerHTML = SCHOOLS_DATA.map(school => {
                const percent = Math.min(Math.round((school.received / school.target) * 100), 100);
                return `
                    <div class="paper-texture rounded-2xl overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="h-40 bg-cover bg-center relative" style="background-image: url('${school.image}')">
                                <span class="absolute top-3 left-3 bg-coffee-900/80 text-white text-[10px] uppercase font-bold px-2.5 py-1 rounded-md backdrop-blur-sm">
                                    <i class="fa-solid fa-location-dot text-amberGold"></i> ${school.location}
                                </span>
                            </div>
                            <div class="p-5 space-y-3">
                                <h3 class="font-serif font-bold text-coffee-900 text-lg">${school.name}</h3>
                                <p class="text-xs text-coffee-700"><strong>Necesidad principal:</strong> ${school.needs}</p>
                            </div>
                        </div>

                        <div class="p-5 pt-0">
                            <div class="space-y-1 mb-2">
                                <div class="flex justify-between text-xs font-bold text-coffee-900">
                                    <span>Progreso de recolección</span>
                                    <span>${school.received} / ${school.target} libros</span>
                                </div>
                                <div class="w-full bg-coffee-200 h-2.5 rounded-full overflow-hidden">
                                    <div class="bg-ruralGreen h-full rounded-full transition-all duration-500" style="width: ${percent}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // --- MANEJO DEL FORMULARIO DE DONACIÓN ---
        function handleFormSubmit(event) {
            event.preventDefault();

            // Obtener categorías seleccionadas
            const selectedCategories = Array.from(document.querySelectorAll('input[name="category"]:checked'))
                .map(cb => cb.value);

            if (selectedCategories.length === 0) {
                showToast('Por favor selecciona al menos una categoría de libros.', 'warning');
                return;
            }

            // Crear objeto de donación
            const randomCode = 'DON-AR-2026-' + Math.random().toString(36).substring(2, 6).toUpperCase();
            const today = new Date().toLocaleDateString('es-AR');

            const newDonation = {
                code: randomCode,
                donorName: document.getElementById('donorName').value,
                email: document.getElementById('donorEmail').value,
                phone: document.getElementById('donorPhone').value,
                province: document.getElementById('donorProvince').value,
                bookCount: parseInt(document.getElementById('bookCount').value),
                categories: selectedCategories,
                condition: document.getElementById('bookCondition').value,
                method: document.querySelector('input[name="deliveryMethod"]:checked').value,
                message: document.getElementById('donorMessage').value,
                status: 'Pendiente',
                date: today
            };

            // Guardar
            donations.unshift(newDonation);
            saveToLocalStorage();
            updateStats();

            // Resetear Formulario
            document.getElementById('donationForm').reset();

            // Mostrar Notificación Toast
            showToast('¡Donación registrada con éxito! Generando tu cupón...', 'success');

            // Generar y Abrir Cupón Modal
            openCouponModal(newDonation);
        }

        // --- MANEJO DEL CUPÓN ---
        function openCouponModal(donation) {
            document.getElementById('ticketCode').innerText = donation.code;
            document.getElementById('ticketDate').innerText = donation.date;
            document.getElementById('ticketDonorName').innerText = donation.donorName;
            document.getElementById('ticketProvince').innerText = donation.province;
            document.getElementById('ticketCount').innerText = donation.bookCount + ' Libros';
            document.getElementById('ticketMethod').innerText = donation.method;

            // Generar Código QR
            const qrContainer = document.getElementById('qrcode');
            qrContainer.innerHTML = ''; // Limpiar previo
            new QRCode(qrContainer, {
                text: `PAGINAS-ABIERTAS:${donation.code}:${donation.donorName}`,
                width: 90,
                height: 90,
                colorDark: "#2d1e0e",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            document.getElementById('couponModal').classList.remove('hidden');
        }

        function closeCouponModal() {
            document.getElementById('couponModal').classList.add('hidden');
        }

        function printCoupon() {
            window.print();
        }

        function simulateEmail() {
            showToast('Se ha enviado una copia del cupón a tu correo electrónico.', 'info');
        }

        // --- DASHBOARD / ADMIN LOCAL ---
        function openAdminModal() {
            renderAdminTable();
            document.getElementById('adminModal').classList.remove('hidden');
        }

        function closeAdminModal() {
            document.getElementById('adminModal').classList.add('hidden');
        }

        function renderAdminTable() {
            const tbody = document.getElementById('adminTableBody');
            const search = document.getElementById('adminSearch').value.toLowerCase();
            const statusFilter = document.getElementById('adminStatusFilter').value;

            const filtered = donations.filter(item => {
                const matchesSearch = item.donorName.toLowerCase().includes(search) || item.code.toLowerCase().includes(search);
                const matchesStatus = statusFilter === 'TODOS' || item.status === statusFilter;
                return matchesSearch && matchesStatus;
            });

            if (filtered.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="p-6 text-center text-coffee-500 italic">
                            No se encontraron registros de donación.
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = filtered.map(item => {
                let badgeClass = 'bg-amber-100 text-amber-800';
                if (item.status === 'Recibido') badgeClass = 'bg-blue-100 text-blue-800';
                if (item.status === 'Clasificado') badgeClass = 'bg-purple-100 text-purple-800';
                if (item.status === 'Enviado') badgeClass = 'bg-emerald-100 text-emerald-800';

                return `
                    <tr class="hover:bg-coffee-50 transition">
                        <td class="p-3 font-mono font-bold">${item.code}</td>
                        <td class="p-3">
                            <div class="font-bold">${item.donorName}</div>
                            <div class="text-[10px] text-coffee-600">${item.province} | ${item.phone}</div>
                        </td>
                        <td class="p-3 font-bold">${item.bookCount}</td>
                        <td class="p-3">${item.categories.join(', ')}</td>
                        <td class="p-3">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold ${badgeClass}">
                                ${item.status}
                            </span>
                        </td>
                        <td class="p-3 text-right">
                            <select onchange="updateDonationStatus('${item.code}', this.value)" class="text-[11px] p-1 rounded border border-coffee-300 bg-white font-medium">
                                <option value="Pendiente" ${item.status === 'Pendiente' ? 'selected' : ''}>Pendiente</option>
                                <option value="Recibido" ${item.status === 'Recibido' ? 'selected' : ''}>Recibido</option>
                                <option value="Clasificado" ${item.status === 'Clasificado' ? 'selected' : ''}>Clasificado</option>
                                <option value="Enviado" ${item.status === 'Enviado' ? 'selected' : ''}>Enviado</option>
                            </select>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function updateDonationStatus(code, newStatus) {
            const index = donations.findIndex(d => d.code === code);
            if (index !== -1) {
                donations[index].status = newStatus;
                saveToLocalStorage();
                renderAdminTable();
                showToast(`Estado de ${code} actualizado a ${newStatus}`, 'info');
            }
        }

        function clearAllData() {
            if (confirm('¿Seguro que deseas reiniciar los datos de la demostración?')) {
                donations = [...INITIAL_DONATIONS];
                saveToLocalStorage();
                renderAdminTable();
                updateStats();
                showToast('Datos reiniciados correctamente.', 'info');
            }
        }

        // --- SISTEMA DE NOTIFICACIONES (TOASTS) ---
        function showToast(message, type = 'info') {
            const container = document.getElementById('toastContainer');
            
            let bgClass = 'bg-coffee-900 text-white';
            let icon = 'fa-info-circle';

            if (type === 'success') {
                bgClass = 'bg-ruralGreen text-white';
                icon = 'fa-circle-check';
            } else if (type === 'warning') {
                bgClass = 'bg-amberGold text-white';
                icon = 'fa-triangle-exclamation';
            }

            const toast = document.createElement('div');
            toast.className = `p-4 rounded-xl shadow-xl ${bgClass} flex items-center gap-3 text-xs font-semibold pointer-events-auto transition duration-300 transform translate-y-2`;
            toast.innerHTML = `<i class="fa-solid ${icon} text-base"></i> <span>${message}</span>`;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('opacity-0', '-translate-y-2');
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }
        document.getElementById('formDonacion').addEventListener('submit', async function(e) {
    e.preventDefault();

    const datos = {
        nombre: document.getElementById('nombre').value,
        email: document.getElementById('email').value,
        telefono: document.getElementById('telefono').value,
        cantidad: document.getElementById('cantidad').value,
        categoria: document.getElementById('categoria').value,
        modalidad: document.getElementById('modalidad').value
    };

    const respuesta = await fetch('procesar.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(datos)
    });

    const resultado = await respuesta.json();

    if (resultado.success) {
        alert("¡Donación guardada en MySQL! Tu cupón es: " + resultado.cupon);
    } else {
        alert("Error al guardar: " + resultado.error);
    }
});
    </script>
    
</body>
</html>