
    <?php
    session_start();
    // echo $_SESSION['is_admin'];
    include "header.php";
    require "connexion.php";

    if (isset($_GET['search'])) {
        $search = "%" . trim($_GET['search']) . "%";
        $journalStatement = $requete->prepare('SELECT * FROM journal WHERE title LIKE :search');
        $journalStatement->bindParam(':search', $search, PDO::PARAM_STR);
    } else {
        $journalStatement = $requete->prepare('SELECT * FROM journal');
    }
    // $journalStatement = $requete->prepare('SELECT * FROM journal');
    $journalStatement->execute();
    $reponses = $journalStatement->fetchAll();

    
    ?>
    <div class="d-flex justify-content-center align-items-center">
    <form method="get" action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Rechercher" name="search">
            <button class="btn btn-outline-secondary" type="submit">Chercher</button>
        </div>
    </form>
</div>

    <div class="d-flex justify-content-center align-items-center">
        <table class="table w-75 p-3">
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date</th>
                <th>Auteur</th>
            </tr>

            <?php
            foreach ($reponses as $reponse) {
                echo "<tr>";
                echo "<td>" . $reponse['title'] . "</td>";
                echo "<td>" . $reponse['content'] . "</td>";
                echo "<td>" . $reponse['dates'] . "</td>";
                echo "<td>" . $reponse['author'] . "</td>";
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

