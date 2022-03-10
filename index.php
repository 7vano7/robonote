<?php
    require_once("config/db.php");

    if(isset($_POST['delete'])) {
    	header('Content-Type: application/json');
    	$sql = "DELETE FROM `icons` WHERE id=".$_POST['delete'];
    	$mysql->query($sql);
    	echo json_encode(['status'=>'success']);die;
    }

    if(isset($_POST['name'])) {
    	header('Content-Type: application/json');
    	$date = date('Y-m-d H:i:s');
    	$name = $_POST['name'];
    	$icon = $_POST['icon'];
    	$sql = "INSERT INTO `icons` (name, path, created_at) VALUES ('".$name."', '".$icon."', '".$date."')";
    	$mysql->query($sql);
    	echo json_encode(['status'=>'success', 'number'=>$mysql->insert_id]);die;
    }

require_once("header.php");
?>

<div class="content">
	<table class="table">
		<tbody>
    	<?php $result = $mysql->query("SELECT * FROM `icons` ORDER BY `id` ASC"); ?>
    	<?php if($result->num_rows > 0): ?>
			<?php while($row = $result->fetch_assoc()) :?>
				<tr class="item">
					<td class="number">
						<?php echo $row['id']?>
					</td>
					<td class="table-text">
						<img src="icons<?php echo $row['path'] ?>" class="img" /> <span><?php echo $row['name'] ?><span>
					</td>
					<td  class="number">
						<a href=""><i class="fa fa-trash" data-id="<?=$row['id']?>"></i></a>
					</td>
				</tr>	
			<?php endwhile?>
    	<?php endif ?>
    </tbody>
	</table>
    <form action="" method="post">
    	<div class="input-icon">
    		<img src="" class="input-img" />
    		<input type="text" name="name" data-id="" class="record" placeholder="Enter text">
    		<button type="submit" class="btn-submit">Save</button>
    		<i class="fa fa-fonticons icon"></i>
    	</div>
    	<div class="icons-list">
    		<?php $dh  = opendir('icons');?>
        <?php while (false !== ($filename = readdir($dh))) :?>
            <?php if(in_array($filename, ['.', '..']))
                continue;
                ?>
    			<span class="icon-img" data-name="<?=$filename?>"><img src="icons/<?=$filename?>"></span> 
        <?php endwhile ?>
    	</div>
    </form>
</div>
<?php
require_once('footer.php');
?>