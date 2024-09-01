<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m240824_175406_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'patronymic' => $this->string(),
        ]);

        $this->addCommentOnTable('{{%authors}}', 'Авторы');
        $this->addCommentOnColumn('{{%authors}}', 'surname', 'Фамилия');
        $this->addCommentOnColumn('{{%authors}}', 'name', 'Имя');
        $this->addCommentOnColumn('{{%authors}}', 'patronymic', 'Отчество');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }
}
