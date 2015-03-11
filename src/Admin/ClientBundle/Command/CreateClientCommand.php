<?php

namespace Admin\ClientBundle\Command;

use Admin\ClientBundle\Entity\Client;
use Admin\ClientBundle\Entity\DBRole;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClientCommand extends ContainerAwareCommand
{
    /**
     * @return Registry
     */
    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

    protected function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function configure()
    {
        $this
            ->setName('client:create')
            ->setDescription('Create a user')
            ->addOption('email', 'u', InputOption::VALUE_REQUIRED, 'client email')
            ->addOption('password', 'p', InputOption::VALUE_REQUIRED, 'client password')
            ->addOption('domain', 'd', InputOption::VALUE_REQUIRED, 'client domain')
            ->addOption('db_role', 'dr', InputOption::VALUE_REQUIRED, 'client database role')
            ->addOption('role', 'r', InputOption::VALUE_REQUIRED, 'client role (should be one of ' . implode(', ', Client::getUserRoles()) . ')');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getOption('email');

        if (!$email) {
            /** @noinspection ThrowRawExceptionInspection */
            throw new \InvalidArgumentException('Client email is required');
        }

        $password = $input->getOption('password');

        if (!$password) {
            throw new \InvalidArgumentException('Client password is required');
        }

        $domain = $input->getOption('domain');

        if (!$domain) {
            throw new \InvalidArgumentException('Client domain is required');
        }

        $db_role = $input->getOption('db_role');

        if (!$db_role) {
            throw new \InvalidArgumentException('Client database role is required');
        }

        $role = $input->getOption('role');

        if (!$role) {
            throw new \InvalidArgumentException('Client role is required');
        }

        $role = strtoupper($role);

        if (!in_array($role, Client::getUserRoles(), true)) {
            throw new \InvalidArgumentException('Client role should be one of ' . implode(', ', Client::getUserRoles()));
        }

        try {
            /** @var DBRole $dbRole */
            $dbRole = $this->getManager()->getRepository('AdminClientBundle:DBRole')->findOneBy(
                [
                    'role' => $db_role,
                    'domain' => $domain
                ]);

            if (!$dbRole) {
                $dbRole = new DBRole();

                $dbRole
                    ->setDomain($domain)
                    ->setRole($db_role);

                $this->getManager()->persist($dbRole);
            }

            $client = $this->getManager()->getRepository('AdminClientBundle:Client')->findOneBy(
                [
                    'email' => $email,
                    'db_role' => $dbRole->getId()
                ]);

            if (!$client) {
                $client = new Client();

                $client
                    ->setDbRole($dbRole)
                    ->setEmail($email)
                    ->setPassword($password)
                    ->setRole($role)
                    ->setRegDtm(new \DateTime())
                    ->setRegIp('127.0.0.1');

                $dbRole->addClient($client);

                $this->getManager()->persist($client);
            } else {
                throw new \LogicException('Client already exists');
            }

            $this->getManager()->flush();
        } catch (\Exception $e) {
            throw new \LogicException('Cannot create user: ' . $e->getMessage());
        }
    }

}