<?php


$oZendeskSection  = new Control_Zendesk_Section();
$aZendeskArticles = $oZendeskSection->GetSingleSection($this->aSection['value']);


?>
<h2><?php echo $this->aSection['label']; ?></h2>

<?php foreach( (array)$aZendeskArticles as $key => $oArticle ) : ?>
<div class="article-<?php echo $key; ?>">
	<?php Template::Render( 'snippet-article', array('oArticle' => $oArticle) ); ?>
</div>

<?php endforeach; ?>


<?php

// p($aZendeskArticles);
