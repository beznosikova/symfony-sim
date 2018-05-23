<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        $array = ['a'=>'fff', 'b'=>'bbb', 'c'=>'ccc'];
        return new JsonResponse($array);
    }    
}
