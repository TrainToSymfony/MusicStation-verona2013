<?php
namespace MusicStation\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

//use Symfony\Component\HttpFoundation\Request;

use MusicStation\UserBundle\Entity\Artist;
use MusicStation\UserBundle\Entity\Event;
use MusicStation\UserBundle\Entity\Shout;

class ImportArtistsCommand extends ContainerAwareCommand
{
    private $input;
    private $output;
    private $em;

    /**
     * Configure Command
     */
    protected function configure()
    {
        $this
            ->setName('musicstation:load_fixtures')

            ->setDescription('Load fixtures')

            ->setHelp(<<<EOF
The <info>musicstation:load_artists:fixtures</info> command loads some fixtures, storing them in database.

  <info>php app/console musicstation:load_artists:fixtures</info>

<error>Attention:</error> every table in database will be TRUNCATED before being populated
EOF
        );
    }

    /**
     * Execute the command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');

        // load fixtures from configuration
        $fixturesArtists = $this->getContainer()->getParameter('fixture_artists');

        $this->input = $input;
        $this->output = $output;

        // truncate table before importing
        $this->truncateTables();

        // import fistures in database
        foreach ($fixturesArtists as $name => $info) {
            $this->insertArtist($name, $info);
        }
    }

    /**
     * truncate tables
     */
    private function truncateTables()
    {
        $tablesToBeTruncated = array('Artist', 'Event', 'Shout', 'fos_user');

        $connection = $this->em->getConnection();
        $platform   = $connection->getDatabasePlatform();

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tablesToBeTruncated as $table) {
            $truncateSql = $platform->getTruncateTableSQL($table);
            $connection->executeUpdate($truncateSql);
        }

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * insert an artist in database
     *
     * @param $name
     * @param array $info
     */
    private function insertArtist($name, $info = array())
    {
        $artist = new Artist();

        $artist->setName($name);
        $artist->setBio($info['bio']);
        $artist->setImage($info['image']);

        // insert events
        $this->insertEvents($artist, $info);

        // insert shouts
        $this->insertShouts($artist, $info);

        // create linked User entity
        $this->linkUser($artist, $info);


        $this->em->persist($artist);
        $this->em->flush();
    }

    /**
     * insert events for an artist
     *
     * @param $artist
     * @param array $info
     */
    private function insertEvents($artist, $info = array())
    {
        foreach ($info['events'] as $infoEvent) {
            $event = new Event();

            $event->setLocation($infoEvent['location']);
            $event->setStartDate(new \DateTime($infoEvent['startDate']));

            $event->setArtist($artist);

            $artist->addEvent($event);
        }
    }

    /**
     * insert shout for an artist
     *
     * @param $artist
     * @param array $info
     */
    private function insertShouts($artist, $info = array())
    {
        foreach ($info['shouts'] as $message) {
            $shout = new Shout();

            $shout->setMessage($message);

            $shout->setArtist($artist);

            $artist->addShout($shout);
        }
    }

    /**
     * create a new User entity and link it with $artist
     *
     * @param $artist
     * @param array $info
     */
    private function linkUser($artist, $info = array())
    {
        $userManager = $this->getContainer()->get('fos_user.user_manager');

        $user = $userManager->createUser();

        $user->setUsername($info['user']['username']);
        $user->setPlainPassword($info['user']['password']);
        $user->setEmail("{$info['user']['username']}@musicstation.com");
        $user->setEnabled(true);

        $userManager->updateUser($user);

        $user->setArtist($artist);
    }
}