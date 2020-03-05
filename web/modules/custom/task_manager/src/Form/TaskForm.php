<?php

namespace Drupal\task_creation_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SimpleForm
 *
 * @package Drupal\task_creation_form\Form
 */
class SimpleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'task_creation_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    //Task description
    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('This form is used to create new tasks for Junior Developers')
    ];

    //Task title
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#size' => 30,
      '#maxlength' => 128,
      '#description' => $this->t('Enter Task Title'),
    ];

    //Task url
    $form['url'] = [
      '#type' => 'url',
      '#title' => $this->t('Task URL Link'),
      '#maxlength' => 255,
      '#size' => 30,
      '#description' => $this->t('Enter Task URL'),
    ];

    //Senior developer name who created task.
    $form['author'] = [
      '#type' => 'select',
      '#title' => $this->t('Tech/Senior Name'),
      '#options' => [
        'petras' => 'Petras',
        'jonas' => 'Jonas',
        'domas' => 'Domas',
      ],
      '#empty_option' => $this->t('-select-'),
      '#description' => $this->t('Senior developer name who created task')
    ];

    // Time given to complete a task in hours.
    $form['time_given'] = [
      '#type' => 'number',
      '#title' => $this->t('Time given'),
      '#description' => $this->t('Time given to complete a task in hours.'),
    ];

    // Tasks list.
    $form['task'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Task'),
      '#description' => $this->t('Enter task here'),
    ];

    // Submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#description' => $this->t('Submit a task'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();
    foreach ($values as $key => $value) {
      $label = isset($form[$key]['#title']) ? $form[$key]['#title'] : $key;

      // Many arrays return 0 for unselected values so lets filter that out.
      if (is_array($value)) {
        $value = array_filter($value);
      }

      // Only display for controls that have titles and values.
      if ($value && $label) {
        $display_value = is_array($value) ? preg_replace('/[\n\r\s]+/', ' ', print_r($value, 1)) : $value;
        $message = $this->t('Value for %title: %value', ['%title' => $label, '%value' => $display_value]);
        $this->messenger()->addMessage($message);
      }
    }
  }

}
