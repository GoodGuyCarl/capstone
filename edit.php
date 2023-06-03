<?php
session_start();
include('inc.connection.php');
$id = $_GET['id'];
$_SESSION['edit_id'] = $id;

$sql = "SELECT * FROM pds WHERE id = :id";
$result = $db->prepare($sql);
$result->bindParam('id', $id);
$result->execute();
$data = $result->fetch();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Update PDS</title>
</head>
<body>
<main>
    <article>
        <header>
            <button onclick="history.back()" aria-label="Close" id="close" style="float: right">Go back</button>
            <h1>Edit <?php echo $data['firstname'] . ' ' .$data['surname'] . '\'s'; ?> PDS</h1>
        </header>
        <h3 style="text-align: center;">Personal Information</h3>
        <form action="edit_sheet.php" method="post">
            <div style="display: flex; flex-direction: row">
                <div style="display: flex; flex-direction: column;">
                    <label for="surname">Surname</label>
                    <input value="<?php echo $data['surname']?>" type="text" name="surname" id="surname" required>
                    <label for="firstname">First Name</label>
                    <input value="<?php echo $data['firstname']?>" type="text" name="firstname" id="firstname" required>
                    <label for="middlename">Middle Name</label>
                    <input value="<?php echo $data['middlename']?>" type="text" name="middlename" id="middlename" required>
                    <label for="extension">Name Extension (Jr., Sr., etc.)</label>
                    <input value="<?php echo $data['extension']?>" type="text" name="extension" id="extension">
                    <label for="birthdate">Birthdate</label>
                    <input value="<?php echo $data['birthdate']?>" type="date" name="birthdate" id="birthdate" required>
                    <label for="birthplace">Birthplace</label>
                    <input value="<?php echo $data['birthplace']?>" type="text" name="birthplace" id="birthplace" required>
                    <label for="sex">Sex</label>
                    <select name="sex" id="sex">
                        <?php
                        if($data['sex'] == 'Male'){
                            echo '<option value="Male" selected>Male</option>';
                            echo '<option value="Female">Female</option>';
                        }
                        else {
                            echo '<option value="Male">Male</option>';
                            echo '<option value="Female" selected>Female</option>';
                        }?>
                    </select>
                    <label for="civil_status">Civil Status</label>
                    <select name="civil_status" id="civil_status">
                        <?php
                        if($data['civil_status'] == 'Single'){
                            echo '<option value="Single" selected>Single</option>';
                            echo '<option value="Married">Married</option>';
                            echo '<option value="Widowed">Widowed</option>';
                            echo '<option value="Separated">Separated</option>';
                        }
                        else if ($data['civil_status'] == 'Married'){
                            echo '<option value="Single">Single</option>';
                            echo '<option value="Married" selected>Married</option>';
                            echo '<option value="Widowed">Widowed</option>';
                            echo '<option value="Separated">Separated</option>';
                        }
                        else if ($data['civil_status'] == 'Widowed'){
                            echo '<option value="Single">Single</option>';
                            echo '<option value="Married">Married</option>';
                            echo '<option value="Widowed" selected>Widowed</option>';
                            echo '<option value="Separated">Separated</option>';
                        }
                        else {
                            echo '<option value="Single">Single</option>';
                            echo '<option value="Married">Married</option>';
                            echo '<option value="Widowed">Widowed</option>';
                            echo '<option value="Separated" selected>Separated</option>';
                        }?>
                    </select>
                </div>
                <div style="display: flex; flex-direction: row;">
                    <div style="flex-direction: column;">
                        <label for="height">Height (in m)</label>
                        <input value="<?php echo $data['height']?>" type="number" name="height" id="height" step="0.01" required>
                        <label for="weight">Weight (in kg)</label>
                        <input value="<?php echo $data['weight']?>" type="number" name="weight" id="weight" step="0.01" required>
                        <label for="blood_type">Blood Type</label>
                        <input value="<?php echo $data['blood_type']?>" type="text" name="blood_type" id="blood_type" required>
                        <label for="citizenship">Citizenship</label>
                        <input value="<?php echo $data['citizenship']?>" type="text" name="citizenship" id="citizenship" required>
                        <label for="tel">Telephone Number</label>
                        <input value="<?php echo $data['tel']?>" type="tel" name="tel" id="tel" pattern="[0-9]{11}" required>
                        <label for="mobile">Mobile Number</label>
                        <input value="<?php echo $data['mobile']?>" type="tel" name="mobile" id="mobile" pattern="[0-9]{11}" required>
                        <label for="email">Email address</label>
                        <input value="<?php echo $data['email']?>" type="email" name="email" id="email" required>
                    </div>
                </div>
                <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-around;">
                    <div style="text-align: center; flex-direction: column">
                        <h4>Residential Address</h4>
                        <input value="<?php echo $data['res_houseblocklot']?>" type="text" name="res_houseblocklot" placeholder="House/Block/Lot No." required>
                        <input value="<?php echo $data['res_street']?>" type="text" name="res_street" placeholder="Street" required>
                        <input value="<?php echo $data['res_subdivision']?>" type="text" name="res_subdivision" placeholder="Subdivision" required>
                        <input value="<?php echo $data['res_barangay']?>" type="text" name="res_barangay" placeholder="Barangay" required>
                        <input value="<?php echo $data['res_city']?>" type="text" name="res_city" placeholder="City/Municipality" required>
                        <input value="<?php echo $data['res_province']?>" type="text" name="res_province" placeholder="Province" required>
                        <input value="<?php echo $data['res_zip']?>" type="text" name="res_zip" placeholder="ZIP Code" pattern="[0-9]{4}" required>
                    </div>
                    <div style="text-align: center; flex-direction: column">
                        <h4>Permanent Address</h4>
                        <input value="<?php echo $data['perm_houseblocklot']?>" type="text" name="perm_houseblocklot" placeholder="House/Block/Lot No." required>
                        <input value="<?php echo $data['perm_street']?>" type="text" name="perm_street" placeholder="Street" required>
                        <input value="<?php echo $data['perm_subdivision']?>" type="text" name="perm_subdivision" placeholder="Subdivision" required>
                        <input value="<?php echo $data['perm_barangay']?>" type="text" name="perm_barangay" placeholder="Barangay" required>
                        <input value="<?php echo $data['perm_city']?>" type="text" name="perm_city" placeholder="City/Municipality" required>
                        <input value="<?php echo $data['perm_province']?>" type="text" name="perm_province" placeholder="Province" required>
                        <input value="<?php echo $data['perm_zip']?>" type="text" name="perm_zip" placeholder="ZIP Code" pattern="[0-9]{4}" required>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: center">
                <button type="submit">Submit</button>
            </div>
        </form>
    </article>
</main>
</body>
</html>
