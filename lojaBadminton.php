<?php
interface ProdutoInterface {
    public function cadastrar();
    public function listar();
    public function excluir($id);
}

abstract class Raquete implements ProdutoInterface {
    protected $id;
    protected $nome;
    protected $marca;
    protected $modelo;
    protected $preco;
    protected $quantidade;
    protected $limiteTensao;

    public function __construct($id, $marca, $modelo, $preco, $quantidade, $limiteTensao) {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->nome = "{$marca} {$modelo}";  //construcao do modo de exibição de marca e modelo
        $this->preco = $preco;
        $this->quantidade = $quantidade;
        $this->limiteTensao = $limiteTensao;
    }

    public function cadastrar() {
        echo "CADASTRO DE RAQUETE '{$this->nome}' CADASTRADA COM SUCESSO!\n";
    }

    public function listar() {
        return "ID: $this->id | NOME: $this->nome | MARCA: $this->marca | MODELO: $this->modelo | PREÇO: $this->preco | QUANTIDADE: $this->quantidade | LIMITE DE TENSÃO: $this->limiteTensao LIBRAS";
    }

    public function excluir($id) {
        echo "RAQUETE COM ID $id FOI EXCLUIDA COM SUCESSO!.\n";
    }
}

// bad.
class RaqueteBadminton extends Raquete {
    private $peso;
    private $material;

    public function __construct($id, $marca, $modelo, $preco, $quantidade, $limiteTensao, $peso, $material) {
        parent::__construct($id, $marca, $modelo, $preco, $quantidade, $limiteTensao);
        $this->peso = $peso;
        $this->material = $material;
    }

    public function listar() {
        return parent::listar() . " | PESO: $this->peso g | MATERIAL: $this->material";
    }
}

// tenis.
class RaqueteTenis extends Raquete {
    private $tamanhoCorda;

    public function __construct($id, $marca, $modelo, $preco, $quantidade, $limiteTensao, $tamanhoCorda) {
        parent::__construct($id, $marca, $modelo, $preco, $quantidade, $limiteTensao);
        $this->tamanhoCorda = $tamanhoCorda;
    }

    public function listar() {
        return parent::listar() . " | TAMANHO DA CORDA: $this->tamanhoCorda cm²";
    }
}

// sqash.
class RaqueteSquash extends Raquete {
    private $rigidez;

    public function __construct($id, $marca, $modelo, $preco, $quantidade, $limiteTensao, $rigidez) {
        parent::__construct($id, $marca, $modelo, $preco, $quantidade, $limiteTensao);
        $this->rigidez = $rigidez;
    }

    public function listar() {
        return parent::listar() . " | RIGIDEZ: $this->rigidez";
    }
}

function menu() {
    echo "\n     ##############################\n";
    echo "####     BAZAR DE RAQUETES     #### \n";
    echo "     ##############################\n";
    echo "1 -> CADASTRAR RAQUETES BADMINTON\n";
    echo "2 -> CADASTRAR RAQUETES TÊNIS\n";
    echo "3 -> CADASTRAR RAQUETE SQUASH\n";
    echo "4 -> LISTAR\n";
    echo "5 -> EXCLUIR\n";
    echo "6 -> SAIR\n";
}
$raquetes = [];
$contaID = 1;

do {
    menu();
    $opcao = readline("INSIRA A OPÇÃO: ");

    switch ($opcao) {
        case 1:
            $marca = readline("MARCA: ");
            $modelo = readline("MODELO: ");
            $preco = readline("PREÇO: ");
            $quantidade = readline("QUANTIDADE: ");
            $limiteTensao = readline("LIMITE DE TENSÃO (LBS): ");
            $peso = readline("PESO (G): ");
            $material = readline("MATERIAL: ");
            $rigidez = readline("RIGIDEZ: ");

            $raquete = new RaqueteBadminton($contaID++, $marca, $modelo, $preco, $quantidade, $limiteTensao, $peso, $material, $rigidez);
            $raquete->cadastrar();
            $raquetes[] = $raquete;
            break;

        case 2:
            $marca = readline("MARCA: ");
            $modelo = readline("MODELO: ");
            $preco = readline("PREÇO: ");
            $quantidade = readline("QUANTIDADE: ");
            $limiteTensao = readline("LIMITE DE TENSÃO (LBS): ");
            $tamanhoCorda = readline("TAMANHO DA CORDA (CM²): ");
            $material = readline("MATERIAL: ");
            $rigidez = readline("RIGIDEZ: ");

            $raquete = new RaqueteTenis($contaID++, $marca, $modelo, $preco, $quantidade, $limiteTensao, $tamanhoCorda,$material, $rigidez);
            $raquete->cadastrar();
            $raquetes[] = $raquete;
            break;

        case 3:
            $marca = readline("MARCA: ");
            $modelo = readline("MODELO: ");
            $preco = readline("PREÇO: ");
            $quantidade = readline("QUANTIDADE: ");
            $limiteTensao = readline("LIMITE DE TENSÃO (LBS): ");
            $material = readline("MATERIAL: ");
            $rigidez = readline("RIGIDEZ: ");

            $raquete = new RaqueteSquash($contaID++, $marca, $modelo, $preco, $quantidade, $limiteTensao,$material, $rigidez);
            $raquete->cadastrar();
            $raquetes[] = $raquete;
            break;

        case 4:
            echo "\n##### LISTA #####\n";
            foreach ($raquetes as $raquete) {
                echo $raquete->listar() . "\n";
            }
            break;

        case 5:
            $id = readline("DIGITE O ID DO PRODUTO PARA SER EXCLUIDO ");
            foreach ($raquetes as $index => $raquete) {
                if ($raquete->id == $id) {
                    unset($raquetes[$index]);
                    echo "RAQUETE COM ID $id EXCLUIDA COM SUCESSO!\n";
                    break;
                }
            }
            break;

        case 6:
            echo "ENCERRANDO...\n";
            break;

        default:
            echo "OPÇÃO INVALIDADA. TENTE NOVAMENTE\n";
            break;
    }
} while ($opcao != 6);

?>
