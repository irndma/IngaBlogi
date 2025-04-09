<?php
include("include/settings.php"); // Andmebaasi seaded lae
include("include/mysqli.php"); // Andmebaasi klass lae
$db = new Db(); // Loo andmebaasi objekt

$page = isset($_GET['page']) ? $_GET['page'] : 'index_'; //Kui on olemas page, siis võta see, muidu võta index
$allowed_pages = ['post_add', 'index_', 'blog', 'contact', 'post']; // .html failid
if(!in_array($page, $allowed_pages)) { 
    $page = 'index_'; // Kui on mingi kolmas leht peale indexi ja posti, siis alati too avalehele
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Avaleht</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php include 'menu.html'; ?>
    </div>

    <div class="container">
        <?php include("$page.php"); ?>

    </div>
   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>