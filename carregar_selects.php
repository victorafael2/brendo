<?php
// Incluir arquivo de conexão com o banco de dados
include 'database/connect.php';

// Verificar se foi passado o parâmetro valorSelecionado via GET
if (isset($_GET['valorSelecionado'])) {
    $valorSelecionado = $_GET['valorSelecionado'];

    // Consulta SQL para buscar os selects adicionais com base no valor selecionado
    // Substitua isso pelo seu código específico para buscar os selects adicionais
    $sql = "SELECT * FROM tabela_tuss WHERE rol_ans_resolucao = '$valorSelecionado' and rol_ans = 'SIM'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $selects = '<select class="form-control"  id="segundoSelect" name="segundoSelect">';
        $selects .= '<option value="">Escolher um item</option>';
        while ($row = $result->fetch_assoc()) {
            $selects .= '<option value="' . $row['tabela_22'] . '">' . $row['codigo_tab_22'] . ' - ' . $row['tabela_22'] . '</option>';
        }
        $selects .= '</select>';
        echo $selects;
    } else {
        echo '<p>Nenhum resultado encontrado.</p>';
    }
} else {
    echo '<p>Parâmetros não especificados.</p>';
}

// Fechar conexão com o banco de dados
$conn->close();
?>
