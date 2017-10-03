<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Billing transaction entities.
 *
 * @ingroup billing
 */
class BillingTransactionListBuilder extends EntityListBuilder {

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
    foreach ($this->load() as $entity) {
      if ($row = $this->buildRow($entity)) {
        $build['table']['#rows'][$entity->id()] = $row;
      }
    }

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
    $header['name'] = $this->t('Comment');
    $header['account'] = $this->t('Account');
    $header['reason'] = $this->t('Reason');
    $header['debit'] = [
      'class' => 'text-align-right',
      'data' => $this->t('Debit'),
    ];
    $header['credit'] = [
      'class' => 'text-align-right',
      'data' => $this->t('Credit'),
    ];
    $header['user'] = $this->t('User');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\billing\Entity\BillingTransaction */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.billing_transaction.canonical',
      ['billing_transaction' => $entity->id()]
    );
    $row['account'] = Link::createFromRoute(
      $entity->account_id->entity->label(),
      'entity.billing_account.canonical',
      ['billing_account' => $entity->account_id->entity->id()]
    );
    $row['reason'] = $entity->entity_type->value . "-" . $entity->entity_id->value;
    $row['debit'] = [
      'class' => 'text-align-right',
      'data' => $entity->debit->value,
    ];
    $row['credit'] = [
      'class' => 'text-align-right',
      'data' => $entity->credit->value,
    ];
    $row['user_id'] = Link::createFromRoute(
      $entity->getOwner()->label(),
      'entity.user.canonical',
      ['user' => $entity->getOwner()->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
