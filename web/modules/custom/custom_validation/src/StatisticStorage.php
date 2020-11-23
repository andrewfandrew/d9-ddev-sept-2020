<?php

namespace Drupal\custom_validation;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\custom_validation\Entity\StatisticInterface;

/**
 * Defines the storage handler class for Statistic entities.
 *
 * This extends the base storage class, adding required special handling for
 * Statistic entities.
 *
 * @ingroup custom_validation
 */
class StatisticStorage extends SqlContentEntityStorage implements StatisticStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(StatisticInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {statistic_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {statistic_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(StatisticInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {statistic_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('statistic_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
