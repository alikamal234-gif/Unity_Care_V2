<?php

session_start();


if($_SESSION['role'] !== 'doctor'){
    header('Location: login/P_login.php');
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

    <title>Tableau de Bord Médecin - Gestion des Patients</title>
    <style>
        .modal {
            transition: opacity 0.25s ease;
        }
        .modal-backdrop {
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-user-md text-blue-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-900">Cabinet Médical</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-bell h-6 w-6"></i>
                        </button>
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400"></span>
                    </div>
                    <div class="flex items-center">
                        <span class="ml-2 text-sm font-medium text-gray-700">Dr. Martin</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex h-screen pt-16">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md overflow-y-auto">
            <div class="p-4">
                <nav class="space-y-2">
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md bg-blue-50 text-blue-700">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Tableau de bord
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-users mr-3"></i>
                        Patients
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        Rendez-vous
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-file-medical mr-3"></i>
                        Prescriptions
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-chart-bar mr-3"></i>
                        Statistiques
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-cog mr-3"></i>
                        Paramètres
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Déconnexion
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="mb-6">
                        <h1 class="text-2xl font-semibold text-gray-900">Tableau de bord</h1>
                        <p class="mt-1 text-sm text-gray-600">Bienvenue, Dr. Martin. Voici un aperçu de votre journée.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                        <i class="fas fa-users text-blue-600"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Patients</dt>
                                            <dd class="text-lg font-medium text-gray-900">247</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-blue-700 hover:text-blue-600">
                                        Voir tous les patients
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                        <i class="fas fa-calendar-check text-green-600"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Rendez-vous aujourd'hui</dt>
                                            <dd class="text-lg font-medium text-gray-900">8</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-green-700 hover:text-green-600">
                                        Voir tous les rendez-vous
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                                        <i class="fas fa-file-prescription text-yellow-600"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Prescriptions ce mois</dt>
                                            <dd class="text-lg font-medium text-gray-900">42</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-yellow-700 hover:text-yellow-600">
                                        Voir toutes les prescriptions
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                                        <i class="fas fa-chart-line text-purple-600"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Taux de croissance</dt>
                                            <dd class="text-lg font-medium text-gray-900">+12%</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-purple-700 hover:text-purple-600">
                                        Voir les statistiques
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div class="bg-white shadow rounded-lg mb-8">
                        <div class="border-b border-gray-200">
                            <nav class="flex -mb-px">
                                <button class="tab-btn py-4 px-6 text-sm font-medium text-blue-600 border-b-2 border-blue-500 focus:outline-none" data-tab="patients">
                                    Patients
                                </button>
                                <button class="tab-btn py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none" data-tab="appointments">
                                    Rendez-vous
                                </button>
                                <button class="tab-btn py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none" data-tab="prescriptions">
                                    Prescriptions
                                </button>
                                <button class="tab-btn py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none" data-tab="statistics">
                                    Statistiques
                                </button>
                            </nav>
                        </div>

                        <!-- Patients Tab -->
                        <div id="patients-tab" class="tab-content p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-medium text-gray-900">Liste des patients</h2>
                                <button id="add-patient-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>Ajouter un patient
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de naissance</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernière visite</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Jean Dupont</div>
                                                        <div class="text-sm text-gray-500">#PAT001</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/03/1985</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">06 12 34 56 78</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12/05/2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3">Voir</button>
                                                <button class="text-green-600 hover:text-green-900 mr-3">Rendez-vous</button>
                                                <button class="text-purple-600 hover:text-purple-900">Prescription</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Marie Martin</div>
                                                        <div class="text-sm text-gray-500">#PAT002</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">22/07/1978</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">06 23 45 67 89</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05/05/2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3">Voir</button>
                                                <button class="text-green-600 hover:text-green-900 mr-3">Rendez-vous</button>
                                                <button class="text-purple-600 hover:text-purple-900">Prescription</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Pierre Bernard</div>
                                                        <div class="text-sm text-gray-500">#PAT003</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">08/11/1992</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">06 34 56 78 90</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/04/2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3">Voir</button>
                                                <button class="text-green-600 hover:text-green-900 mr-3">Rendez-vous</button>
                                                <button class="text-purple-600 hover:text-purple-900">Prescription</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Appointments Tab -->
                        <div id="appointments-tab" class="tab-content p-6 hidden">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-medium text-gray-900">Rendez-vous à venir</h2>
                                <button id="add-appointment-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>Créer un rendez-vous
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Jean Dupont</div>
                                                <div class="text-sm text-gray-500">Consultation générale</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="text-sm text-gray-500">
                                                <i class="far fa-calendar mr-1"></i>
                                                15/06/2023
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <i class="far fa-clock mr-1"></i>
                                                10:30
                                            </div>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Marie Martin</div>
                                                <div class="text-sm text-gray-500">Suivi traitement</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="text-sm text-gray-500">
                                                <i class="far fa-calendar mr-1"></i>
                                                15/06/2023
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <i class="far fa-clock mr-1"></i>
                                                14:00
                                            </div>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Pierre Bernard</div>
                                                <div class="text-sm text-gray-500">Consultation spécialisée</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="text-sm text-gray-500">
                                                <i class="far fa-calendar mr-1"></i>
                                                16/06/2023
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <i class="far fa-clock mr-1"></i>
                                                09:15
                                            </div>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Prescriptions Tab -->
                        <div id="prescriptions-tab" class="tab-content p-6 hidden">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-medium text-gray-900">Prescriptions récentes</h2>
                                <button id="add-prescription-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>Créer une prescription
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médicament</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosage</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Jean Dupont</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Paracétamol</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">500mg, 3x/jour</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12/05/2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3">Voir</button>
                                                <button class="text-gray-600 hover:text-gray-900">Imprimer</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Marie Martin</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Amoxicilline</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1g, 2x/jour</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05/05/2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3">Voir</button>
                                                <button class="text-gray-600 hover:text-gray-900">Imprimer</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Pierre Bernard</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ibuprofène</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">400mg, 2x/jour</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/04/2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3">Voir</button>
                                                <button class="text-gray-600 hover:text-gray-900">Imprimer</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Statistics Tab -->
                        <div id="statistics-tab" class="tab-content p-6 hidden">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Statistiques</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <h3 class="text-base font-medium text-gray-900 mb-3">Visites par mois</h3>
                                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-chart-bar text-4xl mb-2"></i>
                                            <p>Graphique des visites par mois</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <h3 class="text-base font-medium text-gray-900 mb-3">Prescriptions par type</h3>
                                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-chart-pie text-4xl mb-2"></i>
                                            <p>Graphique des prescriptions par type</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <h3 class="text-base font-medium text-gray-900 mb-3">Patients par âge</h3>
                                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-chart-line text-4xl mb-2"></i>
                                            <p>Graphique des patients par tranche d'âge</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                    <h3 class="text-base font-medium text-gray-900 mb-3">Revenus mensuels</h3>
                                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded">
                                        <div class="text-center text-gray-500">
                                            <i class="fas fa-euro-sign text-4xl mb-2"></i>
                                            <p>Graphique des revenus mensuels</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Adding Patient -->
    <div id="add-patient-modal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white modal-backdrop">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Ajouter un nouveau patient</h3>
                    <button id="close-patient-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Nom et prénom">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="06 12 34 56 78">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="email@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" rows="3" placeholder="Adresse complète"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancel-patient-modal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none">
                            Annuler
                        </button>
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Appointment -->
    <div id="add-appointment-modal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white modal-backdrop">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Créer un rendez-vous</h3>
                    <button id="close-appointment-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Patient</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option>Sélectionner un patient</option>
                            <option>Jean Dupont</option>
                            <option>Marie Martin</option>
                            <option>Pierre Bernard</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heure</label>
                        <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de consultation</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option>Consultation générale</option>
                            <option>Suivi traitement</option>
                            <option>Consultation spécialisée</option>
                            <option>Urgence</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" rows="3" placeholder="Notes supplémentaires"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancel-appointment-modal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none">
                            Annuler
                        </button>
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Prescription -->
    <div id="add-prescription-modal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white modal-backdrop">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Créer une prescription</h3>
                    <button id="close-prescription-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Patient</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option>Sélectionner un patient</option>
                            <option>Jean Dupont</option>
                            <option>Marie Martin</option>
                            <option>Pierre Bernard</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Médicament</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Nom du médicament">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dosage</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: 500mg, 3x/jour">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Durée</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: 7 jours">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructions</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" rows="3" placeholder="Instructions spéciales"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancel-prescription-modal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none">
                            Annuler
                        </button>
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Notification -->
    <div id="success-notification" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 ease-in-out">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="notification-message">Opération réussie!</span>
        </div>
    </div>

    <script>
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.getAttribute('data-tab');
                
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('text-blue-600', 'border-b-2', 'border-blue-500');
                    btn.classList.add('text-gray-500');
                });
                
                document.getElementById(`${tabName}-tab`).classList.remove('hidden');
                
                button.classList.remove('text-gray-500');
                button.classList.add('text-blue-600', 'border-b-2', 'border-blue-500');
            });
        });

        function setupModal(modalId, openBtnId, closeBtnId, cancelBtnId) {
            const modal = document.getElementById(modalId);
            const openBtn = document.getElementById(openBtnId);
            const closeBtn = document.getElementById(closeBtnId);
            const cancelBtn = document.getElementById(cancelBtnId);
            
            if (openBtn) {
                openBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                });
            }
            
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            }
            
            if (cancelBtn) {
                cancelBtn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            }
            
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        }

        setupModal('add-patient-modal', 'add-patient-btn', 'close-patient-modal', 'cancel-patient-modal');
        setupModal('add-appointment-modal', 'add-appointment-btn', 'close-appointment-modal', 'cancel-appointment-modal');
        setupModal('add-prescription-modal', 'add-prescription-btn', 'close-prescription-modal', 'cancel-prescription-modal');

        function showNotification(message) {
            const notification = document.getElementById('success-notification');
            const messageElement = document.getElementById('notification-message');
            
            messageElement.textContent = message;
            notification.classList.remove('translate-y-full');
            
            setTimeout(() => {
                notification.classList.add('translate-y-full');
            }, 3000);
        }

        document.querySelectorAll('button[type="button"]:not(#cancel-patient-modal):not(#cancel-appointment-modal):not(#cancel-prescription-modal):not(.tab-btn):not(.text-red-600):not(.text-blue-600):not(.text-green-600):not(.text-purple-600):not(.text-gray-600)').forEach(button => {
            button.addEventListener('click', () => {
                const buttonText = button.textContent.trim();
                if (buttonText === 'Enregistrer' || buttonText === 'Créer') {
                    showNotification('Opération réussie!');
                    
                    const modal = button.closest('.modal');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                }
            });
        });



        document.querySelectorAll('.text-red-600').forEach(button => {
            button.addEventListener('click', () => {
                if (confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous?')) {
                    showNotification('Rendez-vous annulé!');
                    button.closest('.bg-white').remove();
                }
            });
        });
    </script>
</body>
</html>

