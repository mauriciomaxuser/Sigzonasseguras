<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Crear una Cuenta</h2>

        @if ($errors->any())
            <div class="bg-red-100 p-4 mb-4 rounded">
                <ul class="list-disc list-inside text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 p-4 mb-4 rounded text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm mb-2">Nombre</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tu nombre completo"
                    required
                    value="{{ old('name') }}"
                >
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm mb-2">Correo Electrónico</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="correo@ejemplo.com"
                    required
                    value="{{ old('email') }}"
                >
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm mb-2">Contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                    required
                >
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm mb-2">Confirmar Contraseña</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-200"
            >
                Registrarse
            </button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            ¿Ya tienes una cuenta?
            <a href="/" class="text-blue-600 hover:underline">Inicia sesión</a>
        </p>
    </div>

</body>
</html>
