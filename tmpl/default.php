<?php

// no direct access
defined( '_JEXEC' ) or die();

foreach ($contacts as $i => $contact) :

// var_dump($contact);

$contactPage = JRoute::_("index.php?option=com_contact&view=contact&id=" . $contact->id);
?>

<div class="fl-contact <?php echo $moduleclass_sfx; ?>">

	<?php if ($show->image && $contact->image != '') :		
		$thumb = '<img src="thumbs/' . $params->get('thumb_width') . 'x' . $params->get('thumb_height') . '/' . $contact->image . '" alt="' . $contact->name . '">';
		?>
		<?php if ($params->get('link_image') == 'contact_page') : ?>
			<a class="fl-contact-thumb" href="<?php echo $contactPage; ?>"><?php echo $thumb; ?></a>
		<?php elseif ($params->get('link_image') == 'full_image') : ?>
			<a class="fl-contact-thumb" href="<?php echo $contact->image; ?>" data-uk-lightbox><?php echo $thumb; ?></a>
		<?php else : ?>
			<?php echo $thumb; ?>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ($show->name) : ?>
		<?php if ($params->get('link_name')) : ?>
			<a class="fl-contact-name" href="<?php echo $contactPage; ?>"><?php echo $contact->name; ?></a>
		<?php else : ?>
			<span class="fl-contact-name"><?php echo $contact->name; ?></span>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ($show->webpage && $contact->webpage != '') :
		if ($webpage_text != '')
			{
				$webpage_text = JText::_($webpage_text);
			}
		else
			{
				$webpage_text = parse_url($contact->webpage)['host'];
			}	
	?>
		<a class="fl-contact-webpage" href="<?php echo $contact->webpage; ?>" target="_blank"><?php echo $webpage_text; ?></a>
	<?php endif; ?>

	<?php if ($show->con_position && $contact->con_position != '') : ?>
		<span class="fl-contact-position"><?php echo $contact->con_position; ?></span>
	<?php endif; ?>
	
	<?php if ($show->postcode && $contact->postcode != '') : ?>
		<span class="fl-contact-postcode"><?php echo $contact->postcode; ?></span>, 
	<?php endif; ?>
	
	<?php if ($show->country && $contact->country != '') : ?>
		<span class="fl-contact-country"><?php echo $contact->country; ?></span>, 
	<?php endif; ?>
	
	<?php if ($show->state && $contact->state != '') : ?>
		<span class="fl-contact-state"><?php echo $contact->state; ?></span>, 
	<?php endif; ?>
	
	<?php if ($show->suburb && $contact->suburb != '') : ?>
		<span class="fl-contact-suburb"><?php echo $contact->suburb; ?></span>, 
	<?php endif; ?>	
	
	<?php if ($show->address && $contact->address != '') : ?>
		<span class="fl-contact-address"><?php echo $contact->address; ?></span>
	<?php endif; ?>

	<?php	if ($show->telephone && $contact->telephone != "") : ?>
		<span class="fl-contact-phone"><a href="tel:<?php echo preg_replace($phoneRegExp,'',$contact->telephone); ?>" class="fl-contact-phone"><i class="uk-icon-phone uk-margin-small-right"></i><?php echo $contact->telephone; ?></a></span>	
	<?php endif; ?>

	<?php	if ($show->mobile && $contact->mobile != "") : ?>
		<span class="fl-contact-phone"><a href="tel:<?php echo preg_replace($phoneRegExp,'',$contact->mobile); ?>" class="fl-contact-mobile info_mobile"><i class="uk-icon-phone uk-margin-small-right"></i><?php echo $contact->mobile; ?></a></span>
	<?php endif; ?>
	
	<?php	if ($show->fax && $contact->fax != "") : ?>
		<span class="fl-contact-phone"><a href="tel:<?php echo preg_replace($phoneRegExp,'',$contact->fax); ?>" class="fl-contact-fax info_fax"><i class="uk-icon-fax uk-margin-small-right"></i><?php echo $contact->fax; ?></a></span>
	<?php endif; ?>
	
	<?php if ($show->email_to && $contact->email_to != ""):
		if ($email_text != '')
		{
			$email=JHTML::_('email.cloak', $contact->email_to, true, JText::_($email_text), false);
		}
		else
		{
			$email=JHTML::_('email.cloak', $contact->email_to, true );
		}
	?>
		<span class="contact-email" ><?php echo $email; ?></span>
	<?php endif; ?>

	<?php	if ($show->vcard): ?>
		<span class="fl-contact-vcard">
			<i class="uk-icon-card uk-margin-small-right"></i>
			<a class="fl-contact-vcard-link" href="<?php echo JRoute::_($contactPage . "&format=vcf"); ?>"><?php echo JText::_('MOD_FLCONTACTINFO_VCARD'); ?></a>
		</span>
	<?php endif; ?>
	
	<?php	if ($show->links): ?>
		<span class="contact-links">
			<?php
				$contactParams = json_decode($contact->params, true);
				foreach (range('a', 'e') as $char) :
					$link = $contactParams['link' . $char];
					$label = $contactParams['link' . $char . '_name'];
					
					if (!$link) :
						continue;
					endif;
					
					// Add 'http://' if not present
					$link = (0 === strpos($link, 'http')) ? $link : 'http://' . $link;

					// Add class icon as domain name
					$host = parse_url($link)['host'];
					$class = explode('.',$host);
					$s = count($class);
					$class = ($s >= 2) ? $class[$s-2] : '';
					
					// If no label is present, take the link
					$label = $label ? $label : $host;
					?>
					<span><a class="url" href="<?php echo $link; ?>" title="<?php echo $label; ?>"><i class="site-<?php echo $class; ?> uk-icon-button uk-icon-external-link"></i></a></span>
				<?php endforeach; ?>
			</span>
	<?php endif; ?>
	
	<?php if ($show->button && $button_href != ""): ?>
	<div class="uk-margin-small-top">
		<a class="uk-button uk-button-secondary fl-shadow-reset" href="<?php $params->get('button_href'); ?>" data-uk-modal><?php echo $button_text; ?></a>
	</div>
	<?php endif; ?>
	
</div>

<?php	endforeach; ?>
