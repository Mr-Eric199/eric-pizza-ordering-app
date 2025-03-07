<?php

include("config/db_connection.php");

// Corrected SQL query to order by created_at instead of created_by
$sql = "SELECT title, ingredients, id FROM pizza ORDER BY created_by DESC";
$result = mysqli_query($conn, $sql);
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php"); ?>

<h4 class="center grey-text">Pizzas</h4>

<div class="container">
    <div class="row">
        <?php foreach ($pizzas as $pizza) : ?>
            <div class="col s12 m6 l4">
                <div class="card z-depth-0">
                    <img src="img/pizza.svg" alt="pizza" class="pizza">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza["title"]); ?></h6>
                        <ul>
                            <?php foreach (explode(",", $pizza["ingredients"]) as $ing) : ?>
                                <li><?php echo htmlspecialchars($ing); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action center">
                        <a href="details.php?id=<?php echo $pizza['id'] ?>" class="btn-small brand z-depth-0">
                            More Info
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="center">
            <?php if (count($pizzas) >= 2) : ?>
                <p class="green-text">There are 2 or more pizzas.</p>
            <?php else : ?>
                <p class="red-text">There are less than 2 pizzas.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>

</html>
