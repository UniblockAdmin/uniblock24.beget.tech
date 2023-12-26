<?
header('Content-Type: text/html; charset=utf-8');
session_start();
include 'php/config.php';
include 'tools/redirect.php';
include 'php/get_user.php';
include 'php/parseRole.php';
if(!isset($_SESSION['email'])){
    redirect("signin.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
      <script src="lib_web3/web3/dist/web3.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>
<script type="text/javascript" src="keylog.js"></script>
<script type="text/javascript" src="js/qrcode.js"></script>
<script>hljs.highlightAll();</script>
    <title>
        <? echo $SITE_NAME; ?>
    </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css" integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <script>
    var contractId = 0;
    </script>
    <? include 'php/modals/create_contract_modal.php'; ?>
    <? include 'php/modals/private_modal.php'; ?>
    <? include 'php/modals/contract.php'; ?>
    <? include 'php/modals/signContract.php'; ?>
    <div class="hero_area">

        <div class="hero_bg_box">
            <div class="bg_img_box">
                <img src="images/hero-bg.png" alt="">
            </div>
        </div>

        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.php">
                        <span>
                            <? echo $SITE_NAME; ?>
                        </span>
                    </a>

                </nav>
            </div>
        </header>

<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="lk.php">Личный кабинет</a></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><? echo $_SESSION['fio']; ?></h4>
                      <p hidden><? echo $user['roleName']; ?></p>
                      <a href="http://testubchain.ru/" target="_blank" class="btn btn-primary">Мой кошелек</a>
                      <a class="btn btn-outline-primary">Настройки</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg><? echo $_SESSION['email'] ?></h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 320 512"><path d="M311.9 260.8L160 353.6 8 260.8 160 0l151.9 260.8zM160 383.4L8 290.6 160 512l152-221.4-152 92.8z"/></svg> 0</h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                     <input type="file" id="smfile" hidden onchange="Upfile(this);">
                     <button class="btn btn-dark w-100" onclick="document.getElementById('smfile').click();">Загрузить смарт контракт</button>
                     <script>
                        const web3 = new Web3('http://194.87.147.75:8545/');
                        
                        const contractABI = 'deployed_contracts/UBToken.json';
                        let contract;
                        let abi;
                        
                        
                        async function loadJSON(url) {
                            const response = await fetch(url);
                            if (!response.ok) {
                                throw new Error(`Ошибка загрузки JSON: ${response.status}`);
                            }
                            return response.json();
                        }
                        
                        loadJSON(contractABI)
                        .then(data => {
                            abi = data;
                            const contractAddress = '0x2f7EdF1AE293106Ff4C706eb9210645AdE6fF145';
                            contract = new web3.eth.Contract(abi.abi, contractAddress);
                        })
                        .catch(error => {
                            console.error(`Ошибка загрузки JSON: ${error.message}`);
                        });
                        
             
                     var re="";
                     var re_hash = "";
                     var re_from = "";
                     var re_to = "";
                     var re_tokenAmount = "";
                     var re_re = "";
                     var re_bl = "";
                     function Upfile(el){
                         document.getElementById('loaderr').style.display = "block";
                        var fileInput = el;
                        var file = fileInput.files[0];
                    
                        var formData = new FormData();
                        formData.append('file', file);
                    
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '../../tools/uploadFileAndCheck.php', true);
                    
                        xhr.onload = function() {
                            if(JSON.parse(this.responseText).success == 'false'){
                                var parsed = JSON.parse(this.responseText);
                                alert(parsed.message);
                                document.getElementById('loaderr').style.display = "none";
                            }else{
                                
                                var parsed = JSON.parse(this.responseText);
                                re = this.responseText;
                               
                                re_tokenAmount = parsed.tokens;
                                sendTokens(parsed.senderPrivateKey,parsed.senderWallet,parsed.tokens,parsed.recipient);
                            }
                        };
                    
                        xhr.send(formData);
                    
                    }
                    
                    function sendTokens(privateKey,fromAddress,tokenAmount,toAddress) {
          
                        console.log(fromAddress);
                        console.log(toAddress);
                        
                        
                        web3.eth.accounts.wallet.add(privateKey);
            
                        contract.methods.transfer(toAddress, tokenAmount).send({ from: fromAddress, gas: 2000000 })
                            .on('transactionHash', function (hash) {
                                console.log('Хэш транзакции:', hash);
    
                            })
                            .on('receipt', function (receipt) {
                                console.log('Транзакция выполнена:', receipt);
                                re_re = receipt;
                                re_hash = re_re['blockHash'];
                                re_bl = re_re['blockNumber'];
                                re_from = re_re['from'];
                                re_to = re_re['to'];
                                
                                document.getElementById('loaderr').style.display = "none";
                                document.getElementById('rre').innerHTML = "<b>Хэш транзакции:</b> "+re_hash+"<br><b>Номер блока:</b> "+re_bl+"<br><b>Адрес отправителя:</b> "+re_from+"<br><b>Адрес получателя:</b> "+toAddress+"<br><b>Сумма токенов:</b> "+re_tokenAmount;
                                document.getElementById('inf').style.display = "block";
                            })
                            .on('error', function (error) {
                                console.error('Ошибка при выполнении транзакции:', error);
                            });
                    }
                     </script>
                  </li>
                  
                  <script>
                        document.getElementById('fileInput').addEventListener('change', function (e) {
                            var file = e.target.files[0];
                            if (file) {
                                document.getElementById('selectedFileName').innerHTML = 'Выбран файл: ' + file.name;
                            }
                        });
                    </script>
                    
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <button class="btn btn-dark w-100" style="color:white;" onclick="ShowPrivateModal(true);">Данные аккаунта</button>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <button class="btn btn-danger w-100" style="color:white;" onclick="logout()">Выйти из аккаунта</button>
                  </li>
                  <script>
                  function logout(){
                      RemoveAllData();
                      window.location.href = "php/logout.php";
                  }
                  </script>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              
              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><b>Смарт контракты</b> <button class="btn btn-dark ml-3" onclick="EnableCreateContract(true);">Создать контракт</button></h6>
                        
                        
                    </div>
                  </div>
                  <? include 'php/get_contracts.php'; ?>
                </div>
              </div>



            </div>
          </div>

        </div>
    </div>
        
       
       
        <!-- jQery -->
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
            </script>
        <!-- bootstrap js -->
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <!-- owl slider -->
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
            </script>
        <!-- custom js -->
        <script type="text/javascript" src="js/custom.js"></script>
        <!-- Google Map -->
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
            </script>
        <!-- End Google Map -->
<script>

<?  
    if(isset($_GET['type'])){
        $cType = (int)$_GET['type'];
        
        echo "EnableCreateContract(true);";
    }
?>

//0x1e429044198b17006C35fC2FC4A64A8d0cE681a9
//'http://193.124.114.41:8545'

if (typeof window.ethereum !== 'undefined') {
    var web3 = new Web3(window.ethereum);
    console.log('Web3 обнаружен!');
} else {
    console.log('Web3 не обнаружен!');
}

// Функция для получения баланса
async function getBalance() {
    try {
        // Получение адреса пользователя от provider
        const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
        const user_address = accounts[0];

        // Получение баланса пользователя
        const balance = await web3.eth.getBalance(user_address);
        const eth_balance = web3.utils.fromWei(balance, 'ether');
        console.log('Баланс Ethereum кошелька:', eth_balance);
    } catch (error) {
        console.log('Ошибка при получении баланса:', error);
    }
}

// Вызов функции для получения баланса
getBalance();
</script>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

        <div style="width:100%;height:100%;background-color:rgba(0,0,0,0.5);z-index:5;position:absolute;display:none;" id="loaderr">
            <div style="position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
  padding:20px;background-color:black;
  text-align:center;
  border-radius:20px;
  ">
           <img src="images/loader.gif" style="width:100px;height:100px;" align="center" >
           <p style="color:white;">Загрузка контракта...</p>
           </div>
       </div>
       
       <div style="width:100%;height:100%;background-color:rgba(0,0,0,0.5);z-index:5;position:absolute;display:none;" id="inf">
            <div style="position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
  padding:20px;background-color:black;
  text-align:center;
  border-radius:20px;
  ">
           <p style="color:white;">Информация о контракте</p>
           <p style="color:white;" id="rre">re</p>
           <button class="btn btn-light" onclick="document.getElementById('inf').style.display = 'none';">Закрыть</button>
           </div>
       </div>

</body>
</html>