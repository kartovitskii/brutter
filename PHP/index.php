<? if($_COOKIE['id'] == null) {
    header('Location: /auth.php');
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/styles/main.css">
    <title>Brutter | Главная страница</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
      </div>
</form>
  </div>
</div>




    <div class="main-container">
        <div class="menu">
        <a onclick="openSupport()" data-toggle='modal' data-target='#exampleModal' class="menu-link"><i style="color: #fff;" class="fas fa-headphones"></i></a>
        <a href="/actions/deleteCookie.php" class="menu-link2"><i class="fas fa-times-circle"></i></a>
        </div>
        <div class="main-contant">
            <div class="row">
                <div class="col-4">
                    <p style="font-weight: 600; font-size: 14px; color: #100F0F; margin-bottom: 10px;">Профиль и успеваемость</p>
                <div class="cnt">
                    <div class="row">
                        <div class="col">
                            <div class="ava"></div>
                        </div>
                        <div class="col-8">
                        <div id="student"></div>
                        <div id="group"></div>
                        <div id="supertest" class="mark-title">Средний балл</div><div id="mark"></div>
                        </div>
                    </div>
                </div>
                <p style="font-weight: 600; font-size: 14px; color: #100F0F; margin-bottom: 10px;">График успеваемости</p>
                <div class="cnt"><!---->
                
                <canvas id="myChart" width="400" height="400"></canvas>
<script>
    let datesq = []; let marksq = [];
                jQuery.ajax({
                    url: "actions/getSrMark.php", 
                    type: "GET",
                    success: function(marks) {
                        let res = '';
                        for(let i = 0; i < marks.mark.length; i++) {
                            if(marks.date[i].split('.')[1] === '06' && marks.date[i].split('.')[2] === '2020') {
                                datesq.push(marks.date[i]);
                            marksq.push(marks.mark[i]); 
                            }
                        }
                        var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: datesq,
        datasets: [{
            label: 'Успеваемость',
            data: marksq,
            backgroundColor: [
                'rgba(255, 196, 0, 0.2)'
            ],
            borderColor: [
                'rgba(255, 196, 0, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
                    }
                    })     

</script>
                
                <!----></div>

                <p style="font-weight: 600; font-size: 14px; color: #100F0F; margin-bottom: 10px;">Оценки</p>
                <div class="cnt">
                    <div id="spisokMarks"></div>
                </div>
                </div>
                <div class="col">
                <p style="font-weight: 600; font-size: 14px; color: #100F0F; margin-bottom: 10px;">Задания и тесты</p>
                <div id="tests"></div>
                </div>
            </div>
        </div>
    </div>



    <script>
        let countQ = '';
                function endTest(id) {
                    let ansArr = [];
                    for(let i = 0; i < countQ; i++) {
                        let test = 'quest1' + i;
                        ansArr.push(
                            $("label[for="+ $('input[name=quest1'+ i +']:checked')[0].id +"]")[0].innerHTML
                        );
                    }
                    $.ajax({
                        url: "actions/postQuest.php",
                        type: "POST",
                        data: {id: id, ansArr: ansArr},
                        dataType: 'json'
                    })
                }
                function sendToModal(id) {
                $('.modal-body').children().remove();
                $('.modal-footer').children().remove();
            $.ajax({
                url: "actions/getQuest.php", 
                    type: "POST",
                    data: {id: id},
                    dataType: 'json',
                    success: function(quests) {
                        jQuery('.modal-body').append(function() {
                            let res = '';
                            countQ = quests.title.length;
                            for(let i = 0; i < quests.title.length; i++) {
                                res += "<div id='q"+ i +"' class='alert alert-light' role='alert'><div class='alert alert-secondary' role='alert'><p style='font-weight: bold'>Вопрос №" + Number(i+1) + "</p>" + "<p>" + quests.description[i] + "</p></div><input name='quest1" + i + "' type='radio' id='que1" + i + "'> <label name='quest1" + i + "' for='que1" + i + "'>" + quests.ans1[i] + "</label> <br> <input name='quest1" + i + "' type='radio' id='que2" + i + "'> <label name='quest1" + i + "' for='que2" + i + "'>" + quests.ans2[i] + "</label> <br> <input name='quest1" + i + "' type='radio' id='que3" + i + "'> <label name='quest1" + i + "' for='que3" + i + "'>" + quests.ans3[i] + "</label> <br> <input name='quest1" + i + "' type='radio' id='que4" + i + "'> <label name='quest1" + i + "' for='que4" + i + "'>" + quests.ans4[i] + "</label></div>";
                            }
                            return res;
                        })
                        $('.modal-footer').append(function(){
                            return "<button onclick='endTest(" + id + ")' type='submit' class='btn btn-primary'>Завершить</button>"
                        })
                    }
            })
        }

        function openSupport() {
                $('.modal-body').children().remove();
                $('.modal-footer').children().remove();
                jQuery('.modal-body').append(function() {
                            let res = '';
                            res += "<h5>Обратная связь</h5>"
                            res += "<form method='post' action='#'><div class='reg-input-container'>"
                            res += "<label style='top: 16px;' for='theme'>Тема</label><input id='theme' type='text' class='reg-input'></div>"
                            res += "<div class='reg-input-container'>"
                            res += "<label style='top: 16px;' for='problem'>Ваш вопрос</label><input id='problem' type='text' class='reg-input'></div>"
                            res += "<input onclick='sendSupport()' style='margin: auto; display: block; margin-top: 30px; margin-bottom: 10px;' value='Отправить' class='reg-button' id='button'></form>"
                            return res;
                        })
        }

 
        function sendSupport() {
                     let theme = jQuery('#theme').val();
                     let problem = $('#problem').val();
                jQuery.ajax({
                        url: "actions/sendSup.php",
                        type: "POST",
                        data: {theme:theme, problem:problem},
                        dataType: 'json'
        })
        alert('Ваше обращение принято!');
        location.href=location.href;
                }

        function sendToModalLess(id) {
                $('.modal-body').children().remove();
                $('.modal-footer').children().remove();
            $.ajax({
                url: "actions/getQuest.php", 
                    type: "POST",
                    data: {id: id},
                    dataType: 'json',
                    success: function(quests) {
                        jQuery('.modal-body').append(function() {
                            let res = '';
                            for(let i = 0; i < quests.vtitle.length; i++) {
                                res += "<h5>" + quests.vtitle[i] + "</h5><br><iframe style='margin: auto;' width='100%' height='300' src='" + quests.vurl[i] + "' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe><br><br><p>" + quests.vdescription[i] + "</p>";
                            }
                            return res;
                        })
                    }
            })
        }

        
    $(document).ready(function() {
        jQuery.ajax({
                    url: "actions/getTests.php", 
                    type: "GET",
                    success: function(tests) {
                        jQuery('#tests').append(function() { 
                        let res = "";
                        if (tests.vtitle != undefined) {
                       for(let ind = 0; ind < tests.vtitle.length; ind++) {
                            res += "<div onclick='sendToModalLess(" + tests.vid[ind] + ")' class='cnt'><div class='status-test-yellow'>Видеоурок</div><p><a href='#' data-toggle='modal' data-target='#exampleModal' style='color: #68A1B9; font-size: 16px;'>" + tests.vtitle[ind] + "</a> <br><p style='opacity: 0.6; font-size: 12px; font-weight: 300; margin-bottom: -10px; margin-top: 0px;'></p></div>";
                        }
                        }
                        for(let i = 0; i < tests.name.length; i++) {

                            let nameText = 'Не выполнено';

                            if (tests.status === undefined) {
                                nameText = 'Не выполнено'
                            } else {

                                for (let mb = 0; mb < tests.status.length; mb++) {
                                    if (tests.testId[mb] === tests.id[i]) {
                                        nameText = tests.status[mb];
                                    } else {
                                        nameText = 'Не выполнено';
                                    }
                                }
                            }
                        if(nameText === 'Проверяется') { // В данный момент только два статуса, в будущем возможна реализация третьегло статуса и соответсвенно тестов с ручной проверкой
                            res += "<div onclick='sendToModal(" + tests.id[i] + ")' class='cnt'><div class='status-test-yellow'>Проверяется</div><p><a href='#' data-toggle='modal' data-target='#exampleModal' style='color: #68A1B9; font-size: 16px;'>" + tests.name[i] + "</a> <br><p style='opacity: 0.6; font-size: 12px; font-weight: 300; margin-bottom: -10px; margin-top: 0px;'><i style='opacity: 0.36;' class='fas fa-clock'></i>  " + tests.timer[i] + " минут</p></div>";
                        } else if (nameText === 'Выполнено') {
                            res += "<div onclick='sendToModal(" + tests.id[i] + ")' class='cnt'><div class='status-test-green'>Выполнено</div><p><a style='color: #212529; font-size: 16px;'>" + tests.name[i] + "</a> <br><p style='opacity: 0.6; font-size: 12px; font-weight: 300; margin-bottom: -10px; margin-top: 0px;'><i style='opacity: 0.36;' class='fas fa-clock'></i>  " + tests.timer[i] + " минут</p></div>";
                        } else {
                            res += "<div  onclick='sendToModal(" + tests.id[i] + ")' class='cnt'><div class='status-test-red'>Не выполнено</div><p><a href='#' data-toggle='modal' data-target='#exampleModal' style='color: #68A1B9; font-size: 16px;'>" + tests.name[i] + "</a> <br><p style='opacity: 0.6; font-size: 12px; font-weight: 300; margin-bottom: -10px; margin-top: 0px;'><i style='opacity: 0.36;' class='fas fa-clock'></i>  " + tests.timer[i] + " минут</p></div>";
                        }
                        }

                        return res;
                    })
                    }
        });

        jQuery.ajax({
                    url: "actions/getStudent.php", 
                    type: "GET",
                    success: function(user) {
                        jQuery('#student').append(function() { 
                        let res = "";
                        for(let i = 0; i < user.first_name.length; i++) {
                            res += "<p style='font-size: 18px; font-weight: 500;'>" + user.first_name[i] + " " + user.last_name[i] + "</p>";
                        }
                        return res;
                    })
                    }
        });
        jQuery.ajax({
                    url: "actions/getMyGroup.php", 
                    type: "GET",
                    success: function(groups) {
                        jQuery('#group').append(function() { 
                        let res = "";
                        for(let i = 0; i < groups.name.length; i++) {
                            res += "<p style='font-size: 12px; margin-top: -16px; font-weight: 300; opacity: 0.6;'> Группа " + groups.number[i] + "</p>";
                        }
                        return res;
                    })
                    }
                });
                jQuery.ajax({
                    url: "actions/getSrMark.php", 
                    type: "GET",
                    success: function(marks) {
                        jQuery('#mark').append(function() { 
                        let res = '';
                        for(let i = 0; i < marks.mark.length; i++) {
                            res = Number(res) + Number(marks.mark[i]);
                        }
                        res = Number(res / marks.mark.length).toFixed(1);
                        return res;
                    })
                    }
                })     
                jQuery.ajax({
                    url: "actions/getSrMark.php", 
                    type: "GET",
                    success: function(marks) {
                        jQuery('#spisokMarks').append(function() { 
                        let res = '';
                        for(let i = 0; i < marks.mark.length; i++) {
                            if(marks.mark[i] === '2') {
                                res += "<span style='color: #fff; display: inline-block; padding: 5px 0px; width: 22px; text-align: center; background: #FF3D00; margin: 5px;'>" + marks.mark[i] + "</span>";
                            } else if(marks.mark[i] === '3') {
                                res += "<span style='color: #fff; display: inline-block; padding: 5px 0px; width: 22px; text-align: center; background: #FFC502; margin: 5px;'>" + marks.mark[i] + "</span>";
                            } else if(marks.mark[i] === '4' || marks.mark[i] === '5') {
                                res += "<span style='color: #fff; display: inline-block; padding: 5px 0px; width: 22px; text-align: center; background: #00B512; margin: 5px;'>" + marks.mark[i] + "</span>";
                            }
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