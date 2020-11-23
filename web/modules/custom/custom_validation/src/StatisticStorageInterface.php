<?php

namespace Drupal\custom_validation;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface StatisticStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Statistic revision IDs for a specific Statistic.
   *
   * @param \Drupal\custom_validation\Entity\StatisticInterface $entity
   *   The Statistic entity.
   *
   * @return int[]
   *   Statistic revision IDs (in ascending order).
   */
  public function revisionIds(StatisticInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Statistic author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Statistic revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\custom_validation\Entity\StatisticInterface $entity
   *   The Statistic entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(StatisticInterface $entity);

  /**
   * Unsets the language for all Statistic with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
