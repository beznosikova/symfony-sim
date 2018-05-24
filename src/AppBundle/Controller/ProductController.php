<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\JsonResponse;

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
    public function showAction($alias)
    {
        $product = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findActiveByAlias($alias)
        ;

        if (!$product){
            throw $this->createNotFoundException();
        }

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
     * @Route("/test", name="test")
     */
/*    public function testAction()
    {
        return $this->redirectToRoute('product_list');
        // return new JsonResponse($array, 500);
    }    */
}
