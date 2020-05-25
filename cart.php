<?php session_start();
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])):?>
<!--- List Products Data Session  inside Table --->
<br>
============================= Session Cart Products ============
<table >
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th> Price </th>
        <th> Quantity  </th>
        <th> Total Price   </th>
        <th> Delete </th>
    </tr>
    </thead>
    <tbody>
    <?php $i=0;?>
<!--    --><?php //echo '<br>'.print_r($_SESSION['cart']).'<br>';?>
    <?php foreach ($_SESSION['cart'] as $key =>$cart):?>
        <tr>
            <td><?php echo ++$i;?></td>
            <td><?php echo $cart['name'];?></td>
            <td><?php echo $cart['price'];?></td>
            <td><?php echo $cart['quantity'];?></td>
            <td><?php echo $cart['quantity'] * $cart['price'];?></td>
            <!-- Add Product To Session Button --->
            <td>
                <form action="cart_process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $cart['id'];?>">
                    <input type="hidden" name="process" value="delete">
                    <button type="submit"> Delete </button>
                </form>
            </td>
        </tr>
<!--    --><?php //endforeach;?>
    <?php endforeach;?>
    </tbody>
</table>
<?php endif;?>