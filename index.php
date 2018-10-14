<!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<title>Сокращатель ссылок</title>
<script Language="JavaScript">
    function XmlHttp()
    {
    var xmlhttp;
    try{xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");}
    catch(e)
    {
     try {xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");} 
     catch (E) {xmlhttp = false;}
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined')
    {
     xmlhttp = new XMLHttpRequest();
    }
      return xmlhttp;
    }
     
    function ajax(param)
    {
                    if (window.XMLHttpRequest) req = new XmlHttp();
                    method=(!param.method ? "POST" : param.method.toUpperCase());
     
                    if(method=="GET")
                    {
                                   send=null;
                                   param.url=param.url+"&ajax=true";
                    }
                    else
                    {
                                   send="";
                                   for (var i in param.data) send+= i+"="+param.data[i]+"&";
                                   send=send+"ajax=true";
                    }
     
                    req.open(method, param.url, true);
                    if(param.statbox)document.getElementById(param.statbox).innerHTML = '<img src="images/ajax-loader.gif">';
                    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    req.send(send);
                    req.onreadystatechange = function()
                    {
                                   if (req.readyState == 4 && req.status == 200) //если ответ положительный
                                   {
                                                   if(param.success)param.success(req.responseText);
                                   }
                    }
    }
    </script>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php include('views/header.php'); ?>
    <div class="container" id="status"></div>
    <div class="container">
        <form action="" method="post">
            <input type="url" required placeholder="Введите ссылку..." autocomplete="off" name="url_cut" id="to_cut" >
            <div onclick='
                ajax({
                    url: "/models/cut.php",
                    statbox: "status",
                    method: "POST",
                    data:
                    {
                        to_cut:document.getElementById("to_cut").value
                    },
                    success:function(data){document.getElementById("status").innerHTML=data;}
                })'>
            <input type="button" value="Сократить"></div> 
        </form>
        <?php include('views/footer.php'); ?>
    </div>
</body>
</html>
