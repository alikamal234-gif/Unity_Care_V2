<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion Hospitalière (Advanced)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .glassmorphism {
            background: rgba(31, 41, 55, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(75, 85, 99, 0.3);
        }

        .chart-container {
            position: relative;
        }
    </style>
</head>

<body class="bg-gray-950 text-gray-100">

    <header class="glassmorphism sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <i class="fas fa-hospital-alt text-blue-400 text-2xl"></i>
                <h1 class="text-xl font-semibold text-white">HospiManager</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Rechercher..."
                        class="bg-gray-800 text-gray-300 px-4 py-2 pr-10 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                    <i class="fas fa-search absolute right-3 top-2.5 text-gray-500"></i>
                </div>
                <button class="relative p-2 text-gray-400 hover:text-white">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                </button>
                <img src="https://intranet.youcode.ma/storage/users/profile/1525-1760996191.png" alt="Admin"
                    class="w-9 h-9 rounded-full">
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-8">
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="glassmorphism p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Patients Totals</p>
                    <p class="text-3xl font-bold text-white mt-2">1,234</p>
                    <p class="text-green-400 text-sm mt-2"><i class="fas fa-arrow-up"></i> 12% depuis le mois dernier
                    </p>
                </div>
                <div class="mt-4 text-right">
                    <i class="fas fa-users text-4xl text-blue-400 opacity-50"></i>
                </div>
            </div>
            <div class="glassmorphism p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Médecins</p>
                    <p class="text-3xl font-bold text-white mt-2">45</p>
                    <p class="text-gray-500 text-sm mt-2"><i class="fas fa-minus"></i> Aucun changement</p>
                </div>
                <div class="mt-4 text-right">
                    <i class="fas fa-user-md text-4xl text-green-400 opacity-50"></i>
                </div>
            </div>
            <div class="glassmorphism p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Rendez-vous Aujourd'hui</p>
                    <p class="text-3xl font-bold text-white mt-2">28</p>
                    <p class="text-red-400 text-sm mt-2"><i class="fas fa-arrow-down"></i> 5% depuis hier</p>
                </div>
                <div class="mt-4 text-right">
                    <i class="fas fa-calendar-day text-4xl text-yellow-400 opacity-50"></i>
                </div>
            </div>
            <div class="glassmorphism p-6 rounded-2xl flex flex-col justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Taux d'Occupation</p>
                    <p class="text-3xl font-bold text-white mt-2">78%</p>
                    <div class="w-full bg-gray-700 rounded-full h-2 mt-3">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <i class="fas fa-chart-pie text-4xl text-purple-400 opacity-50"></i>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 glassmorphism p-6 rounded-2xl">
                <h3 class="text-lg font-semibold text-white mb-4">Rendez-vous ce Mois</h3>
                <div class="chart-container">
                    <canvas id="appointmentChart"></canvas>
                </div>
            </div>
            <div class="glassmorphism p-6 rounded-2xl">
                <h3 class="text-lg font-semibold text-white mb-4">Activité Récente</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <span class="p-2 bg-blue-500 bg-opacity-20 rounded-lg text-blue-400 mr-3">
                            <i class="fas fa-user-plus"></i>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-white">Nouveau patient enregistré</p>
                            <p class="text-xs text-gray-500">Il y a 2 minutes</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <span class="p-2 bg-green-500 bg-opacity-20 rounded-lg text-green-400 mr-3">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-white">Rendez-vous confirmé</p>
                            <p class="text-xs text-gray-500">Il y a 15 minutes</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <span class="p-2 bg-yellow-500 bg-opacity-20 rounded-lg text-yellow-400 mr-3">
                            <i class="fas fa-edit"></i>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-white">Informations du médecin mises à jour</p>
                            <p class="text-xs text-gray-500">Il y a 1 heure</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="glassmorphism p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-white">Patients Récents</h3>
                    <button onclick="openModal('patient')" class="text-blue-400 hover:text-blue-300"><i
                            class="fas fa-plus-circle"></i></button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-400 border-b border-gray-700">
                                <th class="pb-3 font-medium">Nom</th>
                                <th class="pb-3 font-medium">Date</th>
                                <th class="pb-3 font-medium">Gender</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Jean Dupont</td>
                                <td class="py-3">15/02/1985</td>
                                <td class="py-3"><span
                                        class="px-2 py-1 text-xs rounded-full bg-green-900 text-green-300">Male</span>

                                </td>
                                 <td class="py-3 flex gap-5"><a href="#"><i class="fas fa-edit"></i>
                                    </a><a href="#"><i class="fas fa-trash-can"></i></a></td>
                            </tr>
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Marie Curie</td>
                                <td class="py-3">22/09/1990</td>
                                <td class="py-3"><span
                                        class="px-2 py-1 text-xs rounded-full bg-yellow-900 text-yellow-300">Female</span>
                                </td>
                                 <td class="py-3 flex gap-5"><a href="#"><i class="fas fa-edit"></i>
                                    </a><a href="#"><i class="fas fa-trash-can"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="glassmorphism p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-white">Prochains Rendez-vous</h3>
                    <button class="text-blue-400 hover:text-blue-300"><i class="fas fa-calendar-alt"></i></button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-400 border-b border-gray-700">
                                <th class="pb-3 font-medium">Patient</th>
                                <th class="pb-3 font-medium">Heure</th>
                                <th class="pb-3 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Jean Dupont</td>
                                <td class="py-3">10:00</td>
                                <td class="py-3">
                                    <button class="text-green-400 hover:text-green-300 mr-2" title="Accepter"><i
                                            class="fas fa-check"></i></button>
                                    <button class="text-red-400 hover:text-red-300" title="Refuser"><i
                                            class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Marie Curie</td>
                                <td class="py-3">14:30</td>
                                <td class="py-3">
                                    <button class="text-green-400 hover:text-green-300 mr-2" title="Accepter"><i
                                            class="fas fa-check"></i></button>
                                    <button class="text-red-400 hover:text-red-300" title="Refuser"><i
                                            class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- doctors -->

            <div class="glassmorphism p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-white">Medecient Récents</h3>
                    <button onclick="openModal('doctor')" class="text-blue-400 hover:text-blue-300"><i
                            class="fas fa-plus-circle"></i></button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-400 border-b border-gray-700">
                                <th class="pb-3 font-medium">Nom</th>
                                <th class="pb-3 font-medium">Date</th>
                                <th class="pb-3 font-medium">Specialization</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Jean Dupont</td>
                                <td class="py-3">15/02/1985</td>
                                <td class="py-3"><span
                                        class="px-2 py-1 text-xs rounded-full bg-green-900 text-green-300">Pediatrics</span>
                                </td>
                                 <td class="py-3 flex gap-5"><a href="#"><i class="fas fa-edit"></i>
                                    </a><a href="#"><i class="fas fa-trash-can"></i></a></td>
                            </tr>
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Marie Curie</td>
                                <td class="py-3">22/09/1990</td>
                                <td class="py-3"><span
                                        class="px-2 py-1 text-xs rounded-full bg-yellow-900 text-yellow-300">Psychiatry</span>
                                </td>
                                 <td class="py-3 flex gap-5"><a href="#"><i class="fas fa-edit"></i>
                                    </a><a href="#"><i class="fas fa-trash-can"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="glassmorphism p-6 rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-white">Departments Récents</h3>
                    <button onclick="openModal('department')" class="text-blue-400 hover:text-blue-300"><i
                            class="fas fa-plus-circle"></i></button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-400 border-b border-gray-700">
                                <th class="pb-3 font-medium">Nom</th>
                                <th class="pb-3 font-medium">Location</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Jean Dupont</td>
                                <td class="py-3">15/02/1985</td>
                                 <td class="py-3 flex gap-5"><a href="#"><i class="fas fa-edit"></i>
                                    </a><a href="#"><i class="fas fa-trash-can"></i></a></td>
                            </tr>
                            <tr class="border-b border-gray-800 hover:bg-gray-800 hover:bg-opacity-50">
                                <td class="py-3">Marie Curie</td>
                                <td class="py-3">22/09/1990</td>
                                <td class="py-3 flex gap-5"><a href="#"><i class="fas fa-edit"></i>
                                    </a><a href="#"><i class="fas fa-trash-can"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </main>

    <div id="dynamicModal"
        class="fixed inset-0 bg-black bg-opacity-70 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-gray-800 border-gray-600">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-bold text-white mb-4">Titre de la Modale</h3>
                <form id="modalForm">
                </form>
            </div>
        </div>
    </div>

    <script>
        // --- Chart.js Initialization (Advanced Dark Mode) ---
        Chart.defaults.color = '#9CA3AF';
        Chart.defaults.borderColor = 'rgba(75, 85, 99, 0.3)';
        Chart.defaults.font.family = "'Inter', sans-serif";

        const appointmentCtx = document.getElementById('appointmentChart').getContext('2d');
        new Chart(appointmentCtx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Rendez-vous',
                    data: [12, 19, 15, 25, 22, 30, 28],
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(59, 130, 246, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(75, 85, 99, 0.3)',
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#9CA3AF'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9CA3AF'
                        }
                    }
                }
            }
        });

        // --- Dynamic Modal Logic (remains the same) ---
        const modal = document.getElementById('dynamicModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalForm = document.getElementById('modalForm');

        function openModal(type) {
            modalForm.innerHTML = '';
            if (type === 'patient') {
                modalForm.innerHTML = `
                    <div class="w-full flex gap-2">
                        <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Nom</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value=""></div>
                        <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Prenom</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value=""></div>
                    </div>
                    <div class="w-full flex gap-2">
                        <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Date de Naissance</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="date" value="d"></div>
                        <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Email</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                    </div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Phone</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Gender</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Address</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Doctor de rendez-vous</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                `;
            } else if (type === 'doctor') {
                modalForm.innerHTML = `
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Nom</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Prenom</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Spécialité</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Email</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Phone</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Nom de Department</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                `;
            } else if (type == 'department') {
                modalForm.innerHTML = `
                
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Nom de Department</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Location</label><input class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value=""></div>
                `;
            }
            modalForm.innerHTML += `
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Enregistrer</button>
                </div>
            `;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
        }
    </script>
</body>

</html>