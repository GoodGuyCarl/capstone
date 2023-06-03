<?php
require 'vendor/autoload.php';
include('inc.connection.php');


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$filename = 'pds.xlsx';

$spreadsheet = IOFactory::load($filename);

$valueSurname = $_POST['surname'];
$valueFirstName = $_POST['firstname'];
$valueMiddleName = $_POST['middlename'];
$valueNameExtension = $_POST['extension'];
$valueBirthdate = $_POST['birthdate'];
$valueBirthplace = $_POST['birthplace'];
$valueSex = $_POST['sex'];
$valueCivilStatus = $_POST['civil_status'];
$valueHeight = $_POST['height'];
$valueWeight = $_POST['weight'];
$valueBloodType = $_POST['blood_type'];
$valueCitizenship = $_POST['citizenship'];
$valueResAddHouseBlockLot = $_POST['res_houseblocklot'];
$valueResAddStreet = $_POST['res_street'];
$valueResAddSubdivisionVillage = $_POST['res_subdivision'];
$valueResAddBarangay = $_POST['res_barangay'];
$valueResAddCityMunicipality = $_POST['res_city'];
$valueResAddProvince = $_POST['res_province'];
$valueResAddZipCode = $_POST['res_zip'];
$valuePermAddHouseBlockLot = $_POST['perm_houseblocklot'];
$valuePermAddStreet = $_POST['perm_street'];
$valuePermAddSubdivisionVillage = $_POST['perm_subdivision'];
$valuePermAddBarangay = $_POST['perm_barangay'];
$valuePermAddCityMunicipality = $_POST['perm_city'];
$valuePermAddProvince = $_POST['perm_province'];
$valuePermAddZipCode = $_POST['perm_zip'];
$valueTelNo = $_POST['tel'];
$valueMobileNo = $_POST['mobile'];
$valueEmail = $_POST['email'];

$filename = $valueSurname . '_' . $valueFirstName . '_PDS.xlsx';

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


$spreadsheet->getDefaultStyle()->getFont()->setName('Arial Narrow');

$spreadsheet->getActiveSheet()
    ->setCellValue($cellSurname, $valueSurname)
    ->setCellValue($cellFirstName, $valueFirstName)
    ->setCellValue($cellMiddleName, $valueMiddleName)
    ->setCellValue($cellNameExtension, $valueNameExtension)
    ->setCellValue($cellBirthdate, $valueBirthdate)
    ->setCellValue($cellBirthplace, $valueBirthplace)
    ->setCellValue($cellSex, $valueSex)
    ->setCellValue($cellCivilStatus, $valueCivilStatus)
    ->setCellValue($cellHeight, $valueHeight)
    ->setCellValue($cellWeight, $valueWeight)
    ->setCellValue($cellBloodType, $valueBloodType)
    ->setCellValue($cellCitizenship, $valueCitizenship)
    ->setCellValue($cellResAddHouseBlockLot, $valueResAddHouseBlockLot)
    ->setCellValue($cellResAddStreet, $valueResAddStreet)
    ->setCellValue($cellResAddSubdivisionVillage, $valueResAddSubdivisionVillage)
    ->setCellValue($cellResAddBarangay, $valueResAddBarangay)
    ->setCellValue($cellResAddCityMunicipality, $valueResAddCityMunicipality)
    ->setCellValue($cellResAddProvince, $valueResAddProvince)
    ->setCellValue($cellResAddZipCode, $valueResAddZipCode)
    ->setCellValue($cellPermAddHouseBlockLot, $valuePermAddHouseBlockLot)
    ->setCellValue($cellPermAddStreet, $valuePermAddStreet)
    ->setCellValue($cellPermAddSubdivisionVillage, $valuePermAddSubdivisionVillage)
    ->setCellValue($cellPermAddBarangay, $valuePermAddBarangay)
    ->setCellValue($cellPermAddCityMunicipality, $valuePermAddCityMunicipality)
    ->setCellValue($cellPermAddProvince, $valuePermAddProvince)
    ->setCellValue($cellPermAddZipCode, $valuePermAddZipCode)
    ->setCellValue($cellTelNo, $valueTelNo)
    ->setCellValue($cellMobileNo, $valueMobileNo)
    ->setCellValue($cellEmail, $valueEmail);

