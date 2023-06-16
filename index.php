<!DOCTYPE html>
<html>
<head>
<title>Formulário Discente de Avaliação de Disciplinas </title>

<link rel="stylesheet" href="style.css">
    
</head>
<body>
<?php
    function adicionarOuSubstituirDado($arquivo, $chave, $valor) {
        // Lê o conteúdo atual do arquivo
        
        $conteudo = file_get_contents("materias.txt");
    
        // Procura pela chave no conteúdo
        $posicao = strpos($conteudo, $chave);
        // Se a chave existir, substitui o valor
        if ($posicao != false) {
            // Obtém a posição inicial do valor
            $posicaoValor = $posicao + strlen($chave) + 1;
            $ValorAtual = "";
            $Quant = "";
            // Obtém a posição final do valor
            $posicaoFinal = strpos($conteudo, ":", $posicaoValor);
            
            // Armazena o valor correspondente numa sub string para fazer a soma e substituição
            for($i = $posicaoValor; $i < $posicaoFinal; $i++)
                $ValorAtual .= $conteudo[$i];
            // Substitui o valor total
            $conteudo = substr_replace($conteudo, strval(intval($valor) + intval($ValorAtual)), $posicaoValor, $posicaoFinal - $posicaoValor);

            //substitui a quantidade para um valor a mais

            $posicaoValor = $posicaoFinal + 2;
            $posicaoFinal = strpos($conteudo, "\n", $posicaoValor);

            for($i = $posicaoValor; $i < $posicaoFinal; $i++)
                $Quant .= $conteudo[$i];
            
            $conteudo = substr_replace($conteudo, strval(((int) $Quant))+ 1, $posicaoValor, $posicaoFinal - $posicaoValor);
        }
        else {
            // Adiciona a chave e o valor ao conteúdo
            $conteudo .= $chave . ": " . $valor . ": 1". "\n";
        }
    
        // Escreve o conteúdo atualizado no arquivo
        file_put_contents($arquivo, $conteudo);
    }
    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $disciplina = $_POST["disciplina"];
        $nome = $_POST["nome"];
        $curso = $_POST["matriculado"];
        $periodo = $_POST["periodo"];
        $opiniao = $_POST["opiniao"];

        $data = "Disciplina " . $disciplina . ", " .
                "Nome " . $nome . ", " .
                "Curso ". $curso. ", " .
                "Periodo ". $periodo. ", " .
                "Opiniao " . $opiniao . ";\n";

        $dados_materias = $disciplina . "," .
                          $opiniao . ",";

        // Adicione o caminho e nome do arquivo desejado
        $file = "dados.txt";
        $estatistico = "materias.txt";

        // Abre o arquivo para escrita e leitura com ponteiro no fim do arquivo.
        $handle1 = fopen($file, "a+");
        $handle2 = fopen($estatistico, "a+");

        //Colocar um If empty file pra dar um /n na primeira linha se o aruivo estiver vazio

        // Escreve os dados no arquivo
        fwrite($handle1, $data);
        adicionarOuSubstituirDado($estatistico, $disciplina, $opiniao);

        // Fecha o arquivo
        fclose($handle1);
    }
    ?>
    <div class="container">
        <h2>Formulário Discente de Avaliação de Disciplinas</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="disciplina">Disciplina:</label>
            <select id="disciplina" name="disciplina" required>
                <option value="Bioestatistica 1">Bioestatistica I</option>
                <option value="Inteligencia Computacional">Tópicos de Inteligência Computacional</option>
                <option value="Metodologia Cientifica">Metodologia Científica</option>
                <option value="Doenças Infecciosas">Doenças Infecciosas e parasitárias: uma abordagem multidisciplinar</option>
                <option value="Bioestatistica 2">Bioestatistica II</option>
                <option value="Antropologia medica">Antropologia médica</option>
                <option value="Topicos em Metabolismo e Saude">Tópicos em Metabolismo e Saúde</option>
                <option value="Empreendedorismo Inovacao">Empreendedorismo e Inovação em Saúde</option>
                <option value="Bioetica">Bioética</option>
                <option value="Pesquisa Qualitativa 1">Pesquisa Qualitativa I</option>
                <option value="Pesquisa Qualitativa 2">Pesquisa Qualitativa II</option>
                <option value="Revisao e Meta">Tópicos Especiais em Revisão Sistemática e Meta-análise</option>
                <option value="Estudos em Saude">Estudos Interdisplinares em Saúde</option>
                <option value="Avaliacao critica">Avaliação crítica de projetos de pesquisa e artigos científicos</option>
            </select>
            
            <p for="nome">Identificação: (Opcional)</p>
            <input type="text" id="nome" name="nome">

            <label for="matriculado"> <p class="question-text"> Você está atualmente matriculado em: </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="matriculado" value="Mestrado" required/><span
                        >Mestrado</span
                    ></label>
                <br>
                <label
                    ><input type="radio" name="matriculado" value="Doutorado" /><span
                        >Doutorado</span
                    ></label>
                <br>
                <label
                    ><input type="radio" name="matriculado" value="Pos-Doc" /><span
                        >Pos-Doc</span
                    ></label>
                </li>
            </ul>

            <label for="periodo"> <p class="question-text"> Qual semestre você está cursando em seu curso de pós graduação no PPGCS? 
