<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestao_verbas";

// Parâmetros de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestao_verbas";

// Conexão com banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Cuida da requisição POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];
    $data_prevista = $_POST['data_prevista'];
    $investimento = $_POST['investimento'];
    
    // Checa a data (pelo menos 10 dias)
    $data_minima = date('Y-m-d', strtotime('+10 days'));
    if ($data_prevista < $data_minima) {
        die("A data prevista deve ser pelo menos 10 dias após a data atual.");
    }
    
    // Insere a nova ação 
    $sql = "INSERT INTO acoes_marketing (acao, data_prevista, investimento) VALUES ('$acao', '$data_prevista', '$investimento')";
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

// Cuida da requisição GET 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM acoes_marketing ORDER BY criado_em DESC";
    $result = $conn->query($sql);
    $dados = [];
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }
    echo json_encode($dados);
}

// Cuida da requisição DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];
    $sql = "DELETE FROM acoes_marketing WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Registro deletado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

// Fecha a conexão do database
$conn->close();

?>