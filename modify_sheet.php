<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$filename = 'test.xlsx';

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
$valueGSIS = $_POST['GSIS'];
$valuePAGIBIG = $_POST['PAGIBIG'];
$valuePHILHEALTH = $_POST['PHILHEALTH'];
$valueSSS = $_POST['SSS'];
$valueTIN = $_POST['TIN'];
$valueAgencyEmployee = $_POST['agency'];
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
$valueMobileNo = $_POST['surname'];
$valueEmail = $_POST['surname'];

$cellSurname = 'D10';
$cellFirstName = 'D11';
$cellMiddleName = 'D12';
$cellNameExtension = 'L12';
$cellBirthdate = 'D13:F14';
$cellBirthplace = 'D15';
$cellSex = 'D16';
$cellCivilStatus = 'D17';
$cellHeight = 'D22';
$cellWeight = 'D24';
$cellBloodType = 'D25';
$cellGSIS = 'D27';
$cellPAGIBIG = 'D29';
$cellPHILHEALTH = 'D31';
$cellSSS = 'D32';
$cellTIN = 'D33';
$cellAgencyEmployee = 'D34';
$cellCitizenship = 'J13';
$cellResAddHouseBlockLot = 'I17';
$cellResAddStreet = 'L17';
$cellResAddSubdivisionVillage = 'I19';
$cellResAddBarangay = 'L19';
$cellResAddCityMunicipality = 'I22';
$cellResAddProvince = 'L22';
$cellResAddZipCode = 'I24';
$cellPermAddHouseBlockLot = 'I25';
$cellPermAddStreet = 'L25';
$cellPermAddSubdivisionVillage = 'I27';
$cellPermAddBarangay = 'L27';
$cellPermAddCityMunicipality = 'I30';
$cellPermAddProvince = 'L29';
$cellPermAddZipCode = 'I31';
$cellTelNo = 'I32';
$cellMobileNo = 'I33';
$cellEmail = 'I34';

$spreadsheet->getSheetByName('C1')->setCellValue($cellSurname, $valueSurname);

$writer = new Xlsx($spreadsheet);
try {
    $writer->save('test1.xlsx');
} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
    echo 'Error saving the spreadsheet';
}
