<?php

/**
 * Language actions.
 *
 * @package    shop
 * @subpackage Language
 * @author     Dmitriy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LanguageActions extends sfActions
{
  public function executeChangeLanguage(sfWebRequest $request)
  {
    // Get current user culture
    $oldCulture = $this->getUser()->getCulture();

    // Get enabled cultures from config
    $languages = sfConfig::get('app_cultures_enabled', []);
    $languageCodes = array_keys($languages);

    $form = new sfFormLanguageCustom(
      $this->getUser(),
      array('languages' => $languageCodes)
    );

    if(!$form->process($request)) {
      $this->getUser()->setFlash('warning', __('Language change failed. Please try again.'));

      // Redirecting to homepage by default
      $redirect = 'homepage';

      // If currentPage is provided but form is not valid. Redirect back to provided url.
      if ($this->hasRequestParameter("currentPage"))
      {
        $redirect = $request->getParameter("currentPage");
      }

      // Redirecting
      return $this->redirect($redirect);
    }

    // Get new user culture
    $newCulture = $this->getUser()->getCulture();

    return $this->redirect(str_replace('/'.$oldCulture.'/', '/'.$newCulture.'/', $request->getParameter("currentPage")));
  }
}
