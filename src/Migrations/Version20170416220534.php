<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170416220534 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX facebook_profile_email_address ON facebook_profiles');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX facebook_profile_email_address ON facebook_profiles (email_address)');
    }
}
