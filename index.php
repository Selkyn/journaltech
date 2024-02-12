
    <?php
    session_start();
    include "header.php";
    require "connexion.php";
    // require 'commentSend.php';
    require "delete.php";

$journalJoin = ('SELECT journal.*, users.pseudo as pseudo
                FROM journal
                INNER JOIN users ON journal.user_id = users.id');

    if (isset($_GET['search'])) {
        $search = "%" . trim($_GET['search']) . "%";
        $journalStatement = $requete->prepare('SELECT journal.*, users.pseudo FROM journal JOIN users ON journal.user_id = users.id WHERE title LIKE :search');
        $journalStatement->bindParam(':search', $search, PDO::PARAM_STR);
    } else {
        $journalStatement = $requete->prepare($journalJoin);
    }
    // $journalStatement = $requete->prepare('SELECT * FROM journal');
    $journalStatement->execute();
    $reponses = $journalStatement->fetchAll();
    // $_SESSION['journal_id'] = $responses['journal_id'];


    // $commentJoin = ('SELECT *
    //                 FROM comments
    //                 JOIN users ON comments.user_id = users.id
    //                 JOIN journal ON comments.journal_id = journal.id');
    // $commentSendStatement =  $requete->prepare($commentJoin);
    // $commentSendStatement->execute();
    // $reponsesComment = $commentSendStatement->fetchAll(); 
    // $_SESSION['journal_id'] = $responsesComment['journal_id'];
    
    ?>
    <div class="d-flex justify-content-center align-items-center">
    <form method="get" action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Rechercher" name="search">
            <button class="btn btn-outline-secondary" type="submit">Chercher</button>
        </div>
    </form>
</div>

<div class="d-flex flex-column justify-content-center align-items-center">
    <table class="table w-75 p-3">
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Image</th>
            <th>Date</th>
            <th>Auteur</th>
        </tr>
        
        <?php
        foreach ($reponses as $reponse) {
            echo "<tr>";
            echo "<td>" . $reponse['id'] . "</td>";
            ?>
            <td><a href="article.php?id=<?php echo $reponse['id']; ?>"><?php echo $reponse['title']; ?></a></td>
            <?php
            // echo "<td>" . $reponse['title'] . "</td>";
            echo "<td>" . $reponse['content'] . "</td>";?>
            <td><img src="<?php echo $reponse['image']?>" alt="" style="width: 100px;"></td>
            
            <?php
            echo "<td>" . $reponse['dates'] . "</td>";
            echo "<td>" . $reponse['pseudo'] . "</td>";
            // echo '<td><form action="journal.php"  method="get"><input type="submit" value ="Voir article" name = "goJournal">
            //     </form></td>';
            echo "</tr>";
            
            
            // if (isset($_SESSION['loggedUser'])) {
            //     include "comments.php";
                // echo "<tr>";
                // echo "<td colspan='4'>"; 
                // echo "<form action='' method='post'>"
                // . "<input type = 'text' name='journal_id'>"
                //     . "<textarea name='content' id='' cols='40' rows='2'></textarea>"
                //     . "<input type='submit' name='commentSendBtn'>"
                // . "</form>";
                // echo "</td>";
                // echo "</tr>";
            }
            // foreach($reponsesComment as $reponseComment) {
                
            //     echo "<tr>";
            //     echo "<td>Commentaire de " . $reponseComment['pseudo'] . ": " . $reponseComment['content'] . "</td>";
            //     // if ($_SESSION['is_admin'] == 1) {
            //     //     echo "<td>";
            //     //     echo "<form action='' method='post'>";
            //     //     echo "<input type='hidden' name='id' value='" . $reponseComment['id'] . "'>";
            //     //     echo "<button type='submit' name='delete_comment'>Supprimer</button>";
            //     //     echo "</form>";
            //     //     echo "</td>";
            //     // }
            //     echo "</tr>";
            // }
            
            
        // }
       
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

