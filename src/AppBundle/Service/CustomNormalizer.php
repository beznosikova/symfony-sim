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
}