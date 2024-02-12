<?php
session_start();
include "header.php";
require "connexion.php";
require "delete.php";
if (!isset($_SESSION['loggedUser'])) {
    header("Location : index.php");
}

$usersStatement = $requete->prepare('SELECT * FROM users');
$usersStatement->execute();
$users = $usersStatement->fetchAll();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
// }


?>

<div class="d-flex justify-content-center align-items-center">
    <table class="table w-75 p-3">
        <tr>
            <th>id</th>
            <th>Pseudo</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Supprimer</th>
        </tr>
        <?php
        foreach ($users as $user) {
            if ($user['is_admin'] !== 1) {
                echo "<tr>";
                echo "<form method='POST'>";
                echo "<td>" . $user['id'] . "<input type='hidden' name='id' value='" . $user['id'] . "'></td>";
                ?>
                <td><a href="message_admin.php?id=<?php echo $user['id']; ?>&pseudo=<?php echo $user['pseudo']; ?>"><?php echo $user['pseudo']; ?></a></td>
                <?php
                // echo "<td>" . $user['pseudo'] . "</td>";
                echo "<td>" . $user['name_user'] . "</td>";
                echo "<td>" . $user['surname'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";
                echo "<td><button type='submit' name = 'delete_user'>Supprimer</button></td>";
                echo "</form>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>



<?php
include "footer.php";
