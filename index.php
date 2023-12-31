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
        $valores = explode(",", $valor);
        $proximo_valor = 1;
        $ValorAtual = "";
        $Quant = "";
        $Nova_Linha = "";
        $old_values = "";
        $tamanho = 0;
        
        // Procura pela chave no conteúdo
        $posicao = strpos($conteudo, $chave);
        // Se a chave existir, substitui o valor
        if ($posicao != false) {
            $Nova_Linha .= $chave . ":";

            $posicaoValor = $posicao + strlen($chave) + 1;

            for($i = $posicaoValor; $i < strlen($conteudo); $i++){
                $tamanho++;
                if($conteudo[$i] != "\n"){
                    if($conteudo[$i] != ":")
                        $old_values .= $conteudo[$i];
                }
                else{
                    break;
                }
            }

            $old_values_vec = explode(",", $old_values);

            for($k = 3; $k < sizeof($valores)-1; $k++)
                $Nova_Linha .= strval(intval($valores[$k]) + intval($old_values_vec[$k-3])). ",";
            $Nova_Linha .= ":" . strval(intval($old_values_vec[sizeof($old_values_vec) - 1]) + 1);
    
            $conteudo = substr_replace($conteudo, $Nova_Linha, $posicao, strlen($Nova_Linha));
        }
        else {
            // Adiciona a chave e o valor ao conteúdo
            $conteudo .= $chave . ":";
            for($k = 3; $k < sizeof($valores)-1; $k++)
                $conteudo .= $valores[$k]. ",";
            //55 spaces ate end of the line were added to prevent the string to become to long and eat next line caracters
            $conteudo .= ":1". "                                                       \n";
        }
    
        // Escreve o conteúdo atualizado no arquivo
        file_put_contents($arquivo, $conteudo);
    }
    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $disciplina = $_POST["disciplina"];
        $nome = $_POST["nome"];
        $curso = $_POST["matriculado"];
        $periodo = $_POST["periodo"];
        $opiniao1 = $_POST["disciplina"];
        $opiniao2 = $_POST["matriculado"];
        $opiniao3 = $_POST["periodo"];
        $opiniao4 = $_POST["estrutura"];
        $opiniao5 = $_POST["cargaH"];
        $opiniao6 = $_POST["tempo1"];
        $opiniao7 = $_POST["compreensao"];
        $opiniao8 = $_POST["CritMet"];
        $opiniao9 = $_POST["RelAt"];
        $opiniao10 = $_POST["RelPart"];
        $opiniao11 = $_POST["ContFor"];
        $opiniao12 = $_POST["SolConAs"];
        $opiniao13 = $_POST["EsDuv"];
        $opiniao14 = $_POST["ExPAs"];
        $opiniao15 = $_POST["ApIn"];
        $opiniao16 = $_POST["ExClLi"];
        $opiniao17 = $_POST["RelCord"];
        $opiniao18 = $_POST["IntDisc"];
        $opiniao19 = $_POST["PrepAula"];
        $opiniao20 = $_POST["EncParA"];
        $opiniao21 = $_POST["motLeEl"];
        $opiniao22 = $_POST["DiscTem"];
        $opiniao23 = $_POST["Pontual"];
        $opiniao24 = $_POST["PreReq"];
        $opiniao25 = $_POST["Esforco"];
        $opiniao26 = $_POST["EuPontual"];
        $opiniao27 = $_POST["RelContOut"];

        $data = "Disciplina " . $disciplina . ", " .
                "Nome " . $nome . ", " .
                "Curso ". $curso. ", " .
                "Periodo ". $periodo. ", " .
                "Opiniao " . $opiniao . ";\n";

        $dados_materias =   $opiniao1 . "," .
                            $opiniao2 . "," .
                            $opiniao3 . "," .
                            $opiniao4 . "," .
                            $opiniao5 . "," .
                            $opiniao6 . "," .
                            $opiniao7 . "," .
                            $opiniao8 . "," .
                            $opiniao9 . "," .
                            $opiniao10 . "," .
                            $opiniao11 . "," .
                            $opiniao12 . "," .
                            $opiniao13 . "," .
                            $opiniao14 . "," .
                            $opiniao15 . "," .
                            $opiniao16 . "," .
                            $opiniao17 . "," .
                            $opiniao18 . "," .
                            $opiniao19 . "," .
                            $opiniao20 . "," .
                            $opiniao21 . "," .
                            $opiniao22 . "," .
                            $opiniao23 . "," .
                            $opiniao24 . "," .
                            $opiniao25 . "," .
                            $opiniao26 . "," .
                            $opiniao27 . "," ;

        // Adicione o caminho e nome do arquivo desejado
        $file = "dados.txt";
        $estatistico = "materias.txt";

        // Abre o arquivo para escrita e leitura com ponteiro no fim do arquivo.
        $handle1 = fopen($file, "a+");
        $handle2 = fopen($estatistico, "a+");

        //Colocar um If empty file pra dar um /n na primeira linha se o aruivo estiver vazio

        // Escreve os dados no arquivo
        fwrite($handle1, $data);
        adicionarOuSubstituirDado($estatistico, $disciplina, $dados_materias);

        // Fecha o arquivo
        fclose($handle1);
    }
    ?>
    <div class="container">
        
        <div class="form-question">
            <h2 class="title">Formulário Discente de Avaliação de Disciplinas</h2>
            <p class="subtitle">Prezado pós-graduando do PPGCS,
este formulário tem a intenção de conhecer sua avaliação quanto às disciplinas ministradas. Fique à vontade para se identificar ou não e sintam-se livres para tecer elogios, críticas ou sugestões fundamentadas. Queremos muito ouvir cada um de vocês.
Atenciosamente,
Comissão de Ensino do PPGCS <br><br>

OBS: Este formulário APENAS deverá ser preenchido por pos-graduandos regularmente matriculados em curso de mestrado ou doutorado do PPGCS no semestre vigente.</p>
        </div>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="form-question">
                <label for="nome">Identificação: (Opcional)</label>
                <br>
                <br>
                <input type="text" id="nome" name="nome">
            </div>

            <div class="form-question">
                <label for="disciplina">Escolha a disciplina:</label> <br><br>
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>
            <div class="form-question">
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
            </div>

            <input type="submit" value="Enviar">
        </form>
    </div>

   
</body>
</html>
