<?php

/**
 * PageTranslation form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PageTranslationForm extends BasePageTranslationForm
{
  public function configure()
  {
    $this->widgetSchema['content'] = new sfWidgetFormTextareaTinyMCE(['theme' => 'modern']);
  }
}
