<?php
include('db_connection.php');

if (isset($_FILES['csvFile'])) {
    $file = $_FILES['csvFile']['tmp_name'];
    if (($handle = fopen($file, "r")) !== FALSE) {
        $header = fgetcsv($handle); 

        $stmt = $conn->prepare("INSERT INTO publications_23 (indexing, Emp_id, paper_title, journal_name, authors, indexing_type, impact_factor, snip, issn_no, publication_date, Year_of_publication, listed_ugc, link_wos, link_of_scopus, ugc_link, Q1234NA, title_of_conference, name_of_conference) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        while (($data = fgetcsv($handle)) !== FALSE) {

            $stmt->bind_param("ssssssssssssssssss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17]);

            $stmt->execute();
        }

        fclose($handle);

        echo json_encode(['success' => true]);
    } else {

        echo json_encode(['success' => false, 'error' => 'Failed to open the CSV file.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No file uploaded.']);
}

$conn->close();
?>
