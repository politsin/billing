<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Billing account entities.
 *
 * @ingroup billing
 */
class BillingAccountListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build['table'] = [
      '#type' => 'table',
      '#header' => $this->buildHeader(),
      '#title' => $this->getTitle(),
      '#rows' => [],
      '#empty' => $this->t('There is no @label yet.', ['@label' => $this->entityType->getLabel()]),
      '#cache' => [
        'contexts' => $this->entityType->getListCacheContexts(),
        'tags' => $this->entityType->getListCacheTags(),
      ],
    ];
    $sum = 0;
    foreach ($this->load() as $entity) {
      $sum = $sum + $entity->amount->value;
      if ($row = $this->buildRow($entity)) {
        $build['table']['#rows'][$entity->id()] = $row;
      }
    }
    $build['table']['#rows']['itogo'] = [
      'id' => "",
      'name' => $this->t('Itogo'),
      'entity_type' => "",
      'entity_id' => "",
      'changed' => "",
      'amount' => [
        'class' => 'text-align-right',
        'data' => $sum,
      ],
    ];

    // Only add the pager if a limit is specified.
    if ($this->limit) {
      $build['pager'] = [
        '#type' => 'pager',
      ];
    }
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['name'] = $this->t('Name');
    $header['entity_type'] = $this->t('Type');
    $header['entity_id'] = $this->t('E Id');
    $header['changed'] = $this->t('Update');
    $header['amount'] = [
      'class' => 'text-align-right',
      'data' => $this->t('Amount'),
    ];
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\billing\Entity\BillingAccount */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.billing_account.canonical',
      ['billing_account' => $entity->id()]
    );
    $row['entity_type'] = $entity->entity_type->value;
    $row['entity_id'] = $entity->entity_id->value;
    $row['changed'] = format_date($entity->changed->value, 'middle');
    $row['amount'] = [
      'class' => 'text-align-right',
      'data' => $entity->amount->value,
    ];
    return $row + parent::buildRow($entity);
  }

}
