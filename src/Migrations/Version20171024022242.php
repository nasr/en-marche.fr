<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20171024022242 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE mailjet_emails RENAME emails');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE emails RENAME mailjet_emails');
    }
}
