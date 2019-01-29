<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h3> Sub-categorias de <?=$_REQUEST['nome']?> </h3>
        <?php
        $nome = $_REQUEST['nome'];
        try {
            $host = "db.ist.utl.pt";
            $user ="ist424849";
            $password = "kngc3748";
            $dbname = $user;
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $db->query("start transaction;");

            $sql = "SELECT categoria FROM constituida WHERE super_categoria = ?;";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($nome));

            $rows = $stmt->fetchAll();
            $out = array();

            while (count($rows) > 0) {
                $new_rows = array();
                foreach ($rows as $row) {
                    array_push($out, $row);

                    $sql = "SELECT categoria FROM constituida WHERE super_categoria = ?;";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array($row['categoria']));
                    $res = $stmt->fetchAll();

                    foreach ($res as $new_row) {
                        array_push($new_rows, $new_row);
                    }
                }
                $rows = $new_rows;
            }

            $db->query("commit;");

            $db = null;

            foreach ($out as $row) {
                echo("<p>{$row['categoria']}</p>");               
            } 
        }
        catch (PDOException $e)
        {
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        ?>
        <a href="select-cat.php">Voltar</a>
    </body>
</html>