<?php
session_start();
$servername="Localhost";
$username="root";
$password="";
$database="productb";

$conn=mysqli_connect($servername,$username,$password,$database)

or die ("not connected sucessfully".mysqli_connect_error());

if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $productName=$_GET["name"];
    $deleteQuery = "DELETE FROM `product_second` WHERE description = '$productName'";
    mysqli_query($conn, $deleteQuery);
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
    <h3>Cart</h3>
    <div class="table_contaier">
        <table>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Total Price</th>
            </tr>
            <?php
             $query = "SELECT * FROM `product_second` ORDER BY id ASC";
             $result = mysqli_query($conn,$query);
             $total= 0;
             if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><img src="img/<?php echo $row ["image"];?>" alt=""></td>
                        <td><?php echo $row ["description"];?></td>
                        <td><?php echo $row ["price"];?></td>
                        <td><?php echo $row ["quantity"];?></td>
                        <td><?php echo number_format($row["quantity"]*$row["price"],2);?></td>
                        <td><a href="mycart.php?action=delete&name=<?php echo $row["description"];?>"><span>Remove Item</span></a></td>
                        <?php
                        $total = $total + ($row["quantity"]*$row["price"]);
                     
                        }
                
             }
             ?>
             </tr>
             <tr></tr>
             <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?php echo number_format($total, 2);?></td>
                <td><button>Proceed to Checkout</button></td>
             </tr>
        </table>
    </div>
</body>
</html>