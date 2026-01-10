<?php
require_once "../classes/repositories/DoctorRepository.php";
require_once "../classes/repositories/UserRepository.php";
require_once "../classes/models/User.php";
require_once "../classes/models/Doctor.php";


$Doctor = new DoctorRepository();
$user = new UserRepository();

 if(isset($_GET['id']) && $_GET['action'] == "update" && $_GET['table'] == 'doctors'){
    $result = $Doctor->GetValueDoctors($_GET['id']);
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $modal_user = new User(
        $_GET['id'],
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['role'],
        $_POST['password_hash']
    );
    $user->updateUser($modal_user);

   

    $modal_doctor = new Doctor(
        $_GET['id'],
        $_POST['spicialization'],
        $_POST['department_id']
    );
    $Doctor->updateDoctor($modal_doctor);

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
    <div id="dynamicModal"
        class="fixed inset-0 bg-black bg-opacity-70 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-gray-800 border-gray-600">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-bold text-white mb-4">Titre de la Modale</h3>
                <form id="modalForm" method="post">
                    <div class="w-full flex gap-2">
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Nom</label><input name="first_name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['first_name'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Prenom</label><input name="last_name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['last_name'] ?? '' ?>"></div>
                </div>
                <div class="w-full flex gap-2">
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Role</label><input name="role" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="role" value="<?php echo $result['role'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Spécialité</label><input name="spicialization" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['spicialization'] ?? '' ?>"></div>
                </div> 
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Password</label><input name="password_hash" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" value="<?php echo $result['password_hash'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Email</label><input name="email" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" value="<?php echo $result['email'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Phone</label><input name="Phone" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="phone" value="<?php echo $result['phone'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">id de Department</label><input name="department_id" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="number" value="<?php echo $result['department_id'] ?? '' ?>"></div>                    
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