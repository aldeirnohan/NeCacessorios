<html>
<head>
<script src="jquery.min.js"></script>
<script src="inputmask.js"></script>
<script>
    $(document).ready(function(){
    $("#money").inputmask( 'currency',{"autoUnmask": true,
            radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: 'R$ ',            
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
    });
</script>
</head>
<body>
   <form>
      <input type="text" id="money" /><br>
   </form>
</body>
</html>