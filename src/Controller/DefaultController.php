<?php
namespace App\Controller;

use App\Service\Memory;
use App\Service\Storage;
use App\Service\System;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $system = System::all();

        $memory = Memory::proc();

        $storage = Storage::get();

        return $this->render('index.html.twig', [
            'system'    => $system,
            'memory'    => $memory,
            'storage'   => $storage,
        ]);
    }

}
