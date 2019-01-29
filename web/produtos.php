<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h3> Novo Produto </h3>
        <form action="fornecedores_secundarios.php" method="post">
            <p> EAN: <input type="text" name="ean"></p>
            <p> Designacao: <input type="text" name="design"></p>
            <p> Categoria:
                <select>
                    <?php
                        try {
                            $host = "db.ist.utl.pt";
                            $user ="ist424849";
                            $password = "kngc3748";
                            $dbname = $user;
                        
                            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "SELECT nome FROM categoria;";
                
                            $result = $db->query($sql);
                            $rows = $result->fetchAll();
                            $db = null;

                            if ($rows != null) {
                                foreach($rows as $row) {
                                    echo("<option value={$row['nome']}>{$row['nome']}</option>");
                                }
                            }
                        }
                        catch (PDOException $e)
                        {
                            echo("<p>ERROR: {$e->getMessage()}</p>");
                            $rows = null;
                        }
                    ?>
                </select>
            </p>
            <p> Fornecedor Primario: <input type="text" name="forn_primario"></p>
            <p> Nome do Fornecedor Primario: <input type="text" name="fp_nome"></p>
            <p> Data: <input type="date" name="data"></p>            
            <p> Numero de Fornecedores Secundarios: <input type="number" name="n_fs"></p>
            <p><input type="submit" value="Go"></p>
        </form>

        <h3> Produtos </h3>
        <table>
        <?php
        $sql = "SELECT ean, design FROM produto;";
        try {
            $host = "db.ist.utl.pt";
            $user ="ist424849";
            $password = "kngc3748";
            $dbname = $user;
        
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $result = $db->query($sql);
            $rows = $result->fetchAll();
            $db = null;

            foreach ($rows as $row) {
                echo("<tr>");
                echo("<td>{$row['ean']}</td>");
                echo("<td>{$row['design']}</td>");
                echo("<td>");
                echo("<form action='apagar-produto.php' method='post'>");
                echo("<input type='hidden' name='ean' value='{$row['ean']}'>");
                echo("<input type='submit' value='Delete'>");
                echo("</form></td></tr>");
            }
        }
        catch (PDOException $e)
        {
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        ?>
        </table>
    </body>
</html>