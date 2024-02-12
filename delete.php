<?php
// session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $idToDelete = $_POST['id'];

        $deleteStatement = $requete->prepare('DELETE FROM journal WHERE id = ?');
        $deleteStatement->execute([$idToDelete]);
    }
    if (isset($_POST['delete_user'])) {

        $idUsersToDelete = $_POST['id'];
        $deleteUserStatement = $requete->prepare('DELETE FROM users WHERE id = ?');
        $deleteUserStatement->execute([$idUsersToDelete]);
    }
    if (isset($_POST["delete_comment"])) {
        $idCommentToDelete = $_POST['id'];

        $deleteCommentStatement = $requete->prepare('DELETE FROM comments WHERE id = ?');
        $deleteCommentStatement->execute([$idCommentToDelete]);
    }
    // if(isset($_POST['delete']))
}