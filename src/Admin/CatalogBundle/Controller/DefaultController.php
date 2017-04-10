<?php

namespace Admin\CatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Admin\CatalogBundle\Entity\VerminRepository
     */
    public function getVerminRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Vermin');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\VerminCategoryRepository
     */
    public function getVerminCategoryRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:VerminCategory');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\EntomophageRepository
     */
    public function getEntomophageRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Entomophage');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\EntomophageCategoryRepository
     */
    public function getEntomophageCategoryRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:EntomophageCategory');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\ProviderRepository
     */
    public function getProviderRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Provider');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\ManufacturerRepository
     */
    public function getManufacturerRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Manufacturer');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\ChemistryCategoryRepository
     */
    public function getChemistryCategoryRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:ChemistryCategory');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\ChemistryRepository
     */
    public function getChemistryRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Chemistry');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\CultureRepository
     */
    public function getCultureRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Culture');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\CultureManufacturerRepository
     */
    public function getCultureManufacturerRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:CultureManufacturer');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\Variety
     */
    public function getVarietyRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Variety');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\SubstrateCategory
     */
    public function getSubstrateCategoryRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:SubstrateCategory');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\SubstrateCategoryManufacturer
     */
    public function getSubstrateCategoryManufacturerRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:SubstrateCategoryManufacturer');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\Substrate
     */
    public function getSubstrateRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Substrate');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\BlightRepository
     */
    public function getBlightRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:Blight');
    }

    /**
     * @return \Admin\CatalogBundle\Entity\BlightCategoryRepository
     */
    public function getBlightCategoryRepository()
    {
        return $this->getDoctrine()->getRepository('AdminCatalogBundle:BlightCategory');
    }
}
