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

    $this->languages = sfConfig::get('app_cultures_enabled', []);

    $languageCodes = array_keys($this->languages);
    $this->embedI18n($languageCodes);
    foreach($this->languages as $languageCode => $languageName)
    {
      $this->widgetSchema[$languageCode]->setLabel($languageName);
      $this->widgetSchema[$languageCode]['content'] = new sfWidgetFormTextareaTinyMCE(['theme' => 'modern']);
      // Leaving commented code for further usage once i18n issues with URLs is resolved
//      $this->validatorSchema[$languageCode]['url'] = new sfValidatorAnd(
//          [
//              $this->validatorSchema[$languageCode]['url'],
//              new sfValidatorRegex(['pattern' => '/^\S+$/'], ['invalid' => 'Your URL contains spaces. Please remove them first.'])
//          ]
//      );
      // End of commented code
    }
  }
}
