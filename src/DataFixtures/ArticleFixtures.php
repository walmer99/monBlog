<?php


namespace App\DataFixtures;

use Faker;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface

{
    public function getDependencies()
    {
       return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');

        for ($i = 1; $i <= 50; $i++)
        {
        $article = new Article();
        $article->setTitle(mb_strtolower($faker->sentence()));
        $article->setContent(mb_strtolower($faker->text));
        $manager->persist($article);
        $article->setCategory($this->getReference('categorie_0'));
        }
        $manager->flush();
    }

}


