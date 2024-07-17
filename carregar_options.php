<?php
// Incluir arquivo de conexão com o banco de dados
include 'database/connect.php';

// Verificar se foram passados os parâmetros tabela, coluna e valor via GET
if (isset($_GET['tabela']) && isset($_GET['coluna']) && isset($_GET['valor'])) {
    $tabela = $_GET['tabela'];
    $coluna = $_GET['coluna'];
    $valor = $_GET['valor'];

    // Consulta SQL para buscar opções do select
    // Ajuste a consulta para buscar apenas com base nos 3 primeiros caracteres
    $sql = "SELECT DISTINCT $coluna AS id, $coluna AS text FROM $tabela WHERE $coluna LIKE '$valor%' ORDER BY $coluna";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $options = array();
        while ($row = $result->fetch_assoc()) {
            $options[] = $row;
        }
        echo json_encode($options);
    } else {
        echo json_encode(array());
    }
} else {
    echo json_encode(array());
}

// Fechar conexão com o banco de dados
$conn->close();
?>
