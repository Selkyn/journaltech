<?php
session_start();
include "header.php";
include "connexion.php";

if (!isset($_SESSION['loggedUser'])) {
    header("Location : index.php");
}

$getId = $_GET['id'];
// $recupUser = $requete->prepare('SELECT $ FROM users WHERE id = ?');
// $recupUser->execute(array($getId));
if(isset($_POST['send_message'])) {
    $message = $_POST['message'];
    
    $messageAdmin = $requete->prepare('INSERT INTO contact(message, user_id, target_id)VALUES(?, ?, ?)');
    $messageAdmin->execute(array($message, $_SESSION['id'], $getId)); 
}
?>



<form class="row g-3 needs-validation d-flex flex-column m-3 mb-5 align-items-center" novalidate method="post">

    

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
include "footer.php";