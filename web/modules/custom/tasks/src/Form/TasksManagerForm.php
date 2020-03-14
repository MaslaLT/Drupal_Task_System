<?php

namespace Drupal\tasks\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the tasks manager entity edit forms.
 */
class TasksManagerForm extends ContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New tasks manager %label has been created.', $message_arguments));
      $this->logger('tasks')->notice('Created new tasks manager %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The tasks manager %label has been updated.', $message_arguments));
      $this->logger('tasks')->notice('Updated new tasks manager %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.tasks_manager.canonical', ['tasks_manager' => $entity->id()]);
  }

}
