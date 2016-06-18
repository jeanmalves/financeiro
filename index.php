
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

    <style>
        .valor-debito{
            color: red;
        }
        .valor-credito{
            color: blue;
        }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="js/jquery-3.0.0.min.js"></script>
    

    <script type="text/javascript">
        $(document).ready(function(){
            $.getJSON('model/30dias.php',function(dados){
                console.log(dados);
                
                var total = 0;
                $(dados).each(function(ind, elem){
                    var classValor = (elem.tipo == "C")? 'valor-credito':'valor-debito';
                    
                    total = (elem.tipo == "C")? total + elem.valor : total - elem.valor;
                    
                    var tr = $('<tr>'+
                        '<td>'+elem.data+'</td>'+
                        '<td>'+elem.descricao+'</td>'+
                        '<td>'+elem.categoria+'</td>'+
                        '<td>'+elem.tipo+'</td>'+
                        '<td class="'+classValor+'">R$ '+elem.valor+'</td>'+
                      '</tr>');
        
                    $('#rel-30dias tbody').append(tr);
                    $('#valor-total').html(total);
                });
                
                
        
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
          <h1 class="page-header">Painel</h1>

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

    
  </body>
</html>
