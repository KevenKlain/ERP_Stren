<!DOCTYPE html>
<?php 

echo "<script>console.log(".$_SESSION['id_usuario'].");</script>"

?>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="./src/css/bootstrap.min.css">
        <title>Stren</title>
        <script src="https://use.fontawesome.com/e506c26381.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <img src="./src/img/logo.png" width=100 height=49>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="?page=saleConsult">Pedido</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="?page=productConsult">Produto</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="?page=clientConsult">Cliente</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="?page=saleRelatorio">Relatório de Venda</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Sair</a>
              </li>
            </ul>
          </div>
        </nav>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <?php
                        include("./src/config/config.php");

                        switch (@$_REQUEST["page"]) {
                            //concessionaria
                            case 'productConsult':
                              include("./pages/Product/productConsult.php");
                            break;
                            case 'productRegister':
                              include("./pages/Product/productRegister.php");
                            break;
                            case 'productEdit':
                              include("./pages/Product/productEdit.php");
                            break;
                            case 'productSave':
                              include("./pages/Product/productSave.php");
                            break;
                            
                            //cliente
                            case 'clientRegister':
                              include("./pages/Client/clientRegister.php");
                            break;
                            case 'clientConsult':
                              include("./pages/Client/clientConsult.php");
                            break;
                            case 'clientEdit':
                              include("./pages/Client/clientEdit.php");
                            break;
                            case 'clientSave':
                              include("./pages/Client/clientSave.php");
                            break;
                            
                            //sale
                            case 'saleRegister':
                              include("./pages/Sale/saleRegister.php");
                            break;
                            case 'saleConsult':
                              include("./pages/Sale/saleConsult.php");
                            break;
                            case 'saleEdit':
                              include("./pages/Sale/saleEdit.php");
                            break;
                            case 'saleSave':
                              include("./pages/Sale/saleSave.php");
                            break;

                            //item
                            case 'itemSale':
                              include("./pages/Item/itemSale.php");
                            break;
                            case 'itemSave':
                              include("./pages/Item/itemSave.php");
                            break;
                            case 'itemEdit':
                              include("./pages/Item/itemEdit.php");
                            break;
                            case 'saleSave':
                              include("./pages/Sale/saleSave.php");
                            break;

                            case 'saleRelatorio':
                              include("./pages/Relatorio/saleRelatorio.php");
                            break;
                             
                            default:
                               include("./pages/Product/productConsult.php");
                        }   
                    ?>
                </div>
            </div>
        </div>


        <script src="./src/js/jquery-3.5.1.slim.min.js"></script>
        <script src="./src/js/bootstrap.bundle.min.js"></script>

    </body>
</html>