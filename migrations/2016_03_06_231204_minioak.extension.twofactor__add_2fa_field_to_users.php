<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class MinioakExtensionTwofactorAdd2faFieldToUsers extends Migration
{
    protected $delete = false;
    
    protected $namespace = 'users';
    
    protected $prefix = 'users_';
    
    protected $stream = [
      'slug' => 'users'  
    ];
    
    protected $fields = [
        'twofa_secret' => [
            'type' => 'minioak.field_type.twofa',
            'locked' => false,
            'namespace' => 'users'
        ]
    ];
    
    protected $assignments = [
        'twofa_secret'
    ];
}
