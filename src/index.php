<!DOCTYPE html>
<html>
<meta charset="utf-8"/>
<title>EXCEL</title>
<head>
  <script language="javascript" async src="./js/1.js"></script>
</head>
<style>
form{
  max-width: 500px;
  max-height: 100px;
  margin-left: auto;
  margin-right: auto;

}
form img{
  max-width: 50px;
  max-height: 50px;

}
table{
  border-style:solid;
  overflow:scroll;
  border-width: 1px;

}
table td{
  border-style:solid;
  border-width: 1px;
  text-align:center;

}
#embedsheet {
margin-top:150px;

}
</style>
<body>
<div>

  <form method="post" action="./printSheet.php" enctype="multipart/form-data">
    <input type="file" name="sheet"><img src="./fotos/sheet.png"/></input>
  </form>

    <button onclick="javasript:enviar()">ENVIAR</button>

</div>

<div id="embedsheet">

</div>
</body>
</html>
