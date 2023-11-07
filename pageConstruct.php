<?php
    class MyDB extends SQLite3 {
        public function __construct() {
            $this->open("./shop_items.sqlite");
        }
    }


//testing
    class pageCreator {
        public function __construct(string $title, string $desc, float $price) {
            $this->title = $title;
            $this->desc = $desc;
            $this->price = $price;
            $this->create($title, $desc, $price);
        }

        public function create(string $title, string $desc, float $price) {
            if(!mkdir("./$title")) {
                die("Failed to make folder");
            }
            
            $fw = fopen("./$title/$title","c");
            fwrite($fw,"$title $desc $price");
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

?>