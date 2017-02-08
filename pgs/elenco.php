<?php
	$table='pressione';
	$record=(empty($_REQUEST['id'])) ?  R::dispense($table) : R::load($table, intval($_REQUEST['id']));	
	try {
		if ($record && !empty($_REQUEST['act']) && $_REQUEST['act']=='del') R::trash($record);
		if (!empty($_POST['datamisurazione'])){
			foreach ($_POST as $k=>$v){
				$record[$k]=$_POST[$k];
			}
			die(print_r($record,1));
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
<form name="MyForm " action="?p=elenco" onsubmit="" method="POST">
	<caption>Nuova misurazione:</caption>
	<input type="date" name="datamisurazione" value="<?=date('Y-m-d');?>" placeholder="data" required />
        <input type="number" name="sistolica" placeholder="sistolica"  onchange="checkValue()"  autofocus required />
	<input type="number" name="diastolica" placeholder="diastolica"  required />	
        <input type="number" name="kg" placeholder="kg" step="any" required />
	<button type="submit" onmouseover="setCondition()">Salva</button>
</form>
<table border="1" id="example">
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
				Peso
			</th>                        
			<th>
				&nbsp;
			</th>			
		</tr>
	</thead>
        <tfoot>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tfoot>
	<tbody>
	<?php foreach ($pa as $i) : ?>
		<tr>
			<td>
				<?=date('d/m/y',strtotime($i->datamisurazione))?>
			</td> 
			<td>
				<?=$i->sistolica?> 
			</td> 
			<td>
				<?=$i->diastolica?>
			</td>
			<td>
				<?=$i->kg?>
			</td>                        
			<td>
				<a href="?p=elenco&act=del&id=<?=$i->id?>" title="elimina questa rilevazione">x</a>
			</td>			
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>


<script>
    function setCondition(){
        document.getElementsByName("diastolica")[0].setAttribute("max",document.getElementsByName("sistolica")[0].value);
    }
    
    
    
    
</script>