<html>
<body>
<?php
$ean = $_REQUEST['ean'];
$design = $_REQUEST['design'];
$categoria = $_REQUEST['categoria'];
$forn_primario = $_REQUEST['forn_primario'];
$fp_nome = $_REQUEST['fp_nome'];
$n_fs = $_REQUEST['n_fs'];
$data = $_REQUEST['data'];

try
{
    $host = "db.ist.utl.pt";
    $user ="ist424849";
    $password = "kngc3748";
    $dbname = $user;
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->query("start transaction;");

    /* Criar fornecedor se nao existir */
    $sql = "SELECT COUNT(*) FROM fornecedor WHERE nif = ?;";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($forn_primario));
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res['count'] == 0) {
        $sql = "INSERT INTO fornecedor VALUES (?,?);";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($forn_primario, $fp_nome));
    }


    $sql = "INSERT INTO produto VALUES (?,?,?,?,?);";

    echo("<p>Criar Produto.</p>");

    $stmt = $db->prepare($sql);
    $stmt->execute(array($ean, $design, $categoria, $forn_primario, $data));

    for ($i=0; $i<$n_fs; $i++) {
        $fs_nif = $_REQUEST["nif_s{$i}"];
        $fs_nome = $_REQUEST["nome_s{$i}"];

        /* Criar fornecedor se nao existir */
        $sql = "SELECT COUNT(*) FROM fornecedor WHERE nif = ?;";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($fs_nif));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res['count'] == 0) {
            $sql = "INSERT INTO fornecedor VALUES (?,?);";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($fs_nif, $fs_nome));
        }
        $sql = "INSERT INTO fornece_sec VALUES (?,?);";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($fs_nif, $ean));
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
<a href="produtos.php"> Voltar </a>
</body>
</html>