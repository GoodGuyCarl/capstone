<?php
session_start();
include('inc.connection.php');

// Check if a search query has been submitted
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    if (strlen($search) >= 3) {
        $sql = "SELECT * FROM pds WHERE surname LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM pds";
    }
} else {
    $sql = "SELECT * FROM pds";
}

$query = $db->prepare($sql);
$query->execute();
$rows = $query->fetchAll();

if ($query->rowCount() == 0) {
    if (isset($_GET['search'])) {
        echo '<h2>No records found</h2>
            <div>
                <p>There are no records available for the search query.</p>
            </div>';
    } else {
        echo '<h2>No records found</h2>
            <div>
                <p>There are no records available at this moment.</p>
            </div>';
    }
}
else {
    echo '<table style="max-height: 75vh; overflow-y: scroll">
        <thead>
            <tr>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">File</th>
                <th style="text-align: center;">City</th>
                <th style="text-align: center;">Province</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>';
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td style="text-align: center;">'. $row['firstname'] .' ' . $row['surname'] . '</td>';
        echo '<td style="text-align: center;"><a href="download.php?file=' . $row['file_name'] . '">' . $row['file_name'] . '</a></td>';
        echo '<td style="text-align: center;">' . $row['res_city'] . '</td>';
        echo '<td style="text-align: center;">' . $row['res_province'] . '</td>';
        echo '<td style="text-align: center;"><a id="edit_link" href="edit.php?id='. $row['id'] . '">Edit</a><span> / </span><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

}
