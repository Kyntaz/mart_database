<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
        $rows = null;
        $sql = "SELECT nome FROM categoria;";
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
        }
        catch (PDOException $e)
        {
            echo("<p>ERROR: {$e->getMessage()}</p>");
            $rows = null;
        }
        ?>

        <!-- Inserir Subcategoria -->
        <h3> Nova categoria </h3>
        <form action="cria-categoria.php" method="post">
            <p>Nome: <input type="text" name="nome"/></p>
            <p>Super-Categoria: <select name="super-categoria">
            <option value="">Nenhum</option>

            <?php
            if ($rows != null) {
                foreach($rows as $row) {
                    echo("<option value={$row['nome']}>{$row['nome']}</option>");
                }
            }
            ?>

            </select></p>
            <p><input type="submit" value="Ok"/></p>
        </form>

        <!-- Apagar categorias -->
        <h3> Categorias </h3>
        <table>

            <?php
            if ($rows != null) {
                foreach($rows as $row) {
                    echo("<tr>");
                    echo("<td>{$row['nome']}</td>");
                    echo("<td>");
                    echo("<form action='remove-categoria.php' method='post'>");
                    echo("<input type='hidden' name='nome' value='{$row['nome']}'>");
                    echo("<input type='submit' value='Delete'>");
                    echo("</form></td></tr>");
                }
            }
            ?>

        </table>
    </body>
</html>