<?php
$sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') AS estonia FROM blog ORDER BY added DESC LIMIT 3"; // Viimased 3 postitust sisestamisaja järgi
$data = $db->dbGetArray($sql); 
//$db->show($data); // Väljasta massiivi sisu inimsõbralikul kujul

?>
    <div class="container mt-1 p-0"> 
        <header class="py-5 bg-light border-bottom shadow-sm mb-4">
            <div class="container text-center">
                <h1 class="display-4 fw-bold">Tere tulemast Inga blogisse!</h1>
                <p class="lead text-muted">Avasta artikleid tehnoloogia ja tulevikutrendide kohta.</p>
            </div>
        </header>

          
        <!-- Postituste nimekiri -->
        <?php
        if($data !== false) { // Leiti andmeid
            echo '<div class="card-group">';
            foreach($data as $key=>$val) {
                ?>
                <!-- SIIA HTML OSA -->
              <div class="card">
                  <img src="<?php echo $val['photo']; ?>" class="card-img-top" alt="nasa" />

                  <div class="card-body">
                      <h5 class="card-title"><?php echo $val['heading']; ?></h5>
                      <p class="card-text"><?php echo $val['preamble']; ?></p>
                      <?php 
                    $tags = array_map('trim', explode(",", $val['tags'])); // Muuda massiiviks, eraldaja on koma

                    $links = []; // Tühi linkide list
                    foreach($tags as $tag) {
                        $safeTag = htmlspecialchars($tag); // Turvaline HTML
                        $links[] = "<a href=''>{$safeTag}</a>"; 
                    }
                    $result = implode(", ", $links); 
                    echo $result; // Väljasta lingid
                    //$db->show($links); // TEST
                    ?> <br> <br>
                      <a href="?page=post&sid=<?= $val['id']; ?>" class="btn btn-primary" href="?page=post5">Loe rohkem →</a>
                  
                    </div>
                  <div class="card-footer">
                    <h6 class="fst-italic"><?php echo $val['estonia']; ?></h6>
                  </div>
              </div>
                <?php
            }
        } else {
                echo "ANDMEID pole";
        }
        ?>


          
          <!-- viited kahele teisele lehele -->
          <div class="container mt-5 text-center">
              <div class="d-flex justify-content-center gap-3 mt-3">
                  <a href="?page=blog" class="btn btn-outline-primary">Blogi</a>
                  <a href="?page=contact" class="btn btn-outline-primary">Kontakt</a> 
              </div> <br>
          </div>
    </div>



