<?php 
include_once './../layout/forum_header.php';
if(isset($_SESSION['username']))
{
	?>
	<div class="content">
	En tant que membre de Raining Music, vous avez accès au Forum. Celui-ci vous permet de communiquer avec les autres membres de notre communauté. Cependant, les catégories ne sont gérable que par les admins de notre site. Si vous souhaitez qu'une nouvelle catégorie apparaisse car elle vous semble manquante, veuillez nous contacter via l'onglet "Nous contacter" et nous faire part de cette requête.<br /> L'équipe <br/><br/>
<div class="box">
	<div class="box_left">
		<a href="<?php echo $url_home; ?>">Forum Index</a>
	</div>
	<div class="box_right">
		 
		</a> - <?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>
		</a>  
	</div>
	<div class="clean"></div>
</div> 
<?php
}	?>
<table class="categories_table">
	<tr>
		<th class="forum_cat">Category</th>
		<th class="forum_ntop">Topics</th>
		<th class="forum_nrep">Replies</th>
		<?php
		if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
		{
			?>
		<th class="forum_act">Action</th>
		<?php
		}
		?>
	</tr>
	<?php
	$dn1 = mysql_query('select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
	$nb_cats = mysql_num_rows($dn1);
	while($dnn1 = mysql_fetch_array($dn1))
	{
		?>
	<tr>
		<td class="forum_cat"><a
			href="list_topics.php?parent=<?php echo $dnn1['id']; ?>"
			class="title"><?php echo $dnn1['name'] ?>
		</a>
			<div class="description">
				<?php echo $dnn1['description']; ?>
			</div></td>
		<td><?php echo $dnn1['topics']; ?></td>
		<td><?php echo $dnn1['replies']; ?></td>
		<?php
		if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
		{
			?>
		<td><a href="delete_category.php?id=<?php echo $dnn1['id']; ?>"><img
				src="./../pictures/delete.png" alt="Delete" /> </a>
			<?php if($dnn1['position']>1){ ?><a
			href="move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><img
				src="./../pictures/up.png" alt="Move Up" /> </a> <?php } ?>
			<?php if($dnn1['position']<$nb_cats){ ?><a
			href="move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><img
				src="./../pictures/down.png" alt="Move Down" /> </a>
			<?php } ?> <a href="edit_category.php?id=<?php echo $dnn1['id']; ?>"><img
				src="./../pictures/edit.png" alt="Edit" /> </a>
		</td>
		<?php
		}
		?>
	</tr>
	<?php
	}
	?>
</table>
<?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
	?>
<a href="new_category.php" class="button">New Category</a>
<?php
}

 
include_once './../layout/basic_footer.php';
?>