<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ApiController extends Controller
{
    /**
     * @Route("/api/products/", defaults={"page" = "1"})
     * @Route("/api/products/{page}/", requirements={"page"="\d+"})
     */
//    public function apiIndex(SerializerInterface $serializer)
//    {
//        $products = $this
//            ->getDoctrine()
//            ->getRepository('AppBundle:Product')
//            ->findActive()
//        ;
//
//        $customNormalizer = $this->get('custom.normalizer');
//        $provider = $this->container->get('sonata.media.provider.file');
//        $productsArray = $customNormalizer->productsNormalize($products, $serializer, $provider);
//
//        return new JsonResponse($productsArray);
//    }

    /**
     * @Route("/api/products/{category_alias}/", defaults={"page" = "1"})
     * @Route("/api/products/{category_alias}/{page}/", requirements={"page"="\d+"})
     */
    public function apiProductsByCategory($category_alias, $page, SerializerInterface $serializer)
    {
        $category = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findActiveByAlias($category_alias)
        ;

        if (!$category){
            throw $this->createNotFoundException();
        }

        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findByCategoryByPage($category, $page)
        ;

        $customNormalizer = $this->get('custom.normalizer');
        $provider = $this->container->get('sonata.media.provider.file');

        return new JsonResponse($customNormalizer->productsNormalize($products, $serializer, $provider));
    }

    /**
     * @Route("/api/categories/")
     */
    public function apiCategories(SerializerInterface $serializer)
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findByProductsExisting()
        ;

        return new JsonResponse($serializer->normalize($categories));
    }
}
