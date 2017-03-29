<?php
$sSectionId       = $this->aSection['value'];

$oZendeskSection  = new Control_Zendesk_Section();
$aZendeskArticles = $oZendeskSection->GetSingleSection($sSectionId);


?>
<h2><?php echo $this->aSection['label']; ?></h2>

<div class="panel-group" id="section-<?php echo $sSectionId; ?>">
<?php foreach( (array)$aZendeskArticles as $key => $oArticle ) :
	Template::Render( 'snippet-article', array('oArticle' => $oArticle, 'sSectionId' => $sSectionId) );
	endforeach; ?>
</div>
