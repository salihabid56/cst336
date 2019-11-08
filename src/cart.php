<!DOCTYPE html>
<html>
    <head>
        <title> Cart Page </title>
       <meta charset="UTF-8">
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link href="../css/styles.css" rel="stylesheet" type="text/css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <style>
        * {
            -webkit-box-sizing: content-box;
             -moz-box-sizing: content-box;
                  box-sizing: content-box;
        }
        *:before,
        *:after {
            -webkit-box-sizing: content-box;
             -moz-box-sizing: content-box;
                  box-sizing: content-box;
        }
        button{
            border-radius: 10px;
            width: 150px;
            height: 70px;
            font-size: 20px;
        }
        #cartCol{
            margin-left:25%;
            margin-right:25%;
            margin-top:25px;
            margin-bottom:25px;
            /*background-color:gray;*/
            /*border: solid yellow;*/
        }
        #product_name{
            width:40%;
            margin:0px !important;
            float: left;
            /*border: solid green;*/
        }
        #product_qty{
            margin:0px !important;
            /*border: solid red;*/
        }
        #inputQty{
            margin:10px;
        }
        #prod_name_text{
            margin-top: 10%;
        }
      </style>
      <script>
        /*global $*/
        var products;
        var aUsername;
        function setProductArray(arr){
            products = arr;
        }
        function setUsername(data){
            aUsername = data;
        }
        function getProductArray(){
            return products;
        }
        function update(prod_id){
            var username = $("#userName").html().split(" ")[0];
            $.ajax(
            {
                method: "GET",
                url: "../api/cartAPI/updateCart.php",
                dataType: "json",
                data: {'product_id':prod_id,
                      'username': username,
                      'quantity': $(".qty_"+prod_id).val(),
                },
                success: function(data, status) 
                {
                }
            }); //ajax 
            
        }
        function Delete(prod_id){
            var username = $("#userName").html().split(" ")[0];
            $.ajax(
            {
                method: "GET",
                url: "../api/cartAPI/deleteCart.php",
                dataType: "json",
                data: {'product_id':prod_id,
                       'username': username,
                },
                success: function(data, status) 
                {
                }
            }); //ajax 
        }
        function checkSession(){
            let user = '';
            $.ajax(
            {
                method: "GET",
                url: "../api/userAPI/checkSession.php",
                dataType: "json",
                success: function(data, status) 
                {
                    if(data == "login"){
                        $("#cart").attr("href",'login.php');
                        $("#account").attr("href",'login.php');
                    }
                    else{
                        $("#userName").html(data);
                        $("#cart").attr("href",'cart.php');
                        $("#account").attr("href",'account.php');
                        displayCart(data);
                    }
                }
            }); //ajax 
        }
        function displayCart(userFullName){
            var array = userFullName.split(" ");
            user = array[0];
            setUsername(user);
            var total = 0;
            var product_array = [];
            let i = 0;
            $.ajax({
                type: "GET",
                async: false,
                url: "../api/cartAPI/getCart.php",
                dataType: "json",
                data: { "username": user },
                success: function(data,status) {
                    var stringHtml = "";
                    data.forEach(function(){
                        stringHtml += "<div id='cartCol' value='"+data[i].product_id+"'>";
                        var prod_id = data[i].product_id;
                        var price;
                        var product = [];
                        product.push(data[i].product_id);
                        product.push(data[i].quantity);
                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "../api/productAPI/getProductInfo.php",
                            dataType: "json",
                            data: { "product_id": prod_id},
                            success: function(stuff,status) {
                                price = stuff.product_price;
                                product.push(price);
                                stringHtml += "<div id='product_name' ><div id='prod_name_text'>"+ stuff.product_name +"&emsp;&emsp;$" + price+"</div></div>";
                            },
                        });//ajax
                        total+=price* data[i].quantity;
                        product_array.push(product);
                        stringHtml += "<div id='product_qty'> Qty: <input id='inputQty' class='qty_"+data[i].product_id+"' type='text' style='width:3%' value='" + data[i].quantity + "'> &emsp; <button id='updateBtn' onclick='update("+data[i].product_id+")' style='width:9%; height:1%;'>Update</button>&emsp;&emsp;<button id='delete' onclick='Delete("+data[i++].product_id+")' style='width:9%; height:1%;'>Delete</button></div></div>"
                    })//data for each
                    $("#cart_items").html(stringHtml);
                    $("#total").html("Total: $" + total);
                    setProductArray(product_array);
                }// end success
            });// ajax call getAllCart
        } 
        $(document).ready(function(){
            $("#navSearch").on("click", function(){
              alert($("#searchInput").val());
            });
            checkSession();
            $("#checkoutBtn").on("click", function(){
                $.ajax(
                {
                    method: "GET",
                    url: "../api/cartAPI/checkout.php",
                    dataType: "json",
                    data: {'products': products,
                          'username': aUsername,
                    },
                    success: function(data, status) 
                    {
                    }
                }); //ajax 
            });
        });//documentReady
        </script>
    </head>

    <body>
     <!--NavBar top-->
 <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center align-items-center top">
    <!-- Navbar brand -->
    <div class="top_Nav"style="width=100%">
      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent" style='margin-right: 10px !important;'>
          <!-- Links -->
          <ul class="navbar-nav mr-auto">
            <li> <a class="navbar-brand" href="index.php"><img src="../img/nav_bar/Logo.png" alt="Logo"></a></li>
          </ul>
          <!-- Links -->
          <!-- Search form -->
          <form class="form-inline top_Nav search_bar">
            <input id="searchInput" class="form-control" style="margin-top: 22px !important;" type="text" placeholder="Search" aria-label="Search">
            <button id="navSearch" style="width: 140px !important;" saria-label="Search">Search</button>
          </form>
          <ul class="navbar-nav nav_right">
             <li class="nav-item top_right">
                <a id="cart" class="nav-link" href="login.php"><img src="../img/nav_bar/cart.png" alt="Cart"><br>cart</a>
             </li>
             <li class="nav-item">
                <a id="account" class="nav-link" href="login.php"><img src="../img/nav_bar/account.png" alt="Account"><br>Account</a>
             </li>
          </ul>
        </div>
            <div class="navbar-collapse collapse w-100 ml-auto d-flex align-items-center bottom"style='padding: 15px;' id="collapsingNavbar3">
              <ul class="navbar-nav w-100 justify-content-center">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
            </ul>
          </div>
      </div>
      <!-- Collapsible content -->
  </nav>
<!--/.Navbar--> 
    <div id = "mainBody">  
        <h2 id="userName"></h2>
        <div id="cart_items"></div>
        <h2 id="total"></h2>
        <button id ="checkoutBtn">Checkout</button><br>
       <div id = "successMessage"></div>
    </div>
    </body>
</html>