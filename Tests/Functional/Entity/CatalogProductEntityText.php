<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\MagentoConnectorBundle\Tests\Functional\Entity;

use Doctrine\ORM\Mapping as ORM;
use ONGR\MagentoConnectorBundle\Entity\CatalogProductEntityText as ParentCatalogProductEntityText;

/**
 * Product text attributes entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="catalog_product_entity_text")
 */
class CatalogProductEntityText extends ParentCatalogProductEntityText
{
}
