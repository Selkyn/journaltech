<?php
// session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $idToDelete = $_POST['id'];

        $deleteStatement = $requete->prepare('DELETE FROM journal WHERE id = ?');
        $deleteStatement->execute([$idToDelete]);
    }
    
}