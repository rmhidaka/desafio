function allPedidos(acao=false)
{
    statusPedido=[];
    statusPedido[1] = "Novo";
    statusPedido[2] = "Pendente";
    statusPedido[3] = "Entregue";
    $.ajax({
        "url": "http://127.0.0.1:8088/api/pedidos/",
        "method": "GET",
        "timeout": 0,
        "async": false,
        success: function(response)
        {
            if(response.success)
            {
                retorno =  response.data;
                tabelaPedidos(retorno,acao);
                return retorno;
            }
            else
            {
                alert("Erro ao carregar Pedidos");
            }
        },
        error: function (ajaxContext) {
            alert(ajaxContext.responseText)
        }
    });
    return retorno;
}

function tabelaPedidos(data,acao)
{
    pedidos = data.pedidos;
    for(var i = 0 ; i < pedidos.length; i++){

        tabBody=document.getElementById('tabelaPedidos');
        row=document.createElement("tr");
        cell1 = document.createElement("td");
        cell2 = document.createElement("td");
        cell3 = document.createElement("td");
        cell4 = document.createElement("td");
        cell5 = document.createElement("td");

        textnode1=document.createTextNode(pedidos[i].id);
        textnode2=document.createTextNode(pedidos[i].cliente.primeiro_nome + " " + pedidos[i].cliente.ultimo_nome);
        textnode3=document.createTextNode(pedidos[i].created_at);
        textnode4=document.createTextNode('R$ ' + pedidos[i].valor);
        textnode5=document.createTextNode(statusPedido[pedidos[i].status]);btn1 = document.createElement("BUTTON");

        cell1.appendChild(textnode1);
        cell2.appendChild(textnode2);
        cell3.appendChild(textnode3);
        cell4.appendChild(textnode4);
        cell5.appendChild(textnode5);

        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        row.appendChild(cell4);
        row.appendChild(cell5);

        if (acao)   {
            cell6 = document.createElement("td");
            btn1.classList.add('btn');
            btn1.classList.add('btn-outline-secondary');
            btn1.classList.add('btn-sm');
            btn1.classList.add('modal-pedidos');
            btn1.innerHTML = "Editar";
            btn1.setAttribute("data-toggle","modal");
            btn1.setAttribute("data-target","#modalPedidos");
            btn1.setAttribute("onclick", "carregaModalPedidos("+pedidos[i].id +",'"+ pedidos[i].cliente_id +"','"+ pedidos[i].status +"','"+ pedidos[i].valor +"','"+ pedidos[i].created_at +"')");

            btn2 = document.createElement("BUTTON");
            btn2.classList.add('btn');
            btn2.classList.add('btn-outline-danger');
            btn2.classList.add('btn-sm');
            btn2.innerHTML = "Apagar";
            btn2.setAttribute("onclick", "deletarPedidos("+pedidos[i].id +")");

            div6 = document.createElement("div");
            div6.classList.add('btn-group');
            div6.appendChild(btn1);
            div6.appendChild(btn2);
            cell6.appendChild(div6);

            row.appendChild(cell6);
        }
        tabBody.tBodies[0].appendChild(row);
    }
}

function resetFormPedidos()
{
    document.getElementById("formPedidos").reset();
    $('.pedido_id').val('');
}

function carregaModalPedidos(id, cliente_id,status,valor, created_at)
{
    $('.pedido_id').val(id);
    $('.valor').val(valor);
    $('.created_at').val(created_at);
    $(".select_cliente_id").val(cliente_id);

    //document.getElementById('select_cliente_id').value = cliente_id;

    var radios = document.getElementsByName("status");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].value === status) {
            radios[i].checked = true;
        }
    }
}

function salvarPedidos()
{
    var valor = $('.valor').val();
    valor = valor.replace(".", "");
    valor = valor.replace(",", ".");
    var url="http://127.0.0.1:8088/api/pedidos/";
    var metodo="POST";
    if ($('.pedido_id').val() !=''){
        url += $('.pedido_id').val();
        metodo="PUT";
    }
    $.ajax({
        "url": url,
        "method": metodo,
        "timeout": 0,
        data: {
            'cliente_id' : $('.select_cliente_id').val(),
            'status' : $("input[name='status']:checked").val(),
            'valor' : valor
        },
        "async": false,
        success: function(response)
        {
            if(response.success)
            {
                alert("Pedido salvo com Sucesso!");
                window.location='pedido.html';
                return true;
            }
            else
            {
                alert(response.message);
            }
        }
    });
}

function deletarPedidos(pedido_id)
{
    if(confirm('Deseja realmente excluir o Pedido?'))
    {
        $.ajax({
            "url": "http://127.0.0.1:8088/api/pedidos/" + pedido_id,
            "method": "DELETE",
            "timeout": 0,
            "async": false,
            success: function(response)
            {
                if(response.success)
                {
                    alert("Pedido apagado com Sucesso!");
                    window.location='pedido.html';
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