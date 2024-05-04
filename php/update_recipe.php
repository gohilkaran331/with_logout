<?php
include('../php/config.php');

// Create connection
if (!$con) {
    echo "Error";
}

// Fetch the recipe data when the recipe_id is provided
if (isset($_GET['recipe_id'])) {
    $recipeId = $_GET['recipe_id'];

    $sql = "SELECT * FROM recipes WHERE recipe_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $recipeId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Recipe</title>
            <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');

        html {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--color3);
            height: 100%;
            min-height: 100%;
        }

        :root {
            --color: #1C2541;
            --color2: #3A506B;
            --color3: #fff;
            --error: #FFFF00;
            --success: #28a745;
            --color4: #333;
            --bg: #6FFFE9;

        }

        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            /* min-height: 50px; */
            /* font-weight: bold; */
            min-width: 50px;
            color: #6FFFE9;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px var(--color3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--color);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b30000;
        }

        .header {
            width: 100%;
            height: 815px;
            background-image: url('../img/Dhokla-Recipe-3.jpg');
            background-size: cover;
            background-position: center;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--color);
            color: var(--color3);
        }

        .brand-name {
            width: 100px;
            height: auto;
        }

        .menu-bar ul {
            margin: 0;
            padding: 0;
            display: flex;
        }

        .menu-bar li {
            list-style: none;
            margin: 0 1rem;
        }

        .menu-bar li a {
            text-decoration: none;
            color: var(--color3);
            padding: 1rem;
            display: block;
        }

        .menu-bar li:hover {
            background-color: var(--color2);
        }

        .title {
            text-align: center;
            font-size: 5rem;
            padding-top: 1.5rem;
            font-weight: 600;
            color: var(--color3);
        }

        #none {
            font-size: 2rem;
            font-weight: 600;
            color: #ff0505;
            text-align: center;
        }

        .footer {
            background-color: var(--color);
            height: 150px;
            padding: 10px;
            color: var(--color3);
            clear: both;
        }

        .social-btn {
            position: sticky;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            font-size: 2rem;
            color: black;
        }

        .social-btn a {
            color: black;
        }

        .quick-bar {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            font-size: 1rem;
            padding-top: 1rem;
        }

        .quick-bar a {
            color: var(--color3);
            text-decoration: none;
        }

        .footer p {
            text-align: center;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Form */
        form {
            width: 670px;
            text-align: center;
            /* margin-left: 5%; */
            color: black;
            border-color: black;
        }

        #addIngre {
            height: 50px;
            color: #000;
            text-decoration-color: black;
            border-color: black;
            width: 630px;
            border: 2px solid rgb(0, 0, 0);
            border-radius: 5px;
            place-content: black;
            background: transparent;
        }

        #addInstr {
            color: #000;
            height: 100px;
            border-color: black;
            width: 630px;
            border: 2px solid rgb(0, 0, 0);
            border-radius: 5px;
            background: transparent;
        }

        .fomBox {
            position: relative;
            text-align: center;
            width: 50%;
        }

        .formBox .row50 {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .inputBox {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            width: 50%;
        }

        .formBox .row100 .inputBox {
            width: 100%;
        }

        .inputBox label {
            color: var(--color3);
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .inputBox input {
            color: var(--color4);
            padding: 10px;
            font-size: 1.1em;
            outline: none;
            border: 1px solid var(--color);
        }

        .inputBox textarea {
            color: var(--color4);
            padding: 10px;
            font-size: 1.1em;
            outline: none;
            border: 1px solid var(--color4);
            resize: none;
            min-height: 220px;
            margin-bottom: 10px;
        }

        /* .inputBox input[type="submit"] {
            background: var(--color);
            color: var(--color3);
            border: 2px solid var(--color);
            border-radius: .50em;
            font-size: 1.1em;
            max-width: 200px;
            font-weight: 500;
            cursor: pointer;
            padding: 14px 15px;
            transition: all 300ms ease-in-out;
        } */

        #sendMessage:hover {
            transform: translateY(-3px);
            background-color: transparent;
            border: 2px solid var(--color);
            color: inherit;
        }

        .inputBox::placeholder {
            color: black;
        }

        .info {
            background: var(--color);
        }

        .info h3 {
            color: var(--color3);
        }

        .info .infoBox div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info .infoBox div span {
            min-width: 40px;
            height: 40px;
            color: var(--color3);
            background: var(--color2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            border-radius: 50%;
            margin-right: 15px;
        }

        .info .infoBox div p {
            color: var(--color3);
            font-size: 1.1em;
        }

        .info .infoBox div a {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            color: var(--color3);
            text-decoration: none;
        }

        .socMed {
            margin-top: 40px;
            display: flex;
        }

        .socMed li {
            list-style: none;
            margin-right: 1rem;
        }

        .socMed li a {
            color: var(--color3);
            font-size: 2em;
        }

        .socMed li a:hover {
            color: var(--color2);
        }

        .map {
            padding: 0;
        }

        .map iframe {
            width: 100%;
            height: 100%;
        }

        .error {
            color: var(--error);
        }

        #success {
            color: var(--success);
        }



        @media (max-width: 991px) {
            .nav-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .hamburger {
                display: flex;
            }

            .menu-bar {
                display: none;
                width: 100%;
            }

            .menu-bar ul {
                width: 100%;
                flex-direction: column;
            }

            .menu-bar ul li {
                text-align: center;
            }

            .menu-bar ul li a {
                padding: .5rem 1rem;
            }

            .menu-bar.active {
                display: flex;
            }

            .header {
                width: inherit;
            }

            .search-wrapper {
                width: 400px;
            }

            .result {
                font-size: 1rem;
            }

            .img-me {
                width: 100%;
                float: none;
            }

            .img-me img {
                margin: 0;
            }

            .about-content {
                width: 100%;
                float: none;
                margin-left: 0;
            }

            .about-content h1 {
                font-size: 3.75rem;
                letter-spacing: 2px;
                margin-top: 30px;
            }

            .about-content h3 {
                font-size: 40px;
            }

            .about-content p {
                font-size: 1rem;
            }

            .contact-wrapper {
                padding: 20px;
            }

            .box {
                grid-template-columns: 1fr;
                grid-template-rows: auto;
                grid-template-areas:
                    "form"
                    "info"
                    "map";
            }

            .map {
                min-height: 300px;
            }

            .formBox .row50 {
                display: flex;
                gap: 0;
                flex-direction: column;
            }

            .inputBox {
                width: 100%;
            }

            .contact {
                padding: 30px;
            }

            .map {
                min-height: 300px;
                padding: 0;
            }



        }

        @media (max-width: 500px) {
            .header {
                height: 500px;
            }

            .title {
                font-size: 3rem;
                margin-top: 0.5rem;
            }

            .search-wrapper {
                width: 300px;
                height: 3.5rem;
                margin-top: 1rem;
            }

            .result {
                font-size: 0.8rem;
            }

            .footer {
                height: auto;
            }

            .row {
                padding: 0px 30px;
            }

            .img-me {
                width: 100%;
                float: none;
            }

            .img-me img {
                margin: 0;
            }

            .about-content {
                width: 100%;
                float: none;
            }

            .about-content h1 {
                font-size: 3rem;
                letter-spacing: 2px;
                margin-top: 30px;
            }

            .about-content h3 {
                font-size: 30px;
            }

            .about-content p {
                font-size: 1rem;
            }

            .form {
                display: block;
                margin-left: -12px;
                margin-right: auto;
                width: 85%;
            }

            .info {
                width: 85%;
                display: block;
                margin-left: -12px;
                margin-right: auto;
            }

            .inputBox {
                width: 100%;
            }

            .contact {
                padding: 30px;
            }

            .map {
                display: block;
                margin-left: auto;
                margin-right: 200px;
                min-height: 300px;
                width: 80%;
                padding: 0;
            }

        }

        .wrapper {
            color: #000;
            text-decoration-color: black;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            /* margin-top: -180px; */
            /* margin-left: 20%; */
            text-align: center;
            width: 58%;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .8);
            backdrop-filter: blur(9px);
            color: white;
            border-color: white;
            border-radius: 12px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            color: rgb(0, 0, 0);
            width: 100%;
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            border-color: black;
            padding: 0 10px;
            margin: 30px 0;
        }

        /* .wrapper .submit-btn {
            border-radius: 40px;
            position: relative;
            width: 25%;
            height: 30px;
            border-color: black;
            margin: 30px 0;
        }

        .wrapper .submit-btn:hover {
            
            background-color: transparent;
            border: 2px solid var(--bg);
            color: var(--color3);
            
        } */
        /* transform: scale(1.025);
        size: 1.2%;
        background-color: var(--bg); */

        .wrapper .submit-btn {
            font-weight: 600;
            border-radius: 40px;
            position: relative;
            width: 25%;
            height: 30px;
            border-color: var(--bg);
            background: transparent;
            margin: 30px 0;
        }

        .wrapper .submit-btn:hover {
            /* transform: scale(1.025);
            size: 1.2%;
            background-color: var(--bg); */

            background-color: white;
            border: 2px solid var(--bg);
            /* color: var(--color3); */
            /* color: #28a745; */

        }

        .input-box input {

            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(0, 0, 0, 0.2);
            border-radius: 40px;
            border-color: black;
            font-size: 16px;
            color: white;
            padding: 20px 45px 20px 20px;
        }

        .input-box input[type="file"] {
            color: black;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: solid;
            opacity: 0;
            cursor: pointer;
            text-decoration-color: black;
        }

        .input-box input::placeholder {
            color: black;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 30%;
            color: black;
            transform: translate(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-around;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: rgb(244, 196, 48);
            margin-right: 3px;

        }

        .remember-forgot a {
            color: rgb(244, 196, 48);
            text-decoration: none;

        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: black;
            font-weight: 600;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;

        }

        .bx.bx-rename,
        .bx.bx-tada,
        .bx.bx-envelope,
        .bx.bxl-spring-boot,
        .bx.bxs-camera {
            justify-content: baseline;
            margin-top: -8px;
            font-size: 36px;
        }
    </style>
            <link rel="stylesheet" href="../with_logout/css/hca_style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        </head>
        <body>
        <!--- Navigation Bar -->
    <div class="header">
        <nav class="nav-bar">
            <img src="../flavour-fusion-logo.png" class="brand-name">
            <a href="#" class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <div class="menu-bar">
                <ul>
                    <li><a href="home1.php">Home</a></li>
                    <li><a href="../with_logout/html/about.html">About</a></li>
                    <li><a href="../with_logout/html/contact.html">Contact</a></li>
                    <li><a href="../login.html">Logout</a></li>
                </ul>
            </div>
        </nav>
            <div class="wrapper">
                <form action="update_recipe.php" method="post" enctype="multipart/form-data">
                    <h1>Update Recipe</h1>
                    <input type="hidden" name="recipe_id" value="<?php echo $row['recipe_id']; ?>">
                    <div class="input-box">
                        <i class='bx bx-bowl-hot bx-tada'></i>
                        <input type="text" style='color: #000;' name="Dish_Name" id="Dish_Name" value="<?php echo $row['dishName']; ?>" placeholder="Enter your Recipe Name" required>
                    </div>
                    <div class="input-box">
                        <i class='bx bx-leaf bx-tada'></i>
                        <textarea name="addIngre" id="addIngre" rows="5" placeholder="Ingredients" required><?php echo $row['ingredients']; ?></textarea>
                    </div>
                    <div class="input-box">
                        <i class='bx bxl-spring-boot bx-tada'></i>
                        <textarea name="addInstr" id="addInstr" rows="5" placeholder="Instructions" required><?php echo $row['instructions']; ?></textarea>
                    </div>
                    <br>
                    <div class="input-box">
                        <i class='bx bx-envelope bx-tada'></i>
                        <input type="text" style='color: #000;' name="email" id="Email" value="<?php echo $row['email']; ?>" placeholder="Your Email" required>
                    </div>
                    <div class="input-box">
                        <h3 style="color: #000000;">Upload Image</h3>
                        <i class='bx bxs-camera bx-tada'></i>
                        <input type="file" name="file" id="file" placeholder="insert_recipe">
                    </div>
                    <div class="button" style="display: flex; justify-content: center;">
                        <input style="color: #000000;" type="submit" class="submit-btn" name="submit" id="submit" value="Update Recipe" --success>
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Recipe not found.";
    }
    mysqli_stmt_close($stmt);
}

