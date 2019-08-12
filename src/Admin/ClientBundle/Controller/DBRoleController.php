<?php

namespace Admin\ClientBundle\Controller;

use Admin\ClientBundle\Entity\DBRole;
use Admin\ClientBundle\Form\DBRoleType;
use Doctrine\DBAL\Driver\PDOStatement;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * DBRole controller.
 *
 * @Route("/admin/db_role")
 */
class DBRoleController extends DefaultController
{

    /**
     * @Route(
     *     path="/",
     *     name="db_role",
     *     methods={"GET"}
     * )
     * @Template("@AdminClient/DBRole/index.html.twig")
     * @return array
     */
    public function indexAction()
    {
        $roles = $this->getDBRoleRepository()
            ->createQueryBuilder('dr')
            ->orderBy('dr.role', 'ASC')
            ->getQuery()
            ->getResult();

        return [
            'roles' => $roles,
        ];
    }

    /**
     * @Route(
     *     path="/delete/{id}",
     *     name="db_role_delete",
     *     methods={"GET", "POST", "DELETE"}
     * )
     * @ParamConverter("dbRole", class="AdminClientBundle:DBRole")
     * @param DBRole $dbRole
     * @return RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteAction(DBRole $dbRole)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $con = $em->getConnection()->getWrappedConnection();

        $em->remove($dbRole);

        $stmt = $con->prepare("DROP SCHEMA IF EXISTS {$dbRole->getRole()} CASCADE");
        $stmt->execute();

        $stmt = $con->prepare("DROP ROLE {$dbRole->getRole()}");
        $stmt->execute();

        $em->flush();

        return $this->redirect($this->generateUrl('db_role'));
    }

    /**
     * @Route(
     *     path="/add",
     *     name="db_role_add",
     *     methods={"GET", "POST"}
     * )
     * @Template("@AdminClient/DBRole/edit.html.twig")
     */
    public function addAction()
    {
        $dbRole = new DBRole();

        $form = $this->createForm(
            DBRoleType::class,
            $dbRole,
            [
                'error_bubbling' => true,
            ]
        );

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="db_role_edit",
     *     methods={"GET", "POST"}
     * )
     * @ParamConverter("dbRole", class="AdminClientBundle:DBRole")
     * @Template("@AdminClient/DBRole/edit.html.twig")
     * @param Request $request
     * @param DBRole $dbRole
     * @return array
     */
    public function editAction(Request $request, DBRole $dbRole)
    {
        return [
            'form' => $this->createForm(DBRoleType::class, $dbRole)->createView(),
        ];
    }

    /**
     * @Route(
     *     path="/update/{id}",
     *     defaults={"id" = null},
     *     name="db_role_update",
     *     methods={"POST"}
     * )
     * @ParamConverter("dbRole", class="AdminClientBundle:DBRole")
     * @Template("@AdminClient/DBRole/edit.html.twig")
     * @param Request $request
     * @param DBRole $dbRole
     * @return array
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateAction(Request $request, DBRole $dbRole = null)
    {
        if (!$dbRole) {
            $dbRole = new DBRole();
        }

        $oldRole = clone $dbRole;

        $form = $this->createForm(DBRoleType::class, $dbRole);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $con = $em->getConnection()->getWrappedConnection();

            if ($dbRole->getId()) {
                $em->merge($dbRole);

                /** @var PDOStatement $stmt */
                if ($oldRole->getRole() != $dbRole->getRole()) {
                    $stmt = $con->prepare("ALTER ROLE {$oldRole->getRole()} RENAME TO {$dbRole->getRole()}");
                    $stmt->execute();

                    $stmt = $con->prepare("ALTER IF NOT EXISTS SCHEMA {$oldRole->getRole()} RENAME TO {$dbRole->getRole()}");
                    $stmt->execute();
                }
                if ($dbRole->getPassword()) {
                    $stmt = $con->prepare("ALTER ROLE {$dbRole->getRole()} WITH PASSWORD {$dbRole->getPassword()}");
                    $stmt->execute();
                }
            } else {
                $em->persist($dbRole);
                /** @var PDOStatement $stmt */
                $stmt = $con->prepare("CREATE ROLE {$dbRole->getRole()} WITH LOGIN IN ROLE farming_group PASSWORD '{$dbRole->getPassword()}'");
                $stmt->execute();
                $stmt = $con->prepare("CREATE SCHEMA {$dbRole->getRole()}");
                $stmt->execute();
                $stmt = $con->prepare("GRANT ALL ON SCHEMA {$dbRole->getRole()} TO {$dbRole->getRole()}");
                $stmt->execute();
            }

            $em->flush();

        }

        return [
            'form' => $form->createView(),
        ];
    }
}
