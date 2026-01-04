<?php
require_once "../classes/repositories/PatientRepository.php";
require_once "../classes/repositories/UserRepository.php";

$patient = new PatientRepository();
$user = new UserRepository();

 if(isset($_GET['id']) && $_GET['action'] == "update" && $_GET['table'] == 'patients'){
    $result = $patient->GetValuePatients($_GET['id']);
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $data_user = [
        'first_name' => $_POST['first_name'] ?? null,
        'last_name' => $_POST['last_name'] ?? null,
        'email' => $_POST['email'] ?? null,
        'phone' => $_POST['phone'] ?? null,
        'role' => $_POST['role'] ?? null,
        'password_hash' => $_POST['password_hash'] ?? null,
    ];

    $data_patient = [
        'gender' => $_POST['gender'] ?? null,
        'date_of_birth' => $_POST['date_of_birth'] ?? null,
        'adress' => $_POST['adress'] ?? null
    ];
    foreach ($data_patient as $key => $value) {
        $patient->updatePatient($key,$value,$_GET['id']);
    }
    foreach ($data_user as $key => $value) {
        $user->updateUser($key,$value,$_GET['id']);
    }

    header('Location: ../index.php');
    exit;

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
   




    <div id=""
        class="fixed inset-0 bg-black bg-opacity-70  overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-gray-800 border-gray-600">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-bold text-white mb-4">Titre de la Modale</h3>
                <form id="modalForm" method="post">
                          <div class="w-full flex gap-2">
                        <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Nom</label><input name="first_name"  class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['first_name'] ?? '' ?>"></div>
            <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Prenom</label><input name="last_name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['last_name'] ?? '' ?>"></div>
                    </div>
                    <div class="w-full flex gap-2">
                        <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Date de Naissance</label><input name="date_of_birth" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="date" value="<?php echo $result['date_of_birth'] ?? '' ?>"></div>
                        <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Email</label><input name="email" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value="<?php echo $result['email'] ?? '' ?>"></div>
                    </div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Phone</label><input name="phone" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="phone" value="<?php echo $result['phone'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Gender</label><input name="gender" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="gender" value="<?php echo $result['gender'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Role</label><input name="role" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="role" value="<?php echo $result['role'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Password</label><input name="password_hash" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['password_hash'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Address</label><input name="adress" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="address" value="<?php echo $result['adress'] ?? '' ?>"></div>
    
                    <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors">Annuler</button>
                    <button type="submit" name="${type}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>