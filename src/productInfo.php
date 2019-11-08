<!DOCTYPE html>
<html>
    <head>
        <title> Product Information </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <script>
            
            
        $(document).ready( function(){    
              $.ajax({
                    type: "GET",
                    url: "../api/productAPI/getProductInfo.php",
                    dataType: "json",
                    data:{"product_id": <?=$_GET['product_id']?>},
                    success: function(data, status) {
                         $("#productName").html(data["product_name"]);
                         $("#productDescription").html(data["product_description"]);
                         $("#productPrice").html("$"+data["product_price"]);
                         $("#productStock").html("Qty: " + data["product_stock"]);
                         $("#productImage").attr("src", data["product_img"]);
                    }
                });
            
        });
        
        </script>

    </head>
    <body>
        
        <h2 id="productName"></h2>

        <h3 id="productDescription"></h3>

        <img src="" id="productImage" width="200"/>
        
        <div id="productStock"></div>
        
        <div id="productPrice"></div>

    </body>
</html>