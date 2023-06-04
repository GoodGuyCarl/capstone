<?php
session_start();
include('inc.connection.php');
if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Datasheet Manager</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <form class="form-inline ml-auto" action="logout.php">
        <button class="btn btn-primary" type="submit">Logout</button>
    </form>
</nav>

<main class="container">
    <div id="records-container" class="d-flex flex-column align-items-center">
        <h1 class="mt-4">Personal Datasheet Manager</h1>
        <?php if (isset($_GET['edit']) && $_GET['edit'] == 'success') {
            echo "<div class='alert alert-success mt-4'>Record successfully edited!</div>";
        } else if (isset($_GET['edit']) && $_GET['edit'] == 'error') {
            echo '<div class="alert alert-danger mt-4">Record update failed</div>';
            if (isset($_SESSION["update_error_message"])) {
                echo '<div>' . $_SESSION['udpdate_error_message']  .  '</div>';
            }
        } ?>
        <div class="mt-4">
            <input class="form-control" style="width: 50vh;" type="text" name="search" id="search-input" placeholder="Search by surname (min. 3 characters)">
        </div>
        <div id="records-table" class="mt-4">
            <!-- Table will be populated dynamically using AJAX -->
        </div>
        <div class="mt-4">
            <button class="btn btn-primary" onclick="create.showModal();">Create Records</button>
        </div>
    </div>
</main>

<dialog class="container" style="border: none; border-radius: 5px" id="create">
    <article>
        <header>
            <button class="btn btn-danger" aria-label="Close" style="float: right" onclick="create.close()">Cancel</button>
            <h1>Create PDS</h1>
        </header>
        <h3 style="text-align: center;">Personal Information</h3>
        <form action="create_sheet.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input class="form-control" type="text" name="surname" id="surname" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input class="form-control" type="text" name="firstname" id="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="middlename">Middle Name</label>
                        <input class="form-control" type="text" name="middlename" id="middlename" required>
                    </div>
                    <div class="form-group">
                        <label for="extension">Name Extension (Jr., Sr., etc.)</label>
                        <input class="form-control" type="text" name="extension" id="extension">
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input class="form-control" type="date" name="birthdate" id="birthdate" required>
                    </div>
                    <div class="form-group">
                        <label for="birthplace">Birthplace</label>
                        <input class="form-control" type="text" name="birthplace" id="birthplace" required>
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select class="form-control" name="sex" id="sex">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" name="civil_status" id="civil_status">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="height">Height (in m)</label>
                        <input class="form-control" type="number" name="height" id="height" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (in kg)</label>
                        <input class="form-control" type="number" name="weight" id="weight" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="blood_type">Blood Type</label>
                        <input class="form-control" type="text" name="blood_type" id="blood_type" required>
                    </div>
                    <div class="form-group">
                        <label for="citizenship">Citizenship</label>
                        <input class="form-control" type="text" name="citizenship" id="citizenship" required>
                    </div>
                    <div class="form-group">
                        <label for="tel">Telephone Number</label>
                        <input class="form-control" type="tel" name="tel" id="tel" pattern="[0-9]{11}" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input class="form-control" type="tel" name="mobile" id="mobile" pattern="[0-9]{11}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center">Residential Address</h4>
                    <div class="form-group">
                        <input class="form-control" type="text" name="res_houseblocklot" placeholder="House/Block/Lot No." required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="res_street" placeholder="Street" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="res_subdivision" placeholder="Subdivision" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="res_barangay" placeholder="Barangay" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="res_city" placeholder="City/Municipality" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="res_province" placeholder="Province" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="res_zip" placeholder="ZIP Code" pattern="[0-9]{4}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="text-center">Permanent Address</h4>
                    <div class="form-group">
                        <input class="form-control" type="text" name="perm_houseblocklot" placeholder="House/Block/Lot No." required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="perm_street" placeholder="Street" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="perm_subdivision" placeholder="Subdivision" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="perm_barangay" placeholder="Barangay" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="perm_city" placeholder="City/Municipality" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="perm_province" placeholder="Province" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="perm_zip" placeholder="ZIP Code" pattern="[0-9]{4}" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </article>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('search-input');
        var recordsContainer = document.getElementById('records-container');
        var recordsTable = document.getElementById('records-table');

        // Function to update records table using AJAX
        function updateRecordsTable(searchValue) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        recordsTable.innerHTML = xhr.responseText;
                    } else {
                        console.log('An error occurred.');
                    }
                }
            };

            var url = 'search.php?search=' + encodeURIComponent(searchValue);
            xhr.open('GET', url, true);
            xhr.send();
        }


        // Event listener for search input keyup
        searchInput.addEventListener('keyup', function() {
            var searchValue = searchInput.value.trim();
            if (searchValue.length >= 3) {
                updateRecordsTable(searchValue);
            }
            else if (searchValue === '') {
                updateRecordsTable('');
            }
        });

        // Initial loading of records table
        updateRecordsTable('');
    });

    var create = {
        showModal: function() {
            var createDialog = document.getElementById('create');
            createDialog.showModal();
        },
        close: function() {
            var createDialog = document.getElementById('create');
            createDialog.close();
        }
    };
</script>
</body>

</html>
