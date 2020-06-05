<!---->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brutter | Регистрация</title>
    
    <link rel="stylesheet" href="assets/styles/main.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="reg-container">
        <div class="reg-logo">
            <img src="assets/images/reg-logo.svg">
        </div>

        <form method="post" action="#">
        <div class="reg-input-container">
            <label for="firstgName">Имя</label>
            <input id="firstName" type="text" class="reg-input">
        </div>
        <div class="reg-input-container">
            <label for="lastName">Фамилия</label>
            <input id="lastName" type="text" class="reg-input">
        </div>
        <div class="reg-input-container">
            <label for="email">Email</label>
            <input id="email" type="text" class="reg-input">
        </div>
        <div class="reg-input-container">
            <label for="selectGroup">Группа</label>
            <select class="reg-input" id="selectGroup"></select>
        </div>
        <div class="reg-input-container">
            <label for="password">Пароль</label>
            <input id="password" type="password" class="reg-input">
        </div>
        <div class="reg-input-container">
            <label for="password2">Повтроите пароль</label>
            <input id="password2" type="password" class="reg-input">
        </div>
        <input type="submit" value="Отправить" class="reg-button" id="button"> 
        </form>
        <br>
        <a href="/auth.php" class="reg-auth">Уже зарегистрированы?</a>
    </div>

    <script src="assets/scripts/main.js"></script>

    <script>
        jQuery(document).ready(function() {
            //
            jQuery("#button").bind("click", function() {
                    if($('#password').val() === $('#password2').val() && $('#password').val().length > 6) {

                    let firstName = jQuery('#firstName').val();
                    let lastName = jQuery('#lastName').val();
                    let email = jQuery('#email').val();
                    let group = jQuery('#selectGroup').val();
                    let password = jQuery('#password').val();

                    jQuery('#firstName').val('');
                    jQuery('#lastName').val('');
                    jQuery('#email').val('');
                    jQuery('#password').val('');
                    jQuery('#password2').val('');

                    jQuery.ajax({
                        url: "actions/register.php",
                        type: "POST",
                        data: {firstName:firstName, lastName:lastName, email:email, group:group, password:password},
                        dataType: 'json',
                        success: function(result) {
                            console.log('Вы успешно зарегистрировались, ' + result.firstName);
                        }
                    }) 
                } else {
                    alert('Пароль короче 6 символов или пароли не совпадают!');
                }
                return false;
                })
            //
                jQuery.ajax({
                    url: "actions/getGroups.php", 
                    type: "GET",
                    success: function(groups) {
                        jQuery('#selectGroup').append(function() { 
                        let res = "";
                        for(let i = 0; i < groups.name.length; i++) {
                            res += "<option>" + groups.number[i] + " " + groups.name[i] + "</option>";
                        }
                        return res;
                    })
                    }
                })
              

        })
    </script>

<?
include 'actions/preload.php'; 
?>
</body>
</html>
