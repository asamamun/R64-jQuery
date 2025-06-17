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
<iframe width="560" height="315" src="https://www.youtube.com/embed/Q0fF7AjZC9M?si=NGRUSfgD5FOXjOgm" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <hr>
        <button id="loadProductBtn">load products table from r64_php database</button>
        <div class="row">
            <div class="col-4" id="productList"></div>
            <div class="col-6" id="productDetails"></div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
          function showDataInList(data){
            let html = "<ul class='list-group'>";
            data.forEach(element => {
              html += `<li class="list-group-item" data-price="${element.price}" data-id="${element.id}">${element.name}</li>`;
            });
            html += "</ul>";
            $("#productList").html(html);
          }
          $("#loadProductBtn").click(function(){
            // ajax syntax
            $.ajax({
              type: "post",
              url: "products.php",
              dataType: "json",
              success: function (response) {
                console.log(response); 
                showDataInList(response);               
              }
            });
          });

          //getSingleProduct
          $("#productList").on("click",".list-group-item",function(){
            let id = $(this).data("id");
            // let price = $(this).data("price");
            // console.log(id + " = "+ price);
            $.ajax({
              type: "get",
              url: "productDetails.php",
              data: {pid: id},
              dataType: "json",
              success: function (response) {
                let html = `<h3>${response.name}</h3>
                <p>Price: ${response.price} ( only ${response.quantity} left )</p>
                <p>Description: ${response.description}</p>`;
                $("#productDetails").html(html);
              }
            });
        }); //getSingleProduct end
        });//document ready end
    </script>
</body>
</html>