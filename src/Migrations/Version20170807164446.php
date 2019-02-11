<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170807164446 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE events SET type = \'citizen_initiative\' WHERE type = \'initiative\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE events SET type = \'initiative\' WHERE type = \'citizen_initiative\'');
    }
}
