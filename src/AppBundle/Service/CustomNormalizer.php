<?php

namespace AppBundle\Service;

class CustomNormalizer
{
    public function productsNormalize($products, $serializer, $provider): array
    {
        $productsArray = [];
        foreach ($products as $product){
            $image = $product->getImage();
            $productArray = $serializer->normalize($product, null, [
                'attributes' => [
                    'id',
                    'title',
                    'description',
                    'active',
                    'reserve',
                    'alias',
                    'price',
                    'category' => ['title'],
                    'image' => ['name']
                ]
            ]);
            if ($image){
                $productArray['image']['url'] = $provider->generatePublicUrl($image, 'reference');
            }
            $productsArray[] = $productArray;
        }
        return $productsArray;
    }

    public function categoriesNormalize($categories, $serializer): array
    {
        $categoriesArray = [];
        foreach ($categories as $category){
            $categoryArray = $serializer->normalize($category, null, [
                'attributes' => [
                    'id',
                    'title',
                    'description',
                    'alias',
                    'active',
                    'sort',
                    'mainCategory' => ['id', 'title'],
                ]
            ]);
            if (!isset($categoryArray['mainCategory']['id'])){
                $categoriesArray[$categoryArray['id']] = $categoryArray;
            } else {
                $categoriesArray[$categoryArray['mainCategory']['id']]['subCategories'][] = $categoryArray;
            }

        }
        foreach ($categoriesArray as &$category){
            if (!isset($category['id']) && !empty($category['subCategories'])){
                reset($category['subCategories']);
                $firstElement = current($category['subCategories']);
                $category = array_merge($category, $firstElement['mainCategory']);
            }
        }
        return $categoriesArray;
    }
}