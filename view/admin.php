<div class="admin_main">
	<table class="admin_table">
		<theader>
			<tr>
				<th>id</th>
				<th>author id</th>
				<th>title</th>
				<th>description</th>
				<th>layout</th>
				<th>post date</th>
				<th>delete</th>
			</tr>
		</theader>
		<tbody>	

			<?php 
			$i=0;
			while($i<10):
				foreach ($stories as $story): 
			?>
					<tr>
						<td><?= $story->id(); ?></td>
						<td><?= $story->id_author(); ?></td>
						<td><?= $story->title(); ?></td>
						<td><?= $story->description(); ?></td>
						<td><?= $story->layout(); ?></td>
						<td><?= $story->datetimepost(); ?></td>
						<td><form method="POST"><input type="hidden" name="id_story" value="<?= $story->id() ?>" /><input type="submit" name="delete_submit" class="delete_submit" value="yes" /></td>
					</tr>	
			<?php 
					$i++;	
				endforeach; 
			endwhile;	
			?>
		</tbody>
		<tfooter>
			<tr>
				<th>id</th>
				<th>author id</th>
				<th>title</th>
				<th>description</th>
				<th>layout</th>
				<th>post date</th>
				<th>delete</th>
			</tr>
		</tfooter>
	</table>	
</div>