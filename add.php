<?php
$title = $email = $ingredients = '';
$errors = array("email" => "", "title" => "", "ingredients" => "");

// Database connection
include("config/db_connection.php");


if (isset($_POST["submit"])) {

    // Email Validation
    if (empty($_POST["email"])) {
        $errors['email'] = "An email is required <br/>";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be a valid email address";
        }
    }

    // Title Validation
    if (empty($_POST["title"])) {
        $errors['title'] = "A title is required <br/>";
    } else {
        $title = trim($_POST["title"]);
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = "Title must contain letters and spaces only";
        }
    }

    // Ingredients Validation
    if (empty($_POST["ingredients"])) {
        $errors['ingredients'] = "Ingredients are required <br/>";
    } else {
        $ingredients = trim($_POST["ingredients"]);
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = "Ingredients must be letters and separated by commas";
        }
    }

    // Check if there are no errors
    if (!array_filter($errors)) {
        // Escape user input to prevent SQL Injection
        $email = mysqli_real_escape_string($conn, $email);
        $title = mysqli_real_escape_string($conn, $title);
        $ingredients = mysqli_real_escape_string($conn, $ingredients);

        // SQL Query
        $sql = "INSERT INTO pizza (title, ingredients, email) VALUES ('$title', '$ingredients', '$email')";

        // Execute Query
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit(); // Ensure script stops execution after redirect
        } else {
            echo "Query Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>

<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="add.php" method="POST" class="white">
        <label for="email">Your Email:</label>
        <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label for="title">Pizza Title:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>

        <label for="ingredients">Ingredients (Comma separated):</label>
        <input type="text" name="ingredients" id="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include("templates/footer.php"); ?>
</html>
