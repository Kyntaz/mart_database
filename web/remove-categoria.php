<html>
    <body>
        <?php
            $nome = $_REQUEST['nome'];
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist424849";
                $password = "kngc3748";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $db->query("start transaction;");

                $sql = "DELETE FROM categoria WHERE nome = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($nome));

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