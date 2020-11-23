<?php

namespace Drupal\custom_validation\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\custom_validation\Entity\StatisticInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class StatisticController.
 *
 *  Returns responses for Statistic routes.
 */
class StatisticController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->dateFormatter = $container->get('date.formatter');
    $instance->renderer = $container->get('renderer');
    return $instance;
  }

  /**
   * Displays a Statistic revision.
   *
   * @param int $statistic_revision
   *   The Statistic revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($statistic_revision) {
    $statistic = $this->entityTypeManager()->getStorage('statistic')
      ->loadRevision($statistic_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('statistic');

    return $view_builder->view($statistic);
  }

  /**
   * Page title callback for a Statistic revision.
   *
   * @param int $statistic_revision
   *   The Statistic revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($statistic_revision) {
    $statistic = $this->entityTypeManager()->getStorage('statistic')
      ->loadRevision($statistic_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $statistic->label(),
      '%date' => $this->dateFormatter->format($statistic->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Statistic.
   *
   * @param \Drupal\custom_validation\Entity\StatisticInterface $statistic
   *   A Statistic object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(StatisticInterface $statistic) {
    $account = $this->currentUser();
    $statistic_storage = $this->entityTypeManager()->getStorage('statistic');

    $langcode = $statistic->language()->getId();
    $langname = $statistic->language()->getName();
    $languages = $statistic->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $statistic->label()]) : $this->t('Revisions for %title', ['%title' => $statistic->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all statistic revisions") || $account->hasPermission('administer statistic entities')));
    $delete_permission = (($account->hasPermission("delete all statistic revisions") || $account->hasPermission('administer statistic entities')));

    $rows = [];

    $vids = $statistic_storage->revisionIds($statistic);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\custom_validation\StatisticInterface $revision */
      $revision = $statistic_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $statistic->getRevisionId()) {
          $link = $this->l($date, new Url('entity.statistic.revision', [
            'statistic' => $statistic->id(),
            'statistic_revision' => $vid,
          ]));
        }
        else {
          $link = $statistic->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => $this->renderer->renderPlain($username),
              'message' => [
                '#markup' => $revision->getRevisionLogMessage(),
                '#allowed_tags' => Xss::getHtmlTagList(),
              ],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.statistic.translation_revert', [
                'statistic' => $statistic->id(),
                'statistic_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('entity.statistic.revision_revert', [
                'statistic' => $statistic->id(),
                'statistic_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.statistic.revision_delete', [
                'statistic' => $statistic->id(),
                'statistic_revision' => $vid,
              ]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['statistic_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
