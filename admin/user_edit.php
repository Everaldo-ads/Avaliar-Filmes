<?php
    include_once("../db/config.inc.php");
    readfile("topo.html");
    readfile("menu.html");

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo "<script>window.location='users.php';</script>";
        exit;
    }

    $id = (int)$_GET['id'];

    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "<div class='content'><div class='alert alert-warning'>Usuário não encontrado.</div></div>";
        exit;
    }
?>

<div class="content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Editar Usuário: <?php echo htmlspecialchars($user['nickname']); ?></h2>
            <a href="users.php" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="../api/users/update.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Apelido (Nickname)</label>
                                <input type="text" name="nickname" class="form-control" required value="<?php echo htmlspecialchars($user['nickname']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required value="<?php echo htmlspecialchars($user['email']); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nível de Acesso (Role)</label>
                            <select name="role" class="form-select">
                                <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>Usuário Comum</option>
                                <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                            </select>
                            <div class="form-text text-danger">Cuidado: Administradores têm acesso total ao painel.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nova Senha</label>
                            <input type="password" name="password" class="form-control" autocomplete="new-password">
                            <div class="form-text">Deixe este campo <strong>em branco</strong> se não quiser alterar a senha atual.</div>
                        </div>

                        <div class="row mb-4 align-items-center bg-light p-3 rounded mx-0">
                            <div class="col-md-3 text-center">
                                <label class="form-label d-block fw-bold">Avatar Atual</label>
                                <?php 
                                    if($user['profile_image']) {
                                        $img = base64_encode($user['profile_image']);
                                        echo "<img src='data:image/jpeg;base64,{$img}' class='img-thumbnail rounded-circle' style='width: 80px; height: 80px; object-fit: cover;'>";
                                    } else {
                                        echo "<div class='bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto' style='width:80px; height:80px;'><i class='bi bi-person fs-2'></i></div>";
                                    }
                                ?>
                            </div>
                            <div class="col-md-9">
                                <label class="form-label">Trocar Foto de Perfil</label>
                                <input type="file" name="profile_image" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <hr>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Salvar Alterações</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>