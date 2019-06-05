<?php


namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    private const CATEGORIES =[
        'footballeur',
        'chanteur',
        'actrice',
        'tenniswoman',
        'tennisman',
        'golfeur'
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key=>$categoryName) {
            $category = new category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categorie_'.$key, $category);

        }
        $manager->flush();
    }
}