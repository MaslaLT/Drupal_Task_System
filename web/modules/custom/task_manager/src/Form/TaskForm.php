<?php

namespace Drupal\task_manager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;


/**
 * Class TaskForm
 *
 * @package Drupal\task_manager\Form
 */
class TaskForm extends FormBase {

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
    //Getting developer users list from DB
    $database = Database::getConnection();
    $query = $database->select('user__roles', 'ur');
    $query->condition('roles_target_id', 'developer', '=');
    $query->join('users_field_data', 'ufd', 'ur.entity_id = ufd.uid');
    $query->addField('ufd', 'name');
    $seniorUserNames = $query->execute()->fetchCol();
    $ucFirstDevNames = array_map('ucfirst', $seniorUserNames);

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
    $form['assigned_for'] = [
      '#type' => 'select',
      '#title' => $this->t('Junior Developer Name'),
      '#options' => $ucFirstDevNames,
      '#empty_option' => $this->t('-select-'),
      '#description' => $this->t('Junior developers name. Task is assigned for.')
    ];

    // Time given to complete a task in hours.
    $form['time_given_senior'] = [
      '#type' => 'number',
      '#title' => $this->t('Time Senior Needs'),
      '#description' => $this->t('Time needed for senior developer to complete Hours.'),
    ];

    // Time given to complete a task in hours.
    $form['time_given_junior'] = [
      '#type' => 'number',
      '#title' => $this->t('Time Junior Needs'),
      '#description' => $this->t('Time needed for junior developer to complete Hours.'),
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
      '#value' => $this->t('Create Task'),
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
    dump($values);
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
