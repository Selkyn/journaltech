<?php
session_start();
include "header.php";
include "connexion.php";
include "delete.php";
// include "comments.php";


$getIdArticle = $_GET['id'];

$articleStatement = $requete->prepare('SELECT * FROM journal JOIN users ON journal.user_id = users.id WHERE journal.id = ?');
$articleStatement->execute([$getIdArticle]);
$responsesArticle = $articleStatement->fetch();

// var_dump($responsesArticle);
// foreach($responsesArticle as $responseArticle) {
?>

<div class=" d-flex flex-column align-items-center">
<div class="ms-5 me-5">
    
    <h2><?php echo $responsesArticle['title']?></h2>
    <p><?php echo $responsesArticle['dates']?></p>
    <div>
        <p><?php echo $responsesArticle['content']?></p>
        <?php
        echo "<p><img src='" . $responsesArticle['image'] . "' style='width: 400px;'></p>";?>
        <p>Ecrit par <?php echo $responsesArticle['pseudo']?></p>
    </div>
</div>

<?php
// }
if (isset($_POST['commentSendBtn'])) {
    // $id = $_POST['id'];
    // $journal_id = $_POST['journal_id'];
    $user_id = $_SESSION['id'];
    $content = $_POST['content'];

    $sql = 'INSERT INTO `comments` (`journal_id`,`content`, `user_id`) VALUES (:journal_id, :content, :user_id)';
    $stmt = $requete->prepare($sql);
    $stmt->bindParam(':journal_id', $getIdArticle);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    header('Location: index.php'); //evite que ca m'ecrive un commentaire à chaque refresh de la page
    exit();
}

if (isset($_SESSION['loggedUser'])) {
?>
<tr>
<td colspan='4'>
    <form action='' method='post'>
        <!-- <input type='hidden' name='journal_id' value=""> -->
        <input type="hidden" name = user_id>
        <textarea name='content' id='' cols='40' rows='2'></textarea>
        <input type='submit' name='commentSendBtn'>
    </form>
</td>
</tr>
<?php
}

$commentsJoin = ('SELECT comments.content, users.pseudo, comments.id, comments.journal_id 
                FROM comments
                JOIN users ON comments.user_id =users.id
                JOIN journal ON journal_id = journal.id
                WHERE journal_id = ?');

$commentStatement = $requete->prepare($commentsJoin);
$commentStatement->execute([$getIdArticle]);
$responsesComment = $commentStatement->fetchALL();

?>
<table class="table w-50 p-3">
    <tr>
        <th>pseudo</th>
        <th>commentaire</th>
    </tr>
    <?php
        foreach($responsesComment as $responseComment) {
    echo "<tr>";
        
            echo "<td>" . $responseComment['pseudo'] . "</td>";
            echo "<td>" . $responseComment['content'] . "</td>";
            if($_SESSION['is_admin'] == 1) {
                echo "<td>";
                echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='id' value='" . $responseComment['id'] . "'>";
                    echo "<button type='submit' name='delete_comment'>Supprimer</button>";
                    echo "</form>";
                    echo "</td>";
            }
        }
      echo  "</tr>";
        ?>
    
</table>

</div>















<?php
include "footer.php";