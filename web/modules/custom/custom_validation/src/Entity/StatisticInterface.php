<?php

namespace Drupal\custom_validation\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Statistic entities.
 *
 * @ingroup custom_validation
 */
interface StatisticInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Statistic name.
   *
   * @return string
   *   Name of the Statistic.
   */
  public function getName();

  /**
   * Sets the Statistic name.
   *
   * @param string $name
   *   The Statistic name.
   *
   * @return \Drupal\custom_validation\Entity\StatisticInterface
   *   The called Statistic entity.
   */
  public function setName($name);

  /**
   * Gets the Statistic creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Statistic.
   */
  public function getCreatedTime();

  /**
   * Sets the Statistic creation timestamp.
   *
   * @param int $timestamp
   *   The Statistic creation timestamp.
   *
   * @return \Drupal\custom_validation\Entity\StatisticInterface
   *   The called Statistic entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the Statistic revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Statistic revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\custom_validation\Entity\StatisticInterface
   *   The called Statistic entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Statistic revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Statistic revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\custom_validation\Entity\StatisticInterface
   *   The called Statistic entity.
   */
  public function setRevisionUserId($uid);

}
