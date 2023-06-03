<?php
session_start();
include('inc.connection.php');
if(!isset($_SESSION['logged_in'])){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Datasheet Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<nav>
    <form style="display: flex; justify-content: flex-end" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</nav>

<main>
    <div id="records-container" style="display: flex; align-items: center; justify-content: center; flex-direction: column">
        <h1>Personal Datasheet Manager</h1>
        <?php if(isset($_GET['edit']) && $_GET['edit'] == 'success'){
            echo "<div>Record successfully edited!</div><br>";
        }
        else if (isset($_GET['edit']) && $_GET['edit'] == 'error'){
            echo '<div>Record update failed</div><br>';
            if(isset($_SESSION["update_error_message"])){
            echo '<div>' . $_SESSION['udpdate_error_message']  .  '</div>';
            }
        }?>
        <div>
            <input style="width: 50vh;" type="text" name="search" id="search-input" placeholder="Search by surname (min. 3 characters)">
        </div>
        <div id="records-table" style="display: flex;flex-direction: column; justify-content: center; align-items: center">
            <!-- Table will be populated dynamically using AJAX -->
        </div>
        <div style="display: flex; justify-content: center; align-items: center">
            <button onclick="create.showModal();">Create Records</button>
        </div>
    </div>
</main>
<dialog id="create">
    <article>
        <header>
            <button aria-label="Close" style="float: right" onclick="create.close()">Cancel</button>
            <h1>Create PDS</h1>
        </header>
        <h3 style="text-align: center;">Personal Information</h3>
        <form action="create_sheet.php" method="post">
            <div style="display: flex; flex-direction: row">
                <div style="display: flex; flex-direction: column;">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" required>
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" required>
                    <label for="middlename">Middle Name</label>
                    <input type="text" name="middlename" id="middlename" required>
                    <label for="extension">Name Extension (Jr., Sr., etc.)</label>
                    <input type="text" name="extension" id="extension">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" name="birthdate" id="birthdate" required>
                    <label for="birthplace">Birthplace</label>
                    <input type="text" name="birthplace" id="birthplace" required>
                    <label for="sex">Sex</label>
                    <select name="sex" id="sex">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="civil_status">Civil Status</label>
                    <select name="civil_status" id="civil_status">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                    </select>
                </div>
                <div style="display: flex; flex-direction: row;">
                    <div style="flex-direction: column;">
                        <label for="height">Height (in m)</label>
                        <input type="number" name="height" id="height" step="0.01" required>
                        <label for="weight">Weight (in kg)</label>
                        <input type="number" name="weight" id="weight" step="0.01" required>
                        <label for="blood_type">Blood Type</label>
                        <input type="text" name="blood_type" id="blood_type" required>
                        <label for="citizenship">Citizenship</label>
                        <input type="text" name="citizenship" id="citizenship" required>
                        <label for="tel">Telephone Number</label>
                        <input type="tel" name="tel" id="tel" pattern="[0-9]{11}" required>
                        <label for="mobile">Mobile Number</label>
                        <input type="tel" name="mobile" id="mobile" pattern="[0-9]{11}" required>
                        <label for="email">Email address</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
                <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-around;">
                    <div style="text-align: center; flex-direction: column">
                        <h4>Residential Address</h4>
                        <input type="text" name="res_houseblocklot" placeholder="House/Block/Lot No." required>
                        <input type="text" name="res_street" placeholder="Street" required>
                        <input type="text" name="res_subdivision" placeholder="Subdivision" required>
                        <input type="text" name="res_barangay" placeholder="Barangay" required>
                        <input type="text" name="res_city" placeholder="City/Municipality" required>
                        <input type="text" name="res_province" placeholder="Province" required>
                        <input type="text" name="res_zip" placeholder="ZIP Code" pattern="[0-9]{4}" required>
                    </div>
                    <div style="text-align: center; flex-direction: column">
                        <h4>Permanent Address</h4>
                        <input type="text" name="perm_houseblocklot" placeholder="House/Block/Lot No." required>
                        <input type="text" name="perm_street" placeholder="Street" required>
                        <input type="text" name="perm_subdivision" placeholder="Subdivision" required>
                        <input type="text" name="perm_barangay" placeholder="Barangay" required>
                        <input type="text" name="perm_city" placeholder="City/Municipality" required>
                        <input type="text" name="perm_province" placeholder="Province" required>
                        <input type="text" name="perm_zip" placeholder="ZIP Code" pattern="[0-9]{4}" required>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: center">
                <button type="submit">Submit</button>
            </div>
        </form>
    </article>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('search-input');
        var searchButton = document.getElementById('search-button');
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

</script>

</body>
</html>
