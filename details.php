<?php
// Include database connection
include("config/db_connection.php");

$deleteSuccess = false; // Flag for showing success message

// Check GET request id parameter
if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    // SQL query to fetch pizza details
    $sql = "SELECT * FROM pizza WHERE id = $id";

    // Execute query
    $result = mysqli_query($conn, $sql);

    // Fetch result as associative array
    $pizza = mysqli_fetch_assoc($result);

    // Free result and close connection
    mysqli_free_result($result);
}

// Check if delete button was clicked
if (isset($_POST["delete"])) {
    include("config/db_connection.php"); // Ensure connection before deletion

    $id_to_delete = mysqli_real_escape_string($conn, $_POST["id_to_delete"]);

    $sql = "DELETE FROM pizza WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        $deleteSuccess = true;
    } else {
        echo "Query Error: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>

<div class="container center grey-text">
    <?php if ($deleteSuccess) { ?>
        <h4 class="green-text">Pizza deleted successfully!</h4>
        <a href="index.php" class="btn brand">Back to Home</a>
    <?php } else { ?>
        <?php if ($pizza) { ?>
            <h4>Pizza ID: <?php echo htmlspecialchars($pizza["id"]); ?></h4>
            <p>Created by: <?php echo htmlspecialchars($pizza["email"]); ?></p>
            <p>Created on: <?php echo htmlspecialchars($pizza["created_at"] ?? 'Unknown'); ?></p>

            <h5>Ingredients</h5>
            <p><?php echo htmlspecialchars($pizza["ingredients"]); ?></p>

            <!-- Delete form with confirmation popup -->
            <form action="details.php?id=<?php echo $pizza['id']; ?>" method="POST" onsubmit="return confirmDelete()">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn red z-depth-0">
            </form>
        <?php } else { ?>
            <h5>No such pizza exists.</h5>
        <?php } ?>
    <?php } ?>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this pizza? This action cannot be undone.");
    }
</script>

<?php include("templates/footer.php"); ?>
</html>
