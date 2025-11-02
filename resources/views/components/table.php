<?php
include 'dbconnection.php';

// ====== DISPLAY AVAILABLE TABLES (for accordion selection) ======
$sqlAvailable = "SELECT * FROM tables WHERE IsAvailable = 1";
$availableResult = $conn->query($sqlAvailable);

if ($availableResult->num_rows > 0) {
    while ($row = $availableResult->fetch_assoc()) {
        echo '
        <div class="form-check mb-1">
            <input 
                class="form-check-input" 
                type="radio" 
                name="table" 
                id="table' . $row["tableNum"] . '" 
                value="' . $row["tableNum"] . '">
            <label 
                class="form-check-label small" 
                for="table' . $row["tableNum"] . '">
                Table ' . $row["tableNum"] . '
            </label>
        </div>';
    }
} else {
    echo '<p class="text-muted small">No available tables right now.</p>';
}

$conn->close();
?>
