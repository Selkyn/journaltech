<?php
session_start();
include "header.php";
require "connexion.php";
// require "delete.php";

$usersStatement = $requete->prepare('SELECT * FROM users');
$usersStatement->execute();
$users = $usersStatement->fetchAll();

if (isset($_POST['delete_user'])) {

    // $idUsersToDelete = $_POST['id'];
    $deleteUserStatement = $requete->prepare('DELETE FROM users WHERE id = ?');
    $deleteUserStatement->execute([$_POST['id']]);
}


?>

<div class="d-flex justify-content-center align-items-center">
    <table class="table w-75 p-3">
        <tr>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Date</th>
            <th>Auteur</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($users as $user) {
            if ($user['is_admin'] !== 1) {
                echo "<tr>";
                echo "<form method='POST'>";
                echo "<td>" . $user['id'] . "<input type='hidden' name='id' value='" . $user['id'] . "'></td>";
                echo "<td>" . $user['pseudo'] . "</td>";
                echo "<td>" . $user['name_user'] . "</td>";
                echo "<td>" . $user['surname'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";
                echo "<td><button type='submit' name = 'delete_user'>Supprimer</button></td>";
                echo "</form>";
                echo "</tr>";
            }
        }
        ?>