<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TimerActivities */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="../../timer/web/js/easytimer.min.js" type="text/javascript"></script>
<script>
    $(function () {

        var timer = new Timer();
        $('.startButton').click(function () {
            timer.start();
        });
        $('.pauseButton').click(function () {
            timer.pause();
        });
        $('.stopButton').click(function () {
            timer.stop();
        });
        $('.resetButton').click(function () {
            timer.reset();
        });
        timer.addEventListener('secondsUpdated', function (e) {
            $('.values').html(timer.getTimeValues().toString());
        });
        timer.addEventListener('started', function (e) {
            $('.values').html(timer.getTimeValues().toString());
        });
        timer.addEventListener('reset', function (e) {
            $('.values').html(timer.getTimeValues().toString());
        });

        $('.bookCurrentButton').click(function () {
            var discription = $('#taskDescriptionFromTimerText').val();
            var time = timer.getTimeValues().toString();
            if (discription == "" || discription.length == 0 || discription == null)
            {
                alert("Please Add a Discription");
                return false;
            }

            if (time === "00:00:00")
            {
                alert("Time Can not Be Zero");
                return false;
            }
            var values = {
                'activity_description': discription,
                'activity_time': time
            };
            $.ajax({
                url: '<?= Url::to(['timer-activities/create-from-current-time']) ?>',
                type: 'post',
                data: values,
                success: function (response) {
                    if (response)
                    {
                        timer.stop()
                        $('.values').html("00:00:00");
                        alert("Data Saved");
                    } else
                        alert("Something went wrong");
                }
            });
            return false;
        });

        $('.bookManualButton').click(function () {
            var discription = $('#taskDescriptionManualText').val();
            var time = $('#taskDateTimeText').val();
            if (discription == "" || discription.length == 0 || discription == null)
            {
                alert("Please Add a Discription");
                return false;
            }

            if (time === "00:00:00" || time == "" || time.length == 0 || time == null)
            {
                alert("Time Can not Be Zero");
                return false;
            }
            var values = {
                'activity_description': discription,
                'activity_time': time
            };
            $.ajax({
                url: '<?= Url::to(['timer-activities/create-manually']) ?>',
                type: 'post',
                data: values,
                success: function (response) {
                    if (response)
                    {
                        timer.stop()
                        $('.values').html("00:00:00");
                        alert("Data Saved");
                    } else
                        alert("Something went wrong");
                }
            });
            return false;
        });
    });
</script>

<div class="timer-activities-form">

    <div class="jumbotron">
        <h1><div id="basicUsage" class="values">00:00:00</div></h1>

        <p class="lead">Welcome to the Timenizer The best Timer on the web</p>

        <p><a class="btn btn-lg btn-success" href="https://www.linkedin.com/in/anas-dawood-6755521b/">Created by Anas Daoud</a></p>
        <div class="row">
            <div class="col-lg-3">
                <p><button class="startButton btn btn-success btn-lg">Start</button></p>
            </div>
            <div class="col-lg-3">
                <p><button class="pauseButton pauseButton btn btn-primary btn-lg" >Pause</button></p>
            </div>
            <div class="col-lg-3">
                <p> <button class="stopButton btn btn-danger btn-lg">Stop</button></p>
            </div>
            <div class="col-lg-3">
                <p><button class="resetButton resetButton btn btn-warning btn-lg">Reset</button></p>
            </div>
        </div>
    </div>

    <div class="body-content">        
        <div class="row">
            <div class="col-lg-3">
                <p><input type="text" id="taskDescriptionFromTimerText" class="input-lg" placeholder="Task Description"></p>
            </div>
            <div class="col-lg-3">
                <p><button class="bookCurrentButton btn btn-warning btn-lg" >Book Current Time</button></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <p><input type="text" id="taskDescriptionManualText" class="input-lg"  placeholder="Task Description"></p>
            </div>
            <div class="col-lg-3">
                <p><?php
                    echo DateTimePicker::widget([
                        'id' => 'taskDateTimeText',
                        'name' => 'taskDateTimeText',
                        'options' => ['placeholder' => 'Select Time'],
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-MM-dd HH:i:ss',
                            'startDate' => '01-Mar-2014 12:00 AM',
                            'todayHighlight' => true
                        ]
                    ]);
                    ?></p>
            </div>
            <div class="col-lg-3">
                <p><button class="bookManualButton btn btn-warning btn-lg">Book Manually</button></p>
            </div>
        </div>

    </div>



</div>
