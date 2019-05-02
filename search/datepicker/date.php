<?php
/**
 * @comment
 * @projectCode
 * @tor
 * @package core
 * @author Peerasak Sane(ZenTBelL)
 * @access private
 * @created 14/3/2559
 */
header("content-type: text/html; charset=UTF-8"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/external/jquery/jquery.js"></script>
    <script src="jquery-ui/jquery-ui-thai.js"></script>
    <script src="datepicker.js"></script>

    <script>
        $(document).ready(function () {
            var date3 = new DatePickOne("date3");
            date3.readonly = false;
            date3.format = "dd-mm-yyyy";
            date3.onselect = function(date){
                alert(date);
            };
            date3.Create();
            var date2 = new DatePickTwo("date1","date2");
            date2.Create();
        });
    </script>
</head>
<body>
<input type="text" name="date1" id="date1" style="cursor: pointer !important;">
<input type="text" name="date2" id="date2">
<input type="text" name="date3" id="date3">
</body>
</html>
