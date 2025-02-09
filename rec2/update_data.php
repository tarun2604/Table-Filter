<?php
include('db_connection.php');

$Si_no = $_POST['Si_no'];
$indexing = htmlspecialchars($_POST['indexing']);
$Emp_id = htmlspecialchars($_POST['Emp_id']);
$paper_title = htmlspecialchars($_POST['paper_title']);
$journal_name = htmlspecialchars($_POST['journal_name']);
$authors = htmlspecialchars($_POST['authors']);
$indexing_type = htmlspecialchars($_POST['indexing_type']);
$impact_factor = htmlspecialchars($_POST['impact_factor']);
$snip = htmlspecialchars($_POST['snip']);
$issn_no = htmlspecialchars($_POST['issn_no']);
$publication_date = htmlspecialchars($_POST['publication_date']);
$Year_of_publication = htmlspecialchars($_POST['Year_of_publication']);
$listed_ugc = htmlspecialchars($_POST['listed_ugc']);
$link_wos = htmlspecialchars($_POST['link_wos']);
$link_of_scopus = htmlspecialchars($_POST['link_of_scopus']);
$ugc_link = htmlspecialchars($_POST['ugc_link']);
$Q1234NA = htmlspecialchars($_POST['Q1234NA']);
$title_of_conference = htmlspecialchars($_POST['title_of_conference']);
$name_of_conference = htmlspecialchars($_POST['name_of_conference']);

$query = "UPDATE publications_23 SET 
            indexing =?, Emp_id = ?, paper_title = ?, journal_name = ?, authors = ?, 
            indexing_type = ?, impact_factor = ?, snip = ?, issn_no = ?, 
            publication_date = ?, Year_of_publication = ?, listed_ugc = ?, 
            link_wos = ?, link_of_scopus = ?, ugc_link = ?, Q1234NA = ?, 
            title_of_conference = ?, name_of_conference = ? 
          WHERE Si_no = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param(
    "ssssssssssssssssssi",
    $indexing, $Emp_id, $paper_title, $journal_name, $authors, 
    $indexing_type, $impact_factor, $snip, $issn_no, 
    $publication_date, $Year_of_publication, $listed_ugc, 
    $link_wos, $link_of_scopus, $ugc_link, $Q1234NA, 
    $title_of_conference, $name_of_conference, $Si_no
);

if ($stmt->execute()) {
    header("Location: index.php"); 
    exit;
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