Lembre-se que comumente o curso de mestrado é cumprido em 4 semestres, o curso de doutorado em 8 semestres e o pos-doc em 2 semestres. </p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="periodo" value="1" required/><span
                        >1</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="2" /><span
                        >2</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="3" /><span
                        >3</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="4" /><span
                        >4</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="5" /><span
                        >5</span
                    ></label>
                    <label
                    ><input type="radio" name="periodo" value="6" /><span
                        >6</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="7" /><span
                        >7</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="8" /><span
                        >8</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="9" /><span
                        >9</span
                    ></label>
                <label
                    ><input type="radio" name="periodo" value="10" /><span
                        >10</span
                    ></label>
                </li>
            </ul>

            <label for="estrutura"> <p class="question-text">A estrutura geral da disciplina foi bem concebida/organizada:</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="estrutura" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="estrutura" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="estrutura" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="estrutura" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="estrutura" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>
            
            <label for="cargaH"> <p class="question-text"> A carga horária da disciplina foi adequada </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="cargaH" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="cargaH" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="cargaH" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="cargaH" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="cargaH" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="tempo1"> <p class="question-text"> Houve tempo suficiente para a realização de leituras e atividades solicitadas </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="tempo1" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="tempo1" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="tempo1" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="tempo1" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="tempo1" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="compreensao"> <p class="question-text"> As referências recomendadas foram relevantes e contribuíram para a compreensão do conteúdo ministrado </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="compreensao" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="compreensao" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="compreensao" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="compreensao" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="compreensao" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="CritMet"> <p class="question-text"> Os critérios de avaliação foram coerentes com o conteúdo e as metodologias utilizadas </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="CritMet" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="CritMet" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="CritMet" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="CritMet" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="CritMet" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="RelAt"> <p class="question-text"> Foram estabelecidas relações entre os conteúdos da disciplina e campos de atuação profissional </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="RelAt" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelAt" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelAt" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelAt" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelAt" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="RelPart"><p class="question-text"> Houve bom relacionamento entre os participantes da disciplina </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="RelPart" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelPart" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelPart" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelPart" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelPart" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="ContFor"><p class="question-text"> A disciplina contribuiu efetivamente para minha formação </p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="ContFor" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ContFor" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ContFor" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ContFor" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ContFor" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="SolConAs"> <p class="question-text"> Demonstrou sólido conhecimento dos assuntos ministrados </p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="SolConAs" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="SolConAs" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="SolConAs" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="SolConAs" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="SolConAs" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="EsDuv"> <p class="question-text"> Esclareceu, com segurança, as dúvidas dos alunos </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="EsDuv" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EsDuv" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EsDuv" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EsDuv" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EsDuv" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="ExPAs"><p class="question-text"> Forneceu exemplos práticos atualizados dos assuntos ministrados </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="ExPAs" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExPAs" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExPAs" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExPAs" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExPAs" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="ApIn"><p class="question-text"> Apresentou os assuntos de forma a despertar o interesse do aluno </p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="ApIn" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ApIn" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ApIn" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ApIn" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ApIn" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="ExClLi"><p class="question-text"> Expôs os conteúdos de forma objetiva, clara e numa linguagem acessível. </p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="ExClLi" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExClLi" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExClLi" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExClLi" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="ExClLi" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="RelCord"><p class="question-text"> Demonstrou relacionamento cordial com os alunos Linha 6 </p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="RelCord" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelCord" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelCord" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelCord" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelCord" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="IntDisc"><p class="question-text">Estimulou o interesse pela disciplina</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="IntDisc" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="IntDisc" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="IntDisc" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="IntDisc" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="IntDisc" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="PrepAula"><p class="question-text">Apresentava-se bem preparado para as aulas</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="PrepAula" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PrepAula" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PrepAula" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PrepAula" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PrepAula" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="EncParA"><p class="question-text">Encorajou a participação dos alunos nas aulas.</p> </label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="EncParA" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EncParA" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EncParA" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EncParA" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EncParA" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="motLeEl"><p class="question-text">Motivou para a leitura e elaboração de trabalhos práticos. </p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="motLeEl" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="motLeEl" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="motLeEl" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="motLeEl" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="motLeEl" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="DiscTem"><p class="question-text">Estimulou a discussão sobre o tema estudado, mostrando-se tolerante com opiniões divergentes.</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="DiscTem" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="DiscTem" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="DiscTem" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="DiscTem" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="DiscTem" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="Pontual"><p class="question-text">Foi assíduo e pontual</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="Pontual" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Pontual" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Pontual" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Pontual" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Pontual" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="PreReq"><p class="question-text">Eu possuía os pré-requisitos necessários para o bom aproveitamento da disciplina</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="PreReq" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PreReq" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PreReq" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PreReq" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="PreReq" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="Esforco"><p class="question-text">Dediquei esforço necessário à disciplina</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="Esforco" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Esforco" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Esforco" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Esforco" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="Esforco" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="EuPontual"><p class="question-text">Fui pontual e assíduo</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="EuPontual" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EuPontual" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EuPontual" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EuPontual" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="EuPontual" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>

            <label for="RelContOut"><p class="question-text">Procurei estabelecer relações entre o conteúdo abordado e outros conteúdos já conhecidos e/ou de outras disciplinas</p></label>
            <ul class="quiz">
                <label
                    ><input type="radio" name="RelContOut" value="1" required/><span
                        >Discordo Plenamente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelContOut" value="2" /><span
                        >Discordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelContOut" value="3" /><span
                        >Não Discordo nem Concordo</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelContOut" value="4" /><span
                        >Concordo Parcialmente</span
                    ></label
                ><br>
                <label
                    ><input type="radio" name="RelContOut" value="5" /><span
                        >Concordo Plenamente</span
                    ></label
                ><br>
            </ul>
            <input type="submit" value="Enviar">
        </form>
    </div>

   
</body>
</html>
