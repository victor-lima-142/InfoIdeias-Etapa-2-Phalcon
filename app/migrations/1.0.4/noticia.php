<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class NoticiaMigration_104
 */
class NoticiaMigration_104 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('noticia', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'titulo',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 500,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'texto',
                        [
                            'type' => Column::TYPE_TEXT,
                            'after' => 'titulo'
                        ]
                    ),
                    new Column(
                        'data_ultima_atualizacao',
                        [
                            'type' => Column::TYPE_DATETIME,
                            'after' => 'texto'
                        ]
                    ),
                    new Column(
                        'data_cadastro',
                        [
                            'type' => Column::TYPE_DATETIME,
                            'after' => 'data_ultima_atualizacao'
                        ]
                    ),
                    new Column(
                        'publicado',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 1,
                            'after' => 'data_cadastro'
                        ]
                    ),
                    new Column(
                        'data_publicado',
                        [
                            'type' => Column::TYPE_DATETIME,
                            'after' => 'publicado'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('PRIMARY', ['id'], 'PRIMARY')
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '18',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'latin1_swedish_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
