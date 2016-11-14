<?php

namespace Admin\LanguageBundle\Entity;

use Admin\LanguageBundle\Form\Entity\TranslationSearch;
use Doctrine\ORM\EntityRepository;

/**
 * TranslationRepository
 */
class TranslationRepository extends EntityRepository
{
    public function search(TranslationSearch $translationSearch)
    {
        $qb = $this->createQueryBuilder('translation')
            ->addSelect('term')
            ->leftJoin('translation.term', 'term')
            ->where('translation.language = :language_id')
            ->setParameter('language_id', $translationSearch->getLanguage()->getId());

        if ($translationSearch->getId()) {
            $qb->andWhere('translation.id = :search_id')
                ->setParameter('search_id', $translationSearch->getId());
        } else {

            if ($translationSearch->getValue()) {
                $qb->andWhere('translation.value like :search_value')
                    ->setParameter('search_value', '%' . $translationSearch->getValue() . '%');
            }

            if ($translationSearch->getTerm()) {
                $qb
                    ->andWhere('term.name like :search_term')
                    ->setParameter('search_term', '%' . $translationSearch->getTerm() . '%');
            }
        }

        $qbCount = clone $qb;

        $qbCount->select('count(translation.id)');

        return [
            $qb
                ->setFirstResult(($translationSearch->getPage() - 1) * TranslationSearch::PER_PAGE)
                ->setMaxResults(TranslationSearch::PER_PAGE)
                ->orderBy('term.name', 'ASC')
                ->addOrderBy('translation.value', 'ASC')
                ->getQuery()
                ->getResult(),
            ceil(
                $qbCount
                    ->getQuery()
                    ->getSingleScalarResult() / TranslationSearch::PER_PAGE
            )
        ];
    }

}
