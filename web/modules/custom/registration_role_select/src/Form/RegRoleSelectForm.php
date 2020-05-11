<?php

namespace Drupal\registration_role_select\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for configuration of Registration_role_select module.
 *
 * @package Drupal\registration_role_select\RegRoleSelectForm
 */
class RegRoleSelectForm extends FormBase {

  /**
   * Form name.
   *
   * @inheritDoc
   */
  public function getFormId() {
    return 'registration_role_select_form';
  }

  /**
   * Form render elements.
   *
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['role_select'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Role select'),
    ];
    return $form;
    // TODO: Implement buildForm() method.
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

};
