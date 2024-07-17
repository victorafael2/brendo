<?php
// Incluir arquivo de conexão com o banco de dados
include 'database/connect.php';
// Verificar se foi passado o parâmetro valorSelecionado via GET
if (isset($_GET['valorSelecionado'])) {
    $valorSelecionado = $_GET['valorSelecionado'];

    // Consulta SQL para buscar os valores correspondentes ao segundo select
    // Substitua 'sua_tabela' pelo nome real da sua tabela
    // e 'campo' pelo campo relevante para o valor que você deseja exibir na tabela
    $sql = "SELECT * FROM tabela_tuss WHERE tabela_22 = '$valorSelecionado'";

    // Executar consulta SQL e gerar as linhas da tabela
    // Este é um exemplo básico, adapte conforme necessário
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $html = '';
        $contador = 1;
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td >' . $contador . '</td>'; // Coluna # (número sequencial)
            $html .= '<td class="valor-copiar" >' . $row['codigo_tab_22'] . '</td>'; // Coluna com o valor relevante
            $html .= '<td>' . $row['tabela_22'] . '</td>'; // Coluna com o valor relevante
            $html .= '<td>' . $row['rol_ans_resolucao'] . '</td>'; // Coluna com o valor relevante
            $html .= '<td>' . $row['subgrupo'] . '</td>'; // Coluna com o valor relevante
            $html .= '<td>' . $row['grupo'] . '</td>'; // Coluna com o valor relevante
            $html .= '</tr>';
            $contador++;
        }
        echo $html;
    } else {
        echo '<tr><td colspan="2">Nenhum resultado encontrado</td></tr>';
    }
} else {
    echo '<tr><td colspan="2">Parâmetros não especificados</td></tr>';
}
?>
