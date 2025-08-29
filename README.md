# Magento 2 Hyvä Module Pagespeedfr CmsAcf
When building websites, clients often lack HTML/CSS knowledge and are reluctant to use WYSIWYG editors that expose HTML code, fearing they might break the site. Clients consistently request simpler page and block management solutions.
Advanced Custom Fields CMS was developed to address this need. Through its custom field system, clients can update their page content by simply modifying field values, without risking changes to the underlying DOM structure.
In essence, this solution enables non-technical clients to easily manage their website content by separating content management from the technical site structure.


## Main Functionalities
You can add field textarea, link, image, files in admin
 <img width="1761" height="717" alt="image" src="https://github.com/user-attachments/assets/0e550078-f65c-40ba-89ef-5432cab10dc3" />

and get it in front with viewmodel :
<img width="902" height="370" alt="image" src="https://github.com/user-attachments/assets/fdf71de5-b72e-45c7-807a-176fef810af6" />

	<?php
	use Pagespeedfr\CmsAcf\ViewModel\AcfField;
	
	// Récupérer le ViewModel
	$acfField = $viewModels->require(AcfField::class);
	?>
	
Exemple 1: Show link ACF, id "10"
<?php $fieldData = $acfField->getAcfField(10); ?>
<?php if ($fieldData): ?>
    <div class="acf-field" data-acf-type="<?= $escaper->escapeHtmlAttr($fieldData['acftype']) ?>">
        <?php if ($fieldData['content_secondary']): ?>
          <a href="<?= $escaper->escapeHtml($fieldData['content_secondary']) ?>" class="text-decoration" title="<?= $escaper->escapeHtml($fieldData['content']) ?>">
        <?php endif; ?>
       <?= $escaper->escapeHtml($fieldData['content']) ?></h3>
        <?php if ($fieldData['content_secondary']): ?>
        </a> 
        <?php endif; ?>
    </div>
<?php endif; ?>
<br/>

Exemple: Show Img, id "11"
<?php $fieldData = $acfField->getAcfField(11); ?>
<?php if ($fieldData): ?>
    <div class="acf-field" data-acf-type="<?= $escaper->escapeHtmlAttr($fieldData['acftype']) ?>">
        <img src="<?= $escaper->escapeHtml($fieldData['content']) ?>" width="150"
        <?php if ($fieldData['content_secondary']): ?>
             alt="<?= $escaper->escapeHtml($fieldData['content_secondary']) ?> ""
        <?php endif; ?> />
    </div>
<?php endif; ?>

<br/>
Exemple : Show all field from a tag "Category Link"
<?php $categoryFields = $acfField->getAcfFieldsByCategory('Category Link'); ?>
<?php foreach ($categoryFields as $field): ?>
    <div class="acf-category-field">
        <a href="<?= $field['content'] ?>" title="<?= $escaper->escapeHtml($field['content_secondary']) ?>">Link to files <?= $escaper->escapeHtml($field['content_secondary']) ?></strong>
        
    </div>
<?php endforeach; ?>


### Installation

 - Unzip the zip file in `app/code/Pagespeedfr`
 - Enable the module by running `php bin/magento module:enable Pagespeedfr_CmsAcf`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

Get Hyvä Form, from this repository : https://github.com/hyva-themes/magento2-hyva-admin/tree/hyva-forms

Change from this repository :
add in app\code\Hyva\Admin\etc\hyva-form.xsd this line <xs:attribute name="label" type="xs:string"/> (arround lines 120)
like this
<xs:complexType name="unconstrainedField">
        <xs:attribute name="label" type="xs:string"/>
        <xs:attribute name="name" use="required" type="xs:normalizedString"/>

and put in app\code\Hyva\Admin\view\adminhtml\templates\form\field\input my app\code\Pagespeedfr\CmsAcf\view\adminhtml\templates\form\field\input

Go in Content > Element > Hyvä Acf Form
 All good
 



