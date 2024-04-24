<?php
session_start();
$servername="Localhost";
$username="root";
$password="";
$database="productb";

$conn=mysqli_connect($servername,$username,$password,$database)

or die ("not connected sucessfully".mysqli_connect_error());

if(isset($_POST["add"])){
    $productId = $_GET["id"];
    $productName = $_POST["hidden_name"];
    $productImage = $_POST["hidden_image"];
    $productPrice = $_POST["hidden_price"];
    $productQuantity = $_POST["quantity"];

    $sql= "INSERT INTO `product_second` ( `description`, `image`, `price`, `quantity`) VALUES ('$productName', '$productImage', ' $productPrice', '$productQuantity');";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Product</h2>
    <div class="container">
        <?php
        $query = "SELECT * FROM `product_first` ORDER BY id ASC";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                ?>
                <div class="product">
                    <form action="landing.php?action=add&id=<?php echo $row["id"]?>" method="post">
                    <div class="product">
                        <img src="img/<?php echo $row ["image"];?>" alt="">
                        <h3><?php echo $row["description"]?></h3>
                        <p>£<?php echo $row ["price"];?></p>
                        <input type="text" id="quantity" name="quantity" value ="1">
                        <input type="hidden" name="hidden_image" value="<?php echo $row["image"];?>">
                        <input type="hidden" name="hidden_name" value="<?php echo $row["description"];?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
                        <input type="submit" value="Add to Cart" name="add">
                    </div>
                    </form>
                </div>
                <?php
            }
        }

        ?>
    </div>
</body>
</html>