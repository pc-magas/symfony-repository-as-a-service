<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use AppBundle\Repository\ItemRepository;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request,ItemRepository $item)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
          'items'=>$item->findAll()
        ]);
    }

    /**
    * @Route("/add", name="add_item")
    * @Method("POST")
    */
    public function addItemAction(Request $request,ItemRepository $item)
    {
      $name=$request->get('name');
      try{
        $itemToAdd=$item->add($name);
        return $this->redirect($this->generateUrl('homepage'));
      } catch(Exception $e){
        return new Response("Error Occured",Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }
}
