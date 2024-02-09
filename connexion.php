 <?php
    $host = 'localhost';
    $dbname = 'journaltech';
    $username = 'root';
    $password = '';
    try {
        $requete = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // echo "Connecté à $dbname sur $host avec succès.";
    } catch (PDOException $e) {
        die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
    }
    ?>

 <!-- // $host = 'localhost';
    // $dbname = 'journaltech';
    // $username = 'root';
    // $password = '';
    // $conn = mysqli_connect($host, $username, $password, $dbname);
    // var_dump($conn);
    // if (mysqli_connect_errno()) {
    // echo "Impossible de se connecter à MySQL: " . mysqli_connect_error();
    // exit();
    // } -->