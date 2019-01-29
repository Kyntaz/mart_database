<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h3> Eventos de Reposicao de <?=$_REQUEST['ean']?> </h3>
        <table>
        <tr>
            <th> EAN </th>
            <th> Operador </th>
            <th> Instante </th>
            <th> Unidades </th>
        </tr>

        <?php
        $ean = $_REQUEST['ean'];
        try {
            $host = "db.ist.utl.pt";
            $user ="ist424849";
            $password = "kngc3748";
            $dbname = $user;
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $db->query("start transaction;");

            $sql = "SELECT ean, operador, instante, unidades FROM reposicao WHERE ean = ?;";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($ean));

            $rows = $stmt->fetchAll();

            $db->query("commit;");

            $db = null;

            foreach ($rows as $row) {
                echo("<tr>");
                echo("<td>{$row['ean']}</td>");
                echo("<td>{$row['operador']}</td>");
                echo("<td>{$row['instante']}</td>");
                echo("<td>{$row['unidades']}</td>");
                echo("</td>");                
            } 
        }
        catch (PDOException $e)
        {
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        ?>
        </table>
        <a href="seleciona-evento-rep.php">Voltar</a>
    </body>
</html>