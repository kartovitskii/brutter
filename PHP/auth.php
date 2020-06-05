<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brutter | Авторизация</title>
    
    <link rel="stylesheet" href="assets/styles/main.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="reg-container">
        <div class="reg-logo">
            <img src="assets/images/reg-logo.svg">
        </div>
        <div class="reg-input-container">
        <form method="post">
            <label for="email">Email</label>
            <input type="text" id="email" class="reg-input">
        </div>
        <div class="reg-input-container">
            <label for="password">Пароль</label>
            <input id="password" type="password" class="reg-input">
        </div>
        <input type="submit" class="reg-button" value="Войти" id="button" /> 
        </form>
        <br>
        <a href="/reg.php" class="reg-auth">Зарегистрироваться</a>
    </div>

    <script>
    jQuery(document).ready(function() {
            //
            jQuery("#button").bind("click", function() {

                    let email = jQuery('#email').val();
                    let password = jQuery('#password').val();

                    jQuery('#email').val('');
                    jQuery('#password').val('');

                    jQuery.ajax({
                        url: "actions/auth.php",
                        type: "POST",
                        data: {email:email, password:password},
                        dataType: 'json',
                        success: function(result) {
                            if (result === 1) {
                                console.log('Вы успешно авторизовались');
                                document.location.href = "/";
                            } else {
                                alert('Возможно допущена ошибка или вы не зарегистрированы!');
                            }
                           
                        }
                    }) 
                return false;
                })
    })
 </script>

    <script src="assets/scripts/main.js"></script>

    <?
include 'actions/preload.php'; 
?>
</body>
</html>

