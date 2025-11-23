
<?php
$host = 'localhost';
$db = 'todolist1'; 
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $message = ""; 
    
    $sql_select = "SELECT * FROM todo ORDER BY idtodo DESC"; 
    $stmt_select = $pdo->query($sql_select);
    $taches = $stmt_select->fetchAll(); 
    
} catch (\PDOException $e) {
    die("Erreur de connexion à la BDD : " . $e->getMessage());
}

$edit_data = null; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tache = $_POST['tache'] ?? '';
    $idtodo = $_POST['idtodo'] ?? null;

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'new' && $tache) {
            $sql = "INSERT INTO todo (tache) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$tache]);
            $message = "Nouvel enregistrement créé avec succès.";
            
        } elseif ($action === 'toggle' && $idtodo ) {
            $sql = "UPDATE todo SET done = 1 - done WHERE idtodo = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idtodo]);
            $message = "Enregistrement ID $idtodo mis à jour avec succès.";
          
            } elseif ($action === 'edit_save' && $idtodo && $tache) {
        $sql = "UPDATE todo SET tache = ? WHERE idtodo = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tache, $idtodo]);
        $message = "Tâche modifiée avec succès.";


        } elseif ($action === 'delete' && $idtodo) {
            $sql = "DELETE FROM todo WHERE idtodo = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idtodo]);
            $message = "Enregistrement ID $idtodo supprimé avec succès.";
        }
    }
    
    header("Location: index.php?msg=" . urlencode($message));
    exit;
}
?>

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
        
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success mt-3" role="alert">
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>

        <form method="Post" action="index.php" class="row g-3 pt-5 justify-content-center">
            <input type="hidden" name="action" value="new">
            <div class="col-auto flex-grow-1">
                <input type="text" name="tache" class="form-control" placeholder="Task Title" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Add</button>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center pt-5">
            <div class="col-6">
                <ul class="list-group">
                    <?php if (!empty($taches)): ?>
                        <?php foreach ($taches as $tache): ?>
                            <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center"> 
                                <?= htmlspecialchars($tache['tache']) ?>
                                
                                <form method="POST" action="index.php" class="btn-group" role="group">
                                    <input type="hidden" name="idtodo" value="<?= $tache['idtodo'] ?>">
                                    
                                    <button type="submit" value="toggle" name="action" class="btn btn-primary">Done</button>
                                    <button type="submit" value="delete" name="action" class="btn btn-danger">X</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item">Aucune tâche enregistrée pour le moment.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
   
</body>
</html>