$tempPath = 'temp/' . $filename;
$targetDir = 'uploads/';
$targetPath = $targetDir . $filename;

$writer = new Xlsx($spreadsheet);

try {
    $writer->save($tempPath);
    if (rename($tempPath, $targetPath)) {
        $sql = "INSERT INTO pds (surname, firstname, middlename, extension, birthdate, birthplace, sex, civil_status, height, weight, blood_type, citizenship, tel, mobile, email, res_houseblocklot, res_street, res_subdivision, res_barangay, res_city, res_province, res_zip, perm_houseblocklot, perm_street, perm_subdivision, perm_barangay, perm_city, perm_province, perm_zip, file_name, date_submitted)
                VALUES (:surname, :firstname, :middlename, :extension, :birthdate, :birthplace, :sex, :civil_status, :height, :weight, :blood_type, :citizenship, :tel, :mobile, :email, :res_houseblocklot, :res_street, :res_subdivision, :res_barangay, :res_city, :res_province, :res_zip, :perm_houseblocklot, :perm_street, :perm_subdivision, :perm_barangay, :perm_city, :perm_province, :perm_zip, :file_name, now())";

        $stmt = $db->prepare($sql);

        // Bind the values to the placeholders
        $stmt->bindParam(':surname', $valueSurname);
        $stmt->bindParam(':firstname', $valueFirstName);
        $stmt->bindParam(':middlename', $valueMiddleName);
        $stmt->bindParam(':extension', $valueNameExtension);
        $stmt->bindParam(':birthdate', $valueBirthdate);
        $stmt->bindParam(':birthplace', $valueBirthplace);
        $stmt->bindParam(':sex', $valueSex);
        $stmt->bindParam(':civil_status', $valueCivilStatus);
        $stmt->bindParam(':height', $valueHeight);
        $stmt->bindParam(':weight', $valueWeight);
        $stmt->bindParam(':blood_type', $valueBloodType);
        $stmt->bindParam(':citizenship', $valueCitizenship);
        $stmt->bindParam(':tel', $valueTelNo);
        $stmt->bindParam(':mobile', $valueMobileNo);
        $stmt->bindParam(':email', $valueEmail);
        $stmt->bindParam(':res_houseblocklot', $valueResAddHouseBlockLot);
        $stmt->bindParam(':res_street', $valueResAddStreet);
        $stmt->bindParam(':res_subdivision', $valueResAddSubdivisionVillage);
        $stmt->bindParam(':res_barangay', $valueResAddBarangay);
        $stmt->bindParam(':res_city', $valueResAddCityMunicipality);
        $stmt->bindParam(':res_province', $valueResAddProvince);
        $stmt->bindParam(':res_zip', $valueResAddZipCode);
        $stmt->bindParam(':perm_houseblocklot', $valuePermAddHouseBlockLot);
        $stmt->bindParam(':perm_street', $valuePermAddStreet);
        $stmt->bindParam(':perm_subdivision', $valuePermAddSubdivisionVillage);
        $stmt->bindParam(':perm_barangay', $valuePermAddBarangay);
        $stmt->bindParam(':perm_city', $valuePermAddCityMunicipality);
        $stmt->bindParam(':perm_province', $valuePermAddProvince);
        $stmt->bindParam(':perm_zip', $valuePermAddZipCode);
        $stmt->bindParam(':file_name', $filename);

        if ($stmt->execute()) {
            header('Location: sheet.php?create=success');
        } else {
            echo "Database insertion failed.";
        }
        die;
    } else {
        echo "File move failed.";
    }

    die();
} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
    echo 'Error saving the spreadsheet';
}
