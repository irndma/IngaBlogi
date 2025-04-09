<?php
if(isset($_GET['sid']) && is_numeric($_GET['sid'])) {
    $id = (int)$_GET['sid']; // Võtame url id väärtuse tehes täisarvuks
    $sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as adding FROM blog WHERE id = ".$id; // SQL lause, et leida postitust id järgi
    $data = $db->dbGetArray($sql); // Andmebaasist andmed tagastada 

    if($data !== false) {
        $val = $data[0]; 

?>

    <div class="container mt-1 p-0"> 
          <!-- Lehe sisu-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <article>
                        <!-- header-->
                        <header class="mb-4">
                            <!-- pealkiri-->
                            <h1 class="fw-bolder mb-1"><?php echo $val['heading']; ?> </h1>
                            <div class="text-muted fst-italic mb-2"><?php echo $val['adding']; ?>
                        </header>
                        <!-- Pilt-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="<?php echo $val['photo']; ?>" alt="Pilt" /></figure>
                        <!-- Postituse sisu-->
                        <section class="mb-5">
                        <?php echo $val['context']; ?>
                        </section>
                        <hr>


                        <div class="mb-3">
                            <?php 
                                $tags = array_map('trim', explode(",", $val['tags'])); // Muuda massiiviks, eraldaja on koma

                                $links = []; // Tühi linkide list
                                foreach($tags as $tag) {
                                    $safeTag = htmlspecialchars($tag); // Turvaline HTML
                                    $links[] = "<a href=''>{$safeTag}</a>"; 
                                }
                                $result = implode(", ", $links); 
                            echo $result; // Väljasta lingid
                            ?> 

                        </div>
                        <!-- Nupud-->
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">Eelmine postitus
                        <a class="badge bg-secondary text-decoration-none link-light" href="?page=post2">Järgmine postitus</a>
                    </article>

    </div>

<?php
    } else {
        ?>
        <h4>Viga</h4>
        <p>Sellist postitust ei ole!</p>
        <?php
    }
} else {
    ?>
    <h4>Viga</h4>
    <p>URL on vigane!</p>
    <?php
}
?>