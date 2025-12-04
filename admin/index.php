<?php
    include_once("../db/config.inc.php"); 
    readfile("topo.html");
    readfile("menu.html");
?>

    <div class="content">
        
        <nav class="navbar navbar-light bg-white shadow-sm mb-4 rounded">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Visão Geral</span>
            </div>
        </nav>

        <div class="row">
            
            <div class="col-md-4">
                <div class="card-counter border-start border-4 border-primary position-relative">
                    <i class="bi bi-film"></i>
                    <span class="h3 count-numbers">
                        <?php 
                            if(isset($conn)){
                                $res = mysqli_query($conn, "SELECT count(*) as total FROM movie");
                                $row = mysqli_fetch_assoc($res);
                                echo $row['total'];
                            } else { echo "0"; }
                        ?>
                    </span>
                    <p class="text-muted">Filmes</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-counter border-start border-4 border-success position-relative">
                    <i class="bi bi-person"></i>
                    <span class="h3 count-numbers">
                        <?php 
                            if(isset($conn)){
                                $res = mysqli_query($conn, "SELECT count(*) as total FROM actor");
                                $row = mysqli_fetch_assoc($res);
                                echo $row['total'];
                            } else { echo "0"; }
                        ?>
                    </span>
                    <p class="text-muted">Atores</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-counter border-start border-4 border-warning position-relative">
                    <i class="bi bi-people"></i>
                    <span class="h3 count-numbers">
                        <?php 
                            if(isset($conn)){
                                $res = mysqli_query($conn, "SELECT count(*) as total FROM users");
                                $row = mysqli_fetch_assoc($res);
                                echo $row['total'];
                            } else { echo "0"; }
                        ?>
                    </span>
                    <p class="text-muted">Usuários</p>
                </div>
            </div>

        </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>