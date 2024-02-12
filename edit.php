<?php

session_start();
include "header.php";
require "connexion.php";
require "delete.php";

if (!isset($_SESSION['loggedUser'])) {
    header("Location : index.php");
}

$journalJoin = ('SELECT *
                FROM journal
                JOIN users ON journal.user_id = users.id');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["edit"])) {
        $id = $_POST['id'];
        $newTitle = $_POST['new_title'];
        $newContent = $_POST['new_content'];
        $newDate = $_POST['new_date'];
        $newAuthor = $_SESSION['id'];

        $updateStatement = $requete->prepare('UPDATE journal SET title = ?, content = ?, dates = ?, user_id = ? WHERE id = ?');
        $updateStatement->execute([$newTitle, $newContent, $newDate, $newAuthor, $id]);
        // echo "modifié avec succes !";
    }
}
if ($_SESSION['is_admin'] == 1) {
    $journalStatement = $requete->prepare('SELECT * FROM journal');
    $journalStatement->execute();
} else {
    $journalStatement = $requete->prepare('SELECT * FROM journal WHERE user_id = ?');
    $journalStatement->execute([$_SESSION['id']]);
}

// $journalStatement->execute([$_SESSION['pseudo']]);




$reponses = $journalStatement->fetchAll();
?>

<div class="d-flex justify-content-center align-items-center">
    <table class="table w-75 p-3">
        <tr>
            <th>id</th>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Date</th>
            <th>Auteur</th>
            <?php
            if($_SESSION['is_admin'] == 0) { ?>
            <th>Modif</th>
            <?php }; ?>
            <th>Supprimer</th>
        </tr>

        <?php
        foreach ($reponses as $reponse) {
            echo "<tr>";
            echo "<form method='POST'>";
            echo "<td>" . $reponse['id'] . "<input type='hidden' name='id' value='" . $reponse['id'] . "'></td>";
            echo "<td><input type='text' name='new_title' value='" . $reponse['title'] . "'></td>";
            echo "<td><input type='text' name='new_content' value='" . $reponse['content'] . "'></td>";
            echo "<td><input type='date' name='new_date' value='" . $reponse['dates'] . "'></td>";
            echo "<td>" . $reponse['user_id'] . "<input type='hidden' name='new_author' value='" . $reponse['user_id'] . "'></td>";
            if($_SESSION['is_admin'] == 0) {
                echo "<td><button type='submit' name ='edit'>Modifier</button></td>";
            }
            
            echo "<td><button type='submit' name = 'delete'>Supprimer</button></td>";
            echo "</form>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<!-- foreach($reponses as $reponse) {
        echo $reponse['title'] . '<br>', $reponse['content'] . '<br>', $reponse['dates'] . '<br>', $reponse['author'] . '<br>' . '<br>';
    
    }
    // var_dump($reponse);

    ?> -->



<?php
include "footer.php"
?>