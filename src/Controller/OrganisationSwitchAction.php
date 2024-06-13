<?php

declare(strict_types=1);

namespace App\Controller;

use App\Context\CustomerContext;
use App\Storage\OrganisationStorageInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class OrganisationSwitchAction
{
    public function __construct(private readonly CustomerContext $customerContext, private readonly OrganisationStorageInterface $organisationStorage)
    {
    }

    public function __invoke(Request $request, string $code): Response
    {
        $customer = $this->customerContext->getCustomer();

        $this->organisationStorage->set($customer, $code);

        return new RedirectResponse($request->headers->get('referer', $request->getSchemeAndHttpHost()));
    }
}
