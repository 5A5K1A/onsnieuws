<?php
$aData  = $this->oArticle;
$sLabel = sanitize_title( $aData->name );
?>

<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="faq-<?php echo $sLabel; ?>">
		<h4 class="panel-title question">
			<a data-toggle="collapse" data-parent="#<?php echo $this->sSectionId; ?>" href="#<?php echo $sLabel; ?>" aria-expanded="false" aria-controls="<?php echo $sLabel; ?>">
				<?php echo $aData->name; ?>
			</a>
		</h4>
	</div>
	<div id="<?php echo $sLabel; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq-<?php echo $sLabel; ?>">
		<div class="panel-body answer">
			<?php echo apply_filters( 'the_content', $aData->body ); ?>
		</div>
	</div>
</div>
