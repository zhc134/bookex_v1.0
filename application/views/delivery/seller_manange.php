<?php $this->load->view('delivery/header') ?>
<!-- in the row	 -->
	<div class="span12">
		<p><?php echo $quantity;?></p>
		<?php
			$book_url = site_url('book_details/book/');
			$user_url = site_url('admin/user_modify/');
			$submit_status = array(
			'0'=>'申请委托',
			'11'=>'交易拒绝',
			'12'=>'用户取消',
			'21'=>'审核通过',
			'31'=>'等待收书',
			'41'=>'超时取消',
			'42'=>'无书取消',
			'51'=>'已收到书',
			'61'=>'订单完成，succ',
			'62'=>'订单完成，fail',
			);
		?>
		<?php foreach ($seller_list as $seller) :?>
		<table class="table table-bordered table-hover">
			<tr class="info">
				<td colspan=5>
				<?php
				$user_anchor = anchor_popup(site_url('admin/user_modify/'.$seller['seller_detail']['id']),$seller['seller_detail']['username']);
				echo '  <i class="icon-user"></i>  '.$user_anchor.'('.$seller['seller_detail']['phone'].')';
				echo '  <i class="icon-home"></i>  '.$seller['seller_detail']['dormitory'];
				echo '  <i class="icon-info-sign"></i>  '.$seller['seller_detail']['student_number'];
				if($seller['seller_detail']['show_phone'])
				{
					echo ' 支持自行交易';
				}
				else
				{
					echo ' 不支持自行交易';
				}
					?>
				</td>
			</tr>

			<tr class="info">
				<td colspan=2>
					<form class="form-inline" method='post' action='<?php echo site_url('delivery/add_seller_msg');?>' >
					  <input type="text" name='msg' placeholder="卖家笔记">
					  <input type='hidden' name='seller_id' value='<?php echo $seller['seller_detail']['id'];?>' >
					  <button type="submit" class="btn">新增</button>
					  <a href="<?php echo site_url('delivery/add_seller_msg?seller_id='.
					  $seller['seller_detail']['id'].'&msg=已告知卖家送书来')?>" class="btn">已告知卖家送书来</a>
					</form>
				</td>
				<td colspan=3>
				<?php
				$new = '(最新)';
				foreach ($seller['msg_list'] as $msg) {
					echo '<i class="icon-comment"></i>'.substr($msg['contact_time'],5,11).' '.$msg['msg'].$new;
					echo anchor(site_url('delivery/del_msg/'.$msg['id']),'<span class="label label-important right"><i class="icon-remove icon-white"></i></span>');
					echo '<span class="label label-info right right-margin">by: '.$msg['op_info']['username'].'</span>';
					echo '<br>';
					$new = NULL;
				}
				?>
				</td>
			</tr>


			<?php
			foreach ($seller['submit_info'] as $submit) :?>
			<?php 
			$revocation = anchor(site_url('delivery/revocation/'.$submit['id']),
			"<span class='label label-important right'>恢复等待取书状态</span>");
			$got_book_anchor = anchor(site_url('delivery/got_book/'.$submit['id']),
			"<span class='label label-success right right-margin'>从卖家得到书</span>");
			$no_book_cancel_anchor = anchor(site_url('delivery/no_book_cancel/'.$submit['id']),
			"<span class='label label-important right'>卖家无书</span>");
			?>
				<?php if($submit['status'] == 31) echo "<tr>";else echo "<tr class='success'>";?>
				<td width=5%>#<?php echo $submit['id'];?></td>
				<td width=46%><?php echo anchor_popup($book_url.'/'.$submit['book_detail']['id'],$submit['book_detail']['name']);?>
					<span class="label label-info right"><?php echo $submit_status[$submit['status']];?></span>
				</td>
				<td width=24%>买家 <?php echo anchor_popup($user_url.'/'.$submit['buyer_detail']['id'],$submit['buyer_detail']['username']).
				'('.$submit['buyer_detail']['phone'].')';?></td>
				<td width=6%>￥<?php echo $submit['book_detail']['price'];?></td>
				<td width=19%><?php if($submit['status'] == 31)echo $no_book_cancel_anchor.$got_book_anchor;else echo $revocation;?></td>
				</tr>
			<?php endforeach;?>
		</table>
		<?php endforeach;?>
	</div><!-- end of span12	 -->
</div><!-- end of row -->
</body>
</html>
