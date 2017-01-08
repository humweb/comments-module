<?php

namespace Humweb\Modules\Comments;

use Humweb\Module\AbstractModule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Module extends AbstractModule
{
    public $name = 'Comments';
    public $version = '1.0';
    public $author = 'Ryun Shofner';
    public $website = 'humboldtweb.com';
    public $license = 'BSD-3-Clause';
    public $description = 'Comments Module';
    public $autoload = ['routes.php'];

    public function install()
    {

        //Check if it does not exists
        //log install errors
        if (Schema::hasTable('comments')) {
            //
        } else {
            Schema::create('comments', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('commentable_id');
                $table->string('commentable_type');
                $table->integer('user_id')->index();
                $table->text('body');
                $table->timestamps();
                $table->index(array('commentable_id', 'commentable_type'));
            });
        }

        return true;
    }
    public function upgrade()
    {
        return true;
    }

    public function uninstall($opts = [])
    {
        Schema::drop('comments');

        return true;
    }

    public function admin_menu()
    {
        return [
            'Content' => [
                [
                    // 'label' => 'Tags',
                    // 'url' => '/admin/tags',
                    // 'children' => [
                    // 	['label' => 'New Tag', 'url' => '/admin/tags/create']
                    // ]
                ],
            ],
        ];
    }

    // public function admin_quick_menu()
    // {
    // 	return [
    // 		'index' => [
    // 			['label' => 'Add Page', 'url' => '/admin/pages/create']
    // 		]
    // 	];
    // }
}
