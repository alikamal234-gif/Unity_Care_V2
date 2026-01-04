<?php
require_once "../classes/repositories/DepartmentRepository.php";

$department = new DepartmentRepository();

 if(isset($_GET['id']) && $_GET['action'] == "update" && $_GET['table'] == 'department'){
    $result = $department->GetValueDepartment($_GET['id']);
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $data_department = [
            "name" => $_POST['name'],
            "location" => $_POST['location']
         ];

    foreach ($data_department as $key => $value) {
        $department->updateDepartment($key,$value,$_GET['id']);
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
    <div id="dynamicModal"
        class="fixed inset-0 bg-black bg-opacity-70 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-gray-800 border-gray-600">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-bold text-white mb-4">Titre de la Modale</h3>
                <form id="modalForm" method="post">

                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Nom de Department</label><input name="name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['name'] ?? '' ?>"></div>
                    <div class="mb-4"><label class="block text-gray-300 text-sm font-medium mb-2">Location</label><input name="location" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" value="<?php echo $result['location'] ?? '' ?>"></div>
          
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-colors">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>