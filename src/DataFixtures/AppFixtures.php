<?php

namespace App\DataFixtures;


use App\Factory\CategoryFactory;
use App\Factory\CommentFactory;
use App\Factory\PostFactory;
use App\Factory\UserFactory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CategoryFactory::createMany(8);
        UserFactory::createMany(8);

        PostFactory::createMany(40, function() {
            return [
                'comments' => CommentFactory::new()->many(0,10),
                'category' => CategoryFactory::random(),
                'user' => UserFactory::random(),
            ];
        });
    }
}
