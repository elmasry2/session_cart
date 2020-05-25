<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate ID
    if(!($_POST['id'])){
       $error = "Required Product Id";
        header("Location: index.php?error={$error}");
    }
    // Validate Process
    if(!($_POST['process'])){
       $error = "Required Process ";
        header("Location: index.php?error={$error}");
    }
    // if id && Process Valid Do Code Ops Here
    if(!empty($_POST['id']) && !empty($_POST['process'])){
        session_start();
        $id = $_POST['id'];
        $process = $_POST['process'];
        switch ($process){
            case 'add':
            // fetch products array
                require_once ('products.php');
                $product_data = $productArray[$id];
                $new_product = array($_POST['id']=>array('id'=>$id,'name'=>$product_data['name'], 'price'=>$product_data['price'], 'quantity'=>1));
                // Check if SESSION array Exists
                if(!empty($_SESSION["cart"])) {
                    // search inside SESSION Array
                    if(in_array($id, array_column($_SESSION['cart'], 'id'),true)){
                        foreach($_SESSION["cart"] as $key => $item) {
                            if($_POST['id'] == $_SESSION["cart"][$key]['id']) {
                                $_SESSION["cart"][$key]["quantity"] = $_SESSION["cart"][$key]["quantity"]+1;
                            }
                        }
                    }else{
                        // if this product is new on merge it's Data to SESSION Array
                        $_SESSION['cart']=array_merge($_SESSION['cart'],$new_product);
                    }
                    $success = 'Product Added Successfully ';
                    header("Location: index.php?success={$success}");
                } else {
                    $_SESSION["cart"] = $new_product;
                    $success = 'Product Added Successfully ';
                    header("Location: index.php?success={$success}");

//                return var_dump($_SESSION['cart']['quantity']);
                }    break;
                case 'delete':
                    // delete all session
//                    session_destroy();
//                    session_unset();
//                    session_start();
//                    unset($_SESSION['cart'][$id]);
                if(!empty($_SESSION["cart"])) {
                    foreach($_SESSION["cart"] as $key => $cart) {
                        if($id == $cart['id'])
                            unset($_SESSION["cart"][$key]);
                        if(empty($_SESSION["cart"]))
                            unset($_SESSION["cart"]);
                        $success = 'Product Removed Successfully ';
                        header("Location: index.php?success={$success}");
                    }
                }
                    break;
            default:
                $error = "Not Valid Process";
                header("Location: index.php?error={$error}");

        }


    }
}else{
     $error = 'Server Say Bad Request ';
    header("Location: index.php?error={$error}");

}
?>