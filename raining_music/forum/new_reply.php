<?php
//This page let reply to a topic
include('./../layout/forum_header.php');
if(isset($_GET['id']))
{
	$id = intval($_GET['id']);
if(isset($_SESSION['username']))
{
	$dn1 = mysql_fetch_array(mysql_query('select count(t.id) as nb1, t.title, t.parent, c.name from topics as t, categories as c where t.id="'.$id.'" and t.id2=1 and c.id=t.parent group by t.id'));
if($dn1['nb1']>0)
{
?>  <head>
  		<script type="text/javascript" src="functions.js"></script>
    </head>
        <div class="content">

<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <a href="list_topics.php?parent=<?php echo $dn1['parent']; ?>"><?php echo htmlentities($dn1['name'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; <a href="read_topic.php?id=<?php echo $id; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a> &gt; Add a reply
    </div>
	<div class="box_right">
    	 </a> -<?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a>  
    </div>
    <div class="clean"></div>
</div>
<?php
if(isset($_POST['message']) and $_POST['message']!='')
{
	include('bbcode_function.php');
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysql_real_escape_string(bbcode_to_html($message));
	if(mysql_query('insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$dn1['parent'].'", "'.$id.'", max(id2)+1, "", "'.$message.'", "'.$_SESSION['userid'].'", "'.time().'", "'.time().'" from topics where id="'.$id.'"') and mysql_query('update topics set timestamp2="'.time().'" where id="'.$id.'" and id2=1'))
	{
	?>
	<div class="message">The message have successfully been sent.<br />
	<a href="read_topic.php?id=<?php echo $id; ?>">Go to the topic</a></div>
	<?php
	}
	else
	{
		echo 'An error occurred while sending the message.';
	}
}
else
{
?>
<form action="new_reply.php?id=<?php echo $id; ?>" method="post">
    <label for="message">Message</label><br />
    <div class="message_buttons">
        <input type="button" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Image" onclick="javascript:insert('[img]', '[/img]', 'message');" /><!--
        --><input type="button" value="Link" onclick="javascript:insert('[url]', '[/url]', 'message');" /><!--
        --><input type="button" value="Left" onclick="javascript:insert('[left]', '[/left]', 'message');" /><!--
        --><input type="button" value="Center" onclick="javascript:insert('[center]', '[/center]', 'message');" /><!--
        --><input type="button" value="Right" onclick="javascript:insert('[right]', '[/right]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    <input type="submit" value="Send" />
</form>
<?php
}
include './../layout/basic_footer.php';
}
else
{
	echo '<h2>The topic you want to reply doesn\'t exist.</h2>';
}
}
}
else
{
	echo '<h2>The ID of the topic you want to reply is not defined.</h2>';
}
?>