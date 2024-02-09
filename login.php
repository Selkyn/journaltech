
<?php
session_start();

include "header.php";
include "connexion.php";
if (isset($_POST['send-login'])) {
    $usersStatement = $requete->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
    $usersStatement->bindParam(':pseudo', $_POST['pseudo']);
    $usersStatement->execute();
    $responseUsers = $usersStatement->fetch();


    

        // foreach ($responseUsers as $responseUser) {
        // $passwordH = $responseUser['password_user'];
        if ($responseUsers) {
            if (password_verify($_POST['password_user'], $responseUsers['password_user'])) {
                echo "correct";
                $loggedUser = [
                    'pseudo' => $responseUsers['pseudo'],
                    'surname' => $responseUsers['surname']
                ];
                $_SESSION['pseudo'] = $_POST['pseudo'];
                $_SESSION['surname'] = $_POST['surname'];
                
                // $_SESSION['loggedUser'] = $loggedUser;
                $_SESSION['loggedUser'] = true;
                $_SESSION['is_admin'] = $responseUsers['is_admin'];
                $_SESSION['surname'] = $responseUsers['surname'];
                header('Location: index.php'); 
                exit();
                // $_SESSION['surname'] = $_POST['surname'];
            }
        


        // if (!isset($loggedUser)) {
        //     $errorMessage = sprintf(
        //         'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
        //         $_POST['email'],
        //         strip_tags($_POST['password_user'])

        //     );
            // echo "erreur";
        }
    }
// }
// }




if (isset($loggedUser)) {
    echo "bienvenue : " . $loggedUser['surname'];
} else {
    echo "Vous n'êtes pas connecté.";
}

?>

<form class="row g-3 needs-validation d-flex flex-column m-3 mb-5 align-items-center" novalidate method="post">
    <div class="col-md-4">
        <label for="pseudo" class="form-label">pseudo</label>
        <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="pseudo" class="form-control" id="pseudo" name="pseudo" required>
            <div class="invalid-feedback">
                Choisissez une date
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="author" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password_user" name="password_user" required>
        <div class="invalid-feedback">
            Entrez un nom d'auteur
        </div>
    </div>
    <div class="col-12">
        <input type="submit" name="send-login">
        <!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
    </div>
</form>

<?php
// $loggedUser = null;


include "footer.php";

// $_SESSION['name_user'] = $_POST['name_user'];
                // $_SESSION['email'] = $_POST['email'];
                // $_SESSION['password_user'] = $_POST['password_user'];
                // $_SESSION['surname'] = $_POST['surname'];

                   //  if(isset($_POST["send-login"])){
            // $password = $_POST['password_user'];
        

            // echo "Vous êtes connecté : " . $responseUser['email'];
                        
                        // break;
                    // }