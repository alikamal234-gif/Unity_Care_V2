<?php
require_once "../classes/repositories/AppointmentRepository.php";
require_once "../classes/repositories/DoctorRepository.php";

$appointment = new AppointmentRepository();
session_start();
if (isset($_GET['id']) && $_GET['action'] == "update" && $_GET['table'] == 'appointments') {
    $result = $appointment->GetValueAppointment($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        "date" => $_POST['date'],
        "time" => $_POST['time'],
        "doctor_id" => $_POST['doctor_id'],
        "reason" => $_POST['reason'],
        "status" => $_POST['status'],
        "patient_id" => $_POST['patient_id'],
    ];

    $modal_appointment = new Appointment(
        $_POST['date'],
        $_POST['time'],
        $_POST['doctor_id'],
        $_POST['patient_id'],
        $_POST['reason'],
        $_POST['status'],
    );

        $appointment->updateAppointment($modal_appointment,$_GET['id']);
    

    header('Location: ../pages/P_patients.php');
    exit;

}

$Doctor = new DoctorRepository();
$result_doctor = $Doctor->getAllDoctor();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <div id="add-appointment-modal" class="modal fixed inset-0 bg-gray-900/80 overflow-y-auto h-full w-full block z-50">
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
                            min="" value="<?php echo $result['date'] ?? '' ?>">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Heure</label>
                        <select name="time" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md
           focus:outline-none focus:ring-2 focus:ring-blue-500
           focus:border-blue-500 text-gray-100">

                            <option value="09:00:00" <?= ($result['time'] ?? '') === '09:00:00' ? 'selected' : '' ?>>
                                09:00:00</option>
                            <option value="09:30:00" <?= ($result['time'] ?? '') === '09:30:00' ? 'selected' : '' ?>>
                                09:30:00</option>
                            <option value="10:00:00" <?= ($result['time'] ?? '') === '10:00:00' ? 'selected' : '' ?>>
                                10:00:00</option>
                            <option value="10:30:00" <?= ($result['time'] ?? '') === '10:30:00' ? 'selected' : '' ?>>
                                10:30:00</option>
                            <option value="11:00:00" <?= ($result['time'] ?? '') === '12:30:00' ? 'selected' : '' ?>>
                                11:00:00</option>
                            <option value="11:30:00" <?= ($result['time'] ?? '') === '11:30:00' ? 'selected' : '' ?>>
                                11:30:00</option>
                            <option value="14:00:00" <?= ($result['time'] ?? '') === '14:00:00' ? 'selected' : '' ?>>
                                14:00:00</option>
                            <option value="14:30:00" <?= ($result['time'] ?? '') === '14:30:00' ? 'selected' : '' ?>>
                                14:30:00</option>

                        </select>

                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Doctor</label>
                        <select name="doctor_id" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md
           focus:outline-none focus:ring-2 focus:ring-blue-500
           focus:border-blue-500 text-gray-100">

                            <?php foreach ($result_doctor as $value): ?>
                                <option value="<?= $value['id'] ?>" <?= ($result['doctor_id'] ?? '') == $value['id'] ? 'selected' : '' ?>>
                                    <?= $value['first_name'] . ' ' . $value['last_name'] ?>
                                </option>
                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">
                            Reason (optionnel)
                        </label>

                        <textarea name="reason" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md
               focus:outline-none focus:ring-blue-500
               focus:border-blue-500 text-gray-100 placeholder-gray-400" rows="3"
                            placeholder="Décrivez brièvement le motif de votre consultation..."><?php
                            echo htmlspecialchars($result['reason'] ?? '');
                            ?></textarea>
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
</body>

</html>