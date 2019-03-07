<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Flex\Response;

/**
 * @Route("/api")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }
    /**
     * @Route("/{page}", name="list_product", defaults={"page": 5}, requirements={"page"="\d+"})
     */
    public function list($page = 1, Request $request)
    {
        $limit = $request->get('limit',10);
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $item = $repository->findAll();
        return $this->json(
            [
                'page' => $page,
                'limit' => $limit,
                'data' => array_map(function (Product $item){
                    return $this->generateUrl('product_by_name',['name' => $item->getName()]);
                },$item)
            ]
        );
    }
    /**
     * @Route("/product/{id}", name="product_by_id",requirements={"id":"\d+"}, methods={"GET"})
     */
    public function product(Product $product)
    {
       return $this->json($product);
    }
    /**
     * @Route("/product/{Name}", name="product_by_name", methods={"GET"})
     */
    public function productByName(Product $product)
    {
       return $this->json($product);
    }
    /**
     * @Route("/add", name="creating_product", methods={"POST"})
     */
    public function add(Request $request)
    {
        /** @var Serializer $serializer */
        $serializer = $this->get('serializer');

        $product = $serializer->deserialize($request->getContent(),Product::class,'json');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->json($product);
    }
    /**
     * @Route("/update/{id}", name="updating_product")
     * Method({"GET", "PUT"})
     */
    public function update(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
          throw $this->createNotFoundException('No product found for id '.$id);
        }
       $product->setName($request->get('Name'));
       $product->setPrice($request->get('Price'));
       $entityManager->flush();
       // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
       return new JsonResponse(null, Response::HTTP_OK);
    }
    /**
     * @Route("/product/{id}", name="deleting_product", methods={"DELETE"})
     */
    public function delete(Product $product)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

}
