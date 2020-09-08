
function allClientes(tabela=false)
{
    $.ajax({
        "url": "http://127.0.0.1:8088/api/clientes/",
        "method": "GET",
        "timeout": 0,
        "async": false,
        success: function(response)
        {
            if(response.success)
            {
                retorno =  response.data
                if (tabela) {
                    tabelaClientes(retorno);
                }
                selectClientes(retorno);
                return retorno;
            }
            else
            {
                alert("Erro ao carregar");
                return false;
            }
        },
        error: function (ajaxContext) {
            alert(ajaxContext.responseText)
            return false;
        }
    });
}

function tabelaClientes(data)
{
    clientes = data.clientes;
    for(var i = 0 ; i < clientes.length; i++){

        tabBody=document.getElementById('tabelaClientes');
        row=document.createElement("tr");
        cell1 = document.createElement("td");
        cell2 = document.createElement("td");
        cell3 = document.createElement("td");
        cell4 = document.createElement("td");
        cell5 = document.createElement("td");
        textnode1=document.createTextNode(clientes[i].id);
        textnode2=document.createTextNode(clientes[i].primeiro_nome);
        textnode3=document.createTextNode(clientes[i].ultimo_nome);
        textnode4=document.createTextNode(clientes[i].email);

        btn1 = document.createElement("BUTTON");
        btn1.classList.add('btn');
        btn1.classList.add('btn-outline-secondary');
        btn1.classList.add('btn-sm');
        btn1.classList.add('modal-clientes');
        btn1.innerHTML = "Editar";
        btn1.setAttribute("data-toggle","modal");
        btn1.setAttribute("data-target","#modalClientes");
        btn1.setAttribute("onclick", "carregaModalClientes("+clientes[i].id +",'"+ clientes[i].primeiro_nome +"','"+ clientes[i].ultimo_nome +"','"+ clientes[i].email +"')");

        btn2 = document.createElement("BUTTON");
        btn2.classList.add('btn');
        btn2.classList.add('btn-outline-danger');
        btn2.classList.add('btn-sm');
        btn2.innerHTML = "Apagar";
        btn2.setAttribute("onclick", "deletarClientes("+clientes[i].id +")");

        cell1.appendChild(textnode1);
        cell2.appendChild(textnode2);
        cell3.appendChild(textnode3);
        cell4.appendChild(textnode4);
        div5 = document.createElement("div");
        div5.classList.add('btn-group');
        div5.appendChild(btn1);
        div5.appendChild(btn2);
        cell5.appendChild(div5);
        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        row.appendChild(cell4);
        row.appendChild(cell5);
        tabBody.tBodies[0].appendChild(row);
    }
}

function selectClientes(data)
{
    if (document.getElementById('select_cliente_id')) {
        clientes = data.clientes;
        var select=document.getElementById('select_cliente_id');
        for(var i = 0 ; i < clientes.length; i++){
            const option = document.createElement('option')
            option.textContent = clientes[i].primeiro_nome + " " + clientes[i].ultimo_nome;
            option.value = clientes[i].id;

            select.appendChild(option);
        }
    }
}

function resetFormClientes()
{
    document.getElementById("formClientes").reset();
    $('.cliente_id').val('');
}

function carregaModalClientes(id, primeiro_nome,ultimo_nome,email)
{
    $('.cliente_id').val(id);
    $('.primeiro_nome').val(primeiro_nome);
    $('.ultimo_nome').val(ultimo_nome);
    $('.email').val(email);
}

function salvarClientes()
{
    var url="http://127.0.0.1:8088/api/clientes/";
    var metodo="POST";
    if ($('.cliente_id').val() !=''){
        url += $('.cliente_id').val();
        metodo="PUT";
    }
    $.ajax({
        "url": url,
        "method": metodo,
        "timeout": 0,
        data: {
            'primeiro_nome' : $('.primeiro_nome').val(),
            'ultimo_nome' : $('.ultimo_nome').val(),
            'email' : $('.email').val()
        },
        "async": false,
        success: function(response)
        {
            if(response.success)
            {
                alert("Cliente salvo com Sucesso!");
                window.location='cliente.html';
                return true;
            }
            else
            {
                alert(response.message);
            }
        }
    });
}

function deletarClientes(cliente_id)
{
    if(confirm('Deseja realmente excluir o Cliente?'))
    {
        $.ajax({
            "url": "http://127.0.0.1:8088/api/clientes/" + cliente_id,
            "method": "DELETE",
            "timeout": 0,
            "async": false,
            success: function(response)
            {
                if(response.success)
                {
                    alert("Cliente apagado com Sucesso!");
                    window.location='cliente.html';
                    return true;
                }
                else
                {
                    alert(response.message);
                }
            }
        });
    }
}


