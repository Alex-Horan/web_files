<?php
session_start();
    

$title = $desc = $price = '';
$titleErr = $descErr = $priceErr = '';

function testinput(string $data,) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['submit'])) {

    if (!empty($_POST['title'])) {
        $title = testinput($_POST['title']);
    } else {
        $titleErr = "Please Enter an item name";
    }
    if (!empty($_POST["desc"])) {
        $desc = testinput($_POST["desc"]);
    } else {
        $descErr = "Please enter a description of the item";
    }
    if (isset($_POST["price"])) {
        $price = testinput($_POST["price"]);
    } else {
        $priceErr = "Please enter a price";
    }


    if ((!empty($_POST["title"])) && (!empty($_POST["desc"]))) {
        $db = new SQLite3("./shop_items.sqlite");
        $db->exec("INSERT INTO listings(name, descript, price) VALUES ('$title', '$desc', '$price')");
        $db->close();
        header('Location: ./pageConstruct.php');
        exit();
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
</head>
<body>

    <form action"<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Title: <input type="text" name="title" required> <span>* <?php echo $titleErr; ?></span> <br> <br>
    Description: <input type="text" name="desc" required> <span>* <?php echo $descErr; ?></span> <br> <br>
    Price: <input type="number" name="price" step=".01" required><span>* <?php echo $priceErr; ?></span><br><br>  

    
        <input type="submit" name="submit" value="submit">
    </form>    


</body>
</html> 
