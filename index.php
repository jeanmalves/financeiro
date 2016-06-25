
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
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="js/util.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            
            $("#data").datepicker({
                autoclose:'false',
                format:'dd/mm/yyyy',
                language:'pt-BR'
            });
            
            $.getJSON('model/30dias.php',function(dados){         
                $(dados).each(function(ind, elem){
                    var classValor = (elem.tipo == "C")? 'valor-credito':'valor-debito';
                    var data = new Date(elem.data);
                    
                    var tr = $('<tr>'+
                        '<td>' + data.getDate() + '/' + (data.getMonth()+1) + '/' + data.getFullYear() + '</td>'+
                        '<td>'+elem.descricao+'</td>'+
                        '<td>'+elem.categoria+'</td>'+
                        '<td>'+elem.tipo+'</td>'+
                        '<td class="'+classValor+'">R$ '+ formataDinheiro(elem.valor) +'</td>'+
                      '</tr>');
        
                    $('#rel-30dias tbody').append(tr);
                });
            });
            
            $.getJSON('model/saldo.php', function(dados){
                
                $("#valor-total").html('R$ '+ formataDinheiro(dados.saldo));
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
            <li><a href="#">Usuário</a></li>
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
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Adicionar Novo Registro</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Descricao">Descrição</label>  
                      <div class="col-md-8">
                      <input id="Descricao" name="Descricao" type="text" placeholder="" class="form-control input-md">

                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="categoria">Categoria</label>  
                      <div class="col-md-8">
                      <input id="categoria" name="categoria" type="text" placeholder="" class="form-control input-md">

                      </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="valor">Valor</label>
                      <div class="col-md-8">
                        <div class="input-group">
                          <span class="input-group-addon">R$</span>
                          <input id="valor" name="valor" class="form-control" placeholder="" type="text">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
