<?php

namespace MusicStation\SiteBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ExceptionListener
{
    protected $templating;
    protected $kernel;

    public function __construct($templating, $kernel)
    {
        $this->templating = $templating;
        $this->kernel = $kernel;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ('prod' == $this->kernel->getEnvironment()) {
            // exception object
            $exception = $event->getException();

            // new Response object
            $response = new Response();

            // set response content
            $response->setContent(
                $this->templating->render('MusicStationSiteBundle:Exception:exception.html.twig')
            );

            // HttpExceptionInterface is a special type of exception that
            // holds status code and header details
            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } else {
                $response->setStatusCode(500);
            }

            // set the new $response object to the $event
            $event->setResponse($response);
        }
    }
}