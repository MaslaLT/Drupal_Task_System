<?php

namespace Drupal\tasks\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\tasks\TasksManagerInterface;

class TimeSpent extends FormBase {

  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'time_spent_form';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state, TasksManagerInterface $tasks = null) {
    $taskId = $tasks->get('id')->getValue()[0]['value'];

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('This form is used to create new tasks for Junior Developers')
    ];

    $form['time_junior_spent'] = [
      '#type' => 'number',
      '#title' => $this->t('Time Junior Spent'),
      '#description' => $this->t('Time spent for this task in Hours.'),
    ];

    $form['task_id'] = [
      '#type' => 'hidden',
      '#value' => $taskId,
      '#title' => $this->t('Task id'),
      '#description' => $this->t('Task id'),
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Update'),
      '#description' => $this->t('Submit a time'),
    ];
    return $form;
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $haveEditPermissions = \Drupal::currentUser()->hasPermission('Edit tasks manager');
    $haveEnterTimePermissions = \Drupal::currentUser()->hasPermission('Enter time spent');
    $havePermissions = false;

    if($haveEditPermissions || $haveEnterTimePermissions) {
      $havePermissions = true;
    }

    $enteredTime = $form_state->getValue('time_junior_spent') ?? null;
    $taskId = $form_state->getValue('task_id');

    if($havePermissions && is_numeric($enteredTime)) {
      $entity = \Drupal::entityTypeManager()->getStorage('tasks_manager')
        ->load($taskId);
      $entity->set('time_spent', $form_state->getValue('time_junior_spent'));
      \Drupal::messenger()->addMessage(t('Task completion time successful added.'));
      $entity->save();
    }
  }
}
