<?php
	$table='pressione';
	$record=(empty($_REQUEST['id'])) ?  R::dispense($table) : R::load($table, intval($_REQUEST['id']));	
	try {
		if ($record && !empty($_REQUEST['act']) && $_REQUEST['act']=='del') R::trash($record);
		if (!empty($_POST['datamisurazione'])){
			foreach ($_POST as $k=>$v){
				$record[$k]=$_POST[$k];
			}
			R::store($record);
		}
	} catch (RedBeanPHP\RedException\SQL $e) {
		?>
		<h4 class="msg label error">
			<?=$e->getMessage()?>
		</h4>
		<?php
	}	
	$pa=R::find($table);
?>
<h2>
	<a href="index.php">
		Misurazioni
	</a>
</h2>
<form action="?p=elenco" method="POST">
	<caption>Nuova misurazione:</caption>
	<input type="date" name="datamisurazione" value="<?=date('Y-m-d');?>" placeholder="data" required />
	<input type="number" name="sistolica" placeholder="sistolica" required />
	<input type="number" name="diastolica" placeholder="diastolica" required />	
	<button type="submit">Salva</button>
</form>
<table border="1">
	<thead>
		<tr>
			<th>
				Data misurazione
			</th>
			<th>
				Sistolica
			</th>		
			<th>
				Diastolica
			</th>
			<th>
				&nbsp;
			</th>			
		</tr>
	</thead>
	<tbody>
	<?php foreach ($pa as $i) : ?>
		<tr>
			<td>
				<?=$i->datamisurazione?>
			</td> 
			<td>
				<?=$i->sistolica?> 
			</td> 
			<td>
				<?=$i->diastolica?>
			</td>
			<td>
				<a href="?p=elenco&act=del&id=<?=$i->id?>" title="elimina questa rilevazione">x</a>
			</td>			
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>