@extends("layout.painel")

@section("conteudo-pagina")
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Tutorial
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-question"></i> Tutorial
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
                
            <ul id="lista-tutorial">
                <li>Como utilizar o sistema?</li>
                <li><a href="#tutorial-sessao-empresa">Cadastrar uma empresa</a></li>
                <li><a href="#tutorial-sessao-linha">Cadastrar uma linha</a></li>
                <li><a href="#tutorial-sessao-editar">Editar uma linha</a></li>
                <li><a href="#tutorial-sessao-trajetos">Registrar trajetos em uma linha</a></li>
                <li><a href="#tutorial-sessao-desenho">Registrar desenho do trajeto</a></li>
                <li><a href="#tutorial-sessao-pontos">Registrar pontos de parada em uma linha</a></li>
                <li><a href="#tutorial-sessao-horarios">Registrar horários em um ponto de parada</a></li>
            </ul>

            <div id="tutorial-sessao-empresa" class="tutorial-content">
                
                <h2>Cadastrar uma empresa</h2>

                <p>Obs.: registrar uma nova empresa somente caso ela nao exista ainda no sistema.</p>
                <p>Verificar se a empresa que gostaria de cadastrar ja existe:</p>
                <ul>
                    <li>Acessar o menu "Criar Linha"</li>
                    <li>Verificar se na lista de empresas se a mesma ja existe.</li>
                </ul>

                <p>Cadastrando uma nova empresa:</p>
                <ul>
                    <li>Acessar o menu "Cadastrar Empresa".</li>
                    <li>Informar os valores:
                        <ul>
                            <li>Nome da empresa</li>
                            <li>Website</li>
                            <li>Localização</li>
                        </ul>
                    </li>
                    <li>Clique em "Cadastrar".</li>
                    <li>A nova linha sera cadastrada.</li>
                </ul>

            </div>

            <div id="tutorial-sessao-linha" class="tutorial-content">
                
                <h2>Cadastrar uma linha</h2>

                <p>Obs.: registrar uma nova linha somente caso ela nao exista ainda no sistema.</p>
                <p>Cadastrando uma nova linha:</p>
                <ul>
                    <li>Acessar o menu "Criar Linha".</li>
                    <li>Selecionar a empresa no qual a linha sera associada.</li>
                    <li>Informar os valores:
                        <ul>
                            <li>Nome abreviado da linha</li>
                            <li>Nome completo da linha</li>
                        </ul>
                    </li>
                    <li>Clique em "Cadastrar".</li>
                    <li>A nova linha sera cadastrada.</li>
                </ul>

            </div>

            <div id="tutorial-sessao-editar" class="tutorial-content">
                
                <h2>Editar uma linha</h2>

                <p>Para editar uma linha, caso a tenha criado, ela podera ser encontrada mais facilmente acessando o menu "Minhas Linhas". Apos isso basta encontra-la na tabela e clicar no botao "Editar".</p>

                <p>No caso de edicao de uma linha a qual voce nao criou, basta acessar o menu "Todas as Linhas", procurar pela linha desejada na tabela e clicar no botao "Editar".</p>

            </div>

            <div id="tutorial-sessao-trajetos" class="tutorial-content">
                
                <h2>Registrar trajetos em uma linha</h2>

                <p>Apos solicitar edicao em uma determinada linha:</p>
                <ul>
                    <li>Acessar a aba "Gerenciar trajetos".</li>
                    <li>Clicar no botao "Novo trajeto".</li>
                    <li>Informar os valores:
                        <ul>
                            <li>Nome do trajeto</li>
                            <li>Selecionar os dias que o trajeto funcionara</li>
                            <li>Inicio do funcionamento do servico</li>
                            <li>Termino do funcionamento do servico</li>
                        </ul>
                    </li>
                    <li>Clique em "Cadastrar".</li>
                    <li>O novo trajeto sera cadastrada.</li>
                </ul>

                <p>Para deletar um trajeto existente, basta clicar no icone da lixeira na linha contendo o trajeto em questao.</p>

            </div>

            <div id="tutorial-sessao-desenho" class="tutorial-content">
                
                <h2>Registrar desenho do trajeto</h2>

                <p>Apos solicitar edicao em uma determinada linha:</p>
                <ul>
                    <li>Acessar a aba "Criar/desenhar pontos".</li>
                    <li>Selecionar o trajeto pertencente a linha no qual o trajeto sera desenhado.</li>
                    <li>Marcar o botao duplo na acao "Desenhar Trajeto".</li>
                    <li>Para maior precisao no desenho, aplicar o zoom maximo no mapa.</li>
                    <li>Aplicar cliques com o botao esquerdo do mouse no mapa, a fim de formar retas entre os mesmos.</li>
                    <li>O desenho do trajeto estara sendo salvo.</li>
                </ul>

                <p>Para deletar pontos de desenho, aplicar cliques com o botao direito do mouse, a fim dos mesmos serem deletados decrescentemente.</p>

            </div>

            <div id="tutorial-sessao-pontos" class="tutorial-content">
                
                <h2>Registrar pontos de parada em uma linha</h2>

                <p>Apos solicitar edicao em uma determinada linha:</p>
                <ul>
                    <li>Acessar a aba "Criar/desenhar pontos".</li>
                    <li>Selecionar o trajeto pertencente a linha no qual o ponto sera atribuido.</li>
                    <li>Marcar o botao duplo na acao "Adicionar Ponto".</li>
                    <li>Aplicar cliques com o botao esquerdo do mouse no mapa, a fim de informar o nome que sera atribuito ao ponto de parada.</li>
                </ul>

                <p>Para deletar um ponto de parada ja criado, basta clicar no marcador deste ponto presente no mapa. Sera exibido um popup acima do marcados contendo um icone de lixeira.</p>

            </div>

            <div id="tutorial-sessao-horarios" class="tutorial-content">
                
                <h2>Registrar horários em um ponto de parada</h2>

                <p>Apos solicitar edicao em uma determinada linha:</p>
                <ul>
                    <li>Acessar a aba "Gerenciar horários".</li>
                    <li>Selecionar o trajeto pertencente a linha no qual possui os pontos de parada.</li>
                    <li>Selecionar o ponto de parada pertencente ao trajeto no qual ira possuir os horarios.</li>
                    <li>Clicar no botao "Novo horário".</li>
                    <li>Informar os valores:
                        <ul>
                            <li>Hora de chegada no ponto de parada</li>
                            <li>Hora de partida no ponto de parada</li>
                        </ul>
                    </li>
                </ul>

                <p>Para deletar um horario existente, basta clicar no icone da lixeira na linha contendo o horario em questao na tabela de horarios.</p>

            </div>

        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->
@stop
