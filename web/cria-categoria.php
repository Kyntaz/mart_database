<html>
    <body>
<?php
    $nome = $_REQUEST['nome'];
    $scat = $_REQUEST['super-categoria'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist424849";
        $password = "kngc3748";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql = "INSERT INTO categoria VALUES (?);";

        echo("<p>Criar Categoria.</p>");

        $stmt = $db->prepare($sql);
        $stmt->execute(array($nome));

        if ($scat != "") {
            $sql = "SELECT COUNT(*) FROM super_categoria WHERE nome = ?;";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($scat));
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($res['count'] == 0) {
                $sql = "INSERT INTO super_categoria VALUES (?);";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($scat));
            }

            $sql = "INSERT INTO constituida VALUES (?,?);";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($scat, $nome));
        }

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
    <a href="categorias.php"> Voltar </a>
    </body>
</html>