<section>
	<div id="titre_app" >
		<span class="titre"> Ajouter une tache</span>
		<hr>
		<div class="liens">
			<a href="app.php?views=todo">Liste des taches</a>
		</div>
	</div>
	<br> <br>

	<form name="form_create" method="POST" action="todoController.php?action=create" >
		<fieldset>

			<p class="field ">
				<label for="tache">Tache</label><br/>
				<input type="text" name="tache" id="tache" required/>
			</p>
			
		</fieldset>		
	</form>
</section>