// Update the recipe data when the form is submitted
if (isset($_POST["submit"])) {
    $recipeId = $_POST["recipe_id"];
    $dishName = $_POST["Dish_Name"];
    $ingredients = $_POST["addIngre"];
    $instructions = $_POST["addInstr"];
    $email = $_POST["email"];

    if ($_FILES["file"]["error"] == 4) {
        // No new image uploaded, keep the existing image
        $sql = "UPDATE recipes SET dishName = ?, ingredients = ?, instructions = ?, email = ? WHERE recipe_id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $dishName, $ingredients, $instructions, $email, $recipeId);
    } else {
        $filename = $_FILES["file"]["name"];
        $fileSize = $_FILES["file"]["size"];
        $tempname = $_FILES["file"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png', 'webp'];
        $imageExtension = explode('.', $filename);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert('Invalid Image Extension'); </script>";
        } else if ($fileSize > 1000000) {
            echo "<script> alert('Image Size Is Too Large'); </script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tempname, '../img/' . $newImageName);

            $sql = "UPDATE recipes SET dishName = ?, ingredients = ?, instructions = ?, email = ?, file1 = ? WHERE recipe_id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "sssssi", $dishName, $ingredients, $instructions, $email, $newImageName, $recipeId);
        }
    }

    if ($stmt) {
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Recipe updated successfully'); window.location.href = '../home1.php';</script>";
        } else {
            echo "Error updating recipe: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }
}
?>
</div>
        <!--Footer-->
        <div class="footer">
            <div class="social-btn">
                <a href="https://www.facebook.com/" target="_blank"><i class="	fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="	fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/" target="_blank"><i class="	fab fa-linkedin"></i></a>
                <a href="https://github.com/" target="_blank"><i class="	fab fa-github"></i></a>
            </div>
            <div class="quick-bar">
                <a href="../html/home.html">Home</a>
                <a href="../html/insert_recipe.html">Modify</a>
                <a href="../html/about.html">About</a>
                <a href="../html/contact.html">Contact</a>
            </div>
            <p>Copyright &copy; 2024 EatExpress. All right reserved</p>
        </div>

        <!--Ending of Footer-->

        <!--Script for Javascript-->
        <script src="../assets/index.js"></script>
</body>

</html>