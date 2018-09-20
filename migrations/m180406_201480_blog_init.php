<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use yii\db\Migration;
use yii\db\Schema;

/**
 * CLass m141208_201480_blog_init
 * @package akiraz2\blog\migrations
 *
 * Create blog tables.
 *
 * Will be created 4 tables:
 * - `{{%blog_category}}` - Blog category
 * - `{{%blog_post}}` -
 * - `{{%blog_comment}}` -
 * - `{{%blog_tag}}` -
 */
class m180406_201480_blog_init extends Migration
{
    use \akiraz2\blog\traits\ModuleTrait;

    /**
     * @inheritdoc
     */
    public function up()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // table blog_category
        $this->createTable(
            '{{%blog_category}}',
            [
                'id' => Schema::TYPE_PK,
                'parent_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'title' => Schema::TYPE_STRING . '(255) NOT NULL',
                'slug' => Schema::TYPE_STRING . '(128) NOT NULL',
                'banner' => Schema::TYPE_STRING . '(255) ',
                'is_nav' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
                'sort_order' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 50',
                'page_size' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 10',
                'template' => Schema::TYPE_STRING . '(255) NOT NULL DEFAULT "post"',
                'redirect_url' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
                'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('is_nav', '{{%blog_category}}', 'is_nav');
        $this->createIndex('sort_order', '{{%blog_category}}', 'sort_order');
        $this->createIndex('status', '{{%blog_category}}', 'status');
        $this->createIndex('created_at', '{{%blog_category}}', 'created_at');


        // table blog_post
        $this->createTable(
            '{{%blog_post}}',
            [
                'id' => Schema::TYPE_PK,
                'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'title' => Schema::TYPE_STRING . '(255) NOT NULL',
                'brief' => Schema::TYPE_TEXT,
                'content' => Schema::TYPE_TEXT . ' NOT NULL',
                'tags' => Schema::TYPE_STRING . '(255) NOT NULL',
                'slug' => Schema::TYPE_STRING . '(128) NOT NULL',
                'banner' => Schema::TYPE_STRING . '(255) ',
                'click' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'user_id' => Schema::TYPE_INTEGER . '',
                'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('category_id', '{{%blog_post}}', 'category_id');
        $this->createIndex('status', '{{%blog_post}}', 'status');
        $this->createIndex('created_at', '{{%blog_post}}', 'created_at');

        // Foreign Keys
        $this->addForeignKey('{{%FK_post_category}}', '{{%blog_post}}', 'category_id', '{{%blog_category}}', 'id', 'CASCADE', 'CASCADE');
        if ($this->getModule()->userModel) {
            $userClass = $this->getModule()->userModel;
            $this->addForeignKey('{{%FK_post_user}}', '{{%blog_post}}', 'user_id', $userClass::tableName(), $this->getModule()->userPK, 'CASCADE', 'CASCADE');
        }


        // table blog_comment
        $this->createTable(
            '{{%blog_comment}}',
            [
                'id' => Schema::TYPE_PK,
                'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'content' => Schema::TYPE_TEXT . ' NOT NULL',
                'author' => Schema::TYPE_STRING . '(128) NOT NULL',
                'email' => Schema::TYPE_STRING . '(128) NOT NULL',
                'url' => Schema::TYPE_STRING . '(128) NULL',
                'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('post_id', '{{%blog_comment}}', 'post_id');
        $this->createIndex('status', '{{%blog_comment}}', 'status');
        $this->createIndex('created_at', '{{%blog_comment}}', 'created_at');

        // Foreign Keys
        $this->addForeignKey('{{%FK_comment_post}}', '{{%blog_comment}}', 'post_id', '{{%blog_post}}', 'id', 'CASCADE', 'CASCADE');


        // table blog_tag
        $this->createTable(
            '{{%blog_tag}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . '(128) NOT NULL',
                'frequency' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('frequency', '{{%blog_tag}}', 'frequency');

        // Add super-administrator
        //$this->execute($this->getUserSql());
        //$this->execute($this->getProfileSql());
    }

    /**
     * @return string SQL to insert first user
     */
    private function getUserSql()
    {
        $time = time();
        $password_hash = Yii::$app->security->generatePasswordHash('admin12345');
        $auth_key = Yii::$app->security->generateRandomString();
        $token = Security::generateExpiringRandomString();
        return "INSERT INTO {{%users}} (`username`, `email`, `password_hash`, `auth_key`, `token`, `role`, `status_id`, `created_at`, `updated_at`) VALUES ('admin', 'admin@demo.com', '$password_hash', '$auth_key', '$token', 'superadmin', 1, $time, $time)";
    }

    /**
     * @return string SQL to insert first profile
     */
    private function getProfileSql()
    {
        return "INSERT INTO {{%profiles}} (`user_id`, `name`, `slug`) VALUES (1, 'Administration', 'Site')";
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%blog_tag}}');
        $this->dropTable('{{%blog_comment}}');
        $this->dropTable('{{%blog_post}}');
        $this->dropTable('{{%blog_category}}');
    }
}
