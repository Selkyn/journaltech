
<?php
session_start();
include "header.php";
include "connexion.php";

if (isset($_POST['send-register'])) {
    $pseudo = $_POST['pseudo'];
    $name_user = $_POST['name_user'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password_user = password_hash($_POST['password_user'], PASSWORD_DEFAULT);

    // $passwordH = password_hash($password_user, PASSWORD_DEFAULT);
    $sqlRegister = 'INSERT INTO `users` (`pseudo`, `name_user`, `surname`, `email`, `password_user`) VALUES (:pseudo, :name_user, :surname, :email, :password_user)';
    
    $stmtRegister = $requete->prepare($sqlRegister);
    $stmtRegister->bindParam(':pseudo', $pseudo);
    $stmtRegister->bindParam(':name_user', $name_user);
    $stmtRegister->bindParam(':surname', $surname);
    $stmtRegister->bindParam(':email', $email);
    $stmtRegister->bindParam(':password_user', $password_user);
    $stmtRegister->execute();
    header('Location: login.php'); 
            exit();
}

?>

<form class="row g-3 needs-validation d-flex flex-column m-3 mb-5 align-items-center" novalidate method="post">
        <div class="col-md-4">
            <label for="title" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" required>
            <div class="valid-feedback">
                Titre validé !
            </div>
        </div>
        <div class="col-md-4">
            <label for="title" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name_user" name="name_user" required>
            <div class="valid-feedback">
                Titre validé !
            </div>
        </div>
        <div class="col-md-4">
            <label for="content" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
            <div class="valid-feedback">
                Contenu valide !
            </div>
        </div>
        <div class="col-md-4">
            <label for="dates" class="form-label">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="email" class="form-control" id="email" name="email" required>
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
            <input type="submit" name="send-register">
            <!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
        </div>
    </form>

    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <?php
    include "footer.php"
    ?>