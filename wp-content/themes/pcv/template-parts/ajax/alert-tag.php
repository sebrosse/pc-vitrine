<div class="alert-tag d-flex justify-content-between align-items-center">
	<div>
		<strong>Alerte</strong><br>
		<span class="text-muted threshold"><?php echo $alert['content']['threshold'];?>€</span>
	</div>
	<div class="align-items-center h-100">
		<ul class="d-inline-block mb--0">
			<li class="mr--5 d-inline-block">
				<a href="#" class="mini-action edit-alert-js">
					<i class="fal fa-pencil"></i>
				</a>
			</li>
			<li class="d-inline-block">
				<a href="#" class="mini-action remove-alert-js" data-aid="<?php echo $alert['content']['id'];?>">
					<i class="fal fa-times"></i>
				</a>
			</li>
		</ul>
	</div>
</div>