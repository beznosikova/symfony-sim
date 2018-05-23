<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findBy(['active'=>true], ['price' => 'ASC'])
        ;

        return compact('products');
    }

    /**
     * @Route("/products/{alias}", name="product_page")
     * @Template()
     */
    public function showAction($alias)
    {
        $product = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findActiveByAlias($alias)
        ;
        dump($product);

        if (!$product){
            throw $this->createNotFoundException();
        }

        return compact('product');
    }


    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        return $this->redirectToRoute('product_list');
        // return new JsonResponse($array, 500);
    }    
}
