<?php
define('DB_USER','root');
define('DB_PASS', '');
define('DB_NAME', 'todolist1');
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');

?>

<?php
 $clients= $clientdb->readAll();
?>

<section>
	<div id="titre_app" >
		<span class="titre"> Gestion des clients</span>
		<hr>
		<div class="liens">
			<a href="app.php?views=client_create">Ajouter un client</a>
		</div>
	</div>
	<br> <br>
	<div id="tableau">
		 <table border="1" cellspacing="0" cellpadding="4"><!-- cellspacing espacement a l'interieur de cellule cellpading espace entre les cellule -->
			<thead>
				<tr>
					<th>N°</th>
					<th>tache</th>
					
				</tr>	
			</thead>

			<tbody class="elements">

				<?php
					if ($todos!=null && sizeof($todos)>0):
						$i=0;
						foreach ($todos as $todo):
							$i++;
					$update='app.php?views=todo_update&idtodo='.$todo->idtodo;
					$delete='controller/todoController.php?action=delete&idtodo='.$todo->idtodo;
					
				?>

				<tr class="element">
					<td class="data"><?= $i ?></td>
					<td class="data"><?= $todo->tache?></td>
					<td class="options">
						<a class="update" href="<?= $update ?>">Modifier✍</a>
						<a href="<?= $delete ?>" class="delete">Supprimer🗑</a>
					</td>
				</tr>

				<?php
					endforeach;
				 	endif;
				?>
			</tbody>
		</table>
	</div>
</section>
