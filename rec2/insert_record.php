<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $indexing = $_POST['indexing'];
    $emp_id = $_POST['Emp_id'];
    $paper_title = $_POST['paper_title'];
    $journal_name = $_POST['journal_name'];
    $authors = $_POST['authors'];
    $indexing_type = $_POST['indexing_type'];
    $impact_factor = $_POST['impact_factor'];
    $snip = $_POST['snip'];
    $issn_no = $_POST['issn_no'];
    $publication_date = $_POST['publication_date'];
    $year_of_publication = $_POST['Year_of_publication'];
    $listed_ugc = $_POST['listed_ugc'];
    $link_wos = $_POST['link_wos'];
    $link_of_scopus = $_POST['link_of_scopus'];
    $ugc_link = $_POST['ugc_link'];
    $Q1234NA = $_POST['Q1234NA'];
    $title_of_conference = $_POST['title_of_conference'];
    $name_of_conference = $_POST['name_of_conference'];

    $query = "INSERT INTO publications_23 
        (Indexing, Emp_id, paper_title, journal_name, authors, indexing_type, impact_factor, snip, issn_no, publication_date, Year_of_publication, listed_ugc, link_wos, link_of_scopus, ugc_link, Q1234NA, title_of_conference, name_of_conference) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssssssssssss", 
        $indexing, $emp_id, $paper_title, $journal_name, $authors, $indexing_type, $impact_factor, $snip, $issn_no, 
        $publication_date, $year_of_publication, $listed_ugc, $link_wos, $link_of_scopus, $ugc_link, 
        $Q1234NA, $title_of_conference, $name_of_conference
    );

    if ($stmt->execute()) {
        echo "<script>alert('Record added successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
