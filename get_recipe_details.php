<?php
// Database connection code here
$conn = mysqli_connect("localhost", "root", "", "wp");

$recipeId = $_GET['recipe_id'];

// Fetch the recipe details from the database
$sql = "SELECT * FROM recipes WHERE recipe_id = $recipeId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
  // Display the recipe details
  echo '<button type="button" class="btn recipe-close-btn" onclick="closeRecipeDetails()" title="Close Recipe">
            <i class="fas fa-times"></i>
          </button>';
  echo '<h2 class="meal-name">' . $row['dishName'] . '</h2>';
  echo '<div class="meal-img">';
  echo "<img src='../with_logout/img/" . $row['file1'] . "' alt='Recipe Image'>";
  echo '</div>';
  echo '<div class="meal-instruct">';
  echo '<h3>Ingredients:</h3>';
  echo '<p>' . $row['ingredients'] . '</p>';
  echo '<h3>Instructions:</h3>';
  echo '<p>' . $row['instructions'] . '</p>';
  echo '</div>';
  echo '<div class = "meal-link">';
  echo '<button class="meal-link-btn" onclick="confirmDeleteRecipe(' . $row['recipe_id'] . ')">Get Recipe</button>';
  echo '</div>';
} else {
  echo 'Recipe not found.';
}

mysqli_close($conn);
?>
