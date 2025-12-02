<?php
    readfile("topo.html");
    readfile("menu.html");
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cadastrar Novo Ator</h2>
            <a href="actors.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="../api/actor/create.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome Completo *</label>
                            <input type="text" name="name" class="form-control" required placeholder="Ex: Fernanda Montenegro">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="date" name="birthdate" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">País de Origem *</label>
                            <input type="text" name="country" class="form-control" required placeholder="Ex: Brasil">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Biografia</label>
                        <textarea name="biography" class="form-control" rows="5" placeholder="Escreva um pouco sobre a carreira do ator..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Foto de Perfil</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>

                    <hr>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-person-check"></i> Salvar Ator</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>