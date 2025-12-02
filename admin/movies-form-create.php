<?php
    readfile("topo.html");
    readfile("menu.html");
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cadastrar Novo Filme</h2>
            <a href="movies.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="../api/movies/create.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Nome do Filme *</label>
                            <input type="text" name="name" class="form-control" required placeholder="Ex: Vingadores: Ultimato">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-select" required>
                                <option value="Released">Lançado</option>
                                <option value="Post Production">Pós-produção</option>
                                <option value="In Production">Em Produção</option>
                                <option value="Planned">Planejado</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Data de Lançamento *</label>
                            <input type="date" name="release_date" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Classificação *</label>
                            <select name="age_classification" class="form-select" required>
                                <option value="" selected disabled>Selecione...</option>
                                <option value="L">Livre (L)</option>
                                <option value="10">10 anos</option>
                                <option value="12">12 anos</option>
                                <option value="14">14 anos</option>
                                <option value="16">16 anos</option>
                                <option value="18">18 anos</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Duração (minutos) *</label>
                            <input type="number" name="duration" class="form-control" required placeholder="Ex: 120">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Orçamento ($) *</label>
                            <input type="number" step="0.01" name="budget" class="form-control" required placeholder="Ex: 1000000">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">País de Origem *</label>
                        <input type="text" name="country" class="form-control" required placeholder="Ex: Estados Unidos">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Imagens / Pôsteres</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        <div class="form-text">Você pode selecionar várias imagens segurando Ctrl.</div>
                    </div>

                    <hr>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> Salvar Filme</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>