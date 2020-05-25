 <!--- Call Product Details array from products file -->
<?php  require_once ('products.php');?>
<html   >
<head>  <title> Cart Session Project </title></head>
<body>
<!--- Implement Error Message And Success Message Here --->
<?php if( !empty( $_REQUEST['success'])):?>
    <div style="background:green; color:white; width:20%; padding: 2%;"><?php echo $_REQUEST['success'];?>
        <a href="index.php" style="color: white !important; text-decoration: none; float: right;"> Close </a>
    </div>
<?php elseif(!empty( $_REQUEST['error'])):?>
<div style="background:red; color:white; width:20%; padding: 2%;"><?php echo $_REQUEST['error'];?>
    <a href="index.php" style="color: white !important; text-decoration: none; float: right;"> Close </a>
</div>

<?php endif;?>
<!--- List Products Data inside Table --->
<table >
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th> Price </th>
        <th> Add To cart </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($productArray as $key =>$row):?>
    <tr>
        <td><?php echo $key;?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['price'];?></td>
        <!-- Add Product To Session Button --->
        <td>
            <form action="cart_process.php" method="post">
                <input type="hidden" name="id" value="<?php echo $key;?>">
                <input type="hidden" name="process" value="add">
                <button type="submit"> Add </button>
            </form>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
<!--- View Session Cart Data --->
<?php include_once ('cart.php');?>
</body>
</html>