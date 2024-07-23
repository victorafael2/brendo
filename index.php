<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de Resoluções ANS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap4-theme/1.5.2/select2-bootstrap4.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .navbar-brand img {
            height: 30px;
            margin-right: 10px;
        }

        /* Botão de Modo Noturno */
        .modo-noturno {
            background-color: #343a40 !important;
            color: #ffffff;
        }

        .modo-noturno:hover {
            background-color: #23272b !important;
            color: #ffffff;
        }

        /* Estilo para tabela de valores salvos */
        #tabelaValoresSalvos {
            margin-top: 20px;
        }

        #tabelaValoresSalvos th,
        #tabelaValoresSalvos td {
            padding: 8px;
            text-align: center;
        }
    </style>

</head>

<body>
    <!-- Cabeçalho -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="https://png.pngtree.com/png-clipart/20220719/original/pngtree-task-list-png-image_8368036.png" alt="Logo" height="30px">
                    Busca de Resoluções ANS
                </a>
                <!-- Botão de Modo Noturno -->
                <button class="navbar-toggler modo-noturno" id="modoNoturnoBtn" type="button" onclick="toggleDarkMode()">
                    <i id="modoIcone" class="fas fa-sun"></i>
                </button>
                <!-- Toggler para menu responsivo -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark btn-sm" id="btnModoNoturno"><i id="iconeModo" class="fas fa-sun"></i></button>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Conteúdo da página -->
    <div class="container mt-4">
        <div class="row">
            <!-- Filtros -->
            <div class="col-md-4">
                <div class="h4 pb-2 mb-4 text-body-secondary border-bottom border-secondary">
                    Busca Tuss
                </div>
                <div class="form-group">
                    <label for="primeiroSelect">Selecionar Resolução ANS:</label>
                    <select class="form-control" id="primeiroSelect" name="primeiroSelect"></select>
                </div>

                <!-- Placeholder para exibir selects adicionais -->
                <div id="selectsAdicionais" class="mt-4"></div>

                <div id="tabelaValoresSelecionados" class="mt-4 p-3 card table-responsive">
                    <h4>Valores Selecionados</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Tabela 22</th>
                                <th>ANS Resolução</th>
                                <th>Subgrupo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody id="corpoTabela">
                            <!-- Linhas da tabela serão preenchidas dinamicamente -->
                        </tbody>
                    </table>
                </div>

                <div id="tabelaValoresSalvos" class="mt-4 p-3 card table-responsive fw-lighter">
                    <h5>Histórico de Consultas</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Tabela 22</th>
                                <th>ANS Resolução</th>
                                <th>Subgrupo</th>
                            </tr>
                        </thead>
                        <tbody id="corpoTabelaValoresSalvos">
                            <!-- Linhas da tabela serão preenchidas dinamicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8">
            <iframe src="proxy.php" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
    <!-- FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Script para interação dinâmica e Select2 -->
    <script>
        // Armazenamento local para os valores salvos
        var valoresSalvos = JSON.parse(localStorage.getItem('valoresSalvos')) || [];

        // Função para inicializar o Select2
        function inicializarSelect2() {
            $('#primeiroSelect').select2({
                minimumInputLength: 1, // Mínimo de caracteres para começar a busca
                ajax: {
                    url: 'carregar_options.php',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            tabela: 'tabela_tuss',
                            coluna: 'rol_ans_resolucao',
                            valor: params.term // Termo de busca
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        }

        // Função para carregar selects adicionais baseado na seleção anterior
        function carregarSelectsAdicionais(valorSelecionado) {
            $.ajax({
                url: 'carregar_selects.php',
                method: 'GET',
                data: {
                    valorSelecionado: valorSelecionado
                },
                success: function(response) {
                    $('#selectsAdicionais').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao carregar selects adicionais:', error);
                }
            });
        }

        // Função para atualizar a tabela com os valores do segundo select selecionado
        function atualizarTabela(valorSelecionado) {
            $.ajax({
                url: 'carregar_valores_tabela.php',
                method: 'GET',
                data: {
                    valorSelecionado: valorSelecionado
                },
                success: function(response) {
                    $('#corpoTabela').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao carregar valores para tabela:', error);
                }
            });
        }

// Função para salvar valor clicado na tabela de valores salvos
function salvarValor(valor, tabela22, ansResolucao, subgrupo) {
    // Verificar se o valor já existe nos valores salvos
    var valorExistente = valoresSalvos.find(function(item) {
        return item.valor === valor && item.tabela22 === tabela22 && item.ansResolucao === ansResolucao && item.subgrupo === subgrupo;
    });

    if (!valorExistente) {
        var novoItem = {
            valor: valor,
            tabela22: tabela22,
            ansResolucao: ansResolucao,
            subgrupo: subgrupo
        };

        valoresSalvos.push(novoItem);
        localStorage.setItem('valoresSalvos', JSON.stringify(valoresSalvos));

        // Atualizar a tabela de valores salvos
        atualizarTabelaValoresSalvos();
    } else {


    }
}


        // Função para atualizar a tabela de valores salvos
        function atualizarTabelaValoresSalvos() {
            var corpoTabelaValoresSalvos = $('#corpoTabelaValoresSalvos');
            corpoTabelaValoresSalvos.empty();

            valoresSalvos.forEach(function(item, index) {
                var newRow = '<tr>' +
                    '<td >' + (index + 1) + '</td>' +
                    '<td class="valor-copiar">' + item.valor + '</td>' +
                    '<td>' + item.tabela22 + '</td>' +
                    '<td>' + item.ansResolucao + '</td>' +
                    '<td>' + item.subgrupo + '</td>' +
                    '</tr>';
                corpoTabelaValoresSalvos.append(newRow);
            });
        }

        // Copiar valor para área de transferência ao clicar
        $(document).on('click', '.valor-copiar', function() {
            var valor = $(this).text().trim();
            navigator.clipboard.writeText(valor)
                .then(function() {
                    // Alerta utilizando SweetAlert2 para uma aparência mais bonita
                    Swal.fire({
                        icon: 'success',
                        title: 'Valor Copiado!',
                        text: 'O valor foi copiado para a área de transferência: ' + valor,
                        timer: 1500, // Tempo em milissegundos (1.5 segundos)
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                })
                .catch(function(err) {
                    console.error('Erro ao copiar valor:', err);
                    // Alerta de erro padrão se houver um problema
                    alert('Erro ao copiar valor: ' + err.message);
                });
        });

        // Função para alternar entre Modo Claro e Modo Escuro
        function toggleDarkMode() {
            var body = document.body;
            var modoIcone = document.getElementById('modoIcone');
            if (body.classList.contains('modo-noturno')) {
                body.classList.remove('modo-noturno');
                modoIcone.classList.remove('fa-moon');
                modoIcone.classList.add('fa-sun');
            } else {
                body.classList.add('modo-noturno');
                modoIcone.classList.remove('fa-sun');
                modoIcone.classList.add('fa-moon');
            }
        }

        // Evento de mudança no segundo select (selects adicionais)
        $(document).on('change', '#segundoSelect', function() {
            var valorSelecionado = $(this).val();
            atualizarTabela(valorSelecionado);
        });

        // Evento de inicialização do Select2 ao carregar a página
        $(document).ready(function() {
            inicializarSelect2();

            // Evento de seleção no Select2
            $('#primeiroSelect').on('select2:select', function(e) {
                var data = e.params.data;
                var valorSelecionado = data.id; // Id do item selecionado
                var tabela22 = data.tabela22; // Valor da coluna tabela22
                var ansResolucao = data.ansResolucao; // Valor da coluna ansResolucao
                var subgrupo = data.subgrupo; // Valor da coluna subgrupo

                carregarSelectsAdicionais(valorSelecionado);
                // Limpar a tabela de valores selecionados ao mudar o primeiro select
                $('#corpoTabela').empty();
            });

            // Evento de clique no botão Primary para alternar Modo Noturno
            $('#btnModoNoturno').click(function() {
                toggleDarkMode();
            });

            // Evento de clique em uma linha da tabela para salvar valor
            $(document).on('click', '#corpoTabela tr', function() {
                var valor = $(this).find('td:nth-child(2)').text().trim(); // Valor da segunda coluna (exemplo, ajuste conforme a sua tabela)
                var tabela22 = $(this).find('td:nth-child(3)').text().trim(); // Valor da terceira coluna
                var ansResolucao = $(this).find('td:nth-child(4)').text().trim(); // Valor da quarta coluna
                var subgrupo = $(this).find('td:nth-child(5)').text().trim(); // Valor da quinta coluna
                salvarValor(valor, tabela22, ansResolucao, subgrupo);
            });

            // Carregar valores salvos ao carregar a página
            atualizarTabelaValoresSalvos();
        });
    </script>
</body>

</html>
