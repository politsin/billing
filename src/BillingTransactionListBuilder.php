<?php

namespace Drupal\billing;

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
  public function buildHeader() {
    $header['id'] = $this->t('Billing transaction ID');
    $header['name'] = $this->t('Name');
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
      'entity.billing_transaction.edit_form',
      ['billing_transaction' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
