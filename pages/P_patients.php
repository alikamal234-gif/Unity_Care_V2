<?php

session_start();
require_once "../classes/repositories/PatientRepository.php";
require_once "../classes/repositories/PrescriptionRepository.php";
require_once "../classes/repositories/AppointmentRepository.php";
require_once "../classes/repositories/DoctorRepository.php";


if ($_SESSION['role'] !== 'patient') {
    header('Location: login/P_login.php');
}
$Prescription = new PrescriptionRepository();
$Doctor = new DoctorRepository();
$appointment = new AppointmentRepository();
$result = $Prescription->getById($_SESSION['id_login']);
$result_doctor = $Doctor->getAllDoctor();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = [
        "date" => $_POST['date'],
        "time" => $_POST['time'],
        "doctor_id" => $_POST['doctor_id'],
        "reason" => $_POST['reason'],
        "status" => $_POST['status'],
        "patient_id" => $_POST['patient_id'],

    ];
    
    $appointment->setAppointment($data);
}

$result_appointment = $appointment->getAppointments($_SESSION['id_login']);


if(isset($_GET['id']) && $_GET['action'] == "delete" && $_GET['table'] == 'appointments'){
    $appointment->deleteAppointment((int) $_GET['id'],);
    header('Location: P_patients.php');
    exit;
}

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Espace Patient - Cabinet Médical</title>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#0f172a',
                            card: '#1e293b',
                            border: '#334155',
                            text: '#e2e8f0',
                            textSecondary: '#94a3b8'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .modal {
            transition: opacity 0.25s ease;
        }

        .modal-backdrop {
            backdrop-filter: blur(5px);
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-effect {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
        }

        .glow-effect {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
        }

        .time-slot-selected {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
    </style>
</head>

<body class="bg-gray-950 text-gray-100 dark">
    <header class="glass-effect border-b border-gray-700 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-heartbeat text-blue-400 text-2xl mr-3"></i>
                    <h1 class="text-xl font-semibold text-gray-100">Cabinet Médical</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button
                        class="p-2 rounded-full text-gray-400 hover:text-gray-200 hover:bg-gray-800 transition-all duration-200">
                        <i class="fas fa-bell h-5 w-5"></i>
                    </button>
                    <div class="flex items-center space-x-3">
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium text-gray-100">Jean Dupont</p>
                            <p class="text-xs text-gray-400">#PAT001</p>
                        </div>
                    </div>
                    <button
                        class="p-2 rounded-full text-gray-400 hover:text-gray-200 hover:bg-gray-800 transition-all duration-200">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-2xl p-6 mb-8 text-white glow-effect">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Bonjour, Jean</h2>
                    <p class="text-blue-100">Bienvenue dans votre espace patient</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-user-circle text-6xl text-blue-200 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <button id="quick-appointment-btn"
                class="bg-gray-800/50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center group hover:scale-105 border border-gray-700">
                <div
                    class="bg-blue-900 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-800 transition-colors">
                    <i class="fas fa-calendar-plus text-blue-400 text-xl"></i>
                </div>
                <h3 class="font-semibold text-gray-100 mb-1">Prendre rendez-vous</h3>
                <p class="text-sm text-gray-400">Réserver une consultation</p>
            </button>

            <button
                class=" bg-gray-800/50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center group hover:scale-105 border border-gray-700">
                <div
                    class="bg-green-900 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-green-800 transition-colors">
                    <i class="fas fa-file-medical text-green-400 text-xl"></i>
                </div>
                <h3 class="font-semibold text-gray-100 mb-1">Mes prescriptions</h3>
                <p class="text-sm text-gray-400">Consulter mes ordonnances</p>
            </button>

            <button
                class="bg-gray-800/50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center group hover:scale-105 border border-gray-700">
                <div
                    class="bg-purple-900 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-800 transition-colors">
                    <i class="fas fa-user-md text-purple-400 text-xl"></i>
                </div>
                <h3 class="font-semibold text-gray-100 mb-1">Mon médecin</h3>
                <p class="text-sm text-gray-400">Dr. Martin</p>
            </button>
        </div>

        <div class="bg-gray-800/50 shadow-xl rounded-xl overflow-hidden border border-gray-700">
            <div class="border-b border-gray-700">
                <nav class="flex -mb-px">
                    <button
                        class="tab-btn py-4 px-6 text-sm font-medium text-blue-400 border-b-2 border-blue-500 focus:outline-none"
                        data-tab="appointments">
                        <i class="fas fa-calendar-alt mr-2"></i>Mes rendez-vous
                    </button>

                </nav>
            </div>

            <!-- PRESCRIPTIONS -->
            <div class="bg-gray-800/50 shadow-xl rounded-xl overflow-hidden border border-gray-700 mt-8">
                <div class="border-b border-gray-700 px-6 py-4">
                    <h3 class="text-lg font-medium text-gray-100">
                        <i class="fas fa-file-medical mr-2 text-green-400"></i>
                        Mes prescriptions
                    </h3>
                </div>

                <div class="p-6 space-y-4">


                    <?php foreach ($result as $values): ?>

                        <div
                            class="bg-gray-700/50 border border-gray-600 p-4 rounded-lg hover:bg-gray-700 transition-all duration-200 fade-in flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-100"><?php echo $values['name'] ?></p>
                                <p class="text-sm text-gray-400">
                                    <?php echo "Dosage Instruction : " . $values['dosage_instructions'] ?>
                                </p>
                                <p class="text-sm text-gray-400"><?php echo "Instruction : " . $values['instructions'] ?>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo "Dr. " . $values['first_name'] . $values['last_name'] . " • " . $values['date'] ?>
                                </p>
                            </div>
                            <button
                                class="open-prescription px-3 py-1 bg-green-900/30 text-green-400 rounded-md hover:bg-green-900/50 text-sm border border-green-500/30"
                                data-name="<?= htmlspecialchars($values['name']) ?>"
                                data-dosage="<?= htmlspecialchars($values['dosage_instructions']) ?>"
                                data-instructions="<?= htmlspecialchars($values['instructions']) ?>"
                                data-doctor="<?= htmlspecialchars($values['first_name'] . ' ' . $values['last_name']) ?>"
                                data-date="<?= htmlspecialchars($values['date']) ?>">
                                <i class="fas fa-eye mr-1"></i>Voir
                            </button>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>


            <div id="appointments-tab" class="tab-content p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-100">Rendez-vous à venir</h3>
                    <button id="add-appointment-btn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>Nouveau rendez-vous
                    </button>
                </div>

                <div class="flex space-x-4 mb-6 border-b border-gray-700">
                    <button class="pb-3 px-1 text-sm font-medium text-blue-400 border-b-2 border-blue-500">À
                        venir</button>
                    <button class="pb-3 px-1 text-sm font-medium text-gray-400 hover:text-gray-200">Passés</button>
                    <button class="pb-3 px-1 text-sm font-medium text-gray-400 hover:text-gray-200">Annulés</button>
                </div>

                <div class="space-y-4">

                <?php  foreach($result_appointment as $key => $value): ?>
                    <div class="border-l-4 border-blue-500 bg-blue-900/30 p-4 rounded-r-lg fade-in">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="bg-blue-600/30 text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-500/30"><?php echo $value['date'] ?></span>
                                    <span class="ml-3 text-sm text-gray-300"><?php echo $value['time'] ?></span>
                                </div>
                                <h4 class="font-semibold text-gray-100 mb-1"><?php echo $value['reason'] ?></h4>
                                <p class="text-sm text-gray-400 mb-2"><?php echo $value['doctor_first_name'] . " " . $value['doctor_last_name'] ?></p>
                               
                            </div>
                            <div class="flex space-x-2 ml-4">
                                <a href="../Edit/rendezVous.php?action=update&table=appointments&id=<?php  echo $value['appointment_id'] ?>"
                                    class="px-3 py-1 bg-gray-700 border border-gray-600 text-gray-300 rounded-md hover:bg-gray-600 text-sm transition-colors">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </a>
                                <a   href="P_patients.php?action=delete&table=appointments&id=<?php  echo $value['appointment_id'] ?>"
                                    class="px-3 py-1 bg-red-900/30 text-red-400 rounded-md hover:bg-red-900/50 text-sm transition-colors cancel-appointment border border-red-500/30">
                                    <i class="fas fa-times mr-1"></i>Annuler
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php  endforeach; ?>

                    

                <div class="text-center py-12 hidden" id="no-appointments">
                    <i class="fas fa-calendar-times text-gray-600 text-5xl mb-4"></i>
                    <p class="text-gray-400">Vous n'avez aucun rendez-vous à venir</p>
                    <button
                        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Prendre rendez-vous
                    </button>
                </div>
            </div>


    </main>

    <!-- PRESCRIPTION MODAL -->
    <div id="prescription-modal" class="modal fixed inset-0 bg-gray-900/80 overflow-y-auto h-full w-full hidden z-50">
        <div
            class="relative top-20 mx-auto p-6 border border-gray-600 w-full max-w-md shadow-2xl rounded-xl bg-gray-800 modal-backdrop fade-in">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-100">
                    <i class="fas fa-file-medical text-green-400 mr-2"></i>
                    Détails de la prescription
                </h3>
                <button id="close-prescription" class="text-gray-400 hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="space-y-4 text-left">
                <div>
                    <p class="text-sm text-gray-400">Médicament</p>
                    <p id="modal-medication" class="text-gray-100 font-semibold"></p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">Dosage</p>
                    <p id="modal-dosage" class="text-gray-100"></p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">Instructions</p>
                    <p id="modal-instructions" class="text-gray-100"></p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">Prescrit par</p>
                    <p id="modal-doctor" class="text-gray-100"></p>
                </div>

                <div>
                    <p class="text-sm text-gray-400">Date</p>
                    <p id="modal-date" class="text-gray-100"></p>
                </div>
            </div>


            <div class="flex justify-end mt-6">
                <button id="close-prescription-btn"
                    class="px-4 py-2 bg-gray-700 text-gray-300 rounded-md hover:bg-gray-600 border border-gray-600">
                    Fermer
                </button>
            </div>
        </div>
    </div>


    <div id="add-appointment-modal"
        class="modal fixed inset-0 bg-gray-900/80 overflow-y-auto h-full w-full hidden z-50">
        <div
            class="relative top-20 mx-auto p-5 border border-gray-600 w-full max-w-md shadow-2xl rounded-xl bg-gray-800 modal-backdrop">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-100">Prendre rendez-vous</h3>
                    <button id="close-appointment-modal" class="text-gray-400 hover:text-gray-200 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form class="space-y-4" method="post">
                    <div>
                        <label class="hidden text-sm font-medium text-gray-300 mb-1">Status</label>

                        <input type="text" name="status"
                            class="hidden w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-100"
                            value="scheduled">
                    </div>
                    <div>
                        <label class="hidden text-sm font-medium text-gray-300 mb-1">Patient</label>

                        <input type="text" name="patient_id"
                            class="hidden w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-100"
                            value="<?php echo $_SESSION['id_login'] ?>">
                    </div>

                    <div>

                        <label class="block text-sm font-medium text-gray-300 mb-1">Date</label>
                        <input type="date" name="date"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-100"
                            min="">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Heure</label>
                        <select name="time" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md
               focus:outline-none focus:ring-2 focus:ring-blue-500
               focus:border-blue-500 text-gray-100">
                            <option value="09:00:00">09:00:00</option>
                            <option value="09:30:00">09:30:00</option>
                            <option value="10:00:00">10:00:00</option>
                            <option value="10:30:00">10:30:00</option>
                            <option value="11:00:00">11:00:00</option>
                            <option value="11:30:00">11:30:00</option>
                            <option value="14:00:00">14:00:00</option>
                            <option value="14:30:00">14:30:00</option>
                        </select>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Doctor</label>
                        <select name="doctor_id" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md
                            focus:outline-none focus:ring-2 focus:ring-blue-500
                            focus:border-blue-500 text-gray-100">
                            <?php foreach($result_doctor AS $value): ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] ." ". $value['last_name']  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Reason (optionnel)</label>
                        <textarea name="reason"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-100 placeholder-gray-400"
                            rows="3" placeholder="Décrivez brièvement le motif de votre consultation..."></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" id="cancel-appointment-modal"
                            class="px-4 py-2 bg-gray-700 text-gray-300 rounded-md hover:bg-gray-600 focus:outline-none transition-colors border border-gray-600">
                            Annuler
                        </button>
                        <button type="submit" id="confirm-appointment"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none transition-colors">
                            Confirmer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="success-notification"
        class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-2xl transform translate-y-full transition-transform duration-300 ease-in-out z-50 border border-green-500">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="notification-message">Opération réussie!</span>
        </div>
    </div>

    

    <script>


        const appointmentModal = document.getElementById('add-appointment-modal');

        document.getElementById('add-appointment-btn').addEventListener('click', () => {
            appointmentModal.classList.remove('hidden');
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[type="date"]').min = today;
        });

        document.getElementById('quick-appointment-btn').addEventListener('click', () => {
            appointmentModal.classList.remove('hidden');
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[type="date"]').min = today;
        });

        document.getElementById('close-appointment-modal').addEventListener('click', () => {
            appointmentModal.classList.add('hidden');
        });

        document.getElementById('cancel-appointment-modal').addEventListener('click', () => {
            appointmentModal.classList.add('hidden');
        });

        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.addEventListener('click', () => {
                document.querySelectorAll('.time-slot').forEach(s => {
                    s.classList.remove('time-slot-selected', 'text-white', 'border-blue-500');
                    s.classList.add('bg-gray-700', 'border-gray-600', 'text-gray-300');
                });
                slot.classList.remove('bg-gray-700', 'border-gray-600', 'text-gray-300');
                slot.classList.add('time-slot-selected', 'text-white', 'border-blue-500');
            });
        });

        document.getElementById('confirm-appointment').addEventListener('click', () => {
            appointmentModal.classList.add('hidden');
            showNotification('Rendez-vous confirmé avec succès!');
        });

        let appointmentToCancel = null;

        

       

        document.getElementById('confirm-yes').addEventListener('click', () => {
            if (appointmentToCancel) {
                appointmentToCancel.style.opacity = '0';
                appointmentToCancel.style.transform = 'translateX(-100%)';
                setTimeout(() => {
                    appointmentToCancel.remove();
                }, 300);
                showNotification('Rendez-vous annulé avec succès!');
            }
            confirmModal.classList.add('hidden');
            appointmentToCancel = null;
        });

        appointmentModal.addEventListener('click', (e) => {
            if (e.target === appointmentModal) {
                appointmentModal.classList.add('hidden');
            }
        });

        confirmModal.addEventListener('click', (e) => {
            if (e.target === confirmModal) {
                confirmModal.classList.add('hidden');
            }
        });

        function showNotification(message) {
            const notification = document.getElementById('success-notification');
            const messageElement = document.getElementById('notification-message');

            messageElement.textContent = message;
            notification.classList.remove('translate-y-full');

            setTimeout(() => {
                notification.classList.add('translate-y-full');
            }, 3000);
        }

        document.querySelectorAll('.fa-download').forEach(button => {
            button.parentElement.addEventListener('click', () => {
                showNotification('Téléchargement du PDF en cours...');
            });
        });

        document.querySelectorAll('.fa-print').forEach(button => {
            button.parentElement.addEventListener('click', () => {
                showNotification('Impression en cours...');
            });
        });

        document.querySelectorAll('.fa-eye').forEach(button => {
            button.parentElement.addEventListener('click', () => {
                showNotification('Affichage des détails de la prescription...');
            });
        });


        const prescriptionModal = document.getElementById('prescription-modal');

        const modalMedication = document.getElementById('modal-medication');
        const modalDosage = document.getElementById('modal-dosage');
        const modalInstructions = document.getElementById('modal-instructions');
        const modalDoctor = document.getElementById('modal-doctor');
        const modalDate = document.getElementById('modal-date');

        document.querySelectorAll('.open-prescription').forEach(btn => {
            btn.addEventListener('click', () => {

                modalMedication.textContent = btn.dataset.name;
                modalDosage.textContent = btn.dataset.dosage;
                modalInstructions.textContent = btn.dataset.instructions;
                modalDoctor.textContent = btn.dataset.doctor;
                modalDate.textContent = btn.dataset.date;

                prescriptionModal.classList.remove('hidden');
            });
        });

        document.getElementById('close-prescription').addEventListener('click', () => {
            prescriptionModal.classList.add('hidden');
        });

        document.getElementById('close-prescription-btn').addEventListener('click', () => {
            prescriptionModal.classList.add('hidden');
        });

        prescriptionModal.addEventListener('click', (e) => {
            if (e.target === prescriptionModal) {
                prescriptionModal.classList.add('hidden');
            }
        });
    </script>




</body>

</html>