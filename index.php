<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit Form Without Page Refresh</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
function chk()
{
 
  var fname=document.getElementById('fname').value;
  var lname=document.getElementById('lname').value;
  var dataString='fname='+fname+'&lname='+lname;
  $.ajax({
      type:"post",
      url: "hi.php",
      data: dataString,
      cache: false,
      success: function(html){
          $('#msg').html(html);
      }
  });
  return false;
} 
</script>
</head>

<body>    


<form>
	<input type="text" id="fname"><br><br>
    <input type="text" id="lname"><br><br>
	<input type="submit" id="submit" value="Submit" onclick="return chk()">
</form>
<p id="msg"></p>
</div>
</body>
</html>