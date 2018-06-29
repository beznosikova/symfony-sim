<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ApiController extends Controller
{
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
        $customNormalizer = $this->get('custom.normalizer');
        return new JsonResponse($customNormalizer->categoriesNormalize($categories, $serializer));
    }

    /**
     * @Route("/api/pages/")
     */
    public function apiPages(SerializerInterface $serializer)
    {
        $pages = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Page')
            ->findBy(['active'=>true], ['sort' => 'ASC'])
        ;

        return new JsonResponse($serializer->normalize($pages));
    }

    /**
     * @Route("/api/links/")
     */
    public function apiLinks(SerializerInterface $serializer)
    {
        $pagesObject = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Page')
            ->findBy(['active'=>true], ['sort' => 'ASC'])
        ;
        $pages = $serializer->normalize($pagesObject);

        $categoriesObject = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findByProductsExisting()
        ;
        $customNormalizer = $this->get('custom.normalizer');
        $categories = $customNormalizer->categoriesNormalize($categoriesObject, $serializer);

        return new JsonResponse(compact('pages', 'categories'));
    }
}
