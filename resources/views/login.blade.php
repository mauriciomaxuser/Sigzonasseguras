<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-sm bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Iniciar Sesión</h2>

        @if ($errors->any())
            <div class="text-red-600 mb-4 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm mb-2">Correo Electrónico</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="ejemplo@correo.com"
                    required
                    value="{{ old('email') }}"
                >
            </div>

            <div class="mb-6">
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

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200"
            >
                Ingresar
            </button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            ¿No tienes una cuenta?
            <a href="/register" class="text-blue-600 hover:underline">Regístrate</a>
        </p>
    </div>

</body>
</html>
