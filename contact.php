<?php
session_start();
include "header.php";
include "connexion.php";
if (!isset($_SESSION['loggedUser'])) {
    header("Location : index.php");
}
$sqlJoin = ('SELECT users.id, users.pseudo, contact.message
            FROM contact
            JOIN users ON contact.user_id = users.id');

if (isset($_POST["send_message"])) {
    // $pseudo = $_POST['pseudoo'];
    // $pseudo = $_POST['sujet'];
    $message = $_POST['message'];

    $sqlMessage = 'INSERT INTO `contact` (`user_id`, `message`) VALUES (:user_id, :message)';

    $stmtMessage = $requete->prepare($sqlMessage);
    // $stmtMessage->bindParam(':pseudoo', $pseudo);
    $stmtMessage->bindParam(':user_id', $_SESSION['id']);
    $stmtMessage->bindParam(':message', $message);

    $stmtMessage->execute();
}



?>
<form class="row g-3 needs-validation d-flex flex-column m-3 mb-5 align-items-center" novalidate method="post">
<?php
    if ($_SESSION['is_admin'] !== 1) {
?>
        <form class="row g-3 needs-validation d-flex flex-column m-3 mb-5 align-items-center" novalidate method="post">
            <textarea name="message" id="" cols="65" rows="10">Tapez votre message...</textarea>
            <div class="valid-feedback">
                Contenu valide !
            </div>
            <!-- </div -->
        
            <div class="col-12">
                <input type="submit" name="send_message">
                <!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
            </div>
        </form>
<?php
    }
?>


 


<?php
// $adminJoin = ('SELECT * FROM contact JOIN users ON contact.user_id = users.id');
$adminJoin = ('SELECT * FROM contact JOIN users ON contact.user_id = users.id WHERE users.is_admin != 1');
$contactStatement  = $requete->prepare($adminJoin);
$contactStatement->execute();
$reponsesContact = $contactStatement->fetchAll();


?>
<div class="d-flex flex-column justify-content-center align-items-center">
    <table class="table w-75 p-3">
        <tr>
            <!-- <th>Id</th> -->
            <th>pseudo</th>
            <th>message</th>
        </tr>
<!-- <a href=''></a> -->
        <?php
        foreach ($reponsesContact as $reponseContact) {
        if ($_SESSION['is_admin'] == 1) {
            
                echo "<tr>";
                // echo "<td>" . $reponseContact['pseudo'] . "</td>";
                ?>
                <td><a href="message_admin.php?id=<?php echo $reponseContact['id']; ?>&pseudo=<?php echo $reponseContact['pseudo']; ?>"><?php echo $reponseContact['pseudo']; ?></a></td>
                <?php
                echo "<td>" . $reponseContact['message'] .
                    "</td>";
                echo "</tr>";
            }
        // else {
        //     echo "<tr>";
        //         echo "<td>" . $reponseContact['pseudo'] . "</td>";
        //         echo "<td>" . $reponseContact['message'] .
        //             "</td>";
        //         echo "</tr>";
        // }
    }

    if($_SESSION['is_admin'] == 0) {
    $messageOfAdminJoin = ('SELECT * FROM contact JOIN users ON contact.user_id = users.id');
    $messageOfAdminStatement = $requete->prepare($messageOfAdminJoin);
    // $messageOfAdminStatement  = $requete->prepare('SELECT * FROM contact JOIN users ON contact.user_id = users.id WHERE user_id= ? AND is_admin = ?');
    $messageOfAdminStatement->execute();
    // $messageOfAdminStatement->execute($_SESSION['id'], '1');
    $reponsesOfAdmin = $messageOfAdminStatement->fetchAll();
    foreach($reponsesOfAdmin as $responseAdmin) {
        if($_SESSION['id'] == $responseAdmin['target_id']) {
            echo "<tr>";
                echo "<td>" . $responseAdmin['pseudo'] . "</td>";
                echo "<td>" . $responseAdmin['message'] .
                    "</td>";
                echo "</tr>";
        }
        
    }
}
// $adminJoin2 = ('SELECT * FROM contact JOIN users ON contact.user_id = users.id');
// if($_SESSION['id'] == )
        ?>
    </table>
</div>
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
include "footer.php";
?>
<!-- <div class="col-md-4">
            <label for="sujet" class="form-label">sujet</label>
            <input type="text" class="form-control" id="sujet" name="sujet" required>
            <div class="valid-feedback">
                Titre validé !
            </div>
        </div>
        <div class="col-md-4"> -->