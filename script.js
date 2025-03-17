document.addEventListener("DOMContentLoaded", function () {
    let table = new DataTable("#verbaTable");

    // Função para retornar a data mínima 

    function getMinDate() {
        let today = new Date();
        today.setDate(today.getDate() + 10);
        return today.toISOString().split("T")[0];
    }
    document.getElementById("dataPrevista").setAttribute("min", getMinDate());

    // Função para adicionar elementos a tabela

    document.getElementById("adicionar").addEventListener("click", function () {
        let acao = document.getElementById("acao").value;
        let dataPrevista = document.getElementById("dataPrevista").value;
        let investimento = document.getElementById("investimento").value;

    // 'If' para verificar se os campos estão preenchidos
        
        if (!acao || !dataPrevista || !investimento) {
            alert("Preencha todos os campos!");
            return;
        }

        
    // Ação para adicionar os elementos na tabela
        table.row.add([
            acao,
            dataPrevista,
            `R$ ${parseFloat(investimento).toFixed(2)}`,
            '<button class="btn btn-primary btn-sm editar">✏️</button>',
            '<button class="btn btn-danger btn-sm excluir">❌</button>'
        ]).draw();

        document.getElementById("verbaForm").reset();
    });

    // Função para limpar os campos do formulário

    document.getElementById("limpar").addEventListener("click", function () {
        document.getElementById("verbaForm").reset();
    });

    // Função para excluir ou editar elementos da tabela

    document.querySelector("#verbaTable tbody").addEventListener("click", function (event) {
        let target = event.target;

        if (target.classList.contains("excluir")) {
            table.row(target.closest("tr")).remove().draw();
        } else if (target.classList.contains("editar")) {
            let row = table.row(target.closest("tr")).data();
            document.getElementById("acao").value = row[0];
            document.getElementById("dataPrevista").value = row[1];
            document.getElementById("investimento").value = row[2].replace("R$ ", "");
            table.row(target.closest("tr")).remove().draw();
        }
    });
});