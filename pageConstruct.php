<?php
session_start();
    class MyDB extends SQLite3 {
        public function __construct() {
            $this->open("./shop_items.sqlite");
        }
    }

//function addInfo($stream, string $titleAdd, string $descAdd, float $priceAdd, string $templateAdd) {
 //   fwrite($stream);
//}

class pageCreator {

    public function create(string $title, string $desc, float $price, string $template, string $addPhp) {
        $title = str_replace(" ","_", $title);
        $_SESSION['title'] = $title;
        $_SESSION['descript'] = $desc;
        $_SESSION['price'] = $price;
        if(!mkdir("./item_pages/$title")) {
            header("Location: ./index.php");
            die("failed to create folder - ./item_pages/$title/$title");
        }
        if (is_dir("./item_pages/$title/$title")) {
            rename("./item_pages/$title/$title", "./item_pages/err$title/err$title");
        } else {
        $fw = fopen("./item_pages/$title/$title","c");
        fwrite($fw,"$addPhp");
        fwrite($fw,"$template");
        rename("./item_pages/$title/$title","./item_pages/$title/$title.php");
        }
        fclose($fw);
        header("Location: ./item_pages/$title/$title.php");
    }
    
}

$addPhp =" <?php 
    session_start();
    \$title = \$_SESSION['title'];
    \$desc =  \$_SESSION['descript'];
    \$price =  \$_SESSION['price'];
?>";

$template = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
        <div class='listings'>
            <h1><?php echo \$title; ?></h1>
            <br><br>
            <p><?php echo \$desc; ?></p>
            <br><br>
            <h3><?php echo \$price; ?></h3>
        </div>
    
    
    </body>
    </html>
";

$newPage = new pageCreator();
$db = new MyDB();
$rdb = $db->query("SELECT * FROM listings");
    while ($results = $rdb->fetchArray(SQLITE3_ASSOC)) {
        $title = $results['name'];
        $desc = $results['descript'];
        $price = $results['price'];

        $newPage->create($title, $desc, $price, $template, $addPhp);
        
    }



//testing





?>