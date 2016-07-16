<?php
if (!isset($_COOKIE['sess-sis'])) {
    header('Location: login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker3.min.css" rel="stylesheet">

    <style>
        .valor-debito {
            color: red;
        }
        .valor-credito {
            color: blue;
        }
        .saldo {
            font-size: 12pt;
            border-top: solid 2px black;
        }
        
        #valor-total {
            font-weight: bold;
        }
        
    </style>
    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/chartist.css" rel="stylesheet">
    
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="js/util.js"></script>
    <script src="js/jquery.inputmask-3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/chartist.js"></script>    
    
    <script type="text/javascript">
        $(document).ready(function(){
            
            var cookies = leCookie();
            var user = JSON.parse(cookies["sess-sis"]);
            
            $("#userNome").html(user.nome);
            $("#userNome").click(desloga);
            
            $("#valor").inputmask();
            
            $("#data").datepicker({
                autoclose:'false',
                format:'dd/mm/yyyy',
                language:'pt-BR'
            });
            
            $.getJSON('model/categorias.php',function(dados){ 
                var opt = '<option value="0" selected="selected">Selecione</option>';
                $(dados).each(function(ind, elem){
                    opt += '<option value='+ elem.id +'>'+ elem.nome +'</option>';
                });
                $("#categoria").html(opt);
            });
            
            $.getJSON('model/30dias.php',function(dados){
                
                //monta a tabela
                $(dados).each(function(ind, elem){
                    elem.data = formataDataDB(elem.data);
                    insereRegistro(elem, "append");
                });
            });
            
            $.getJSON('model/saldo.php', function(dados){
                
                $("#valor-total").html('R$ '+ formataDinheiro(dados.saldo));
            });
            
            $.getJSON('model/grafCategoria.php', function(dados){
                
                var data = {
                    labels: [],
                    series: []
                };
                
                $(dados).each(function(ind, elem){
                    data.labels.push(elem.categoria);
                    data.series.push(elem.total);
                });
                
                var options = {
                    labelInterpolationFnc: function(value) {
                      return value[0]
                    }
                };

                var responsiveOptions = [
                  ['screen and (min-width: 640px)', {
                    chartPadding: 30,
                    labelOffset: 100,
                    labelDirection: 'explode',
                    labelInterpolationFnc: function(value) {
                      return value;
                    }
                  }],
                  ['screen and (min-width: 1024px)', {
                    labelOffset: 80,
                    chartPadding: 20
                  }]
                ];
                new Chartist.Pie('#graf-pizza', data, options, responsiveOptions);
            });
            
            $("#cadastro-novo").submit(function(evento){
                evento.preventDefault();
                if($('#Descricao').val() == "") {
                   $('#Descricao').parent()
                           .parent()
                           .addClass('has-error');
                    
                    $('#Descricao').parent()
                            .find('.help-block')
                            .removeClass('hide');
                    
                    return false;
                }
                if($("#categoria").val() == 0){
                    $("#categoria").parent().addClass('has-error');
                    
                    $("#categoria").parent()
                            .find('.help-block')
                            .removeClass('hide');
                    
                    return false;
                }
                var novoRegistro = {
                    descricao: $('#Descricao').val(),
                    data: $('#data').val(),
                    valor: $('#valor').val(),
                    categoria: $('#categoria').val(),
                    tipo: $("input[name='tipos']:checked").val(),
                    usuario: user.id
                };
                
                $.post('model/novo.php', novoRegistro);
                $('#modal-add').modal('hide');
                insereRegistro(novoRegistro, 'prepend');
            });
            
            $('#modal-add').on('hidden.bs.modal', function(e){
                $('#cadastro-novo input').val('');
            });
        });
    </script>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Gerenciador Financeiro</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Relatorios</a></li>
            <li><a href="#">Histórico</a></li>
            <li><a href="#">Contas</a></li>
            <li><a id="userNome" href="#">Usuário</a></li>
          </ul>
          
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
       
        <div class="col-md-12  main">
          <h1 class="page-header">
              Painel
              <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-add">
                  <span class="glyphicon glyphicon-plus-sign"> Registro</span>
              </button>
          </h1>

          <div class="row placeholders">
              <div class="col-xs-6 col-sm-4">
                  <div id="graf-pizza" class="ct-square"></div>
              </div>
          </div>

          <h2 class="sub-header">Ultimos 30 dias</h2>
          <div class="table-responsive">
            <table class="table table-striped" id="rel-30dias">
              <thead>
                <tr>
                  <th>Data</th>
                  <th>Descrição</th>
                  <th>Categoria</th>
                  <th>Tipo (C/D)</th>
                  <th>Valor</th>
                </tr>
              </thead>
              <tbody>
                
                
              </tbody>
              
              <tfoot>
                  <tr>
                      <td colspan="4">Saldo Total:</td>
                      <td id="valor-total">123.89</td>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Small modal -->
    <div id="modal-add" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="cadastro-novo" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Adicionar Novo Registro</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Descricao">Descrição</label>  
                      <div class="col-md-8">
                        <input id="Descricao" name="Descricao" type="text" placeholder="" class="form-control input-md">
                        <span class="help-block hide">Este campo é obrigatório.</span>    
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="categoria">Categoria</label>  
                        <div class="col-md-8">
                            <select id="categoria" name="categoria" class="form-control input-md">
                                <option value="0">Selecione</option>
                            </select>
                            <span class="help-block hide">Este campo é obrigatório.</span>
                        </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="valor">Valor</label>
                      <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input id="valor" name="valor" class="form-control" 
                            placeholder="" type="text"
                            data-inputmask="'alias': 'numeric',
                                'groupSeparator': ',', 
                                'autoGroup': true,
                                'digits': 2,
                                'digitsOptional': false, 
                                'placeholder': '0'">
                        </div>

                      </div>
                    </div>

                    <!-- Multiple Radios -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="tipos">Tipo</label>
                      <div class="col-md-4">
                      <div class="radio">
                        <label for="tipos-0">
                          <input type="radio" name="tipos" id="tipos-0" value="C" checked="checked">
                          Crédito
                        </label>
                            </div>
                      <div class="radio">
                        <label for="tipos-1">
                          <input type="radio" name="tipos" id="tipos-1" value="D">
                          Débito
                        </label>
                            </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="data">Data</label>  
                      <div class="col-md-8">
                      <input id="data" name="data" type="text" placeholder="" class="form-control input-md">

                      </div>
                    </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>    
        </div>
      </div>
    </div>
  </body>
</html>
