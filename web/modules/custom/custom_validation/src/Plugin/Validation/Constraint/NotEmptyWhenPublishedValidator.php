<?php
## Filename: custom_validation/src/Plugin/Validation/Constraint
# /NotEmptyWhenPublishedValidator.php

namespace Drupal\custom_validation\Plugin\Validation\Constraint;

use Drupal\Core\Entity\EntityPublishedInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the NotEmptyWhenPublished constraint.
 */
class NotEmptyWhenPublishedValidator extends ConstraintValidator {

  /**
   * {@inheritdoc }
   */
  public function validate($value, Constraint $constraint) {
    /** @var \Drupal\Core\Entity\ContentEntityInterface $entity */
    $entity = $this->context->getRoot()->getValue();
    if (
      // If the entity can be published.
      $entity instanceof EntityPublishedInterface &&
      $entity->isPublished() &&
      $value->isEmpty()
    ) {
      $this->context->addViolation($constraint->needsValue, [
        '%field' => $value->getFieldDefinition()->getLabel(),
      ]);
    }
  }
}
