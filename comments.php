<?php
// include "commentSend.php";
// require "connexion.php";
if (isset($_POST['commentSendBtn'])) {
    // $id = $_POST['id'];
    $journal_id = $_POST['journal_id'];
    $user_id = $_SESSION['id'];
    $content = $_POST['content'];

    $sql = 'INSERT INTO `comments` (`journal_id`,`content`, `user_id`) VALUES (:journal_id, :content, :user_id)';
    $stmt = $requete->prepare($sql);
    $stmt->bindParam(':journal_id', $journal_id);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    header('Location: index.php'); //evite que ca m'ecrive un commentaire à chaque refresh de la page
    exit();
}
?>


<!-- <tr>
    <td colspan='4'>
        <form action='' method='post'>
            <input type='hidden' name='journal_id' value="" >
            <input type='submit' name='commentSendBtn'>
        </form>
    </td>
</tr> -->

