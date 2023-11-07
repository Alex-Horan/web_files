<?php
    class MyDB extends SQLite3 {
        public function __construct() {
            $this->open("./shop_items.sqlite");
        }
    }
$newPage = new pageCreator();
$db = new MyDB();
$rdb = $db->query("SELECT * FROM listings");
    while ($results = $rdb->fetchArray(SQLITE3_ASSOC)) {
        $title = $results['name'];
        $desc = $results['descript'];
        $price = $results['price'];

        foreach ($results as $key => $value) {
            if ($key === 'name') {
                echo $value;
            }
        }
    }

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
            <h1>$title</h1>
            <br><br>
            <p>$desc</p>
            <br><br>
            <h3>$price</h3>
        </div>
    
    
    </body>
    </html>
";

//testing
    class pageCreator {

        public function create(string $title, string $desc, float $price, string $template) {
            if(!mkdir("./$title")) {
                die("Failed to make folder");
            }
            
            $fw = fopen("./$title/$title","c");
            fwrite($fw,"$template");
    }
}




?>