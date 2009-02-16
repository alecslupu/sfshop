<?php

/**
 * Subclass for representing a row from the 'products' table.
 *
 *
 *
 * @package plugins.sfsProductPlugin.lib.model
 */
class Product extends BaseProduct
{
    protected $hasOptions = null;

   /**
    * Gets thumbnail object for current product.
    *
    * @param  string $type
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getThumbnail($thumbnailType)
    {
        return ThumbnailPeer::retrieveByTypeAndAssetId($thumbnailType, $this->getId(), get_class($this));
    }

   /**
    * Gets brand optin for product with translation.
    *
    * @param  object $con
    * @return object
    * @author Dmitry Nesteruk
    * @access public
    */
    public function getBrand(PropelPDO $con = null)
    {
        if ($this->getBrandId() !== null) {

            $criteria = new Criteria();
            $criteria->add(BrandPeer::ID, $this->getBrandId());
            list($brand) = BrandPeer::doSelectWithTranslation($criteria);
            return $brand;
        }
        else {
            return null;
        }
    }

    public function setCategoryId($categoryId)
    {
        $this->save();

        $c = new Criteria();
        $c->addAnd(Product2CategoryPeer::PRODUCT_ID, $this->getId(), Criteria::EQUAL);
        foreach (Product2CategoryPeer::doSelect($c) as $p2c) {
            $p2c->delete();
        }

        $p2c = new Product2Category();
        $p2c->setProductId($this->getId());
        $p2c->setCategoryId($categoryId);
        $p2c->save();
    }

    public function getCategoryId()
    {
        $c = new Criteria();
        $c->addAnd(Product2CategoryPeer::PRODUCT_ID, $this->getId(), Criteria::EQUAL);

        if (($p2c = Product2CategoryPeer::doSelectOne($c)) !== null) {
            return $p2c->getCategoryId();
        }
        return null;
    }

    public function __toString()
    {
    	return $this->getTitle();
    }
}

xfPropelBehavior::register('Product', array('ProductSearchGroup'));

