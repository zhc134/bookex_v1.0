<?php
					$st = $this->session->userdata('is_logged_in');
					$user = $this->session->userdata('username');

					$id = $info->id;
					$name = $info->name;
					$author = $info->author;
					$price = $info->price;
					$publisher = $info->publisher;
					$ISBN = $info->ISBN;
					$description = $info->description;
					$uploader = $info->uploader;
					$subscriber = $info->subscriber;
					$originprice = $info->originprice;
					$finished = ($info->finishtime != "0000-00-00 00:00:00");

					$err = $err_mes;
					$is_success = $is_succ;
?>

<style type="text/css">
	p {
		word-break: break-all;
		font-size: 15px;
	}
</style>


<div class = "container" style = "font-family: verdana">

<?php
	if ($err != "")
		if ($is_success == true) {
			?>

			<div class="alert alert-success fade in">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong></strong> <?php echo $err; ?>
			</div>

			<?php
		}
		else
		{
			?>


			<div class="alert alert-error fade in">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong></strong> <?php echo $err; ?>
			</div>

			<?php
		}
?>

	<div class = "row">
		<div id = "left" class = "span4 text-center">
			<div class="thumbnail">

				<img src = "<?php echo base_url('get_data.php?id='.$id); ?>" style = "width:80%" />
				
				<p> <strong> 上传人: </strong> &nbsp <?php echo $uploader; ?> </p>
				<?php
					if ($finished == true) {
						?>
						<a class = "btn disabled"> 已交易 </a>
						<?php
					}
					else if ($st == true) {
						if ($uploader == $user) {
							if ($subscriber == 'N') {
								?>

								<a class = "btn disabled"> 未预订 </a>

								<?php
							}
							else {
								?>

								<a class = "btn" href = "<?php echo site_url('book_details/uploader_cancel/'.$id); ?>"> 已预订，取消该订单 </a>

								<?php
							}
						}
						else if ($subscriber == 'N') {
							?>

								<a class = "btn" href = "<?php echo site_url('book_details/order/'.$id); ?>"> 预订 </a>

							<?php
						}
						else {
							if ($subscriber == $user) {
								?>

								<a class = "btn" href = "<?php echo site_url('book_details/user_cancel/'.$id); ?>"> 取消订单 </a>

								<?php
							}
							else {
								?>

								<a class = "btn disabled"> 已被预订 </a>

								<?php
							}
						}
					}
					else {
						?>

						<a class = "btn disabled"> 您还未登入 </a>

						<?php
					}
				?>
					
			</div>
		</div>

		<div id = "right" class = "span7 offset1">
			<legend>
				<strong> <?php echo $name; ?> </strong>
				
				<?php
					$user = $this->session->userdata('username');
					if ($uploader == $user) { 
				?>
					<a href="<?php echo site_url('book_upload/modify') ?>/<?php echo $id ?>"> 
						<span style = "font-size: 12px;"> 编辑 <span>
					</a>
				<?php } ?>


			</legend>
			<div class = "row-fluid">
				<p class = "span2">  <strong> 价格 </strong> </p>
				<p class = "span10" style = "font-size: 17px; color: #ff0000;">
					<strong> ￥<?php echo $price; ?> </strong>
					<span style = "text-decoration: line-through; font-size: 12px; color: #999">
						￥<?php echo $originprice; ?>
					</span>
				</p>
			</div>

			<div class = "row-fluid">
				<p class = "span2"> <strong> 作者 </strong> </p>
				<p class = "span10"> <?php echo $author; ?> </p>
			</div>

			<div class = "row-fluid">
				<p class = "span2"> <strong> 出版社 </strong> </p>
				<p class = "span10"> <?php echo $publisher; ?> </p>
			</div>

			<div class = "row-fluid">
				<p class = "span2"> <strong> 简介 </strong> </p>
				<p class = "span10">
					<?php echo $description; ?>
				</p>
			
			</div>
		</div>

	</div>
</div>
