<?php
require_once __DIR__ . "/../../classes/models/Validation.php";

$login = new ValidationLogin();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $login->login($_POST['email'],$_POST['password']);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Hospital Management</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        glass: 'rgba(31, 41, 55, 0.6)'
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(135deg, #020617, #020617);
        }
        .glass {
            backdrop-filter: blur(12px);
            background: rgba(31, 41, 55, 0.6);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center text-gray-100">

    <div class="glass w-full max-w-md p-8 rounded-2xl shadow-2xl border border-gray-700">

        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto rounded-full bg-blue-600 flex items-center justify-center mb-4">
                <i class="fas fa-hospital text-2xl text-white"></i>
            </div>
            <h1 class="text-2xl font-bold">Hospital Management</h1>
            <p class="text-gray-400 text-sm">Connexion à votre espace</p>
        </div>

        <!-- Form -->
        <form class="space-y-5" method="post">

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Email
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input
                    name="email"
                        type="email"
                        placeholder="exemple@hospital.com"
                        class="w-full pl-10 pr-3 py-2 rounded-lg bg-gray-800 border border-gray-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Mot de passe
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input
                    name="password"
                        type="password"
                        placeholder="••••••••"
                        class="w-full pl-10 pr-3 py-2 rounded-lg bg-gray-800 border border-gray-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>
            </div>

            <!-- Options -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-400">
                    <input type="checkbox" class="accent-blue-600">
                    Se souvenir de moi
                </label>
                <a href="#" class="text-blue-400 hover:underline">
                    Mot de passe oublié ?
                </a>
            </div>

            <!-- Button -->
            <button
                type="submit"
                
                class="w-full py-2 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                Se connecter
            </button>

        </form>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 mt-6">
            © 2026 Hospital Management System
        </p>
    </div>


</body>
</html>
