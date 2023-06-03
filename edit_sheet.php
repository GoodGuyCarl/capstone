<?php
session_start();
require 'vendor/autoload.php';
include "inc.connection.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$filename = 'pds.xlsx';
$id = $_SESSION['edit_id'];
$spreadsheet = IOFactory::load($filename);


$surname = $_POST['surname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$extension = $_POST['extension'];
$birthdate = $_POST['birthdate'];
$birthplace = $_POST['birthplace'];
$sex = $_POST['sex'];
$civil_status = $_POST['civil_status'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$blood_type = $_POST['blood_type'];
$citizenship = $_POST['citizenship'];
$tel = $_POST['tel'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$res_houseblocklot = $_POST['res_houseblocklot'];
$res_street = $_POST['res_street'];
$res_subdivision = $_POST['res_subdivision'];
$res_barangay = $_POST['res_barangay'];
$res_city = $_POST['res_city'];
$res_province = $_POST['res_province'];
$res_zip = $_POST['res_zip'];
$perm_houseblocklot = $_POST['perm_houseblocklot'];
$perm_street = $_POST['perm_street'];
$perm_subdivision = $_POST['perm_subdivision'];
$perm_barangay = $_POST['perm_barangay'];
$perm_city = $_POST['perm_city'];
$perm_province = $_POST['perm_province'];
$perm_zip = $_POST['perm_zip'];

$cellSurname = 'C7';
$cellFirstName = 'C9';
$cellMiddleName = 'C11';
$cellNameExtension = 'L11';
$cellBirthdate = 'C13';
$cellBirthplace = 'C15';
$cellSex = 'I15';
$cellCivilStatus = 'C17';
$cellHeight = 'C19';
$cellWeight = 'C21';
$cellBloodType = 'C23';
$cellTelNo = 'C25';
$cellMobileNo = 'C27';
$cellEmail = 'C29';
$cellCitizenship = 'I13';
$cellResAddHouseBlockLot = 'I16';
$cellResAddStreet = 'L16';
$cellResAddSubdivisionVillage = 'I18';
$cellResAddBarangay = 'L18';
$cellResAddCityMunicipality = 'I20';
$cellResAddProvince = 'L20';
$cellResAddZipCode = 'I22';
$cellPermAddHouseBlockLot = 'I23';
$cellPermAddStreet = 'L23';
$cellPermAddSubdivisionVillage = 'I25';
$cellPermAddBarangay = 'L25';
$cellPermAddCityMunicipality = 'I27';
$cellPermAddProvince = 'L27';
$cellPermAddZipCode = 'I29';



$filename = $surname . '_' . $firstname . '_PDS.xlsx';


$spreadsheet->getDefaultStyle()->getFont()->setName('Arial Narrow');
$spreadsheet->getActiveSheet()
    ->setCellValue($cellSurname, $surname)
    ->setCellValue($cellFirstName, $firstname)
    ->setCellValue($cellMiddleName, $middlename)
    ->setCellValue($cellNameExtension, $extension)
    ->setCellValue($cellBirthdate, $birthdate)
    ->setCellValue($cellBirthplace, $birthplace)
    ->setCellValue($cellSex, $sex)
    ->setCellValue($cellCivilStatus, $civil_status)
    ->setCellValue($cellHeight, $height)
    ->setCellValue($cellWeight, $weight)
    ->setCellValue($cellBloodType, $blood_type)
    ->setCellValue($cellCitizenship, $citizenship)
    ->setCellValue($cellResAddHouseBlockLot, $res_houseblocklot)
    ->setCellValue($cellResAddStreet, $res_street)
    ->setCellValue($cellResAddSubdivisionVillage, $res_subdivision)
    ->setCellValue($cellResAddBarangay, $res_barangay)
    ->setCellValue($cellResAddCityMunicipality, $res_city)
    ->setCellValue($cellResAddProvince, $res_province)
    ->setCellValue($cellResAddZipCode, $res_zip)
    ->setCellValue($cellPermAddHouseBlockLot, $perm_houseblocklot)
    ->setCellValue($cellPermAddStreet, $perm_street)
    ->setCellValue($cellPermAddSubdivisionVillage, $perm_subdivision)
    ->setCellValue($cellPermAddBarangay, $perm_barangay)
    ->setCellValue($cellPermAddCityMunicipality, $perm_city)
    ->setCellValue($cellPermAddProvince, $perm_city)
    ->setCellValue($cellPermAddZipCode, $perm_zip)
    ->setCellValue($cellTelNo, $tel)
    ->setCellValue($cellMobileNo, $mobile)
    ->setCellValue($cellEmail, $email);

$tempPath = 'temp/' . $filename;
$targetDir = 'uploads/';
$targetPath = $targetDir . $filename;

$writer = new Xlsx($spreadsheet);

try {
    $writer->save($tempPath);
    if(rename($tempPath, $targetPath)){
        $query = "UPDATE pds SET 
        surname = :surname,
        firstname = :firstname,
        middlename = :middlename,
        extension = :extension,
        birthdate = :birthdate,
        birthplace = :birthplace,
        sex = :sex,
        civil_status = :civil_status,
        height = :height,
        weight = :weight,
        blood_type = :blood_type,
        citizenship = :citizenship,
        tel = :tel,
        mobile = :mobile,
        email = :email,
        res_houseblocklot = :res_houseblocklot,
        res_street = :res_street,
        res_subdivision = :res_subdivision,
        res_barangay = :res_barangay,
        res_city = :res_city,
        res_province = :res_province,
        res_zip = :res_zip,
        perm_houseblocklot = :perm_houseblocklot,
        perm_street = :perm_street,
        perm_subdivision = :perm_subdivision,
        perm_barangay = :perm_barangay,
        perm_city = :perm_city,
        perm_province = :perm_province,
        perm_zip = :perm_zip,
        file_name = :file_name
        WHERE id = :id";

        $update = $db->prepare($query);

        $update->bindParam(':surname', $surname);
        $update->bindParam(':firstname', $firstname);
        $update->bindParam(':middlename', $middlename);
        $update->bindParam(':extension', $extension);
        $update->bindParam(':birthdate', $birthdate);
        $update->bindParam(':birthplace', $birthplace);
        $update->bindParam(':sex', $sex);
        $update->bindParam(':civil_status', $civil_status);
        $update->bindParam(':height', $height);
        $update->bindParam(':weight', $weight);
        $update->bindParam(':blood_type', $blood_type);
        $update->bindParam(':citizenship', $citizenship);
        $update->bindParam(':tel', $tel);
        $update->bindParam(':mobile', $mobile);
        $update->bindParam(':email', $email);
        $update->bindParam(':res_houseblocklot', $res_houseblocklot);
        $update->bindParam(':res_street', $res_street);
        $update->bindParam(':res_subdivision', $res_subdivision);
        $update->bindParam(':res_barangay', $res_barangay);
        $update->bindParam(':res_city', $res_city);
        $update->bindParam(':res_province', $res_province);
        $update->bindParam(':res_zip', $res_zip);
        $update->bindParam(':perm_houseblocklot', $perm_houseblocklot);
        $update->bindParam(':perm_street', $perm_street);
        $update->bindParam(':perm_subdivision', $perm_subdivision);
        $update->bindParam(':perm_barangay', $perm_barangay);
        $update->bindParam(':perm_city', $perm_city);
        $update->bindParam(':perm_province', $perm_province);
        $update->bindParam(':perm_zip', $perm_zip);
        $update->bindParam(':id', $id);
        $update->bindParam(':file_name', $filename);

        if($update->execute()){
            header('Location: sheet.php?edit=success');
        }
        else {
            header('Location: sheet.php?edit=error');
        }
    }
    die();
} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
    $_SESSION['update_error_message'] = $e->getMessage();
    header('Location: sheet.php?edit=error');
}
