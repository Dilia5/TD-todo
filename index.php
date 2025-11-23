
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark py-3 px-5">
        <a class="nav-link active text-white fw-bold fs-5 " aria-current="page" href="#">Todolist</a>
    </nav>
    <div class="container">
        <?php if (isset($_GET["msg"])): ?>
            <div class="alert alert-success alert-dismissible fade show text-center mt-4" role="alert">
                <?= htmlspecialchars($_GET["msg"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form method="post" action="index.php" class="row g-3 pt-5 justify-center d-flex justify-content-center">
            <div class="col-4 ">
                <input type="text" name="title" class="form-control" id="inputPassword2" placeholder="Task Title">
            </div>
            <div class="col-auto">
                <button type="submit" name="action" class="btn btn-primary mb-3" value="new">Add</button>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center pt-5">
            <div class="col-6">
                <?php  if(empty($taches)): ?>
                    <div class="fs-4 text-center py-4">Aucune Taches Trouver</div>
                <?php  else: ?>
                    <ul class="list-group">
                        <?php foreach ($taches as $t):?>
                            <?php if($t["done"] == 1):?>
                                <li class="list-group-item list-group-item-success d-flex justify-content-between"> 
                                     <span class="me-3 flex-shrink-1 " style=" word-break: break-word; "><?= $t["title"] ?></span>
                                    <form method="post" action="index.php" class="btn-group flex-shrink-0 " role="group" aria-label="Basic outlined example">
                                        <input type="hidden" name="idtodo" value="<?= $t["id"]?>">
                                        <button type="submit" value="toggle" name="action" class="btn btn-primary rounded-start">Done</button>
                                        <button type="submit" value="delete" name="action" class="btn btn-danger">X</button>
                                    </form>
                                </li>
                            <?php else:?>
                                <li class="list-group-item list-group-item-warning d-flex justify-content-between">
                                     <span class="me-3 flex-shrink-1" style="word-break: break-word;"><?= $t["title"] ?></span>
                                    <form method="post"  action="index.php" class="btn-group flex-shrink-0" role="group" aria-label="Basic outlined example">
                                        <input type="hidden" name = "idtodo" value="<?= $t["id"]?>">
                                        <button type="submit" value="toggle" name="action" class="btn btn-primary rounded-start">Done</button>
                                        <button type="submit" value="delete" name="action" class="btn btn-danger">X</button>
                                    </form>
                                </li>
                        <?php endif ?>
                        <?php  endforeach ?>
                    </ul>
                <?php  endif ?>
            </div>
        </div>
    <div>
</body>
<style>
</style>
</html>

