<?php
session_start();
    


$title = $desc = $price = '';
$titleErr = $descErr = $priceErr = '';

function testinput(string $data,) {
    $data = trim($data);    //removes any whitespace from the start or end of the input data
    $data = stripslashes($data); //removes any possible malicious slashes from the input data
    $data = htmlspecialchars($data); //any characters that could be used to inject malicious code into the website
    return $data;
} //sanatizing data
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
    } //validating data


    if ((!empty($_POST["title"])) && (!empty($_POST["desc"]))) {
        $db = new SQLite3("./shop_items.sqlite");
        $db->exec("INSERT INTO listings(name, descript, price) VALUES ('$title', '$desc', '$price')");
        $db->close();
        header('Location: ./pageConstruct.php');
        exit();
    } //after sanitation and validation, insert the data into the sqlite database
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <script src="./jquery-3.7.1.js"></script>
</head>
<body>
    <!--Form start -->


    <form action"<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Title: <input type="text" name="title" required> <span>* <?php echo $titleErr; ?></span> <br> <br>
    Description: <input type="text" name="desc" required> <span>* <?php echo $descErr; ?></span> <br> <br>
    Price: <input type="number" class="price" name="price" step=".01" required><span>* <?php echo $priceErr; ?></span><br><br>  

 
        <input type="submit" name="submit" value="submit">
    </form>
       <!--Form End -->
    <script> //this checks for the input price and adjusts it to be less than 9999.99 and have no more than 2 decimal points
        $(document).ready(function() {
            $(".price").on("change", function() { //runs this any time the value in the price input changes

                this.value = parseFloat(this.value).toFixed(2);
                let part2 = (this.value).split(".")[1].toString(); //converting right side of the decimal to a string so it can be rounded to 2 decimal points

                let part1 = (this.value.split('.')[0]).toString(); //converting left side of the decimal to a string so it can be shortened
                if (part1.length > 4) {
                    part1 = part1.substring(0, part1.length-1);
                    
                }
                if ((part1.length <= 4) && part2.length == 2) {
                    this.value = parseFloat(part1 + "." + part2); //merging the 2 decimal points with the adjusted value to the left of the decimal point
                }
            });
        });
    </script>
    
</body>
</html> 
