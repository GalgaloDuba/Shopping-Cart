<?php
    session_start();
    require 'connection.php';

    header('Content-Type: application/json');

    if (!isset($_SESSION['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid item ID']);
        exit();
    }

    $item_id = intval($_GET['id']);
    $user_id = intval($_SESSION['id']);

    $delete_query = "DELETE FROM users_items WHERE user_id = ? AND item_id = ?";

    if ($stmt = $con->prepare($delete_query)) {
        $stmt->bind_param("ii", $user_id, $item_id);
        if ($stmt->execute()) {
            $stmt->close();
            echo json_encode(['status' => 'success', 'message' => 'Item removed from cart']);
            exit();
        } else {
            $stmt->close();
            echo json_encode(['status' => 'error', 'message' => 'Error executing query: ' . $stmt->error]);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing query: ' . $con->error]);
        exit();
    }
?>
