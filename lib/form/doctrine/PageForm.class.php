<?php

/**
 * Page form.
 *
 * @package    shop
 * @subpackage form
 * @author     Dmitriy
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PageForm extends BasePageForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at']);
    $this->validatorSchema['url'] = new sfValidatorAnd(
        [
            $this->validatorSchema['url'],
            new sfValidatorRegex(['pattern' => '/^\S+$/'], ['invalid' => 'Your URL contains spaces. Please remove them first.'])
        ]
    );
    $this->widgetSchema['content'] = new sfWidgetFormTextareaTinyMCE(['theme' => 'modern']);
  }
}
