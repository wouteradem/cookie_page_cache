<?php

namespace Drupal\cookie_page_cache_form_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\LocalRedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * A form to test cookie page cache.
 *
 * @internal
 */
class TestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cookie_page_cache_form_test';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#prefix'] = '<p>Please enter a cookie value to vary your content on!</p>';

    $form['cookie'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your favorite cookie.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $response = new LocalRedirectResponse($this->getRequest()->query->get('destination'));
    $response->headers->setCookie(new Cookie($form['cookie']['#value'], TRUE, 0, '/', NULL, FALSE, FALSE));
  }

}