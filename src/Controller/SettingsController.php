<?php
namespace App\Controller;

use App\Service\Router;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\SettingsType;

class SettingsController extends AbstractController
{
    public function getSettings(string $service, Router $router): Response
    {
        $microservice = $router->handle($service);
        if ($microservice === false) {
            throw $this->createNotFoundException('The settings for this microservice does not exist');
        }

        $settings = $microservice->get();
        return $microservice->makeResponse($settings);
    }

    public function setSettings(string $service, Router $router, Request $request)
    {
        $microservice = $router->handle($service);
        if ($microservice === false) {
            throw $this->createNotFoundException('The settings for this microservice does not exist');
        }

        $settings = $microservice->get();
        $form = $this->createForm(SettingsType::class);
        $form->get('settings')->setData(json_encode($settings));

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $settings = $microservice->set($request);
            return $microservice->makeResponse($settings);
        }

        return $this->renderForm('settings.html.twig', [
            'form' => $form,
        ]);
    }
}
