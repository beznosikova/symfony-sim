<?php

namespace AppBundle\Controller;

use App\Utils\CustomNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends Controller
{
    /**
     * @Route("/products/", name="product_list")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findActive()
        ;

        return compact('products');
    }

    /**
     * @Route("/products/{alias}/", name="product_page")
     * @Template()
     */
    public function showAction($alias, SerializerInterface $serializer)
    {
        $product = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findActiveByAlias($alias)
        ;

        if (!$product){
            throw $this->createNotFoundException();
        }

        dump($product);

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $jsonContent = $serializer->normalize($product, null, [
            'attributes' => [
                'id',
                'title',
                'category' => ['title'],
                'image' => ['name']
            ]
        ]);
        dump($jsonContent);
//        $provider = $this->container->get('sonata.media.provider.file');
//        $media = $product->getImage();

//        dump($provider->getReferenceImage($media));
//        dump($provider->getReferenceFile($media));
//        dump($provider->generatePublicUrl($media, 'reference'));
//        dump($provider->getHelperProperties($media, 'reference'));
//        dump($provider->getCdn());

        return compact('product');
    }

    /**
     * @Route("/{category_alias}/", name="product_by_category")
     * @Template()
     */
    public function listByCategoryAction($category_alias)
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
            ->findByCategory($category)
        ;

        return compact('products', 'category');
    }

    /**
     * @Route("/api/products/", name="product_api")
     */
    public function apiIndex(SerializerInterface $serializer)
    {
        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findActive()
        ;

        $customNormalizer = $this->get('custom.normalizer');
        $provider = $this->container->get('sonata.media.provider.file');
        $productsArray = $customNormalizer->productsNormalize($products, $serializer, $provider);

        return new JsonResponse($productsArray);
    }


    /**
     * @Route("/test", name="test")
     */
/*    public function testAction()
    {
        return $this->redirectToRoute('product_list');
        // return new JsonResponse($array, 500);
    }    */
}
