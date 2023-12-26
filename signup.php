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
                        <h5 class="modal-title">Регистрация</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fio">Ф.И.О</label>
                            <input type="type" class="form-control" id="fio" placeholder="Иванов Иван Иванович">
                        </div>
                        <div class="form-group">
                            <label for="email">Эл. почта</label>
                            <input type="email" class="form-control" id="email" placeholder="ivanov@mail.ru">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" placeholder="*********">
                        </div>
                        <div class="form-group">
                            <label for="password_retry">Повторите пароль</label>
                            <input type="password" class="form-control" id="password_retry" placeholder="*********">
                        </div>
                        
                    </div>
                    <div class="modal-footer" style="display:inline;">
                        <button type="button" class="btn btn-primary w-100" onclick="SignUp();">Зарегистрироваться</button>
                        <p class="text-center my-3">У меня уже есть аккаунт. <a href="signin.php" class="link">Войти</a></p>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function SignUp(){
            var name = document.getElementById('fio').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var password_retry = document.getElementById('password_retry').value;
            
            if(name.length < 1 || email.length < 1 || password.length < 1 || password_retry.length < 1){
                alert("Заполните все поля!");
                return;
            }
            
            if(password!=password_retry){
                alert("Вы ввели неверный повторный пароль. Проверьте данные и попробуйте еще раз.");
                return;
            }
            
            $.post('/php/db_register.php', { fio: name, email : email, password : password}, function(data){
                console.log(data);
                alert("Вы успешно зарегистрировались!");
            });
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

</body>

</html>