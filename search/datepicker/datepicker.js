/**
 * Created by ZenTBelL on 14/3/2559.
 */
var image = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAVBJREFUSIljYBgIsPfw8ZN7Dh47ToL6c3sOHjuNTY4Fhx4zRiZGUtxkiEs9igUv+to7/p08VHodyn/uY/OfGNOvQeln4R5/mcztOyWKKqtgckzICv+eOlz2+9NHuNivv/8IGv7r7184+/enT0x/Tx2uwOkDpi+fGD//+sXA8OguA+N/BobPv34xCHNy4LXg86/fDAyP7jIw/PsPUf/lE0pYoXCe+9j8//X3H8PjT58ZGBkYGGT5eBhYmZkJ+ABTveSWI3BzMSKZjZmJQVmQH6+hpKhHseDm2/dEG0wsQAmiNx8+EpVqCAERAX64uUz4FFIDYLXg4uVrDBcvXyOLTZQF1AQDEwejQTSMg+jlm7f/mVlw1UHEgT9//jBIiAhjD6JHT599+vPnD0WGP3ry/AOyGIpzP3/4Gnf1w61ZDEwMYmTZ8O/fy/9MjKlku3BQAgApTcvZ43+XLQAAAABJRU5ErkJggg==";
function isValidDate(day, month, yeari, regional,swa) {
    var year = yeari;
    var monthName = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var monthNameTH = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
    if (regional == "TH") {
        year = yeari - 543;
    }
    if (day < 1 || day > 31) {
        if(swa==true){
            if (regional == "TH") {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "กรุณากรอกวันที่ระหว่าง 1 ถึง 31",
                    type: "error",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: true
                });
            }else {
                swal({
                    title: "ERROR!",
                    text: "Day must be between 1 and 31",
                    type: "error",
                    closeOnConfirm: true
                });
            }

        }
        else {
            if (regional == "TH") {
                alert("กรุณากรอกวันที่ระหว่าง 1 ถึง 31");
            }
            else {
                alert("Day must be between 1 and 31");
            }
        }
        return false;
    }
    if (month < 1 || month > 12) { // check month range
        if(swa==true){
            if (regional == "TH") {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "กรุณากรอกเดือนระหว่าง 1 ถึง 12",
                    type: "error",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: true
                });
            }else {
                swal({
                    title: "ERROR!",
                    text: "Month must be between 1 and 12",
                    type: "error",
                    closeOnConfirm: true
                });
            }

        }
        else {
            if (regional == "TH") {
                alert("กรุณากรอกเดือนระหว่าง 1 ถึง 12");
            }
            else {
                alert("Month must be between 1 and 12");
            }
        }
        return false;
    }
    if ((month == 4 || month == 6 || month == 9 || month == 11) && day == 31) {
        if(swa==true){
            if (regional == "TH") {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "เดือน " + monthNameTH[(month - 1)] + " มี30วัน",
                    type: "error",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: true
                });
            }else {
                swal({
                    title: "ERROR!",
                    text: "Month " + monthName[(month - 1)] + " doesn't have 31 days!",
                    type: "error",
                    closeOnConfirm: true
                });
            }

        }
        else {
            if (regional == "TH") {
                alert("เดือน " + monthNameTH[(month - 1)] + " มี30วัน");
            }
            else {
                alert("Month " + monthName[(month - 1)] + " doesn't have 31 days!");
            }
        }
        return false;
    }
    if (month == 2) { // check for february 29th
        var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
        if (day > 29 || (day == 29 && !isleap)) {
            if(swa==true){
                if (regional == "TH") {
                    swal({
                        title: "เกิดข้อผิดพลาด",
                        text: "เดือนกุมภาพันธ์ ปี" + (year+543) + " ไมีมีวันที่ " + day,
                        type: "error",
                        confirmButtonText: "ตกลง",
                        closeOnConfirm: true
                    });
                }else {
                    swal({
                        title: "ERROR!",
                        text: "February " + year + " doesn't have " + day + " days!",
                        type: "error",
                        closeOnConfirm: true
                    });
                }

            }
            else {
                if (regional == "TH") {
                    alert("เดือนกุมภาพันธ์ ปี" + (year+543) + " ไมีมีวันที่ " + day);
                }
                else {
                    alert("February " + year + " doesn't have " + day + " days!");
                }
            }
            return false;
        }
    }
    return true;  // date is valid
}
function checkDate(elem, format, regional,swa) {
    var datePat1 = /^(\d{2,2})(\/|-)(\d{2,2})\2(\d{4}|\d{4})$/; //dd/mm/yyyy
    var datePat2 = /^(\d{4}|\d{4})(\/|-)(\d{2,2})(\/|-)(\d{2,2})$/; //yyyy/mm/dd
    var matchArray = null;
    elem.bind('keyup', 'keydown', function () {
        if (format.length == elem.val().length) {
            if (format == "dd-mm-yyyy" || format == "dd/mm/yyyy") {
                //alert(elem.val());
                matchArray = elem.val().match(datePat1);
                //alert(matchArray);
                if (matchArray == null) {
                    if(swa==true){
                        if (regional == "TH") {
                            swal({
                                title: "เกิดข้อผิดพลาด",
                                text: "กรุณากรอกวันที่ให้ถูกต้อง",
                                type: "error",
                                confirmButtonText: "ตกลง",
                                closeOnConfirm: true
                            });
                        }else {
                            swal({
                                title: "ERROR!",
                                text: "date is valid",
                                type: "error",
                                closeOnConfirm: true
                            });
                        }

                    }
                    else {
                        if (regional == "TH") {
                            alert('กรุณากรอกวันที่ให้ถูกต้อง');
                        }else {
                            alert('date is valid');
                        }
                    }
                    elem.val('')
                }
                else {
                    if (!isValidDate(matchArray[1], matchArray[3], matchArray[4], regional,swa)) {
                        elem.val('')
                    }
                }
            }
            else if (format == "yyyy-mm-dd" || format == "yyyy-mm-dd") {
                //alert(elem.val());
                matchArray = elem.val().match(datePat2);
                //alert(matchArray);
                if (matchArray !== null) {
                    if(swa==true){
                        if (regional == "TH") {
                            swal({
                                title: "เกิดข้อผิดพลาด",
                                text: "กรุณากรอกวันที่ให้ถูกต้อง",
                                type: "error",
                                confirmButtonText: "ตกลง",
                                closeOnConfirm: true
                            });
                        }else {
                            swal({
                                title: "ERROR!",
                                text: "date is valid",
                                type: "error",
                                closeOnConfirm: true
                            });
                        }

                    }
                    else {
                        if (regional == "TH") {
                            alert('กรุณากรอกวันที่ให้ถูกต้อง');
                        }else {
                            alert('date is valid');
                        }
                    }
                    elem.val('')
                }else {
                    if (!isValidDate(matchArray[5], matchArray[3], matchArray[0], regional,swa)) {
                        elem.val('')
                    }
                }
            }
        }
    });
    /*elem.blur(function () {
        if (format.length == elem.val().length) {
            if (format == "dd-mm-yyyy" || format == "dd/mm/yyyy") {
                matchArray = elem.val().match(datePat1);
                 alert(matchArray);
                if (matchArray == null) {
                    alert('กรุณากรอกวันที่ให้ถูกต้อง');
                }
                else {
                    if (!isValidDate(matchArray[1], matchArray[3], matchArray[4], regional)) {
                        elem.val('')
                    }
                }
            }
            else if (format == "yyyy-mm-dd" || format == "yyyy-mm-dd") {
                matchArray = elem.val().match(datePat2);
                 alert(matchArray);
                if (matchArray !== null) {

                    alert('กรุณากรอกวันที่ให้ถูกต้อง');
                }else {
                    if (!isValidDate(matchArray[5], matchArray[3], matchArray[0], regional)) {
                        elem.val('')
                    }
                }
            }
        }
        else {
            alert('กรุณากรอกวันที่');
        }
    });*/
}
function dateAdj(elem, format) {
    var slash1 = format.indexOf("/");
    var slash2 = format.lastIndexOf("/");
    var minus1 = format.indexOf("-");
    var minus2 = format.lastIndexOf("-");
    var type = '';
    var first = '';
    var last = '';
    if (slash1 != -1 && slash2 != -1) {
        type = '/';
        first = slash1;
        last = slash2;
    }
    else if (minus1 != -1 && minus2 != -1) {
        type = '-';
        first = minus1;
        last = minus2;
    }
    //Put our input DOM element into a jQuery Object
    var $jqDate = elem;
    //Bind keyup/keydown to the input
    $jqDate.bind('keyup', 'keydown', function (e) {
        //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
        if (e.which !== 8) {
            var numChars = $jqDate.val().length;
            if (numChars === first || numChars === last) {
                var thisVal = $jqDate.val();
                thisVal += type;
                $jqDate.val(thisVal);
            }
        }
    });
}
function chgFormat(format) {
    var result = format;
    var patt = /yyyy/g;
    var patt2 = /yy/g;
    if (patt.test(format)) {
        result = format.replace("yyyy", "yy");
    }
    else if (patt2.test(format)) {
        result = format.replace("yy", "y");
    }
    return result;
}
function placeholderTH(format) {
    var result = format.replace("yyyy", "ปปปป");
    result = result.replace("yy", "ปป");
    result = result.replace("mm", "ดด");
    result = result.replace("dd", "วว");
    return result
}
var DatePickOne = function DatePickOne(elem_id) {
    this.name = elem_id;
    this.regional = "TH";
    this.format = "dd/mm/yyyy";
    this.changeMonth = true;
    this.changeYear = true;
    this.buttonImg = true;
    this.defaultdate = null;
    this.mindate = null;
    this.maxdate = null;
    this.onselect = null;
    this.readonly = true;
    this.swal = false;
    this.placeholder = true;
    this.Create = function () {
        var date = $("#" + this.name);
        $.datepicker.setDefaults($.datepicker.regional[""]);
        if (this.regional != null) {
            date.datepicker($.datepicker.regional[this.regional]);
        }
        if (this.format != null) {
            date.datepicker("option", "dateFormat", chgFormat(this.format));
        }
        if (this.defaultdate != null) {
            date.datepicker("option", "defaultDate", this.defaultdate);
        }
        date.datepicker("option", "changeMonth", true);
        date.datepicker("option", "changeYear", true);
        date.datepicker("option", "autoSize", true);
        if (this.buttonImg == true) {
            date.datepicker("option", "buttonImage", image);
            date.datepicker("option", "buttonImageOnly", true);
            date.datepicker("option", "showOn", "both");

        }
        if (this.mindate != null) {
            date.datepicker("option", "minDate", this.mindate);
        }
        if (this.maxdate != null) {
            date.datepicker("option", "maxDate", this.maxdate);
        }
        if (this.onselect != null) {
            date.datepicker("option", "onSelect", this.onselect);
        }
        if(this.placeholder){
            date.attr("placeholder", placeholderTH(this.format));
        }
        if (this.readonly == true) {
            date.attr("readonly", "readonly");
            date.css("cursor", "pointer");
        }
        else {
            dateAdj(date, this.format);
            date.attr("maxlength", this.format.length);
            checkDate(date, this.format, this.regional,this.swal);
        }
        $("img.ui-datepicker-trigger").css("cursor", "pointer !important;");

    }
    this.Destroy = function () {
        var date = $("#" + this.name);
        date.datepicker("destroy");
    }
}
var DatePickTwo = function DatePickTwo(elem_id1, elem_id2) {
    this.name1 = elem_id1;
    this.name2 = elem_id2;
    this.regional = "TH";
    this.format = "dd/mm/yyyy";
    this.changeMonth = true;
    this.changeYear = true;
    this.buttonImg = true;
    this.onselect1 = null;
    this.onselect2 = null;
    this.mindate1 = null;
    this.mindate2 = null;
    this.maxdate1 = null;
    this.maxdate2 = null;
    this.readonly = true;
    this.placeholder = true;
    this.swal = false;
    this.Create = function () {
        var date1 = $("#" + this.name1);
        var date2 = $("#" + this.name2);
        $.datepicker.setDefaults($.datepicker.regional[""]);
        if (this.regional != null) {
            date1.datepicker($.datepicker.regional[this.regional]);
            date2.datepicker($.datepicker.regional[this.regional]);
        }
        if (this.format != null) {
            date1.datepicker("option", "dateFormat", chgFormat(this.format));
            date2.datepicker("option", "dateFormat", chgFormat(this.format));
        }
        date1.datepicker("option", "changeMonth", true);
        date2.datepicker("option", "changeMonth", true);
        date1.datepicker("option", "changeYear", true);
        date2.datepicker("option", "changeYear", true);
        date1.datepicker("option", "autoSize", true);
        date2.datepicker("option", "autoSize", true);
        if (this.onselect1 != null) {
            date1.datepicker("option", "onSelect", this.onselect1);
        }
        else {
            date1.datepicker("option", "onSelect", function (date, inst) {
                date2.datepicker("option", "minDate", new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
            });
        }
        if (this.onselect2 != null) {
            date2.datepicker("option", "onSelect", this.onselect2);
        }
        else {
            date2.datepicker("option", "onSelect", function (date, inst) {
                date1.datepicker("option", "maxDate", new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
            });
        }
        if(this.placeholder){
            date1.attr("placeholder", placeholderTH(this.format));
            date2.attr("placeholder", placeholderTH(this.format));
        }
        if (this.buttonImg == true) {
            date1.datepicker("option", "buttonImage", image);
            date1.datepicker("option", "buttonImageOnly", true);
            date1.datepicker("option", "showOn", "both");
            date2.datepicker("option", "buttonImage", image);
            date2.datepicker("option", "buttonImageOnly", true);
            date2.datepicker("option", "showOn", "both");
        }
        if (this.mindate1 != null) {
            date1.datepicker("option", "minDate", this.mindate1);
        }
        if (this.mindate2 != null) {
            date2.datepicker("option", "minDate", this.mindate2);
        }
        if (this.maxdate1 != null) {
            date1.datepicker("option", "maxDate", this.maxdate1);
        }
        if (this.maxdate2 != null) {
            date2.datepicker("option", "maxDate", this.maxdate2);
        }
        if (this.readonly == true) {
            date1.attr("readonly", "readonly");
            date2.attr("readonly", "readonly");
            date1.css("cursor", "pointer");
            date2.css("cursor", "pointer");
        }
        else {
            dateAdj(date1, this.format);
            dateAdj(date2, this.format);
            date1.attr("maxlength", this.format.length);
            date2.attr("maxlength", this.format.length);
            checkDate(date1, this.format, this.regional,this.swal);
            checkDate(date2, this.format, this.regional,this.swal);
        }
        $("img.ui-datepicker-trigger").css("cursor", "pointer !important;");

    }
    this.Destroy = function () {
        var date1 = $("#" + this.name1);
        var date2 = $("#" + this.name2);
        date1.datepicker("destroy");
        date2.datepicker("destroy");
    }
}