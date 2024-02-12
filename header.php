<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>journalTech</title>
</head>

<body>
    <?php
    
    // if (isset($_SESSION['loggedUser'])) {
    //     $loggedUser = $_SESSION['loggedUser'];
    // }
    ?>

    <header>
        <h1>Journal Tech</h1>
        <?php
        if (isset ($_SESSION['loggedUser'])) {
            echo "Vous êtes connecté " . $_SESSION['surname'];
        }
        ?>
        <nav>
            <ul>
                <li><a href="index.php">Articles</a></li>
                <?php
                // echo 'Valeur de $loggedUser : ' . var_export($loggedUser, true);
                if (isset($_SESSION['loggedUser'])) {
                    echo '<li><a href="add.php">Publier</a></li>';
                    echo '<li><a href="edit.php">Modifier</a></li>';
                    echo '<li><form action="index.php"  method="post"><input type="submit" value ="delog" name = "delog">
                </form></li>';
                echo '<li><a href="contact.php">Contact</a></li>';
                    if (isset($_SESSION['loggedUser']) && $_SESSION["is_admin"] == 1) {
                        echo '<li><a href="admin.php">admin</a></li>';
                    }
                }
                if (!isset($_SESSION['loggedUser'])) {
                    echo '<li><a href="register.php">S\'enregistrer</a></li>';
                    echo '<li><a id="loginId" href="login.php">Login</a></li>';
                }

                ?>
                <!-- <li><a href="add.php">Publier</a></li>
            <li><a href="edit.php">Modifier</a></li> -->

                <!-- <li><form action="index.php"  method="post"> -->


            </ul>
            <!-- <input class="form-group" type="text" id="search-user" value="" placeholder="Rechercher"> -->

        </nav>
        <!-- <div style="margin-top: 20px">
            <div id="result-search"></div>
        </div> -->
    </header>


    <?php
    if (isset($_POST['delog'])) {
        session_start();
        session_destroy();
        header('Location: index.php'); // Redirigez l'utilisateur vers la page d'accueil après la déconnexion
        exit();
    }
    // if (!isset($loggedUser)) {
    //     echo '<li><a href="add.php">Publier</a></li>';
    //     echo '<li><a href="edit.php">Modifier</a></li>'; 
    // }
    ?>