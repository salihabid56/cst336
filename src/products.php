<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
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
    .img 
    {
    margin:0px;
    padding:0px;
    float: left;
    width:  150px;
    height: 150px;
    background-position: 0% 0%;
    background-repeat:   no-repeat;
    background-size:     cover;
    }
    .row{
        margin:10px;
        padding:auto;
        text-align:center;
        justify-content:center;
        display:inline-block;
        /*border: solid red;*/
    }
    .col{
        margin:0px;
        /*border: solid green;*/
        width:  150px;
        height: 200px;
        /*padding:25px!important;*/
        /*padding-right: 30px !important;*/
    }
    .text{
        text-align:center;
        display: block;
        height: 70px;    
        margin: 0 auto;
    }
    button{
        width: 10%;
    }
    .active-filter{
        background-color:red;
    }
</style>
<script>
function showAll(){
    var eK = [];
    eK.push(document.getElementsByClassName('1'));
    eK.push(document.getElementsByClassName('2'));
    eK.push(document.getElementsByClassName('3'));
    eK.push(document.getElementsByClassName('4'));
    for(let k = 0; k < eK.length;k++){
        for(let i = 0; i < eK[k].length;i++){
            eK[k][i].style.display='block';
        }
    } 
}
function showClass(j){
    var e = [];
    var e = document.getElementsByClassName(j);
    switch(+j){
        case 0:
            showAll();
            break;
        case 1:
            showAll();
            var eR = []; // elements to remove
            eR.push(document.getElementsByClassName('2'));
            eR.push(document.getElementsByClassName('3'));
            eR.push(document.getElementsByClassName('4'));
            for(let k = 0; k < eR.length;k++){
                for(let i = 0; i < eR[k].length;i++){
                    eR[k][i].style.display='none';
                }
            } 
            break;
        case 2:
            showAll();
            var eR = []; // element to remove
            eR.push(document.getElementsByClassName('1'));
            eR.push(document.getElementsByClassName('3'));
            eR.push(document.getElementsByClassName('4'));
            for(let k = 0; k < eR.length;k++){
                for(let i = 0; i < eR[k].length;i++){
                    eR[k][i].style.display='none';
                }
            } 
            break;
        case 3:
            showAll();
            var eR = []; // element to remove
            eR.push(document.getElementsByClassName('2'));
            eR.push(document.getElementsByClassName('1'));
            eR.push(document.getElementsByClassName('4'));
            for(let k = 0; k < eR.length;k++){
                for(let i = 0; i < eR[k].length;i++){
                    eR[k][i].style.display='none';
                }
            } 
            break;
        case 4:
            showAll();
            var eR = []; // element to remove
            eR.push(document.getElementsByClassName('2'));
            eR.push(document.getElementsByClassName('3'));
            eR.push(document.getElementsByClassName('1'));
            for(let k = 0; k < eR.length;k++){
                for(let i = 0; i < eR[k].length;i++){
                    eR[k][i].style.display='none';
                }
            }
            break;
        default:
            alert(j);
            break;
    }
}
function checkSession(){
    $.ajax(
    {
        method: "GET",
        url: "../api/checkSession.php",
        dataType: "json",
        success: function(data, status) 
        {
            if(data == "user"){
                $("#cart").attr("href",'cart.php');
                $("#account").attr("href",'account.php');
            }
            if(data == "login"){
                $("#cart").attr("href",'login.php');
                $("#account").attr("href",'login.php');
            }
        }
    }); //ajax 
}
function addCart(){
     $.ajax(
    {
        method: "GET",
        url: "../api/userAPI/checkSession.php",
        dataType: "json",
        success: function(data, status) 
        {
            user = data.split(" ")[0];
            if(data == 'login'){
                alert("sign in!");
            }
            if(data != 'login'){
                alert("Product in your cart!");
            }
            $.ajax(
            {
                method: "POST",
                url: "../api/cartAPI/addCart.php",
                dataType: "json",
                data: {'username': user,
                       'product_id': $("#modalId").html(),
                       'quantity': $("#modalQty").val(),
                       'unit_price': $("#modalPrice").html(),
                },
                success: function(data, status) 
                {
                }
            }); //ajax 
        }
    }); //ajax 
}
$(document).on('click', '.historyLink', function(){
    
    $('#myModal').modal("show");
    $("#product").html("");
    $.ajax({
        type: "GET",
        url:  "../api/productAPI/getProductInfo.php",
        dataType: "json",
        data: {"product_id" : $(this).attr("id")},
        
        success: function(data,status) {
            $("#product").append("<div id='modalId' style='display:none'>" +data.product_id + "</div>");
            $("#product").append(data.product_name+ "<br />");
            $("#product").append("<img src='" + data.product_img + "' width='200' /> <br />");
            $("#product").append("<div id='modalPrice' style='display:none'>" +data.product_price + "</div>");
            $("#product").append("<div> Price: $"+data.product_price + "</div></br>");
            $("#product").append("Quantity: "+data.product_stock+ "<br />");
            $("#product").append("Description: "+data.product_description + "<br />");
            $("#product").append("<input id='modalQty' value='1' style='width:20%; margin-top: 22px !important;' type='text' placeholder='Qty'>");
            $("#product").append("<button id='cartBtn' style='width:50%;' onclick='addCart()'>add to Cart</button>");
        },
        complete: function(data,status) { //optional, used for debugging purposes
        // alert(status);
        }
    });//ajax
});//ProductLink

