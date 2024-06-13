<?php

declare(strict_types=1);

namespace App\Twig;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ProjectExtension extends AbstractExtension
{
    public function __construct(private readonly RepositoryInterface $projectRepository)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('app_get_project', [$this, 'getProject']),
        ];
    }

    public function getProject($projectId)
    {
        return $this->projectRepository->find($projectId);
    }
}