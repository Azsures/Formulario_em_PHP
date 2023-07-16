<!DOCTYPE html>
<html>
<head>
<title>Formulário Discente de Avaliação da Orientação </title>

<link rel="stylesheet" href="style.css">
    
</head>

<body>
<?php
     function adicionarOuSubstituirDado($arquivo, $chave, $valor) {
        // Lê o conteúdo atual do arquivo
        
        $conteudo = file_get_contents($arquivo);
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

            
            $Nova_Linha .= strval(intval($valor) + intval($old_values_vec[0])). ",";
            $Nova_Linha .= ":" . strval(intval($old_values_vec[sizeof($old_values_vec) - 1]) + 1);
    
            $conteudo = substr_replace($conteudo, $Nova_Linha, $posicao, strlen($Nova_Linha));
        }
        else {
            // Adiciona a chave e o valor ao conteúdo
            $conteudo .= $chave . ":";
            for($k = 0; $k < sizeof($valores)-1; $k++)
                $conteudo .= $valores[$k]. ",";
            //55 spaces ate end of the line were added to prevent the string to become to long and eat next line caracters
            $conteudo .= ":1". "                                                       \n";
        }
    
        // Escreve o conteúdo atualizado no arquivo
        file_put_contents($arquivo, $conteudo);
    }
    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $professor = $_POST["prof"];
        $nome = $_POST["nome"];
        $curso = $_POST["matriculado"];
        $periodo = $_POST["periodo"];
        $nota = $_POST["nota"];
        $opiniao = $_POST["opLivre"];
        

        $data = "Professor: " . $professor . ", " .
                "Nome: " . $nome . ", " .
                "Curso: ". $curso. ", " .
                "Periodo: ". $periodo. ", " .
                "Opiniao: " . $opiniao . ";\n\n";

        $dados_materias = $nota . ",";

        // Adicione o caminho e nome do arquivo desejado
        $file = "orientacao.txt";
        $notas = "mediaprof.txt";

        // Abre o arquivo para escrita e leitura com ponteiro no fim do arquivo.
        $handle1 = fopen($file, "a+");
        $handle2 = fopen($notas, "a+");

        //Colocar um If empty file pra dar um /n na primeira linha se o aruivo estiver vazio

        // Escreve os dados no arquivo
        if(!empty($opiniao))
            fwrite($handle1, $data);
        adicionarOuSubstituirDado($notas, $professor, $dados_materias);

        // Fecha o arquivo
        fclose($handle1);
        fclose($handle2);
    }
?>

    <div class="container">
        
        <div class="form-question">
            <h2 class="title" >Formulário Discente de Avaliação da Orientação</h2>
            <p class="subtitle">Prezado pós-graduando do PPGCS,
este formulário tem a intenção de conhecer sua avaliação quanto a orientação que você tem recebido de seu Professor Orientador. Fique a vontade para se identificar ou não e sintam-se livres para tecer elogios, críticas ou sugestões fundamentadas. Queremos muito ouvir cada um de vocês.
Atenciosamente,
Comissão de Ensino do PPGCS <br><br>

OBS: Este formulário APENAS deverá ser preenchido por pos-graduandos regularmente matriculados em curso de mestrado ou doutorado do PPGCS no semestre vigente.</p>
        </div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            
            <div class="form-question">
                <label>Identificação: (Opcional)</label>
                <br>
                <br>
                <input type="text" id="nome" name="nome">
            </div>

            <div class="form-question">
                <label for="prof">Você é orientado por qual professor?</label>
                <br>
                <br>
                <select id="prof" name="prof" required>
                    <option value="Alfredo">Alfredo de Paula</option>
                    <option value="AnaPaula">Ana Paula Venuto</option>
                    <option value="AndreLuiz">André Luiz Sena Guimaraes</option>
                    <option value="Andrea">Andréa Maria Eleutério de Barros Lima Martins</option>
                    <option value="Antonio">Antônio Caldeira Prates</option>
                    <option value="Carla">Carla Silvana Oliveira Silva</option>
                    <option value="Cristina">Cristina Andrade Sampaio</option>
                    <option value="Desiree">Desirée Sant Ana Haikal</option>
                    <option value="Hercilio">Hercílio Martelli Junior</option>
                    <option value="Israel">Israel Molina</option>
                    <option value="JoaoFelicio">João Felício Rodrigues Neto</option>
                    <option value="JoaoMarcus">João Marcus Oliveira Andrade</option>
                    <option value="Lucyana">Lucyana Conceição Farias</option>
                    <option value="Luiz">Luiz Resende</option>
                    <option value="Marcelo">Marcelo Baldo</option>
                    <option value="MarcosFlavio">Marcos Flávio Dangelo</option>
                    <option value="Marileia">Mariléia Chaves Andrade</option>
                    <option value="Marise">Marise Fagundes Silveira</option>
                    <option value="Renato">Renato Sobral Monteiro Junior</option>
                    <option value="Sergio">Sérgio Souza Santos</option>
                    <option value="Silvio">Silvio Fernando Guimaraes</option>
                    <option value="Thallyta">Thallyta Vieira Maria</option>
                </select>
            </div>

            <div class="form-question">
                <label for="matriculado"> <p class="question-text"> Você está atualmente matriculado em: </p> </label>
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
                </div>
            <div class="form-question">
            <label for="periodo"> <p class="question-text"> Qual semestre você está cursando em seu curso de pós graduação no PPGCS? 
Lembre-se que comumente o curso de mestrado é cumprido em 4 semestres, o curso de doutorado em 8 semestres e o pos-doc em 2 semestres. </p></label>
                <div class="questions">
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
                </div>
                </li>
            </div>
            <div class="form-question">
            <label for="nota"> <p class="question-text"> No geral, que nota você atribui a orientação que tem recebido de seu Professor Orientador? Avalie numa escala de 0 (péssima) a 10 (excelente). </p></label>
            
            
                <label
                    ><input type="radio" name="nota" value="1" required/><span
                        >1</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="2" /><span
                        >2</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="3" /><span
                        >3</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="4" /><span
                        >4</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="5" /><span
                        >5</span
                    ></label>
                    <label
                    ><input type="radio" name="nota" value="6" /><span
                        >6</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="7" /><span
                        >7</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="8" /><span
                        >8</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="9" /><span
                        >9</span
                    ></label>
                <label
                    ><input type="radio" name="nota" value="10" /><span
                        >10</span
                    ></label>
                </li>
            </div>
            <div class="form-question">
            <label for="opLivre">Espaço aberto. Sinta-se livre para tecer seus comentários de forma a justificar a nota atribuída no tópico anterior.</label>
            <br>
            <br>
            <input type="text" id="opLivre" name="opLivre">
            </div>

            <input type="submit" value="Enviar">
            
    </div>
</body>