<form method=post action=''>
Enter a product name <input type=text name=product>
<input type=submit value='Add to Cart'>
</form>
<?Php
@$product=$_POST['product'];
if(strlen($product)>3){
array_push($_SESSION['cart'],$product); // Items added to cart
}
echo "<br>Number of Items in the cart = ".sizeof($_SESSION['cart']);