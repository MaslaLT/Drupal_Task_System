<?php

namespace Drupal\task_manager\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the task_manager entity edit forms.
 */
class TaskManagerForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New task_manager %label has been created.', $message_arguments));
      $this->logger('task_manager')->notice('Created new task_manager %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The task_manager %label has been updated.', $message_arguments));
      $this->logger('task_manager')->notice('Updated new task_manager %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.task_manager.canonical', ['task_manager' => $entity->id()]);
  }

}