$("#navSearch").on("click", function(){
    alert($("#searchInput").val());
});

$(document).ready(function(){
    checkSession();
    $.ajax({
         method: "GET",
            url: "../api/productAPI/getProducts.php",
        dataType: "json",
        success: function(data, status) {
            let htmlString = "";
            let i = 0;
            $("#products").html();
            
            for (let rows=0; rows < 3; rows++) {
                if(rows < 4){
                    htmlString += "<div class='row' sytle='margin:auto; justify-content:center;'>";
                }
                else{
                    htmlString += "<div class='row'>";
                }
                for (let cols=0; cols < Math.floor(data.length/3); cols++) {
                    htmlString += "<div class='" + data[i].cat_id +" col'>";
                    htmlString += "<img id='"+ data[i].product_id +"'class='img historyLink' src='" + data[i].product_img + "'/><br>";
                    htmlString += "<div class='img text'>";
                    htmlString += "<a href='#' class='historyLink' id='" + data[i].product_id + "'>" + data[i].product_name + "</a>";
                    htmlString += "<br>$" +data[i++].product_price+"</div><br>";
                    htmlString += "</div><br>";
                }//for
                htmlString += "<br></div>";
            }//for
            htmlString += "</div>";
           $("#products").append(htmlString);
            }
    }); //ajax 
    $(".btn").each(function(){
   $(this).click(function(){
      $(this).addClass("active-filter");
      $(this).siblings().removeClass("active-filter");
      showClass($(this).val());
   });
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

<!-- Control buttons -->
<div class="btn-group" role="group" aria-label="..." style=" justify-content: center; text-align: center; width: 100%;">
  <button type='button' class="btn btn-default active-filter" value='0'> Show all</button>
  <button type='button' class="btn btn-default" value='1'> Vegetables</button>
  <button type='button' class="btn btn-default" value='2'> Fruits</button>
  <button type='button' class="btn btn-default" value='4'> Herbs & Spices</button>
  <button type='button' class="btn btn-default" value='3'> Misc Items</button>
</div>
<div class='container' id="products" style=" margin: auto; text-align:center;"></div>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product</h5>
            </div>
            <div class="modal-body">
                <div id="product"></div>
            </div>
            <div class="modal-footer">
                <button type="button" style="width:100%;" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<div class = "footer" id = "footer">
      <footer>
        <p>We care about you. Do not hesitate to contact us.</p>
        <p><h3>Contact us: </h3> @ 831-000-11111 or by email:    spicy@basket.com</p>
    </footer>
</body>
</html>