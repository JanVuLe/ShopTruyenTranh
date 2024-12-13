<ul class="d-flex flex-column" style="list-style-type: none">
<?php foreach($mathangxemnhieu as $x): ?>
	<li style="max-height:100px; padding-top: 3px;"><a class="text-decoration-none" href="index.php?action=detail&id=<?php echo $x["id"]; ?>">		
		<img style="max-width:12%; max-height:92px;" class="img-thumbnail float-start m-2" 
			src="../<?php echo $x["hinhanh"]; ?>" 
			alt="<?php echo $x["tenmathang"]; ?>">		
		<h6 class="card-title text-info" style="padding-top: 6px;"><?php echo $x["tenmathang"]; ?></h6>
		<p class="card-text text-danger fw-bold"><?php echo number_format($x["giaban"]); ?>đ</p>	</a>	
	</li>
<?php endforeach; ?>
</ul>