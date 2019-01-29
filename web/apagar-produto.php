<html>
    <body>
        <?php
            $ean = $_REQUEST['ean'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist424849";
                $password = "kngc3748";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("start transaction;");

                $sql = "DELETE FROM produto WHERE ean = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($ean));

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
    <a href="produtos.php"> Voltar </a>
    </body>
</html>