<?php

/*
 * This file has been created by developers from BitBag. 
 * Feel free to contact us once you face any issues or want to start
 * another great project. 
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl. 
 */

declare(strict_types=1);

namespace BitBag\SyliusElasticsearchPlugin\Controller\Action\Shop;

use BitBag\SyliusElasticsearchPlugin\Controller\RequestDataHandler\DataHandlerInterface;
use BitBag\SyliusElasticsearchPlugin\Finder\FinderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ListProductsAction
{
    /**
     * @var DataHandlerInterface
     */
    private $shopProductListDataHandler;

    /**
     * @var FinderInterface
     */
    private $shopProductsFinder;

    /**
     * @param DataHandlerInterface $shopProductListDataHandler
     * @param FinderInterface $shopProductsFinder
     */
    public function __construct(
        DataHandlerInterface $shopProductListDataHandler,
        FinderInterface $shopProductsFinder
    )
    {
        $this->shopProductListDataHandler = $shopProductListDataHandler;
        $this->shopProductsFinder = $shopProductsFinder;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $data = $this->shopProductListDataHandler->retrieveData($request);
        $result = $this->shopProductsFinder->find($data);

        return new JsonResponse($result);
    }
}