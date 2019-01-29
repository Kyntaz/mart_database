<html>
    <body>
    <form action="cria-produto.php" method="post">
    <input type="hidden" value="<?=$_REQUEST['ean']?>" name="ean">
    <input type="hidden" value="<?=$_REQUEST['design']?>" name="design">
    <input type="hidden" value="<?=$_REQUEST['categoria']?>" name="categoria">
    <input type="hidden" value="<?=$_REQUEST['forn_primario']?>" name="forn_primario">
    <input type="hidden" value="<?=$_REQUEST['fp_nome']?>" name="fp_nome">
    <input type="hidden" value="<?=$_REQUEST['n_fs']?>" name="n_fs">
    <input type="hidden" value="<?=$_REQUEST['data']?>" name="data">
    
    <?php
    $n = $_REQUEST['n_fs'];
    for ($i = 0; $i < $n; $i++) {
        echo("<p>Fornecedor Secundario {$i}:</p>");
        echo("<p>NIF: <input type='text' name='nif_s{$i}'></p>");
        echo("<p>Nome: <input type='text' name='nome_s{$i}'></p>");
        echo("<br>");
    }
    ?>
    <input type="submit" value="Go">
    </form>
    </body>
</html>