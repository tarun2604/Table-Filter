<?php
header('Content-Type: application/json');

require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['Si_no'])) {
    echo json_encode(["success" => false, "error" => "Missing Si_no"]);
    exit;
}

$Si_no = intval($data['Si_no']);

error_log("Deleting record with Si_no: " . $Si_no);

$sql = "DELETE FROM publications_23 WHERE Si_no = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "error" => "SQL error: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $Si_no);

if ($stmt->execute()) {
    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "No record found with Si_no: $Si_no"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Database error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
