    <?php
    session_start();
    include "header.php";
    include "connexion.php";
    if (!isset($_SESSION['loggedUser'])) {
        header("Location : index.php");
    }
    ?>

    <form class="row g-3 needs-validation d-flex flex-column m-3 mb-5 align-items-center" novalidate method="post">
        <div class="col-md-4">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <div class="valid-feedback">
                Titre validé !
            </div>
        </div>
        <div class="col-md-4">
            <label for="content" class="form-label">Contenu</label>
            <input type="text" class="form-control" id="content" name="content" required>
            <div class="valid-feedback">
                Contenu valide !
            </div>
        </div>
        <div class="col-md-4">
            <label for="dates" class="form-label">Date</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="date" class="form-control" id="dates" name="dates" required>
                <div class="invalid-feedback">
                    Choisissez une date
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4"> -->
            <!-- <label for="author" class="form-label">Auteur</label> -->
            <!-- <input type="hidden" class="form-control" id="author" name="user_id"> -->
            <!-- <div class="invalid-feedback">
                Entrez un nom d'auteur
            </div>
        </div> -->
        <div class="col-12">
            <input type="submit" name="send">
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

    // $authorLoggued = "SELECT `users`.`surname` 
    // FROM `journal` 
    // JOIN `users` ON `journal`.`author` = `users`.`id`";

    if (isset($_POST['send'])) {

        // $_SESSION['journal_id'] = $_POST['id'];
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $dates = $_POST['dates'];
        $user_id = $_SESSION['id'];
        echo $user_id;

        $sql = 'INSERT INTO `journal` (`id`, `title`, `content`, `dates`, `user_id`) VALUES (:id, :title, :content, :dates, :user_id)';
        $stmt = $requete->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':dates', $dates);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
    ?>

    
    <?php
    include "footer.php"
    ?>