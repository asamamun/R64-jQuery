<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
      <marquee behavior="" direction="">testing AJAX</marquee>
      <input type="text" name="theme" id="theme">
        <button id="loadTableBtn">load table</button>
        <div id="tableContainer"></div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#loadTableBtn").click(function(){
            $.ajax({
              type: "get",
              url: "result.php",
              data: {theme: $("#theme").val()},
              dataType: "html",
              success: function (response) {
                console.log(response);
                $("#tableContainer").html(response);
              }
            });
            
          });
        });
    </script>
</body>
</html>