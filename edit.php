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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Update PDS</title>
</head>
<body>
<main>
    <div class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <header>
                                <button onclick="history.back()" aria-label="Close" id="close" class="btn btn-secondary float-right">Go back</button>
                                <h1>Edit <?php echo $data['firstname'] . ' ' .$data['surname'] . '\'s'; ?> PDS</h1>
                            </header>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center">Personal Information</h3>
                            <form action="edit_sheet.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="surname">Surname</label>
                                            <input value="<?php echo $data['surname']?>" type="text" name="surname" id="surname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input value="<?php echo $data['firstname']?>" type="text" name="firstname" id="firstname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="middlename">Middle Name</label>
                                            <input value="<?php echo $data['middlename']?>" type="text" name="middlename" id="middlename" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="extension">Name Extension (Jr., Sr., etc.)</label>
                                            <input value="<?php echo $data['extension']?>" type="text" name="extension" id="extension" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="birthdate">Birthdate</label>
                                            <input value="<?php echo $data['birthdate']?>" type="date" name="birthdate" id="birthdate" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthplace">Birthplace</label>
                                            <input value="<?php echo $data['birthplace']?>" type="text" name="birthplace" id="birthplace" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sex">Sex</label>
                                            <select name="sex" id="sex" class="form-control">
                                                <?php
                                                if($data['sex'] == 'Male'){
                                                    echo '<option value="Male" selected>Male</option>';
                                                    echo '<option value="Female">Female</option>';
                                                }
                                                else {
                                                    echo '<option value="Male">Male</option>';
                                                    echo '<option value="Female" selected>Female</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="civil_status">Civil Status</label>
                                            <select name="civil_status" id="civil_status" class="form-control">
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
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="height">Height (in m)</label>
                                            <input value="<?php echo $data['height']?>" type="number" name="height" id="height" step="0.01" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="weight">Weight (in kg)</label>
                                            <input value="<?php echo $data['weight']?>" type="number" name="weight" id="weight" step="0.01" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="blood_type">Blood Type</label>
                                            <input value="<?php echo $data['blood_type']?>" type="text" name="blood_type" id="blood_type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="citizenship">Citizenship</label>
                                            <input value="<?php echo $data['citizenship']?>" type="text" name="citizenship" id="citizenship" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Telephone Number</label>
                                            <input value="<?php echo $data['tel']?>" type="tel" name="tel" id="tel" pattern="[0-9]{11}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label>
                                            <input value="<?php echo $data['mobile']?>" type="tel" name="mobile" id="mobile" pattern="[0-9]{11}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input value="<?php echo $data['email']?>" type="email" name="email" id="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4>Residential Address</h4>
                                            <div class="form-group">
                                                <input value="<?php echo $data['res_houseblocklot']?>" type="text" name="res_houseblocklot" placeholder="House/Block/Lot No." class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['res_street']?>" type="text" name="res_street" placeholder="Street" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['res_subdivision']?>" type="text" name="res_subdivision" placeholder="Subdivision" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['res_barangay']?>" type="text" name="res_barangay" placeholder="Barangay" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['res_city']?>" type="text" name="res_city" placeholder="City/Municipality" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['res_province']?>" type="text" name="res_province" placeholder="Province" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['res_zip']?>" type="text" name="res_zip" placeholder="ZIP Code" pattern="[0-9]{4}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h4>Permanent Address</h4>
                                            <div class="form-group">
                                                <input value="<?php echo $data['perm_houseblocklot']?>" type="text" name="perm_houseblocklot" placeholder="House/Block/Lot No." class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['perm_street']?>" type="text" name="perm_street" placeholder="Street" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['perm_subdivision']?>" type="text" name="perm_subdivision" placeholder="Subdivision" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['perm_barangay']?>" type="text" name="perm_barangay" placeholder="Barangay" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['perm_city']?>" type="text" name="perm_city" placeholder="City/Municipality" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['perm_province']?>" type="text" name="perm_province" placeholder="Province" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $data['perm_zip']?>" type="text" name="perm_zip" placeholder="ZIP Code" pattern="[0-9]{4}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
