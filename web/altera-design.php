<html>
    <body>
<?php
    $ean = $_REQUEST['ean'];
    $design = $_REQUEST['design'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist424849";
        $password = "kngc3748";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql = "UPDATE produto SET design = ? WHERE ean = ?;";

        echo("<p>Altera Designacao.</p>");

        $stmt = $db->prepare($sql);
        $stmt->execute(array($design, $ean));

        $db->query("commit;");

        $db = null;
        echo("<p>Sucesso!</p>");
    }
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
<a href="altera-design-select.php">Voltar</a>
    </body>
</html>