<?php 
    session_start();
    $title = $_SESSION['title'];
    $desc = $_SESSION['desc'];

    class MyDB extends SQLite3 {
        public function __construct() {
            $this->open('./shop_items.sqlite');
        }
    }

    $db = new MyDB();
    $rdb = $db->query('SELECT * from listings');
    while ($result = $rdb->fetcharray()) {
        echo $result['name'] . "\n";
        echo $result["descript"] . "\n";
        echo $result["price"] . "\n";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php ?></h1>
    <h2><?php echo $desc; ?></h2>
</body>
</html>
