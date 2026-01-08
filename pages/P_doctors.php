<?php
require_once "../classes/repositories/DoctorRepository.php";
require_once "../classes/repositories/PatientRepository.php";
require_once "../classes/repositories/PrescriptionRepository.php";
require_once "../classes/repositories/AppointmentRepository.php";

session_start();
if ($_SESSION['role'] !== 'doctor') {
    header('Location: login/P_login.php');
}
// getPatientBydoctorId
$Doctor = new DoctorRepository();
$Prescription = new PrescriptionRepository();
$Appointment = new AppointmentRepository();
$Patient = new PatientRepository();
$result_patient = $Doctor->getPatientBydoctorId($_SESSION['id_login']);
$result_number_patient = $Doctor->getNumberPatientBydoctorId($_SESSION['id_login']);
$result_number_prescription = $Prescription->getNumberPrescriptions($_SESSION['id_login']);
$result_appointment = $Appointment->getAppointmentByDoctorsId($_SESSION['id_login']);
$result_prescription = $Prescription->getByDoctorId($_SESSION['id_login']);

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

<body class="bg-gray-900 text-white font-sans">
    <!-- Header -->
    <header class="bg-gray-800 shadow-sm border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-user-md text-blue-600 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-white">Cabinet Médical</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button
                            class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-bell h-6 w-6"></i>
                        </button>
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400"></span>
                    </div>
                    <div class="flex items-center">
                        <span class="ml-2 text-sm font-medium text-gray-300">Dr. Martin</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex h-screen ">

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="mb-6">
                        <h1 class="text-2xl font-semibold text-white">Tableau de bord</h1>
                        <p class="mt-1 text-sm text-gray-400">Bienvenue, Dr. Martin. Voici un aperçu de votre journée.
                        </p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-600 rounded-md p-3">
                                        <i class="fas fa-users text-white"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-400 truncate">Patients</dt>
                                            <dd class="text-lg font-medium text-white"><?= $result_number_patient ?>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-700 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-blue-400 hover:text-blue-300">
                                        Voir tous les patients
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-600 rounded-md p-3">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-400 truncate">Rendez-vous</dt>
                                            <dd class="text-lg font-medium text-white"><?= $result_number_patient ?>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-700 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-green-400 hover:text-green-300">
                                        Voir tous les rendez-vous
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-600 rounded-md p-3">
                                        <i class="fas fa-file-prescription text-white"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-400 truncate">Prescriptions ce mois
                                            </dt>
                                            <dd class="text-lg font-medium text-white">
                                                <?= $result_number_prescription ?>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-700 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-yellow-400 hover:text-yellow-300">
                                        Voir toutes les prescriptions
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-600 rounded-md p-3">
                                        <i class="fas fa-chart-line text-white"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-400 truncate">Taux de croissance
                                            </dt>
                                            <dd class="text-lg font-medium text-white">+12%</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-700 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-purple-400 hover:text-purple-300">
                                        Voir les statistiques
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div class="bg-gray-800 shadow rounded-lg mb-8">
                        <div class="border-b border-gray-700">
                            <nav class="flex -mb-px">
                                <button
                                    class="tab-btn py-4 px-6 text-sm font-medium text-blue-400 border-b-2 border-blue-500 focus:outline-none"
                                    data-tab="patients">
                                    Patients
                                </button>
                                <button
                                    class="tab-btn py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none"
                                    data-tab="appointments">
                                    Rendez-vous
                                </button>
                                <button
                                    class="tab-btn py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none"
                                    data-tab="prescriptions">
                                    Prescriptions
                                </button>
                            </nav>
                        </div>

                        <!-- Patients Tab -->
                        <div id="patients-tab" class="tab-content p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-medium text-white">Liste des patients</h2>
                                <button id="add-patient-btn"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>Ajouter un patient
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-700">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Nom</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Date de naissance</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Téléphone</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Dernière visite</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                                        <?php foreach ($result_patient as $value): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-white">
                                                                <?= $value['user_first_name'] . " " . $value['user_last_name'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                    <?= $value['patient_date_of_birth'] ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                    <?= $value['user_phone'] ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                    <?= $value['appointment_date'] ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Appointments Tab -->
                        <div id="appointments-tab" class="tab-content p-6 hidden">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-medium text-white">Rendez-vous à venir</h2>
                                <button id="add-appointment-btn"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>Créer un rendez-vous
                                </button>
                            </div>
                            <?php foreach ($result_appointment as $value): ?>
                                <div class="space-y-4">
                                    <div class="bg-gray-800 p-4 border border-gray-700 rounded-lg shadow-sm">
                                        <div class="flex justify-between">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-white"><?php
                                                    $result_Patient = $Patient->GetValuePatients($value['patient_id']);
                                                    echo $result_patient[0]['user_first_name'] . " " . $result_patient[0]['user_last_name'];
                                                    ?>
                                                    </div>
                                                    <div class="text-sm text-gray-400"><?= $value['reason'] ?></div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <div class="text-sm text-gray-400">
                                                    <i class="far fa-calendar mr-1"></i>
                                                    <?= $value['date'] ?>
                                                </div>
                                                <div class="text-sm text-gray-400">
                                                    <i class="far fa-clock mr-1"></i>
                                                    <?= $value['time'] ?>
                                                </div>
                                                <button class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Prescriptions Tab -->
                        <div id="prescriptions-tab" class="tab-content p-6 hidden">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-medium text-white">Prescriptions récentes</h2>
                                <button id="add-prescription-btn"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-plus mr-2"></i>Créer une prescription
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-700">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Patient</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Médicament</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Dosage</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                                Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                                        <?php foreach ($result_prescription as $value): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-white"><?= $result_prescription['user_first_name'] . " " . $result_prescription['user_last_name']  ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                Paracétamol</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">500mg,
                                                3x/jour</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">12/05/2023
                                            </td>
                                        </tr>
                                        <?php endforeach;  ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-white">Marie Martin</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                Amoxicilline</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">1g,
                                                2x/jour</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">05/05/2023
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Adding Patient -->
    <div id="add-patient-modal"
        class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-gray-800 modal-backdrop">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Ajouter un nouveau patient</h3>
                    <button id="close-patient-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Nom complet</label>
                        <input type="text"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            placeholder="Nom et prénom">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Date de naissance</label>
                        <input type="date"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Téléphone</label>
                        <input type="tel"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            placeholder="06 12 34 56 78">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            placeholder="email@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Adresse</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            rows="3" placeholder="Adresse complète"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancel-patient-modal"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded-md hover:bg-gray-600 focus:outline-none">
                            Annuler
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Appointment -->
    <div id="add-appointment-modal"
        class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-gray-800 modal-backdrop">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Créer un rendez-vous</h3>
                    <button id="close-appointment-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Patient</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white">
                            <option>Sélectionner un patient</option>
                            <option>Jean Dupont</option>
                            <option>Marie Martin</option>
                            <option>Pierre Bernard</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Date</label>
                        <input type="date"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Heure</label>
                        <input type="time"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Type de consultation</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white">
                            <option>Consultation générale</option>
                            <option>Suivi traitement</option>
                            <option>Consultation spécialisée</option>
                            <option>Urgence</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Notes</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            rows="3" placeholder="Notes supplémentaires"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancel-appointment-modal"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded-md hover:bg-gray-600 focus:outline-none">
                            Annuler
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Prescription -->
    <div id="add-prescription-modal"
        class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-gray-800 modal-backdrop">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Créer une prescription</h3>
                    <button id="close-prescription-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Patient</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white">
                            <option>Sélectionner un patient</option>
                            <option>Jean Dupont</option>
                            <option>Marie Martin</option>
                            <option>Pierre Bernard</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Médicament</label>
                        <input type="text"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            placeholder="Nom du médicament">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Dosage</label>
                        <input type="text"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            placeholder="Ex: 500mg, 3x/jour">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Durée</label>
                        <input type="text"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            placeholder="Ex: 7 jours">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Instructions</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-900 text-white"
                            rows="3" placeholder="Instructions spéciales"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancel-prescription-modal"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded-md hover:bg-gray-600 focus:outline-none">
                            Annuler
                        </button>
                        <button type="button"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Success Notification -->
    <div id="success-notification"
        class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 ease-in-out">
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