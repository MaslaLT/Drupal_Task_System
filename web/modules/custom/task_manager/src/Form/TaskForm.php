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
    $query->addField('ufd', 'uid');
    $developerUserNames = $query->execute()->fetchAllKeyed(1, 0);
    $upCaseDeveloperUserNames = array_map("ucfirst", $developerUserNames);

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
      '#options' => $upCaseDeveloperUserNames,
      '#empty_option' => $this->t('-select-'),
      '#description' => $this->t('Junior developers name. Task is assigned for.'),
    ];

    // Time given to complete a task in hours.
    $form['time_needs_senior'] = [
      '#type' => 'number',
      '#title' => $this->t('Time Senior Needs'),
      '#description' => $this->t('Time needed for senior developer to complete Hours.'),
    ];

    // Time given to complete a task in hours.
    $form['time_needs_junior'] = [
      '#type' => 'number',
      '#title' => $this->t('Time Junior Needs'),
      '#description' => $this->t('Time needed for junior developer to complete Hours.'),
    ];

    // Tasks list.
    $form['task'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Task details'),
      '#description' => $this->t('Enter task details here'),
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
    $currentUser = \Drupal::currentUser()->id();
    $entity = \Drupal::entityTypeManager()->getStorage('task')
      ->create([
        'title' => $form_state->getValue('title'),
        'url' => $form_state->getValue('url'),
        'assigned_for' => $form_state->getValue('assigned_for'),
        'time_needs_senior' => $form_state->getValue('time_needs_senior'),
        'time_needs_junior' => $form_state->getValue('time_needs_junior'),
        'task' => $form_state->getValue('task'),
        'created_by' => $currentUser,
        'status' => 'To do',
        'time_spent' => 0,
      ]);
    \Drupal::messenger()->addMessage(t('Task %task is successful added.', ['%task' => $form_state->getValue('title')]));
    $entity->save();
  }

}
