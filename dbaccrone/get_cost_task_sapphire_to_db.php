<!DOCTYPE html>
<html>
    <head>
        <meta charset='Windows-874' />
        <title>welcome</title>
        <script src="./SMLcore/TheirParty/js/jquery-1.8.1.min.js"></script>
    </head>
    <body>
        <b>�к����ѧ�ӧҹ</b><br>
        <b>[INFO] : </b>���ѧ��Ŵ cost task �ҡ����ͧ��Կ�������¹͡...<br>
        <b>[INFO] : </b>��س����ѡ����...<br>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: "http://202.129.35.101/cost_script/load_cost_task_sapphire.php?key=superSapphire",
                    dataType: 'jsonp',
                    success: function(json) {
                        $('body').append("<b>[COMPLETE] : </b>�����Ŵ cost task ����� !!! <br>");
                        $('body').append("<b>[INFO] : </b>���ѧ���ҧ Array ������... <br>");
                        var dataToSend = new Array();
                        dataToSend["data"] = new Array();
                        var dataindex = 0;
                        $.each(json, function(key, value) {
                            dataToSend["data"][dataindex] = value;
                            dataindex++;
                        });

                        $('body').append("<b>[COMPLETE] : </b>������ҧ Array ����������� !!! <br>");
                        $('body').append("<b>[INFO] : </b>���ѧ���ҧ���ҧ�ҹ���������� ��س����ѡ����... <br>");
                        
                        dataToSend = JSON.stringify(dataToSend);
                        dataToSend = encodeURIComponent(dataToSend);

                        jQuery.ajax({
                            type: 'POST',
                            url: "./save_cost_task_sapphire_to_db.php",
                            data: dataToSend,
                            dataType: "html",
                            success: function(data) {
                                $('body').append("<b>[COMPLETE] : </b>������ҧ���ҧ�ҹ��������������� !!! <br>");
                                $('body').append("<b>============= SUCCESS ===============</b>");
                                $('body').append(data);
                            },
                            error: function() {
                                $('body').append("<b>[ERROR] : </b>�Դ��ͼԴ��Ҵ ��سҵԴ��ͷ���Ѳ���к� !!! <br>");
                            }
                        });
                    },
                    error: function() {
                        $('body').append("<b>[ERROR] : </b>�Դ��ͼԴ��Ҵ ��سҵԴ��ͷ���Ѳ���к� !!! <br>");
                    }
                });
            });
        </script>
    </body>
</html>