<?php session_start();
include('inc.connection.php');
if(!isset($_SESSION['logged_in'])){
    header('Location: index.php');
    die();
}

$sql = 'SELECT * FROM resumes;';
$query = $db->prepare($sql);
$query->execute();
$rows = $query->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resume Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    if($query->rowCount() == 0) {
        echo '<div class="container mx-auto">
  <div class="bg-white border border-gray-300 p-4 my-2">
    <div class="text-lg font-medium mb-4">No records found</div>
    <div class="text-gray-600">There are no records available at the moment.</div>
  </div>
</div>';
    }
    else {
        echo '<div class="container mx-auto my-2">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-orange-500 text-white">
                    <tr>
                        <th class="py-3 px-4 font-medium text-left">ID</th>
                        <th class="py-3 px-4 font-medium text-left">Name</th>
                        <th class="py-3 px-4 font-medium text-left">Email</th>
                        <th class="py-3 px-4 font-medium text-left">Phone</th>
                        <th class="py-3 px-4 font-medium text-left">File</th>
                        <th class="py-3 px-4 font-medium text-left">Date Submitted</th>
                        <th class="py-3 px-4 font-medium text-left">Actions</th>
                    </tr>
                    </thead>
                    <tbody>';

        foreach($rows as $row) {
            echo '<tr class="border-b border-gray-300">';

            echo '<td class="py-3 px-4">'.$row['id'].'</td>';
            echo '<td class="py-3 px-4">'.$row['name'].'</td>';
            echo '<td class="py-3 px-4">'.$row['email'].'</td>';
            echo '<td class="py-3 px-4">'.$row['phone'].'</td>';
            echo '<td class="py-3 px-4"><a href="download.php?file='.$row['resume'].'">'.$row['resume'].'</a></td>';
            echo '<td class="py-3 px-4">'.$row['date_submitted'].'</td>';
            echo '<td class="py-3 px-4"><a href="delete.php?id='.$row['id'].'">Delete</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    ?>
    <div class="container mx-auto">
        <button onclick="toggleModal()" class="px-4 my-2 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Create Records</button>
    </div>

    <div class="modal" id="create_resumes" style="display: none">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="create.php" method="post" class="bg-white border border-gray-300 p-4">
                <!-- Form fields -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" class="mt-1 px-3 py-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-orange-500 focus:border-orange-500" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" class="mt-1 px-3 py-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-orange-500 focus:border-orange-500" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" name="phone" class="mt-1 px-3 py-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-orange-500 focus:border-orange-500" required/>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">File</label>
                    <input type="file" name="resume" accept="application/pdf" class="mt-1 px-3 py-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-orange-500 focus:border-orange-500" />
                </div>
                <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Create Record</button>
            </form>
            <button onclick="toggleModal()" class="modal-close absolute top-0 right-0 m-4 text-gray-700 hover:text-gray-900">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>

    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 4px;
            padding: 20px;
            position: relative;
            max-width: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
    </style>

    <script>
        function toggleModal() {
            const modal = document.getElementById("create_resumes");
            modal.style.display = modal.style.display === "none" ? "block" : "none";
        }
    </script>
    <div class="container mx-auto" id="create_resumes" style="display: none">
        <form enctype="multipart/form-data" action="create.php" method="post" class="bg-white border border-gray-300 p-4">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" class="mt-1 px-3 py-2 block w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-orange-500 focus:border-orange-500" />
            </div>
        </form>
    </div>
</body>
</html>
