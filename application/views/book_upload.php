<div class="container">
<?php if (form_error('bookname') != ''): ?>
	<div class="alert alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo form_error('bookname'); ?>
	</div>
<?php endif; ?>
<?php if (form_error('price') != ''): ?>
	<div class="alert alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo form_error('price'); ?>
	</div>
<?php endif; ?>
<?php if (form_error('originprice') != ''): ?>
	<div class="alert alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo form_error('originprice'); ?>
	</div>
<?php endif; ?>
<?php if (form_error('userfile') != ''): ?>
	<div class="alert alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo form_error('userfile'); ?>
	</div>
<?php endif; ?>
<?php if (isset($isbn_error)): ?>
	<div class="alert alert-error fade in">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo $isbn_error; ?>
	</div>
<?php endif; ?>
</div>

<div id="book_upload" class="container">
<fieldset>
	<legend>快速上传</legend>
	<div class="row">
		<div class="span5">
			<form class="form-search" action="<?php echo site_url('book_upload/book_isbn') ?>" method="get" accept-charset="utf-8">
			  <input type="text" name ="book_isbn" class="input-medium search-query">
			  <button id="isbn_btn" type="submit" class="btn">通过ISBN快速上传</button>
			</form>
		</div>
		<div class="span7">
			<form class="form-search" action="<?php echo site_url('book_upload/book_select') ?>" method="get" accept-charset="utf-8">
			  <input type="text" name ="book_name" class="input-medium search-query">
			  <button id="q_btn" type="submit" class="btn">搜索书名上传</button>
			</form>
		</div>
	</div>
	<legend>或 自行填写书本信息</legend>
	<form class="form-horizontal" action="<?php echo site_url('book_upload/upload_validation') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<div class="control-group">
		    <label class="control-label" for="bookname">书本名称</label>
		    <div class="controls">
		      	<input type="text" id="bookname" name="bookname" value="<?php echo set_value('bookname'); ?>" placeholder="书本名称">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="author">作者</label>
		    <div class="controls">
		     	<input type="text" id="author" name="author" value="<?php echo set_value('author'); ?>" placeholder="作者">
		    	<span class="help-inline">如有多个作者请用空格分开.</span>
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="publisher">出版社</label>
		    <div class="controls">
		      	<input type="text" id="publisher" name="publisher" value="<?php echo set_value('publisher'); ?>" placeholder="出版社">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="isbn">ISBN</label>
		    <div class="controls">
		      <input type="text" id="isbn" name="isbn" value="<?php echo set_value('isbn'); ?>" placeholder="ISBN">
		    	<span class="help-inline">选填</span>	
		    </div>
		</div>
		<div class="control-group">
	    <label class="control-label" for="originprice">原价</label>
	    <div class="controls">
	     	<input type="text" id="originprice" name="originprice" value="<?php echo set_value('originprice'); ?>" placeholder="原价">
	    </div>
		</div>
		<div class="control-group">
	    <label class="control-label" for="price">售出价格</label>
	    <div class="controls">
	     	<input type="text" id="price" name="price" value="<?php echo set_value('price'); ?>" placeholder="售出价格">
	    </div>
		</div>
		<div class="control-group">
	    <label class="control-label" for="description">简介</label>
	    <div class="controls">
	     	<textarea name="description" id="description" cols="60" rows="5"><?php echo set_value('description') ?></textarea>
	     	<span class="help-inline">比如新旧程度，有无笔记（笔记质量好坏）等。</span>
	    </div>
		</div>
		<div class="control-group">
	    <label class="control-label" for="description">上传图片</label>
	    <div class="controls">
	    	<input type="hidden" name="max_file_size" value="2000000">
	     	<input type="text" id="filename" class="disabled" style="width: 148px;" disabled>
				<input type="button" class="btn" onclick="file.click();" value="浏览">  
				<input style="display: none" type="file" id="file" name="userfile" onchange="filename.value=this.value">
	     	                <span class="help-inline">上传图片有助于提高书的出售率哦～</span>
		<span class="help-block">若不上传图片则将会使用默认图片.<br /> 书本图片可以在z.cn亚马逊上轻松找到哦～</span>
	    </div>
		</div>			
	  <input type="hidden" id="uploader" name="uploader" value="<?php echo $this->session->userdata('username') ?>">
		<div class="control-group">
		    <div class="controls">
		      	<button type="submit" class="btn">确认上传</button>
		    </div>
		</div>
	</form>
</fieldset>
</div>


<div class="modal fade hide" id="dataLoad">
  <div class="modal-header">
    <h3>提示</h3>
  </div>
  <div class="modal-body">
    <p>正在从豆瓣拉取书本信息...</p>
    <p>读取时间取决于当前网络环境...</p>
  </div>
  <div class="modal-footer">
    <a class="btn" data-dismiss="modal" aria-hidden="true">关闭提示框继续等待</a>
  </div>
</div>

