<?php
//This page let create a new category
$_SESSION['username'] ='chazinou';
include('./../layout/forum_header.php');
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>    <div class="content">
<?php
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; New Category
    </div>
	<div class="box_right">
    	 </a> -<?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>  
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['name'], $_POST['description']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	get_magic_quotes_gpc();
	
	if(mysql_query('insert into categories (id, name, description, position) select ifnull(max(id), 0)+1, "'.$name.'", "'.$description.'", count(id)+1 from categories'))
	{
	?>
	<div class="message">The category have successfully been created.<br />
	<a href="<?php echo $url_home; ?>">Go to the forum index</a></div>
	<?php
	}
	else
	{
		echo 'An error occured while creating the category.';
	}
}
else
{
?>
<form action="new_category.php" method="post">
	<label for="name">Name</label><input type="text" name="name" id="name" /><br />
	<label for="description">Description</label>(html enabled)<br />
    <textarea name="description" id="description" cols="70" rows="6"></textarea><br />
    <input type="submit" value="Create" />
</form>
<?php
}
include './../layout/basic_footer.php';
}
else
{
	echo '<h2>You must be logged as an administrator to access this page: <a href="login.php">Login</a> - <a href="signup.php">Sign Up</a></h2>';
}
?>