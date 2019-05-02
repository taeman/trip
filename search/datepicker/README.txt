การเรียกใช้ DatePicker
=====================
###ไฟล์ที่ต้องเรียก
```html
  <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
  <script src="jquery-ui/external/jquery/jquery.js"></script>
  <script src="jquery-ui/jquery-ui-thai.js"></script>
  <script src="datepicker.js"></script>
```
###ตัวอย่างเรียกใช้ 1 input
```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Datepicker</title>
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/external/jquery/jquery.js"></script>
    <script src="jquery-ui/jquery-ui-thai.js"></script>
    <script src="datepicker.js"></script>
    <script>
        $(document).ready(function () {
            var date = new DatePickOne("date");
            date.Create();           
        });
    </script>
</head>
<body>
<input type="text" name="date" id="date">
</body>
</html>
```
###ตัวอย่างเรียกใช้ 2 input
```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Datepicker</title>
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/external/jquery/jquery.js"></script>
    <script src="jquery-ui/jquery-ui-thai.js"></script>
    <script src="datepicker.js"></script>
    <script>
        $(document).ready(function () {
            var date = new DatePickTwo("date1","date2");
            date.Create();
        });
    </script>
</head>
<body>
<input type="text" name="date1" id="date1">
<input type="text" name="date2" id="date2">
</body>
</html>
```
###การตั้งค่าเพิ่มเติม

-กำหนดปีเป็น พ.ศ. หรือ ค.ศ
```js
date.regional = "TH"; //พ.ศ. ค่าเริ่มต้น 
date.regional = "EN"; //ค.ศ
```
-กำหนดรูปแบบ
```js
date.format = "dd/mm/yyyy"; //ค่าเริ่มต้น 
date.format = "yyyy/mm/dd";
date.format = "dd/mm/yy";
date.format = "yy/mm/dd"; 
date.format = "dd-mm-yyyy";
date.format = "dd-mm-yy"; 
date.format = "yyyy-mm-dd";
date.format = "yy-mm-dd";
```
-กำหนดวันที่สามารถเลือกได้น้อยสุด
```js
date.mindate = null;//ค่าเริ่มต้น 
date.mindate = new Date('2000/10/25'); //ย้อนหลังไม่เกิน 2000/10/25
date.mindate = "-10"; //ย้อนหลังจากวันปัจจุบัน 10วัน
date.mindate1 = "-10"; //ย้อนหลังจากวันปัจจุบัน 10วัน กรณี 2 input
date.mindate2 = "-10"; //ย้อนหลังจากวันปัจจุบัน 10วัน กรณี 2 input
```
-กำหนดวันที่สามารถเลือกได้มากที่สุด
```js
date.maxdate = null;//ค่าเริ่มต้น
date.maxdate = "+10"; //อนาคตจากวันปัจจุบัน 10วัน
date.maxdate = "+10"; //อนาคตจากวันปัจจุบัน 10วัน
date.maxdate1 = "+10"; //อนาคตจากวันปัจจุบัน 10วัน กรณี 2 input
date.maxdate2 = "+10"; //อนาคตจากวันปัจจุบัน 10วัน กรณี 2 input
```
-กำหนดกระทำเมื่อมีการเลือกวันที่
```js
date.onselect = null; //ค่าเริ่มต้น 
date.onselect = function(date){alert(date)}; //ใส่การกระทำเมื่อมีการเลือกวันที่
date.onselect1 = function(date){alert(date)}; //ใส่การกระทำเมื่อมีการเลือกวันที่ กรณี 2 input
date.onselect2 = function(date){alert(date)}; //ใส่การกระทำเมื่อมีการเลือกวันที่ กรณี 2 input
```
-กำหนดให้พิมพ์ได้หรือไม่
```js
 date.readonly = false; //ค่าเริ่มต้น 
 date.readonly = true; 
```
-กำหนดรูปแบบแจ้งเตือน
```js
 date.swal = false; //ค่าเริ่มต้น 
 date.swal = true; //ใช้ sweetalert จำเป็นต้องเรียก Libraryสำหรับ sweetalert เพิ่ม
 <link rel="stylesheet" href="../../../common/global/sweetalert/dist/sweetalert.css" type="text/css">
 <script src="../../../common/global/sweetalert/dist/sweetalert.min.js"></script>
```